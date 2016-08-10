<?php
/*
 * PayZen VADS payment example
 *
 * Bootstraping code, handles initialisation and configuration
 *
 * @version 0.6
 *
 */

require "../lib/payzenFormToolbox.php";

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

$args = array(
    'shopID'    => '[***CHANGE-ME***]', // shopID
    'certTest'  => '[***CHANGE-ME***]', // certificate, TEST-version
    'certProd'  => '[***CHANGE-ME***]', // certificate, PRODUCTION-version
    'ctxMode'   => 'TEST',              // PRODUCTION || TEST
    'platform'  => '[***CHANGE-ME***]', // Platform URL
);

$toolbox = new payzenFormToolbox($args);

return $toolbox;
