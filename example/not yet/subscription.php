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
 * vads_page_action possible values :
    PAYMENT
    REGISTER
    REGISTER_UPDATE
    REGISTER_PAY
    REGISTER_SUBSCRIBE
    REGISTER_PAY_SUBSCRIBE
    SUBSCRIBE
    REGISTER_UPDATE_PAY
    ASK_REGISTER_PAY
 *
 *
 */
$next_month = date('Ymd', strtotime('+1 month'));
$args = array(
    "vads_amount" => null,//must be null
    'vads_sub_amount' => '350',//	Mandatory parameter used for creating a subscription.The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    'vads_cust_email' => 'customer@example.com',////Buyer's e-mail address, required if you want the buyer to receive e-mails from the payment gateway
    'vads_page_action' => 'REGISTER_SUBSCRIBE',//Defines the action that must be performed.
    'vads_sub_desc' => 'RRULE:FREQ=MONTHLY;BYMONTHDAY=1',//the subscription rule to be applied. a chain of characters that respect the iCalendar (Internet Calendar) specification, described in RFC5545 (see http://tools.ietf.org/html/rfc5545).
    'vads_sub_effect_date' => $next_month,//The effective date indicates from which day the subscription starts. The date format is AAAAMMJJ.
    'vads_sub_currency'     => '978',//Numerical code of the currency used for the subscription in compliance with the ISO 4217 standard.
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
$form .= '<input type="submit" name="pay-submit" value="'.'Pay'.'"/>';
$form .= '</form>';

echo $form;
