<?php
/*
 * PayZen VADS payment example
 * This script demonstrate how to realise the first step
 * of IPN process, the validation of the data received from PayZen, 
 * and how the other steps could be done.
 *
 * @version 0.6
 *
 */


$toolbox = require "payzenBootstrap.php";
include_once 'returnPayment.php';
$key = '5964746647175265';
try {
// PayZen Response Authentification
 $toolbox->checkIpnRequest($_POST);
}catch(Exception $e) {
  $error_msg= _('### ERROR - An exception raised during IPN PayZen process:');
  error_log($error_msg. ' '.$e);
  http_response_code(400); // Something's wrong in the data received
  exit();
}

//To ensure the integrity of the response, you must compare the value of the signature field received in the response with the one computed previously.
$control = $toolbox->Check_Signature($_REQUEST,$key);
if($control == 'true'){
 the_payment_response();
}else{
 echo _('INVALID SIGNATURE');
 echo '<pre>';
 foreach ($_POST as $key => $value){
  echo "{$key} = {$value}\r\n";
 }
 echo '</pre>';
 exit('vads_url_check_src is not defined');
}



if(!isset($_POST['vads_url_check_src']))
 exit();
// Your specific PayZen Response Analysis
// You may want to check the type of the notification:
 switch($_POST['vads_url_check_src']) {

  case 'BO':                  // IPN check initiated from PayZen back-office
   http_response_code(200);   // A simple response to prove that is script is ready
   exit('Nice to see you again');

  case 'PAY':           // Immediate payment (the only payment type handled by this example)
   switch($_POST['vads_trans_status']){

    case 'AUTHORISED': // Payment is authorised, but we wait for 'CAPTURED' event to validate the order
    case 'AUTHORISED_TO_VALIDATE': 
     /* Here your code for authorised payments
      * For example:
      *  $myTransId = $_POST['vads_trans_id']
      *  authorisedOrderByTransId($myTransId); 
     */
     break;

    case 'CAPTURED':
     /* Here the code for successful payments
      * For example:
      *  $myTransId = $_POST['vads_trans_id']
      *  validateOrderByTransId($myTransId); 
     */
     break;

    case 'REFUSED':
     /* Here the code for refused payments
      * For example:
      *  $myTransId = $_POST['vads_trans_id']
      *  refuseOrderByTransId($myTransId); 
     */
     break;

    // Here are the others status you may want to handle
    case 'ABANDONED':
    case 'CANCELED':
    case 'EXPIRED':
    case 'WAITING_AUTHORISATION':
    case 'WAITING_AUTHORISATION_TO_VALIDATE':
    case 'UNDER_VERIFICATION':
    case 'NOT_CREATED':
    default:
     /*
      * Specific code here
      */
     break;
   }

   http_response_code(200);   // Notification process is done, we respond to PayZen server
   exit('Notification well received, Thank-you.');

  case 'MERCH_BO':      // Back-office operation (refund, update,...)
  case 'BATCH_AUTO':    // Recurrent or delayed payment
  case 'REC':           // Recurrent payment creation
  default:
   http_response_code(501);
   exit(sprintf("Unknown notification : `%s`", $_POST['vads_url_check_src']));
 }

