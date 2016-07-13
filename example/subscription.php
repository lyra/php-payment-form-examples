<?php
/**
 * Toolbox initialisation, using PayZen account informations
 * Required : ShopID + CERTIFICATE + platform URL
 */
$toolbox = require "../lib/payzenBootstrap.php";

/**
 * Payment arguments
 * If none is mentioned, defaults will be used
 * You can check defaults and formats : vads-payment-php\lib\payzenFormToolbox.php  in function "getFormFields"
 */
$next_month = date('Ymd', strtotime('+1 month'));
$args = array(
    "vads_amount" => null,
    'vads_sub_amount' => '350',
    'vads_cust_email' => 'customer@example.com',
    'vads_page_action' => 'REGISTER_SUBSCRIBE',
    'vads_sub_desc' => 'RRULE:FREQ=MONTHLY;BYMONTHDAY=1',
    'vads_sub_effect_date' => $next_month,
    'vads_sub_currency'     => '978',
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
