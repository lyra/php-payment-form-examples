<?php

if (! class_exists('LyraPaymentProcessor', false)) {
    class LyraPaymentProcessor
    {
        private $config_parameters;
        private $required_fields = false;
        private $request;
        private $response;

        private $warning = '';
        private $logger;
        private $plugin_version = '1.0.0';


        private $std_payment_parameters = array();
        private $multi_payment_parameters = array();
        private $deferred_payment_parameters = array();

        /**************** CLASS METHODS - PUBLIC **************/
        /**
         * Constructor, stores the PayZen user's account informations
         * @param $config array(
         *    $site_id => string, the account site id as provided by Payzen
         *    $key_test => string, key, test-version
         *    $key_prod => string, key, production-version
         *    $ctx_mode => string ("TEST" or "PRODUCTION"), the PayZen mode to operate
         *    $platform_url => string URL
         *    $sign_algo => string signature algorihtm
         *    $debug => string debug mode
         * )
         */
        public function __construct($config = array(), $log_dir = './logs') {
            $this->setLogger($log_dir);

            if (isset($config) && is_array($config) && !empty($config)) {
                # set config parameters
                $this->setConfigParameters($config);
            }else{
                //Load config parameters from Config.php file
                $configuration = new  Config();
                $this->setConfigParameters($configuration->getConfigParams());
            }
        }

        public function setLogger($log_dir)
        {
            $this->logger = Logger::instance();
            if (!is_dir($log_dir)) {
                mkdir($log_dir);
            }
            $this->logger->__set('logfile', $log_dir . '/__vads-' . date('Y-m') . '.log');
        }

        public function setConfigParameters($config) {
            $this->required_fields =
                ((count(array_filter($config)) == count($config)) || (count(array_filter($config)) == count($config)-1) && !$config['debug'])
                ? true : false;

                if($this->required_fields){
                    $this->config_parameters = array();
                    $this->config_parameters['site_id'] = (isset($config['site_id']))? $config['site_id'] : '';
                    $this->config_parameters['key_test'] = (isset($config['key_test']))? $config['key_test'] : '';
                    $this->config_parameters['key_prod'] = (isset($config['key_prod']))? $config['key_prod'] : '';
                    $this->config_parameters['ctx_mode'] = (isset($config['ctx_mode']))? $config['ctx_mode'] : 'TEST';
                    $this->config_parameters['platform_url'] = (isset($config['platform_url']))? $config['platform_url'] : '';
                    $this->config_parameters['debug'] = (isset($config['debug']))? $config['debug'] : false;
                    $this->config_parameters['sign_algo'] = (isset($config['sign_algo']))? $config['sign_algo'] : Api::ALGO_SHA1;
                    $this->config_parameters['action_mode'] = (isset($config['action_mode']))? $config['action_mode'] : '';
                    $this->config_parameters['return_mode'] = (isset($config['return_mode']))? $config['return_mode'] : '';
                    $this->config_parameters['url_return'] = (isset($config['url_return']))? $config['url_return'] : '';

                    $this->required_fields = true;
                }else{
                    $this->warning .= '<h1>One of the config parameters is missing in config/Config.php </h1>';
                    $this->logger->write($this->warning);
                    echo '<pre>'.$this->warning.'</pre>';
                }
        }

        public function initRequest($order_info)
        {
            // Use our custom class to generate the HTML.
            $request = new Request();

            $params = $this->config_parameters;

            $this->logger->write('Generating payment form for order #' . $order_info['order_id'] . '.');

            // Admin configuration parameters.
            $config_params = array(
                'site_id', 'key_test', 'key_prod', 'ctx_mode', 'platform_url', 'available_languages',
                'capture_delay', 'validation_mode', 'payment_cards', 'redirect_enabled',
                'redirect_success_timeout', 'redirect_success_message', 'redirect_error_timeout', 'redirect_error_message', 'action_mode', 'return_mode', 'url_return','sign_algo'
            );

            foreach ($config_params as $name) {
                $value = key_exists($name, $params) ? $params[$name] : '';
                if (is_array($value)) {
                    $value = implode(';', $value);
                }

                $request->set($name, $value);
            }

            // Get the shop language code.
            $lang = strtolower($order_info['lang_code']);
            $order_info['language'] = Api::isSupportedLanguage($lang) ? $lang : 'en';

            // Order parameters.
            $request->setFromArray($order_info);

            //iframe mode
            if ($request->get('action_mode') === 'IFRAME') {
                // hide logos below payment fields
                $request->set('theme_config', '3DS_LOGOS=false;');

                // enable automatic redirection
                $request->set('redirect_enabled', '1');
                $request->set('redirect_success_timeout', '0');
                $request->set('redirect_error_timeout', '0');

                $return_url = $request->get('url_return');
                $sep = strpos($return_url, '?') === false ? '?' : '&';
                $request->set('url_return', $return_url.$sep.'content_only=1');
            }

            return $request;
        }

        public function prepareForm($order_info, $request)
        {
            //insert style
            $formContent = "";
            //include ($lang.'.php');
            $lang = isset($order_info['lang_code']) ? $order_info['lang_code'] : 'en';
            include '../lib/locale/'. $lang .'/messages.php';

            if ($this->config_parameters['debug']) {
                $formContent = '<html>';
                $formContent.= '<head>';
                $formContent.= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

                $formContent.= '<title style="align">' . $i18n['paymentform'] .'</title>';
                $formContent.= '<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>';
                $formContent.= '</head>';
                $formContent.= '<body style="padding: 10%;">';
                $formContent.= '<h1 style="text-align: center;">'. $i18n['paymentform']  .'</h1>';

                $form = $this->getDisplayRequestHtml($request, $i18n['sendform']);
                $submitScript = '';
                // Message to be shown when forwarding to payment platform.
                $msg = '';
            }else{
                $form = $request->getRequestHtmlFields();
                $submitScript = '<script type="text/javascript">window.onload = function(){document.payment_form.submit();};</script>';
                // Message to be shown when forwarding to payment platform.
                $msg = $i18n['redirect_message_defaut'];
            }

            //get html form
            $formContent .= '<form action="' . $request->get('platform_url') . '" method="POST" name="payment_form">';
            $formContent .= "\n";
            $formContent .= $form;
            $formContent .= "\n";
            $formContent .= '</form>';
            $formContent .= '<div style="text-align: center;">' . $msg . '</div>';
            $formContent .= $submitScript;
            $formContent .= '</body>';
            $formContent .= '</html>';
            return $formContent;
        }

        public function submitStandardPaymentForm($order_info) {
            if ($this->required_fields) {
                $request = $this->initRequest($order_info);

                // Log data that will be sent to payment gateway.
                $this->logger->write('Data to be sent to payment gateway : ' . print_r($request->getRequestFieldsArray(true /* To hide sensitive data. */), true));

                //get prepared form
                $formContent = $this->prepareForm($order_info, $request);

                Api::fn_echo($formContent);
            }
        }

        public function submitMultiPaymentForm($order_info, $params_multi) {
            if ($this->required_fields) {
                // Use our custom class to generate the HTML.
                $request = $this->initRequest($order_info);

                // set multi payment options
                $first = (isset($params_multi['first']) && $params_multi['first']) ?
                (int) (string) (($params_multi['first'] / 100) * $order_info['amount']) /* amount is in cents*/ : null;

                $request->setMultiPayment(null /* use already set amount */, $first, $params_multi['count'], $params_multi['period']);

                // Log data that will be sent to payment gateway.
                $this->logger->write('Data to be sent to payment gateway : ' . print_r($request->getRequestFieldsArray(true /* To hide sensitive data. */), true));

                //get prepared form
                $formContent = $this->prepareForm($order_info, $request);

                Api::fn_echo($formContent);
            }
        }

        /**
         * Return the HTML inputs of fields to send to the payment page.
         *
         * @request Request
         */
        public function getDisplayRequestHtml($request, $submit)
        {
            $fields = $request->getRequestFields();

            $html = '';
            foreach ($fields as $field) {
                if (! $field->isFilled()) {
                    continue;
                }
                $value = htmlspecialchars($field->getValue(), ENT_QUOTES, 'UTF-8');
                $html .= '<label style="width:50%" for="'. $field->getName() .'">'. $field->getName() .'</label><input style="width:100%" class="forminput" name="'. $field->getName() .'" value="'. $value .'" type="text" />';

                //$html .= sprintf($format, $field->getName(), $field->getName(), $field->getName(), $value);
                $html .= "<br>";
            }

            $html .= '<input class="forminput" type="submit" value="' . $submit . '"/>';
            return $html;
        }

        public function checkResponse($param = array())
        {
            // Load gateway response.
            $response = new Response(
                $param,
                $this->config_parameters['ctx_mode'],
                $this->config_parameters['key_test'],
                $this->config_parameters['key_prod'],
                $this->config_parameters['sign_algo']
                );

            $from_server = $response->get('hash') !== null;

            if (!$response->isAuthentified()) {
                $this->logger->write('Authentication failed: received invalid response with parameters: ' . print_r($param, true));
                $this->logger->write('Signature algorithm selected in module settings must be the same as one selected in gateway Back Office.');

                if ($from_server) {
                    $this->logger->write('IPN URL PROCESS END.');
                } else {
                    $this->logger->write('RETURN URL PROCESS END.');
                }
            }else{
                $this->logger->write($response->getLogMessage());
                if ($from_server) {
                    $this->logger->write('IPN URL PROCESS END.');
                } else {
                    $this->logger->write('RETURN URL PROCESS END.');
                }
            }

            return $response->isAuthentified();
        }
    }
}
