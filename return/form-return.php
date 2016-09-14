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
if($control && $toolbox->debug == true){
    $response = $toolbox->getIpn();
    $status = (isset($response['vads_trans_status']) && is_array($response)) ? $response['vads_trans_status'] : 'undefined';
    $vads_warranty_result = (isset($response['vads_warranty_result'])) ? $response['vads_warranty_result'] : 'undefined';
    $vads_threeds_status = (isset($response['vads_threeds_status'])) ? $response['vads_threeds_status'] : 'undefined';
    $vads_auth_result = (isset($response['vads_auth_result'])) ? $response['vads_auth_result'] : 'undefined';
    $vads_capture_delay = (isset($response['vads_capture_delay'])) ? $response['vads_capture_delay'] : 'undefined';
    $vads_validation_mode = (isset($response['vads_validation_mode'])) ? $response['vads_validation_mode'] : 'undefined';

    echo '<h1>'.$i18n['paymentstatus'].' : '.$status.'</h1>';
    echo '<p>vads_warranty_result : '.$vads_warranty_result.'</p>';
    echo '<p>vads_threeds_status (3DS) : '.$vads_warranty_result.'</p>';
    echo '<p>vads_auth_result : '.$vads_auth_result.'</p>';
    echo '<p>vads_capture_delay: '.$vads_capture_delay.'</p>';
    echo '<p>vads_validation_mode: '.$vads_validation_mode.'</p>';


    echo "<h2>".$i18n['datawithdoclinks'].'</h2>';
    echo '<table class="table table-bordered">';
    $form = '';
    foreach ($response as $name => $value) {
        $doc_name = (strpos($name, 'vads_') !== false) ? str_replace('_','-',$name): false;
        $doclink = ($doc_name) ? 'https://payzen.io/en-EN/form-payment/standard-payment/'.$doc_name.'.html': '#';
        $form .= '<tr>';
        $form .= '<td><label for="'. $name. '"><a target="_blank" href="'.$doclink.'">'.$name.'</a></label></td>';
        $form .= '<td><input type="text" readonly="readonly"  name="'.$name.'" value="'.$value.'" /></td>';
        $form .= '</tr>';
    }
    echo $form;
    echo '</table>';

    echo "<h2>".$i18n['rawdata'].'</h2>';
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} elseif($control && $toolbox->debug == false){
    $response = $toolbox->getIpn();
    $status = (isset($response['vads_trans_status']) && is_array($response)) ? $response['vads_trans_status'] : 'undefined';
    echo '<h1>'.$i18n['paymentstatus'].' : '.$status.'</h1>';
}else {
    echo $i18n['invalidsign'];
}
