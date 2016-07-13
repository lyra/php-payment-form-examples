<?php

/**
 * Class payzenFormToolbox
 *
 *
 */
class payzenFormToolbox {

  /**************** CLASS PROPERTIES **************/

  // Container for PayZen user's account informations
  public $account;

  // Container for shop user's account informations
  public $shopPlatForm = array();


  /**************** CLASS METHODS - PUBLIC **************/
  /**
   * Constructor, stores the PayZen user's account informations
   *
   * @param $siteId string, the account site id as provided by Payzen
   * @param $certTest string, certificate, test-version
   * @param $certProd string, certificate, production-version
   * @param $ctxMode string ("TEST" or "PRODUCTION"), the PayZen mode to operate
   * @param $platform string URL
   */
  public function __construct($siteId, $certTest, $certProd, $ctxMode, $platform) {

    if (empty($siteId) || $siteId == '[***CHANGE-ME***]') {
      echo _('please fill your site ID in').' lib/payzenBootstrap.php <br />';
      echo _('find some help on payzen.io');
      exit;
    }
    elseif ($ctxMode == 'TEST' && (empty($certTest) || $certTest == '[***CHANGE-ME***]')) {
      echo _('please fill your certificate (TEST-version) in').' lib/payzenBootstrap.php <br />';
      echo _('find some help on payzen.io');
      exit;
    }
    elseif ($ctxMode == 'PRODUCTION' && (empty($certProd) || $certProd == '[***CHANGE-ME***]')) {
      echo _('please fill your certificate (PRODUCTION) in').'lib/payzenBootstrap.php <br />';
      echo _('find some help on payzen.io');
      exit;
    }

    $this->account = array(
        'vadsSiteId' => $siteId,
        'cert'        => array(
            'TEST'        => $certTest,
            'PRODUCTION'  => $certProd
        ),
        'ctxMode'     => $ctxMode,
        'platform'    => $platform
    );
  }

  /**
   * parse_args
   * Merge user defined arguments into defaults array.
   * @param  string|array|object $args     Value to merge with $defaults
   * @param  array|string $defaults Optional. Array that serves as the defaults. Default empty.
   *
   * @return array Merged user defined values with defaults.
   */
  public function pz_parse_args( $args, $defaults = '' ) {
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
        "vads_trans_id" => $this->get_Trans_id(), // substr(time(), -6)
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
      $form_data = $this->pz_parse_args($args,$default_fields);
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

    $form_data['signature'] = $this->sign($form_data_signature);

    return $form_data;
  }



  /**
   * Utility function, builds and returns the signature string of the data
   *  being transmitted to the PayZen plat-form
   *
   * @param $vads_form array, array of data being signed
   *
   * @return String, the signature
   */
  public function sign(Array $vads_form) {
    // Choice between TEST and PRODUCTION certificates
    $cert = $this->account['cert'][$this->account['ctxMode']];
    ksort($vads_form);           // VADS values sorted by name, ascending order
    return sha1(                 // SHA1 encryption of ...
        implode('+', $vads_form)    // ... VADS array values joined with '+' ...
        . "+$cert"                  // ... concatenated with '+' and the certificate.
    );
  }


  /**
   * get_Signature
   * Calcul de la signature
   *
   * @param $field
   * @param $key
   * @return string
   */
  public function get_Signature($field,$key) {

    ksort($field); // tri des paramétres par ordre alphabétique
    $contenu_signature = "";
    foreach ($field as $nom => $valeur)
    {
      if(substr($nom,0,5) == 'vads_') {
        $contenu_signature .= $valeur."+";
      }
    }
    $contenu_signature .= $key;	// On ajoute le certificat à la fin de la chaîne.
    $signature = sha1($contenu_signature);

    return($signature);
  }

  /**
   * Check_Signature
   * Signature control
   *
   * @param $field
   * @param $key string
   * @return string
   */
  public function Check_Signature($field,$key) {

    $signature= $this->get_Signature($field,$key);
    if( isset($field['signature']) && ($signature == $field['signature'])) {
      return true;
    } else {
      return false;
    }

  }


  /**
   * Main fonction, checks the authenticity of the data received
   * during IPN request from PayZen plat-form
   *
   * @param $data array, the data received from PayZen, usually the _POST PHP super-global
   * @throws Exception if the authenticity data can't be established
   */
  public function checkIpnRequest($data) {

    $vads_data = $this->filterVadsData($data);
    $signature_check = $this->sign($vads_data);
    if (@$data['signature'] != $signature_check) {
      throw new Exception('Signature mismatch'. json_encode($data));
    }

  }


  /**
   * Main fonction, checks the authenticity of the data received
   * during IPN request from PayZen plat-form
   *
   * @param $data array, the data received from PayZen, usually the _POST PHP super-global
   *
   * @return array|bool
   */
  public function sendIpnRequestData($data) {

    $vads_data = $this->filterVadsData($data);
    $signature_check = $this->sign($vads_data);
    if (@$data['signature'] != $signature_check) {
      $msg = 'Signature mismatch';
      $output = array(
          'data'  => json_encode($data),
          'msg'   => $msg
      );
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
    $res = array();
    if ($fields && is_array($fields)) {
      foreach ($fields as $field => $value) {
        if(substr($field, 0, 5) == 'vads_'){
          $res[$field] = $value;
        }
      }
    }
    return $res;
  }

  /**
   * get_Trans_id
   * calculate vads_trans_id value
   * value is incremented eachtime, and reseted to 0 if > to 899999
   * @return string
   */
  public function get_Trans_id() {

    // get file
    $filename = dirname(__FILE__) ."/trans_id/count"; // filePath
    if(!file_exists($filename) || !fopen($filename, 'r+')) {
      $trans_id = substr(time(), -6);
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
        $trans_id = substr(time(), -6);
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
}
