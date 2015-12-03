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

// Toolbox initialisation, using PayZen account informations
$toolbox = new payzenFormToolbox(
     '[***CHANGE-ME***]' // shopId
   , '[***CHANGE-ME***]' // certificate, TEST-version
   , '[***CHANGE-ME***]' // certificate, PRODUCTION-version
   , 'TEST'              // TEST-mode toggle
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
