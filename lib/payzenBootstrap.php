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
 * About the platform URL :
 * the platform URL needs to be changed according to your needs (COUNTRY)
 *
 * France :
 * https://secure.payzen.eu/vads-payment/ || https://demo.payzen.eu/vads-payment/
 * Brazil :
 * https://secure.payzen.com.br/vads-payment/
 *
 * Ask support at payzen.io for your platform URL if you don't know it
 */

$toolbox = new payzenFormToolbox(
  '[***CHANGE-ME***]', // shopId
  '[***CHANGE-ME***]', // certificate, TEST-version
  '[***CHANGE-ME***]', // certificate, PRODUCTION-version
  'TEST',              // PRODUCTION || TEST
  '[***CHANGE-ME***]'  // Platform URL
);


/*
 * Toolbox can accept logging callback method
 * Use it if you need special logging, like database logging
 * or if you need to hook the toolbox to your own loggin process
 *
 $toolbox->setLogFunction(function($level, $message, $data = null){
  error_log(sprintf(
        ">>>\nLOG TIME: %s\nLOG LEVEL: %s\nLOG MESSAGE: %s\nLOG DATA:\n %s\n<<<\n"
      , date('r')
      , $level
      , $message
     , print_r($data, true)
    )
  );
  });
*/

// Sets the toolbox log level to 'NOTICE', to gain maximun feedback
// about the request process. Comment out this line to get rid of logs
$toolbox->setNoticeLogLevel();

return $toolbox;
