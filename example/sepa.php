<?php
/**
 * Toolbox initialisation, using PayZen account informations
 * Required : ShopID + CERTIFICATE
 */
$toolbox = require "../lib/payzenBootstrap.php";

/**
 * Payment arguments
 * If none is mentioned, defaults will be used
 * You can check defaults and formats : vads-payment-php\lib\payzenFormToolbox.php  in function "getFormFields"
 */
$args = array(
    "vads_amount" => "350", //3,50 EURO
    "vads_payment_cards" => "SDD",
    'vads_cust_email' => 'client@example.com',
    'vads_cust_title'       => 'M.',
    'vads_cust_first_name' => 'John',
    'vads_cust_last_name'   =>  'Doe',
    'vads_cust_cell_phone'  => '0600112233',
    'vads_cust_country'     => 'FR',
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
