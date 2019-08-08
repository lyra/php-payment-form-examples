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
$order_info['payment_cards'] = "E_CV"; // Contains the list of card types proposed to the buyer,
$order_info['contracts'] = "ANCV=123459-1-1";//Presents a list with a Merchant ID (MID) to use for each acceptance network.

//Submit payment form
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
