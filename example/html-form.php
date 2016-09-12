<?php
session_start();
// I18N support information here
if(isset($_GET['lang'])){
    $lang = $_GET["lang"];
} elseif (isset($_SESSION["lang"])) {
    $lang  = $_SESSION["lang"];
} else {
    $lang = 'en_EN';
}

// save language preference for future page requests
$_SESSION["Language"]  = $lang;
$domain = 'messages';
$folder = "lib/locale";
$encoding = "UTF-8";

putenv("LANG=" . $lang);
setlocale(LC_ALL, $lang);

// Set the text domain as 'messages'
bindtextdomain($domain, $folder);
bind_textdomain_codeset($domain, $encoding);
textdomain($domain);

//vars
$protocol = ( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://' ;
$site_url_full =  $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$uri_parts = explode('?',$site_url_full);
$site_url = (isset($uri_parts[0])) ? $uri_parts[0] : $site_url_full;
$lang_doc = (!empty($lang)) ? str_replace('_','-',$lang) : 'en-EN';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title>PayZen - VADS PAYMENT PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 70px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
            padding-bottom: 8em;
        }
        .form-control{min-width: 220px;}
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">PayZen</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Contact us'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a target="_blank" href="https://payzen.io/en-EN/support/">English</a></li>
                        <li><a target="_blank" href="https://payzen.io/fr-FR/support/">French</a></li>
                        <li><a target="_blank" href="https://payzen.io/de-DE/support/">German</a></li>
                        <li><a target="_blank" href="https://payzen.io/pt-BR/support/">Portugese</a></li>
                        <li><a target="_blank" href="https://payzen.io/es-CL/support/">Spanish</a></li>
                    </ul>

                </li>

                <li>
                    <a target="_blank" href="https://github.com/payzen">Github</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo _('Language'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $site_url; ?>?lang=fr_FR">French</a></li>
                        <li><a href="<?php echo $site_url; ?>?lang=en_EN">English</a></li>

                        <li role="separator" class="divider"></li>
                        <li><a href="#"><code>Coming soon</code></a></li>
                        <li><a href="#">Portuguese</a></li>
                        <li><a href="#">German</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12" style="max-width: 92%;">
            <br><br>
            <div class="bg-info">
                <div style="padding: 2em;">
                <h2><?php echo _('PAYZEN PAYMENT SOLUTION IMPLEMENTATION EXAMPLE'); ?> </h2>
                <div id="Info">
                    <p><b><?php echo _('INFORMATIONS'); ?></b></p>
                    <p><?php echo _("The payment uses the sending of a payment form to PAYZEN payment gateway URL."); ?></p>
                    <p><strong><?php echo _('File'); ?> config.php</strong></p>
                    <p><?php echo _('Before the first use you have to fill the <code>shopID</code>, <code>certTest</code>, <code>platform</code> and <code>ctxMode</code> of the <code>config/config.php</code>.e. This file contains secure data.  <b>This data securing is on your responsibility.</b>'); ?></p>

                    <p><strong><u><?php echo _('File'); ?> html-form.php</u></strong></p>
                    <p><?php echo _("the file <code>html-form.php</code> sends these payment fields to the<code>form-tunnel.php</code>  which fetch these fields to create the payment request.</p>
                    <p>These fields are filled with examples, it is up to you to fill them depending on your context and configuration.</p>
                    <p><b>Some other fields are available, PAYZEN support recommends to read the payment form documentation</b> <a href='https://payzen.io'>Read the documentation.</a>"); ?></p>

                </div>
                </div>
            </div>

<form style="margin-top:10px;" method="POST" action="form-tunnel.php">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td colspan="3" class="title_array"><h2><?php echo _('TRANSACTION SETTINGS'); ?></h2></td>
        </tr>
        <tr>
            <td class="field_mandatory text-danger"><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-amount.html">vads_amount</a></td>
            <td><input type="text" class="form-control" name="vads_amount" value="1000" size="20"></td>
            <td  class="text-right text-danger">
                <?php echo _('Order amount set in the smallest currency unit. Cents for EURO. Ex: 1000 for 10 euros'); ?></td>
        </tr>

        <tr>
            <td colspan="3"><h3><?php echo _('CLIENT SETTINGS'); ?></h3></td>
        </tr>

        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-order-id.html">vads_order_id</a></td>
            <td><input type="text" class="form-control" name="vads_order_id" value="123456" size="20"></td>
            <td><?php echo _('Order number. Optional setting. Length of field: 32 characters max - Alphanumeric Type'); ?></td>
        </tr>

        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-id.html">vads_cust_id</a></td>
            <td><input type="text" class="form-control" name="vads_cust_id" value="2380" size="20"></td>
            <td class="text-right"><?php echo _('Customer number. Optional setting. Length of field: 32 characters max - Alphanumeric Type'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-name.html">vads_cust_name</a></td>
            <td><input type="text" class="form-control" name="vads_cust_name" value="Henri Durand" size="20"></td>
            <td class="text-right"><?php echo _('Customer name. Optional setting. Length of field: 127 characters max - Alphanumeric Type'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-address.html">vads_cust_address</a></td>
            <td><input type="text" class="form-control" name="vads_cust_address" value="Bd Paul Picot" size="20"></td>
            <td class="text-right"><?php echo _('Customer address. Optional setting. Length of field: 255 characters max - Alphanumeric Type'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-zip.html">vads_cust_zip</a></td>
            <td><input type="text" class="form-control" name="vads_cust_zip" value="83200" size="20"></td>
            <td class="text-right"><?php echo _('Customer Postal Code. Optional setting. Length of field: 32 characters max - Alphanumeric Type'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-city.html">vads_cust_city</a></td>
            <td><input type="text" class="form-control" name="vads_cust_city" value="TOULON" size="20"></td>
            <td class="text-right"><?php echo _('Customer City. Optional setting. Length of field: 63 characters max - Alphanumeric Type'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-country.html">vads_cust_country</a></td>
            <td><input type="text" class="form-control" name="vads_cust_country" value="FR" size="20"></td>
            <td class="text-right"><?php echo _('Customer Country. Customer country code according to the ISO 3166 norm. Optional setting. Length of field: 2 characters max - Alphanumeric Type'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-phone.html">vads_cust_phone</a></td>
            <td><input type="text" class="form-control" name="vads_cust_phone" value="06002822672" size="20"></td>
            <td class="text-right"><?php echo _('Customer Phone Number. Optional setting. Length of field: 32 characters max - Alphanumeric Type'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-email.html">vads_cust_email</a></td>
            <td><input type="text" class="form-control" name="vads_cust_email" size="20" placeholder="john@email.com"></td>
            <td class="text-right"><?php echo _('Customer Email. Optional setting.'); ?></td>
        </tr>

        <tr>
            <td colspan="3"><h3><?php echo _('RETURN URL'); ?></h3></td>
        </tr>

        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-url-return.html">vads_url_return</a></td>
            <td><input type="text" class="form-control" name="vads_url_return" value="http://localhost:8888/vads-payment-php/return/form-return.php" placeholder="http://localhost:8888/vads-payment-php/return/form-return.php" size="20"></td>
            <td><?php echo _('Default URL to where the buyer will be redirected. If this field has not been transmitted, the Back Office configuration will be taken into account.'); ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-redirect-success-timeout.html">vads_redirect_success_timeout</a></td>
            <td><input type="text" class="form-control" name="vads_redirect_success_timeout" value="10" placeholder="10" size="20"></td>
            <td><?php echo _('delay in seconds before an automatic redirection to the merchant website at the end of an accepted payment.'); ?></td>
        </tr>

        </tbody></table>
    <br><br>

    <button type="submit" class="btn btn-primary btn-lg btn-block">
        <?php echo _('Validate and send the settings  <br>by POST mode to'); ?> form-tunnel.php
    </button>
</form>
</div>
        </div>
    </div>

<br><br>
<hr>
<br>
</body>
</html>