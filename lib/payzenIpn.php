<?php

/**
 * IPN
 * URL of the page that analyzes the payment outcome must be specified in the Back Office
 * The merchant has to make sure that this URL is available from the payment gateway without redirection.
 * Redirection leads to losing data presented in POST.
 *
 *
 * RESPONSE EXEMPLE
 *
 * HASH : 95cf4068a1c97765850214d0dab9049627851914e37832781ce855b2d5041d2c
 * vads_url_check_src: BO
 * vads_amount:4300
 * vads_auth_mode:FULL
 * vads_auth_number:3fd74f
 * vads_auth_result:00
 * vads_capture_delay:0
 * vads_card_brand:CB
 * vads_card_number:497010XXXXXX0000
 * vads_payment_certificate:c2228d9d12cc0ef470fddaed19f2e6ad0bdbf272
 * vads_ctx_mode:TEST
 * vads_currency:978
 * vads_effective_amount:4300
 * vads_site_id:61234789
 * vads_trans_date:20160713073908
 * vads_trans_id:000017
 * vads_trans_uuid:0bbb5334009645608950a48c9389bb73
 * vads_validation_mode:0
 * vads_version:V2
 * vads_warranty_result:NO
 * vads_payment_src:EC
 * vads_cust_email:client@example.com
 * vads_sequence_number:1
 * vads_contract_used:7698321
 * vads_trans_status:AUTHORISED
 * vads_expiry_month:6
 * vads_expiry_year:2017
 * vads_bank_product:F
 * vads_pays_ip:FR
 * vads_presentation_date:20160713073910
 * vads_effective_creation_date:20160713073910
 * vads_operation_type:DEBIT
 * vads_threeds_enrolled:
 * vads_threeds_cavv:
 * vads_threeds_eci:
 * vads_threeds_xid:
 * vads_threeds_cavvAlgorithm:
 * vads_threeds_status:
 * vads_threeds_sign_valid:
 * vads_threeds_error_code:
 * vads_threeds_exit_status:
 * vads_result:00
 * vads_extra_result:
 * vads_card_country:FR
 * vads_language:fr
 * vads_hash:95cf4068a1c97765850214d0dab9049627851914e37832781ce855b2d5041d2c
 * vads_url_check_src:BO
 * signature:31dcd1bfa71b4418e3a8c0f6994b7c34c9817bc1
 *
 */


// Should test for : vads_hash & vads_url_check_src
if(isset($_POST['vads_url_check_src']) && isset($_POST['vads_hash'])){

    date_default_timezone_set('Europe/Berlin');
    $toolbox = require "../lib/payzenBootstrap.php";
    $pz_outcome = require '../lib/payzenPaymentOutcome.php';
    $key = '5964746647175265';

    try {
        $toolbox->checkIpnRequest($_POST);
    }catch(Exception $e) {
        $error_msg= _('### ERROR - An exception raised during IPN PayZen process:');
        error_log($error_msg. ' '.$e);
        exit();
    }


    //Check Signature
    $control = $toolbox->Check_Signature($_REQUEST,$key);
    
    if($control == true){

        // In our case,Data is stored in a simple file
        $response = $pz_outcome->the_response_data();
        $pz_outcome->save_ipn($response);
        
    }else{
        $output = _('INVALID SIGNATURE');
        $output .= '<pre>';
        foreach ($_POST as $key => $value){
            $output .= "{$key} = {$value}\r\n";
        }
        $output .= '</pre>';
        $pz_outcome->save_ipn($output);
    }
}
   
 

