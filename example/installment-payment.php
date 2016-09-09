<?php
/**
 * Toolbox initialisation, using PayZen account informations
 * Required : ShopID + CERTIFICATE + platform URL
 */
$toolbox = require "../config/config.php";

/**
 * Payment arguments
 * If none is mentioned, defaults will be used
 * You can check defaults and formats : vads-payment-php\lib\payzenFormToolbox.php  in function "getFormFields"
 *
 * vads_payment_config :
 * single payment == SINGLE.
 * installment payment with fixed amounts and dates ==  MULTI:
 * first : indicates the amount of the first installment (populated in the smallest unit of the currency).
 * count : indicates the total number of installments.
 * period : indicates the number of days between 2 installments.
 * The field order associated with MULTI must be respected.
 */
$args = array(
    "vads_amount" => "3000",//The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    "vads_payment_config" => "MULTI:first=1500;count=3;period=30",//Defines the type of payment: immediate or installment.
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
  $form .= '<input type="submit" name="pay-submit" value="'.gettext("Pay").'"/>';
$form .= '</form>';

echo $form;
