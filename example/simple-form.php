<?php
/**
 * Toolbox initialisation, using PayZen account informations
 * Required : ShopID + CERTIFICATE + platform URL
 */
$toolbox = require "payzenBootstrap.php";

/**
 * Payment arguments
 * If none is mentioned, defaults will be used
 * You can check defaults and formats : vads-payment-php\lib\payzenFormToolbox.php  in function "getFormFields"
 */
$args = array(
    "vads_amount" => "4500",//The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    "vads_currency" => "978" // An ISO 4217 numerical code of the payment currency.
);

/**
 * Retrieve FORM DATA
 */
$formData = $toolbox->getFormData($args);

/**
 * Output the form in html
 */
$form = '<form action="'.$formData['form']['action'].'" method="'.$formData['form']['method'].'" accept-charset="'.$formData['form']['accept-charset'].'">';
  foreach ($formData['fields'] as $name => $value) {
    $form .= '<label for="'. $name. '">'.$name.'</label>';
    $form .= '<input type="text" readonly="readonly"  name="'.$name.'" value="'.$value.'" /><br />';
   }
  $form .= '<input type="submit" name="submit" value="Pay"/>';
$form .= '</form>';

echo $form;
