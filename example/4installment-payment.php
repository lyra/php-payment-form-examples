<?php
require_once '../init.php'; // loads the autoloader

//Order data
$order_info = $_REQUEST;
//installment data
$params_multi = array(
                'first' => 25,
                'count' => 4,
                'period' => 30
            );

//Module configuration parameters
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitMultiPaymentForm($order_info, $params_multi);
