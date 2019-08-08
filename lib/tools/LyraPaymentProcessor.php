<?php

use Lyranetwork\Lyra\Api;
use Lyranetwork\Lyra\Request;
use Lyranetwork\Lyra\Response;

function autoloadSdk($className) {
    $filename = "../lyra-payment-form-sdk/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
function autoloadTools($className) {
    $filename = $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadSdk");
spl_autoload_register("autoloadTools");

require_once '../config/config.php';

function loadClasse($classe)
{
    require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

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
        public function __construct($config = array()) {
            $this->logger = Logger::instance();
            $log_dir = './logs';
            if (!is_dir($log_dir)) {
                mkdir($log_dir);
            }
            $this->logger->__set('logfile', $log_dir . '/__vads-' . date('Y-m') . '.log');

            if (isset($config) && is_array($config) && !empty($config)) {
                # set config parameters
                $this->setconfig_parameters($config);
            }else{
                //Load config parameters from config.php file

                $configuration = new ModuleConfiguration();
                $this->setconfig_parameters($configuration->getConfigParams());
            }
        }

        public function setLogger()
        {
            $logger = Logger::instance();
            $log_dir = 'logs/';
            if (!is_dir($log_dir)) {
                fn_mkdir($log_dir);
            }
            $logger->__set('logfile', $log_dir . '__vads-' . date('Y-m') . '.log');
        }
        public function setconfig_parameters($config) {
            $this->required_fields = (in_array( '[***CHANGE-ME***]', $config) ||
                        (count(array_filter($config)) == count($config))
                ) ? true : false;

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
                $this->warning .= '<h1>One of the config parameters is missing in config/config.php </h1>';
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
            $order_info['lang_code'] = Api::isSupportedLanguage($lang) ? $lang : 'en';

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

        public function submitStandardPaymentForm($order_info) {
            $request = $this->initRequest($order_info);

            // Log data that will be sent to payment gateway.
            $this->logger->write('Data to be sent to payment gateway : ' . print_r($request->getRequestFieldsArray(true /* To hide sensitive data. */), true));

            // Message to be shown when forwarding to payment platform.
            $msg = 'text_cc_processor_connection';

            //get html form
            $form_content = <<<EOT
        <form action="{$request->get('platform_url')}" method="POST" name="payment_form">
            {$request->getRequestHtmlFields()}
        </form>

        <div style="text-align: center;">{$msg}</div>

        <script type="text/javascript">
            window.onload = function() {
                document.payment_form.submit();
            };
        </script>
    </body>
</html>
EOT;
            Api::fn_echo($form_content);
        }

        public function submitMultiPaymentForm($order_info, $params_multi) {
            // Use our custom class to generate the HTML.
            $request = $this->initRequest($order_info);

            // set multi payment options
            $first = (isset($params_multi['first']) && $params_multi['first']) ?
            (int) (string) (($params_multi['first'] / 100) * $order_info['amount']) /* amount is in cents*/ : null;

            $request->setMultiPayment(null /* use already set amount */, $first, $params_multi['count'], $params_multi['period']);

            // Log data that will be sent to payment gateway.
            $this->logger->write('Data to be sent to payment gateway : ' . print_r($request->getRequestFieldsArray(true /* To hide sensitive data. */), true));

            // Message to be shown when forwarding to payment platform.
            $msg = 'text_cc_processor_connection';

            //get html form
            $form_content = <<<EOT
        <form action="{$request->get('platform_url')}" method="POST" name="payment_form">
            {$request->getRequestHtmlFields()}
        </form>

        <div style="text-align: center;">{$msg}</div>

        <script type="text/javascript">
            window.onload = function() {
                document.payment_form.submit();
            };
        </script>
    </body>
</html>
EOT;
            Api::fn_echo($form_content);
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

            return $response->getLogMessage();
        }
    }
}
