<?php
session_start();

function autoloadTools($className) {
    $filename = "../lib/tools/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadTools");

/**
 * Payment arguments
 * If none is mentioned, defaults will be used
 * You can check defaults and formats : vads-payment-php\lib\payzenFormToolbox.php  in function "getFormFields"
 *
 * vads_page_action possible values :
    PAYMENT
    REGISTER
    REGISTER_UPDATE
    REGISTER_PAY
    REGISTER_SUBSCRIBE
    REGISTER_PAY_SUBSCRIBE
    SUBSCRIBE
    REGISTER_UPDATE_PAY
    ASK_REGISTER_PAY
 *
 *
 */
$sub_info = array(
    "amount" => null,//must be null
    'sub_amount' => '350',//	Mandatory parameter used for creating a subscription.The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    'cust_email' => 'customer@example.com',////Buyer's e-mail address, required if you want the buyer to receive e-mails from the payment gateway
    'page_action' => 'REGISTER_SUBSCRIBE',//Defines the action that must be performed.
    'sub_desc' => 'RRULE:FREQ=MONTHLY;BYMONTHDAY=1',//the subscription rule to be applied. a chain of characters that respect the iCalendar (Internet Calendar) specification, described in RFC5545 (see http://tools.ietf.org/html/rfc5545).
    'sub_effect_date' => date('Ymd', strtotime('+1 month')),//The effective date indicates from which day the subscription starts. The date format is AAAAMMJJ.
    'sub_currency'     => '978',//Numerical code of the currency used for the subscription in compliance with the ISO 4217 standard.
);
//Order Info
$order_info = array_merge($_REQUEST,$sub_info);

$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
