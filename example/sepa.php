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
    "vads_amount" => "350", //3,50 EURO The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    "vads_currency" => "978", // An ISO 4217 numerical code of the payment currency.
    "vads_payment_cards" => "SDD",//Contains the list of card types proposed to the buyer, separated by a ";".
    'vads_cust_email' => 'client@example.com',//Buyer's e-mail address, required if you want the buyer to receive e-mails from the payment gateway
    'vads_cust_title'       => 'M.',//Buyer's marital status (e.g. Mr, Mrs, Ms).
    'vads_cust_first_name' => 'John',//Buyer's first name.
    'vads_cust_last_name'   =>  'Doe',//Buyer's last name.
    'vads_cust_cell_phone'  => '0600112233',//Buyer's mobile phone number.
    'vads_cust_country'     => 'FR',//Buyer's country code in compliance with the ISO 3166 standard.
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
