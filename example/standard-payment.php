<?php
require_once '../init.php'; // Loads the autoloader.
// Order Info.
$order_info = $_REQUEST;

// Module configuration parameters.
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
