<?php
/**
 * You can set the return URL in your back office for IPN
 * this file serves the Instant Payment Notification URL first
 *
 * IPN
 * URL of the page that analyzes the payment outcome must be specified in the Back Office
 * The merchant has to make sure that this URL is available from the payment gateway without redirection.
 * Redirection leads to losing data presented in POST.
 */

$toolbox = require "../config/config.php";

$control = $toolbox->checkSignature($_POST);
if($control){
    $response = $toolbox->getIpn();
    $status = (isset($response['vads_trans_status']) && is_array($response)) ? $response['vads_trans_status'] : 'undefined';

    echo '<h1>Payment status : '.$status.'</h1>';
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} else {
    echo 'INVALID SIGNATURE';
}
