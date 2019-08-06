<?php
/*
 * PayZen VADS payment example
 *
 * Bootstraping code, handles initialisation and configuration
 *
 * @version 0.7
 *
 */

/**
 * Toolbox initialisation, using PayZen account informations
 *
 * Shop ID (shopID)
 * 8-digit shop ID provided in your Back Office (Menu: Settings > Shop > Certificates).
 *
 * Certificate (certTest || certProd)
 * provided in your Back Office (Menu: Settings > Shop > Certificates).
 *
 * Mode (ctxMode)
 * Allows to indicate the operating mode of the module (TEST or PRODUCTION)
 *
 * Platform URL (platform)
 * the platform URL needs to be changed according to your needs (COUNTRY)
 * DEMO: https://demo.payzen.eu/vads-payment/
 * France: https://secure.payzen.eu/vads-payment/
 * Brazil: https://secure.payzen.com.br/vads-payment/
 * Germany: https://de.payzen.eu/vads-payment/
 * Chili: https://secure.payzen.cl/vads-payment/
 * India: https://secure.payzen.co.in/vads-payment/
 *
 * Ask support at payzen.io for your platform URL if you don't know it
 *
 * IPN (optional)
 * Instant Payment Notification URL
 * will override the IPN URL and popuplate the vads_url_check field
 */

/**
 *
 */
class ModuleConfiguration
{
    private $config_params = array(
        'site_id' => '***CHANGE-ME***',
        'key_test' => '***CHANGE-ME***',
        'key_prod' => '***CHANGE-ME***',
        'ctx_mode' => '***CHANGE-ME***',
        'platform_url' => '***CHANGE-ME***',
        'sign_algo' => 'SHA-256', // the signature algorithm chosen in the shop configuration
        'return_mode' => 'POST',
        'url_return' => '***CHANGE-ME***',
        'action_mode' => '***CHANGE-ME***', // 'INTERACTIVE'/ 'IFRAME'
        'theme_config' => '',
        'debug' => true
    );

    public function getConfigParams()
    {
        return $this->config_params;
    }

    public function getConfigParam($name)
    {
        if (array_key_exists($name, $this->config_params)) {
            return $this->config_params[$name];
        }
    }

    public function setConfigParam($name, $value)
    {
        if (!empty($name)) {
            $this->config_params[$name] = $value;
        }
    }
}
?>