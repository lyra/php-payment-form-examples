<?php
session_start();

require_once '../payment/entity/PaymentProcessor.php';
require_once '../config/config.php';

if(isset($_GET['lang'])){
    $lang = $_GET["lang"];
} elseif (isset($_SESSION["lang"])) {
    $lang  = $_SESSION["lang"];
} else {
    $lang = 'fr';
}

//$order_info for example
$order_info= array(
    // Order info.
    "amount" => "4500",//The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    "currency" => "978", // An ISO 4217 numerical code of the payment currency.
    "order_id" => "1",
    "lang_code" => "fr",
    //'url_return' => 'http://ed89a903.ngrok.io/monsite/test2/example/return_payment.php',
    // Customer info.
    "cust_id" => "258",
    "cust_email" => "cmshb09@gmail.com",

    "cust_first_name" => "test1",
    "cust_last_name" => "test2",
    "cust_address" => "adresse",
    "cust_city" => "Bab Ezzouar",
    "cust_state" => "Algiers",
    "cust_zip" => "16000",
    "cust_country" => "DZ",
    "cust_phone" => "088854756"
);

//Module configuration parameters

$paymentProcessor = new PaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
