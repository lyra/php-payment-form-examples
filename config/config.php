<?php

/**
 * Configuration initialisation, using PayZen account informations
 *
 * shop ID (site_id)
 * 8-digit shop ID provided in your Back Office (Menu: Settings > Shop > Certificates).
 *
 * Certificate (key_test || key_prod)
 * provided in your Back Office (Menu: Settings > Shop > Certificates).
 *
 * Mode (ctx_mode)
 * Allows to indicate the operating mode of the module (TEST or PRODUCTION)
 *
 * Platform URL (platform_url)
 * the platform URL needs to be changed according to your needs (COUNTRY)
 * DEMO: https://demo.payzen.eu/vads-payment/
 * France: https://secure.payzen.eu/vads-payment/
 * Brazil: https://secure.payzen.com.br/vads-payment/
 * Germany: https://de.payzen.eu/vads-payment/
 * Chili: https://secure.payzen.cl/vads-payment/
 *
 * Ask support at payzen.io for your platform URL if you don't know it
 *
 * Signature algorithm (sign_algo)
 * The signature algorithm chosen in the shop configuration : 'SHA-256'/'SHA-1'
 *
 * Return Mode (return_mode)
 * This setting defines the return mode by which the settings will be sent back to the shop
 * (3 possible values GET / POST / NONE). If this field is not filled the gateway does not
 * send back any data to the shop when the customer returns to the shop.
 *
 * URL Return (url_return)
 * Shop return URL. When the customer clicks on "return to the shop" this URL permits to treat
 * the data in order to display the payment details. It is strongly recommended NOT to treat
 * the data in the database (order update, order record) after the payment analysis.
 * The server URL must allow you to update the database.
 *
 * Data acquisition mode (action_mode)
 * This setting is set to INTERACTIVE if the card details are entered on the payment gateway.
 *
 * Debug Mode (debug)
 * TRUE: Allows to display the fields which will be sent to the shop.
 * FALSE: Automatic redirection to the payment page.
 *
 */
class Config
{
    /**
     * @var array string[]
     */
    private $config_params = array (
        'site_id' => '12345678',
        'key_test' => '1111111111111111',
        'key_prod' => '2222222222222222',
        'ctx_mode' => 'TEST', // 'TEST' / 'PRODUCTION'
        'platform_url' => 'https://secure.payzen.eu/vads-payment/',
        'sign_algo' => 'SHA-256', // 'SHA-256'/'SHA-1'
        'return_mode' => 'POST',// 'POST' / 'GET'
        'url_return' => '***CHANGE-ME***',
        'action_mode' => 'INTERACTIVE',//'INTERACTIVE'/ 'IFRAME'
        'debug' => true // TRUE / FALSE
    );

    /**
     * @return string
     */
    public function getAbsPath ()
    {
        return realpath(implode(DIRECTORY_SEPARATOR,
                                ['.', '..']
                        )
            ) .
            DIRECTORY_SEPARATOR;
    }

    /**
     * @return array
     */
    public function getConfigParams ()
    {
        return $this->config_params;
    }

    /**
     * @param $name
     * @return mixed|void
     */
    public function getConfigParam ($name)
    {
        if (array_key_exists($name,
                             $this->config_params
        )) {
            return $this->config_params[$name];
        }
    }

    /**
     * @param $name
     * @param $value
     * @return void
     */
    public function setConfigParam ($name,
                                    $value)
    {
        if (! empty($name)) {
            $this->config_params[$name] = $value;
        }
    }
}

?>