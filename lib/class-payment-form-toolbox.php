<?php
/**
 * Class payzenFormToolbox
 *
 */
class paymentFormToolbox {

    /**************** CLASS PROPERTIES **************/
    // Container for PayZen user's account informations
    public $account;
    public $debug;
    public $requiredfields;
    public $algorithm;

    //Container for certificate
    private $certificate;

    /**************** CLASS METHODS - PUBLIC **************/
    /**
     * Constructor, stores the PayZen user's account informations
     * @param $args array(
     *    $shopID => string, the account site id as provided by Payzen
     *    $certTest => string, certificate, test-version
     *    $certProd => string, certificate, production-version
     *    $ctxMode => string ("TEST" or "PRODUCTION"), the PayZen mode to operate
     *    $platform => string URL
     * )
     */
    public function __construct($args) {
        $shopID = (isset($args['shopID']))? $args['shopID'] : '';
        $certTest = (isset($args['certTest']))? $args['certTest'] : '';
        $certProd = (isset($args['certProd']))? $args['certProd'] : '';
        $ctxMode = (isset($args['ctxMode']))? $args['ctxMode'] : 'TEST';
        $platform = (isset($args['platform']))? $args['platform'] : '';
        $debug = (isset($args['debug']))? $args['debug'] : false;

        $this->required_fields = true;
        $warning = '';
        if (empty($shopID) || $shopID == '[***CHANGE-ME***]') {
            $warning .= '<h1>SITE ID missing in config/config.php </h1>';
            $this->required_fields = false;
        }
        if ($ctxMode == 'TEST' && (empty($certTest) || $certTest == '[***CHANGE-ME***]')) {
            $warning .= '<h1>Certificate (TEST) missing in config/config.php </h1>';
            $this->required_fields = false;
        }
        if ($ctxMode == 'PRODUCTION' && (empty($certProd) || $certProd == '[***CHANGE-ME***]')) {
            $warning .= '<h1>Certificate (PRODUCTION) missing in config/config.php </h1>';
            $this->required_fields = false;
        }
        if ( empty($platform) ||  $platform == '[***CHANGE-ME***]') {
            $warning .=  '<h1>Platform URL missing in config/config.php </h1>';
            $this->required_fields = false;
        }

        if($this->required_fields == false){
            echo '<pre>'.$warning.'</pre>';
        }
        $this->account = array(
            'vadsSiteId'        => $shopID,
            'ctxMode'           => $ctxMode,
            'platform'          => $platform
        );

        $this->certificate = ($ctxMode == 'PRODUCTION') ? $certProd : $certTest ;
        $this->debug = $debug;
    }

    /**
     * ParseArgs
     * Merge user defined arguments into defaults array.
     * @param  string|array|object $args     Value to merge with $defaults
     * @param  array|string $defaults Optional. Array that serves as the defaults. Default empty.
     *
     * @return array Merged user defined values with defaults.
     */
    public function ParseArgs( $args, $defaults = '' ) {
        if ( is_object( $args ) ){
            $r = get_object_vars( $args );
        } elseif ( is_array( $args ) ) {
            $r =& $args;
        } else {
            parse_str( $args, $r );
        }

        if ( is_array( $defaults ) ){
            return array_merge( $defaults, $r );
        }

        return $r;
    }

    /**
     * Main function, returns an array containing all mandatory
     * information needed to build an HTML form for an createPayment
     * request
     * @param $args array
     * @return array, the form data, as follow:
     *
     *  [form] => Array
     *      (
     *          [action] => PLATFORM_URL
     *          [method] => POST
     *          [accept-charset] => UTF-8
     *          [enctype] => multipart/form-data
     *      )
     *  [fields] => Array
     *      (
     *          [vads_site_id] => 12345678
     *          [vads_ctx_mode] => TEST || PRODUCTION
     *          [vads_trans_id] => 612435 //$transId string, an external transaction id
     *          [vads_trans_date] => 20151116183355
     *          [vads_amount] => 4300 //string, the amount of the payment
     *          [vads_currency] => 978 //string, the code of the currency to use
     *          [vads_action_mode] => INTERACTIVE
     *          [vads_page_action] => PAYMENT
     *          [vads_version] => V2
     *          [vads_payment_config] => SINGLE
     *          [vads_capture_delay] => 0
     *          [vads_validation_mode] => 0
     *          [signature] => 89d95486ac27addea254cf478fabf1d4a968266a
     *      )
     *
     */
    public function getFormData($args){
        return array(
            "form" => array(
                "action" => $this->account['platform'],
                "method" => "POST",
                "accept-charset" => "UTF-8",
                "enctype" => "multipart/form-data"
            ),
            "fields" => $this->getFormFields($args)
        );
    }

    /**
     * getFormFields
     * Utility function, returns all the mandatory data needed by a PayZen form payment
     * as an array
     *
     * @param  $args array|string override the default values
     *     $default_fields = array(
     * "vads_site_id" => $siteId,//8 digit
     * "vads_ctx_mode" => $this->account['ctxMode'],
     * "vads_trans_id" => substr(time(), -6), //6 digits - not necessarily a safe option as 2 payments can occur at the same second and therefore provide the same ID, you should prefix it for example with the customer ID.
     * "vads_trans_date" => gmdate('YmdHis'),
     * "vads_action_mode" => "INTERACTIVE",
     * "vads_page_action" => "PAYMENT",
     * "vads_version" => "V2",
     * "vads_capture_delay" => "0",
     * "vads_validation_mode" => "0",
     * "vads_return_mode"    => 'POST',
     * "vads_payment_config" => "SINGLE",
     * "vads_amount" => 1000,
     * "vads_currency" => 978
     * );
     * you can pass a string or array as a value, if you add an array with more information
     * you will need to pass the value like this :
     * "vads_site_id" => array('value' => 'YOUR_VALUE');
     *
     * @return array, the data to use in the fields of HTML payment form
     */
    public function getFormFields($args = '') {

        // Defaults arguments with mandatory fields
        $default_fields = array(
            "vads_site_id" => $this->account['vadsSiteId'],
            "vads_ctx_mode" => $this->account['ctxMode'],
            "vads_trans_id" => $this->getTransId(), // substr(time(), -6)
            "vads_trans_date" => gmdate('YmdHis'),
            "vads_action_mode" => "INTERACTIVE",
            "vads_page_action" => "PAYMENT",
            "vads_version" => "V2",
            "vads_capture_delay" => "0",
            "vads_validation_mode" => "0",
            "vads_return_mode"    => 'POST',
            "vads_payment_config" => "SINGLE",
            "vads_amount" => 1000,
            "vads_currency" => 978
        );

        /**
         * to calculate signature, extract value from optionnal field
         * merge with mandatory fields values
         */
        if(is_array($args)){
            //merge fields
            $form_data = $this->ParseArgs($args,$default_fields);
            //add values to args for signature calculation - make sure the are 'vads_' prefixed
            $form_data_signature = array();
            foreach($form_data as $arg => $value){
                if(substr($arg, 0, 5) == 'vads_'){
                    $data = (isset($value['value']) && is_array($value)) ? $value['value'] : $value ;
                    $form_data_signature[$arg] = $data;
                }
            }

        } else {
            $form_data = $default_fields;
            $form_data_signature = $default_fields;
        }

        $form_data['signature'] = $this->getSignature($form_data_signature);

        return $form_data;
    }



    /**
     * getSignature
     * computes the signature
     * @param $fields array fields to send in the payment form
     * @return string
     */
    public function getSignature($fields) {

        ksort($fields); //sorting fields alphabetically
        $signature_content  = "";
        foreach ($fields as $nom => $valeur) {
            if(substr($nom,0,5) == 'vads_') {
                // Concatenation with  "+"
                $signature_content  .= $valeur."+";
            }
        }
        // Adding the certificate at the end
        $signature_content .= $this->certificate;;
        // Applying SHA-1 algorithm if defined in shop
	    if($this->algorithm === 'sha1'){
		    return sha1($signature_content);
	    }
	    // Applying sha256 algorythm
	    return base64_encode(hash_hmac('sha256',$signature_content, $this->certificate, true));
    }

    /**
     * checkSignature
     * Signature control
     *
     * @param $fields
     * @return string
     */
    public function checkSignature($fields) {
        $signature= $this->getSignature($fields);
        if( isset($fields['signature']) && ($signature == $fields['signature'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * getIpnRequestData
     * previously sendIpnRequestData
     * Main fonction, checks the authenticity of the data received
     * during IPN request from PayZen plat-form
     *
     * @param $fields array, the data received from PayZen, usually the _POST PHP super-global
     *
     * @return array|bool
     */
    public function getIpnRequestData($fields) {

        $vads_data = $this->filterVadsData($fields);
        $signature_check = $this->getSignature($vads_data);
        if (@$fields['signature'] != $signature_check) {
            $msg = 'Signature mismatch';
            $output = array(
                'data'  => json_encode($fields),
                'msg'   => $msg
            );
            //throw new Exception('Signature mismatch'. json_encode($data));
            return $output;
        }
        return false;
    }

    /**
     * Utility function, filters out the useless fields
     *  for PayZen signature
     *
     * @param $fields array data received from PayZen
     * (typically $_POST)
     *
     * @return array, the data filtered
     */
    public function filterVadsData($fields) {
        $vads_fields = array();
        if ($fields && is_array($fields)) {
            foreach ($fields as $field => $value) {
                if(substr($field, 0, 5) == 'vads_'){
                    $vads_fields[$field] = $value;
                }
            }
        }
        return $vads_fields;
    }

    /**
     * Generate a trans_id.
     * fallback method
     * To be independent from shared/persistent counters, we use the number of 1/10 seconds since midnight which has the appropriate
     * format (000000-899999) and has great chances to be unique.
     *
     * @param int $timestamp
     * @return string the generated trans_id
     */
    public static function generateTransId($timestamp = null)
    {
        if (! $timestamp) {
            $timestamp = time();
        }

        $parts = explode(' ', microtime());
        $id = ($timestamp + $parts[0] - strtotime('today 00:00')) * 10;
        $id = sprintf('%06d', $id);

        return $id;
    }

    /**
     * getTransId
     * need the write access to trans_id/count - fallback on generateTransId
     * calculate vads_trans_id value
     * value is incremented eachtime, and reseted to 0 if > to 899999
     * @return string
     */
    public function getTransId() {

        // get file
        $filename = dirname(__FILE__) ."/trans_id/count"; // filePath
        if(!file_exists($filename) || !fopen($filename, 'r+')) {
            $trans_id = $this->generateTransId();
        } else {
            $handle = fopen($filename, 'r+') or die("Unable to open file!");;
            flock($handle, LOCK_EX);
            // read
            $count_init = intval(fread($handle, 6));
            $count_val = str_pad($count_init + 1, 6, 0, STR_PAD_LEFT);
            $count = substr($count_val,0,6);
            if($count < 0 || $count > 899999) {
                $count = 0;
            }
            // write & lock file
            if (fwrite($handle, $count) === FALSE) {
                // if we can't write to file
                $trans_id = $this->generateTransId();
            } else {
                // Sets the file position indicator to 0
                fseek($handle, 0);
                ftruncate($handle,0);
                rewind($handle);
                fwrite($handle, $count,6);
                flock($handle, LOCK_UN);
                fclose($handle);

                // Return the formatted string
                $trans_id = sprintf("%06d",$count);
            }

        }
        return $trans_id;
    }

    /***************************************
     * Handle RESPONSE
     **************************************/

    public function getIpn(){
        /**
         * mandatory : vads_hash & vads_url_check_src
         * date_default_timezone_set('Europe/Berlin');
         */
        if( isset($_POST['vads_trans_status'])){

            try {
                $this->getIpnRequestData($_POST);
            }catch(Exception $e) {
                $error_msg= '### ERROR - An exception raised during IPN PayZen process:';
                error_log($error_msg. ' '.$e);
                return $e;
            }

            return $this->theResponseData();
        } else {
            $response = 'missing arguments vads_trans_status';
            return $response;
        }
    }


    /**
     * theResponseData
     * @return mixed
     */
    public function theResponseData(){
        return $_POST;
    }
}
