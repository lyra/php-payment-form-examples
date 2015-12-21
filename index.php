<?php
$toolbox = require "lib/payzenBootstrap.php";
$formData = $toolbox->getFormData(
  substr(time(), -6),       // transaction id
    '4300',                // Payment amount
    '978'                 // Payment currency code
);

$form = '<form action="'.$formData['form']['action'].'" method="'.$formData['form']['method'].'" accept-charset="'.$formData['form']['accept-charset'].'">';
echo '<input type="text" name="vads_cust_name" value="Henri Durand" size="20" />';
  foreach ($formData['fields'] as $name => $value) {
    $form .= '<label for="'. $name. '">'.$name.'</label>';
    $form .= '<input type="text" readonly="readonly"  name="'.$name.'" value="'.$value.'" /><br />';
   }
  $form .= '<input type="submit" name="submit" value="Pay"/>';
$form .= '</form>';

echo $form;

/**
 * Payment Format : https://payzen.io/doc/en/form-payment/standard-payment/index.html#vads-amount.html
 * Payment currency code : https://payzen.io/doc/en/form-payment/standard-payment/index.html#vads-currency.html
 */
