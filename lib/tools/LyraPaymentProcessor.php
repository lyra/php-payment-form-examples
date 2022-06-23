<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra PHP payment form example. See COPYING.md for license details.
 *
 * @author    Lyra Network <https://www.lyra.com>
 * @copyright Lyra Network
 * @license   http://www.apache.org/licenses/
 */

if (! class_exists('LyraPaymentProcessor', false)) {
    /**
     * Lyra payment example.
     */
    class LyraPaymentProcessor
    {
        /**
         * @var array
         */
        private $config_parameters;

        /**
         * @var bool
         */
        private $required_fields = false;

        /**
         * @var string
         */
        private $warning = '';

        /**
         * @var Logger
         */
        private $logger;

        /**
         * Constructor, stores Lyra user's account informations
         * @param $config array (
         *    $site_id => string, the identifier provided by Lyra
         *    $key_test => string, key in test mode
         *    $key_prod => string, key in production mode
         *    $ctx_mode => string ("TEST" or "PRODUCTION"), the context mode to operate
         *    $platform_url => string, link to the payment page.
         *    $sign_algo => string (SHA-256 or SHA1), algorithm used to compute the payment form signature
         *    $debug => string debug mode
         * )
         */
        public function __construct($config = array (), $log_dir = './logs')
        {
            $this->setLogger($log_dir);

            if (isset($config) && is_array($config) && ! empty($config)) {
                // Set config parameters.
                $this->setConfigParameters($config);
            } else {
                // Load config parameters from Config.php file.
                $configuration = new Config();
                $this->setConfigParameters($configuration->getConfigParams());
            }
        }

        /**
         * @param $log_dir
         * @return void
         */
        public function setLogger($log_dir)
        {
            $this->logger = Logger::instance();
            if (! is_dir($log_dir)) {
                mkdir($log_dir);
            }

            $this->logger->__set('logfile', $log_dir . DIRECTORY_SEPARATOR . 'lyra-' . date('Y-m') . '.log');
        }

        /**
         * @param $config
         * @return void
         */
        public function setConfigParameters($config)
        {
            $this->required_fields = (count(array_filter($config)) == count($config)) ||
                (count(array_filter($config)) == count($config) - 1) && ! $config['debug'];

            if ($this->required_fields) {
                $this->config_parameters = array ();
                $this->config_parameters['site_id'] = (isset($config['site_id'])) ? $config['site_id'] : '';
                $this->config_parameters['key_test'] = (isset($config['key_test'])) ? $config['key_test'] : '';
                $this->config_parameters['key_prod'] = (isset($config['key_prod'])) ? $config['key_prod'] : '';
                $this->config_parameters['ctx_mode'] = (isset($config['ctx_mode'])) ? $config['ctx_mode'] : 'TEST';
                $this->config_parameters['platform_url'] = (isset($config['platform_url'])) ? $config['platform_url']
                    : '';
                $this->config_parameters['debug'] = (isset($config['debug'])) ? $config['debug'] : false;
                $this->config_parameters['sign_algo'] = (isset($config['sign_algo'])) ? $config['sign_algo'] :
                    Api::ALGO_SHA1;
                $this->config_parameters['action_mode'] = (isset($config['action_mode'])) ? $config['action_mode'] : '';
                $this->config_parameters['return_mode'] = (isset($config['return_mode'])) ? $config['return_mode'] : '';
                $this->config_parameters['url_return'] = (isset($config['url_return'])) ? $config['url_return'] : '';

                $this->required_fields = true;
            } else {
                $this->warning .= '<h1>One of the config parameters is missing in config/Config.php </h1>';
                $this->logger->write($this->warning);
                echo '<pre>' . $this->warning . '</pre>';
            }
        }

        /**
         * @param $order_info
         * @return Request
         */
        public function initRequest($order_info)
        {
            // Use our custom class to generate the HTML.
            $request = new Request();

            $params = $this->config_parameters;

            $this->logger->write('Generating payment form for order #' . $order_info['order_id'] . '.');

            // Admin configuration parameters.
            $config_params = array (
                'site_id', 'key_test', 'key_prod', 'ctx_mode', 'platform_url', 'available_languages',
                'capture_delay', 'validation_mode', 'payment_cards', 'redirect_enabled',
                'redirect_success_timeout', 'redirect_success_message', 'redirect_error_timeout',
                'redirect_error_message', 'action_mode', 'return_mode', 'url_return', 'sign_algo'
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
            $request->setFromarray($order_info);

            // iFrame mode.
            if ($request->get('action_mode') === 'IFRAME') {
                // Hide logos below payment fields.
                $request->set('theme_config', '3DS_LOGOS=false;');

                // Enable automatic redirection.
                $request->set('redirect_enabled', '1');
                $request->set('redirect_success_timeout', '0');
                $request->set('redirect_error_timeout', '0');

                $return_url = $request->get('url_return');
                $sep = strpos($return_url, '?') === false ? '?' : '&';
                $request->set('url_return', $return_url . $sep . 'content_only=1');
            }

            return $request;
        }

        /**
         * @param $order_info
         * @param $request
         * @return string
         */
        public function prepareForm($order_info, $request)
        {
            // Insert style.
            $formContent = "";

            $lang = isset($order_info['lang_code']) ? $order_info['lang_code'] : 'en';
            include implode(DIRECTORY_SEPARATOR, ['..', 'lib', 'locale', $lang, 'messages.php']);

            if ($this->config_parameters['debug']) {
                $formContent = '<html>';
                $formContent .= '<head>';
                $formContent .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';

                $formContent .= '<title style="align">' . $i18n['paymentform'] . '</title>';
                $formContent .= '<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>';
                $formContent .= '</head>';
                $formContent .= '<body style="padding: 10%;">';
                $formContent .= '<h1 style="text-align: center;">' . $i18n['paymentform'] .'</h1>';

                $form = $this->getDisplayRequestHtml($request, $i18n['sendform']);
                $submitScript = '';
                // Message to be shown when forwarding to payment platform.
                $msg = '';
            } else {
                $form = $request->getRequestHtmlFields();
                $submitScript =
                    '<script type="text/javascript">window.onload = function(){document.payment_form.submit();};</script>';
                // Message to be shown when forwarding to payment platform.
                $msg = $i18n['redirect_message_defaut'];
            }

            // Get html form.
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

        /**
         * @param $order_info
         * @return void
         */
        public function submitStandardPaymentForm($order_info)
        {
            if ($this->required_fields) {
                $request = $this->initRequest($order_info);

                // Log data that will be sent to payment gateway.
                $this->logger->write('Data to be sent to payment gateway : ' . 
                    print_r($request->getRequestFieldsarray(true /* To hide sensitive data. */), true));

                // Get prepared form.
                $formContent = $this->prepareForm($order_info, $request);
                Api::fn_echo($formContent);
            }
        }

        /**
         * @param $order_info
         * @param $params_multi
         * @return void
         */
        public function submitMultiPaymentForm($order_info, $params_multi)
        {
            if ($this->required_fields) {
                // Use our custom class to generate the HTML.
                $request = $this->initRequest($order_info);

                // Set multi payment options.
                $first = (isset($params_multi['first']) && $params_multi['first']) ?
                    (int) (string) (($params_multi['first'] / 100) * $order_info['amount']) /* Amount is in cents. */
                    : null;

                $request->setMultiPayment(null, $first, $params_multi['count'], $params_multi['period']);

                // Log data that will be sent to payment gateway.
                $this->logger->write('Data to be sent to payment gateway : '
                    . print_r($request->getRequestFieldsarray(true /* To hide sensitive data. */), true));

                // Get prepared form.
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
                $html .= '<label style="width:50%" for="' . $field->getName() . '">'
                    . $field->getName() . '</label><input style="width:100%" class="forminput" name="'
                    . $field->getName() . '" value="' . $value . '" type="text"/>';
                $html .= "<br>";
            }

            $html .= '<input class="forminput" type="submit" value="' . $submit . '"/>';

            return $html;
        }

        /**
         * @param $param
         * @return bool
         */
        public function checkResponse($param = array ())
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

            if (! $response->isAuthentified()) {
                $this->logger->write('Authentication failed: received invalid response with parameters: ' . print_r($param, true));
                $this->logger->write('Signature algorithm selected in module settings must be the same as one selected in gateway Back Office.');

                if ($from_server) {
                    $this->logger->write('IPN URL PROCESS END.');
                } else {
                    $this->logger->write('RETURN URL PROCESS END.');
                }
            } else {
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
