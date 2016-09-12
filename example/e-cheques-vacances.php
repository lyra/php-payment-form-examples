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
 */
$args = array(
    "vads_amount" => "8050", //80,50 EURO - a minimum amount is required for ECV. The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    "vads_payment_cards" => "E_CV",//Contains the list of card types proposed to the buyer, separated by a ";".
    'vads_contracts=ANCV=123459-1-1' => ''//Presents a list with a Merchant ID (MID) to use for each acceptance network.
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
$form .= '<input type="submit" name="pay-submit" value="'._("Pay").'"/>';
$form .= '</form>';

echo $form;
