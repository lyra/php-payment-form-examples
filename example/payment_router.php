<?php
session_start();

require_once '../payment/entity/PaymentProcessor.php';

if(isset($_GET['lang'])){
    $lang = $_GET["lang"];
} elseif (isset($_SESSION["lang"])) {
    $lang  = $_SESSION["lang"];
} else {
    $lang = 'fr';
}

//'language' => $lang,
//'url_return' => fn_url('payment_notification.process?payment=__vads'),

/**
 * Payment arguments
 * If none is mentioned, defaults will be used
 * You can check defaults and formats : vads-payment-php\lib\payzenFormToolbox.php  in function "getFormFields"
 */
//$order_info for example
$order_info= array(
    // Order info.
    "amount" => "4500",//The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    "currency" => "978", // An ISO 4217 numerical code of the payment currency.
    "order_id" => "1",
    "lang_code" => "fr",
    'url_return' => 'http://34a4791a.ngrok.io/monsite/test2/example/return_payment.php',
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

//payment_info
$payment_methods = array('standard', 'multi', 'deferred', 'iframe');

$payment_method = $_POST['paymentmethod'];
if (isset($_POST['paymentmethod']) && $_POST['paymentmethod'] && in_array( $_POST['paymentmethod'], $payment_methods )) {
    switch ($payment_method){
        case 'standard':
            header('Location: standard-payment.php');
            break;
        case 'multi':
            header('Location: installment-payment.php');
            break;
        case 'deferred':
            $params_deferred = array(
                'first' => array('amount','date'),
            );
            $paymentProcessor = new PaymentProcessor();
            $paymentProcessor->submitDeferredPaymentForm($order_info, $params_deferred, $lang);
            break;
        case 'iframe':
            header('Location: installment-payment.php');
            break;
    }
}
