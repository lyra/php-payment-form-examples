<?php
require_once '../init.php'; // loads the autoloader.

// Order Info.
$order_info = $_REQUEST;
$order_info['payment_cards'] = "CB"; // Contains the list of card types proposed to the buyer.

// Submit payment form.
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
