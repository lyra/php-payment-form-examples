<?php
require_once implode(DIRECTORY_SEPARATOR, ['..', 'init.php']); // loads the autoloader.

// Order data.
$order_info = $_REQUEST;
// Installment data.
$params_multi = array (
    'first' => 50,
    'count' => 2,
    'period' => 30
);

// Module configuration parameters.
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitMultiPaymentForm($order_info,
                                          $params_multi
);
