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

//GET return URL
$protocol = ( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://' ;
$url =  $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$return_url = str_replace('example/simple-form-with-card-preselected.php','return/form-return.php',$url);

$args = array(
    "vads_amount" => "4500", //The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
    "vads_currency" => "978", // An ISO 4217 numerical code of the payment currency.
    "vads_payment_cards" => "CB", // Contains the list of card types proposed to the buyer, separated by a ";".
    'vads_redirect_error_timeout'   => '10',//delay in seconds before an automatic redirection to the merchant website at the end of a declined payment.
    'vads_redirect_success_timeout' => '10',// delay in seconds before an automatic redirection to the merchant website at the end of an accepted payment.
    'vads_url_return'   => $return_url //Default URL to where the buyer will be redirected. If this field has not been transmitted, the Back Office configuration will be taken into account.
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
