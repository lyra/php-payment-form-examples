<?php
session_start();

function autoloadTools($className) {
    $filename = "../lib/tools/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadTools");

//Order Info
$order_info= $_REQUEST;
$order_info['payment_cards'] = "CB"; // Contains the list of card types proposed to the buyer,

//Submit payment form
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
