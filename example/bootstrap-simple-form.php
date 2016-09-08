<?php
$toolbox = require "../config/config.php";

/**
 * Payment arguments
 * If none is mentioned, defaults will be used
 * You can check defaults and formats : vads-payment-php\lib\payzenFormToolbox.php  in function "getFormFields"
 */
$args = array(
    'vads_amount' => array(
        'value' => '4500',//The amount of the transaction presented in the smallest unit of the currency (cents for Euro).
        'label' => 'Price',
        'type' => 'text',
        'class'  => 'vads-field',
        'wrapper_class' => 'vads-wrapper',
        'readonly' => true,
        'help' => 'Display only the price to play'
    ),
    "vads_currency" => "978" // An ISO 4217 numerical code of the payment currency.
);

/**
 * Retrieve FORM DATA
 */
$formData = $toolbox->getFormData($args);

/**
 * Output the form in html
 */
$form = '<form action="'.$formData['form']['action'].'" method="'.$formData['form']['method'].'" accept-charset="'.$formData['form']['accept-charset'].'" class="form-horizontal">';

foreach ($formData['fields'] as $name => $value) {

    $display_value = (isset($value['value']) && is_array($value)) ? $value['value'] : $value;
    $label = (isset($value['label']) && is_array($value)) ? $value['label'] : $name;
    $class = (isset($value['class']) && is_array($value)) ? $value['class'] : '';
    $help = (isset($value['help']) && $value['help'] !== '' && is_array($value)) ? ' '.$value['help'] : '';
    $wrapper_class = (isset($value['wrapper_class']) && is_array($value)) ? $value['wrapper_class'] : 'hidden';
    $type = (isset($value['type']) && is_array($value) ) ? $value['type'] : 'text';
    $help_link = '<small id="helpBlock" class="help-block">'.$help.'</small>';
    $addon = '';
    $addon_end = '';
    $hidden_field = '';

    if($name == 'vads_amount'){
        $hidden_field = '<input type="hidden" value="'.$display_value.'" name="vads_amount"/>';
        $cents =  substr($display_value,-2);
        $amount = substr($display_value,0,-2);
        $display_value = $amount.','.$cents;
        $addon = '<div class="input-group">';
        $addon_end = '<span class="glyphicon glyphicon-euro form-control-feedback" aria-hidden="true"></span></div>';
    }

    //$form .= $hidden_field;
    $form .= '<div class="form-group '.$wrapper_class.'">';
    $form .= '<label for="'. $name. '" class="col-sm-2 control-label">'.$label.'</label>';
    $form .= '<div class="col-sm-10">';
    $form .= $addon;
    $form .= $hidden_field;
    $form .= '<input type="'.$type.'" readonly="readonly"  class="form-control '.$class.'"  name="'.$name.'" value="'.$display_value.'" />';
    $form .= $help_link;
    $form .= $addon_end;
    $form .= '</div></div>';
}

$form .= '<button type="submit" class="btn btn-default">Pay</button>';
$form .= '</form>';
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <title>Simple form</title>

</head>

<body>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12" style="max-width: 320px;">
            <h1>Payment form</h1>
            <?php echo $form; ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

</body>
</html>