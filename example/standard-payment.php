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

//Module configuration parameters

$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
