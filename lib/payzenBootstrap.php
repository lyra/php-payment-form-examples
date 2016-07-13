<?php
/*
 * PayZen VADS payment example
 *
 * Bootstraping code, handles initialisation and configuration
 *
 * @version 0.6
 *
 */

require "payzenFormToolbox.php";

/**
 * Toolbox initialisation, using PayZen account informations
 *
 * Shop ID
 * 8-digit shop ID provided in your Back Office (Menu: Settings > Shop > Certificates).
 *
 * Certificate
 * provided in your Back Office (Menu: Settings > Shop > Certificates).
 *
 * Mode
 * Allows to indicate the operating mode of the module (TEST or PRODUCTION)
 *
 * Platform URL :
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

$toolbox = new payzenFormToolbox(
  '[***CHANGE-ME***]', // shopId
  '[***CHANGE-ME***]', // certificate, TEST-version
  '[***CHANGE-ME***]', // certificate, PRODUCTION-version
  'TEST',              // PRODUCTION || TEST
  '[***CHANGE-ME***]'  // Platform URL
);



return $toolbox;
