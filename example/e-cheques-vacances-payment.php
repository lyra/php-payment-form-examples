<?php
require_once implode(DIRECTORY_SEPARATOR, ['..', 'init.php']); // loads the autoloader.

// Order Info.
$order_info = $_REQUEST;
$order_info['payment_cards'] = "VISA;MASTERCARD;E_CV"; // Contains the list of card types proposed to the buyer,
$order_info['contracts'] = "ANCV=123459-1-1"; // Presents a list with a Merchant ID (MID) to use for each acceptance
// network.

// Submit payment form.
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitStandardPaymentForm($order_info);
