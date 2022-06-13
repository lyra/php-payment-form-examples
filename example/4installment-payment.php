<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra PHP payment form example. See COPYING.md for license details.
 *
 * @author    Lyra Network <https://www.lyra.com>
 * @copyright Lyra Network
 * @license   http://www.apache.org/licenses/
 */

require_once implode(DIRECTORY_SEPARATOR, ['..', 'init.php']); // Loads the autoloader.

// Order data.
$order_info = $_REQUEST;

// Installment data.
$params_multi = array (
    'first' => 25,
    'count' => 4,
    'period' => 30
);

// Module configuration parameters.
$paymentProcessor = new LyraPaymentProcessor();
$paymentProcessor->submitMultiPaymentForm($order_info, $params_multi);
