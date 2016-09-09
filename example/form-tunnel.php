<?php
/**
 * A simple example of integration
 *
 */
?>

<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>

<body>

<?php if(isset($_POST)): ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12" style="max-width: 92%;">
            <br><br>
            <h2><?php echo gettext('BELOW IS THE DATA WHICH WILL BE SENT TO THE GATEWAY'); ?></h2>
            <p><?php echo gettext('NOTE:'); ?> <br>
                <?php echo gettext('In order to be redirected straight to the payment gateway, you need to change the debug value of the config.php file to false.'); ?></p>
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


/**
 * Retrieve FORM DATA
 */
$formData = $toolbox->getFormData($_POST);

/**
 * Output the form in html
 */
$form = '<form action="'.$formData['form']['action'].'" method="'.$formData['form']['method'].'" accept-charset="'.$formData['form']['accept-charset'].'" id="auto-submit-form">';
$form .= '<table class="table table-bordered">';
foreach ($formData['fields'] as $name => $value) {

    $doc_name = (strpos($name, 'vads_') !== false) ? str_replace('_','-',$name): false;
    $doclink = ($doc_name) ? 'https://payzen.io/en-EN/form-payment/standard-payment/'.$doc_name.'.html': '#';
    $form .= '<tr>';
    $form .= '<td><label for="'. $name. '"><a target="_blank" href="'.$doclink.'">'.$name.'</a></label></td>';
    $form .= '<td><input type="text" readonly="readonly"  name="'.$name.'" value="'.$value.'" /></td>';
    $form .= '</tr>';
}
$form .= '</table>';
$form .= '<input type="submit" name="pay-submit" value="'.gettext("Pay").'" class="btn btn-primary btn-lg btn-block"/>';
$form .= '</form>';

echo $form;
?>
<?php if($toolbox->debug == false){ ?>
    <script type="text/javascript">
        document.getElementById('auto-submit-form').submit(); // SUBMIT FORM
    </script>
<?php } ?>

        </div></div></div>
<?php else: ?>
    <?php echo _('no POST data has been sent'); ?>
<?php endif; ?>
</body>
</html>
