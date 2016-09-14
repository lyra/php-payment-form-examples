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
$_SESSION["lang"]  = $lang;
$encoding = "UTF-8";

if($lang == 'fr_FR'){
    include '../lib/locale/fr_FR/messages.php';
} else {
    include '../lib/locale/en_EN/messages.php';
}

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
            <a class="navbar-brand" href="<?php echo $site_url; ?>">PayZen</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $i18n['contactus']; ?> <span class="caret"></span></a>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $i18n['lang']; ?> <span class="caret"></span></a>
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
                <h2><?php echo $i18n['payzensolution']; ?> </h2>
                <div id="Info">
                    <p><b><?php echo $i18n['info']; ?></b></p>
                    <p><?php echo $i18n['usesform']; ?></p>
                    <p><strong><?php echo $i18n['file']; ?> config.php</strong></p>
                    <p><?php echo $i18n['beforefirstuse']; ?></p>

                    <p><strong><u><?php echo $i18n['file']; ?> html-form.php</u></strong></p>
                    <p><?php echo $i18n['htmlformuse']; ?></p>

                </div>
                </div>
            </div>

<form style="margin-top:10px;" method="POST" action="form-tunnel.php">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td colspan="3" class="title_array"><h2><?php echo $i18n['transsettings']; ?></h2></td>
        </tr>
        <tr>
            <td class="field_mandatory text-danger"><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-amount.html">vads_amount</a></td>
            <td><input type="text" class="form-control" name="vads_amount" value="1000" size="20"></td>
            <td  class="text-right text-danger">
                <?php echo $i18n['amountdesc']; ?></td>
        </tr>

        <tr>
            <td colspan="3"><h3><?php echo $i18n['clientssettings']; ?></h3></td>
        </tr>

        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-order-id.html">vads_order_id</a></td>
            <td><input type="text" class="form-control" name="vads_order_id" value="123456" size="20"></td>
            <td><?php echo $i18n['orderdesc']; ?></td>
        </tr>

        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-id.html">vads_cust_id</a></td>
            <td><input type="text" class="form-control" name="vads_cust_id" value="2380" size="20"></td>
            <td class="text-right"><?php echo $i18n['custid']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-name.html">vads_cust_name</a></td>
            <td><input type="text" class="form-control" name="vads_cust_name" value="Henri Durand" size="20"></td>
            <td class="text-right"><?php echo $i18n['custname']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-address.html">vads_cust_address</a></td>
            <td><input type="text" class="form-control" name="vads_cust_address" value="Bd Paul Picot" size="20"></td>
            <td class="text-right"><?php echo $i18n['custaddress']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-zip.html">vads_cust_zip</a></td>
            <td><input type="text" class="form-control" name="vads_cust_zip" value="83200" size="20"></td>
            <td class="text-right"><?php echo $i18n['custzip']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-city.html">vads_cust_city</a></td>
            <td><input type="text" class="form-control" name="vads_cust_city" value="TOULON" size="20"></td>
            <td class="text-right"><?php echo $i18n['custcity']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-country.html">vads_cust_country</a></td>
            <td><input type="text" class="form-control" name="vads_cust_country" value="FR" size="20"></td>
            <td class="text-right"><?php echo $i18n['custcountry']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-phone.html">vads_cust_phone</a></td>
            <td><input type="text" class="form-control" name="vads_cust_phone" value="06002822672" size="20"></td>
            <td class="text-right"><?php echo $i18n['custphone']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-cust-email.html">vads_cust_email</a></td>
            <td><input type="text" class="form-control" name="vads_cust_email" size="20" placeholder="john@email.com"></td>
            <td class="text-right"><?php echo $i18n['custemail']; ?></td>
        </tr>

        <tr>
            <td colspan="3"><h3><?php echo $i18n['returnurl']; ?></h3></td>
        </tr>

        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-url-return.html">vads_url_return</a></td>
            <td><input type="text" class="form-control" name="vads_url_return" value="http://localhost:8888/vads-payment-php/return/form-return.php" placeholder="http://localhost:8888/vads-payment-php/return/form-return.php" size="20"></td>
            <td><?php echo $i18n['urlreturndesc']; ?></td>
        </tr>
        <tr>
            <td><a target="_blank" href="https://payzen.io/<?php echo $lang_doc; ?>/form-payment/standard-payment/vads-redirect-success-timeout.html">vads_redirect_success_timeout</a></td>
            <td><input type="text" class="form-control" name="vads_redirect_success_timeout" value="10" placeholder="10" size="20"></td>
            <td><?php echo $i18n['redirect']; ?></td>
        </tr>

        </tbody></table>
    <br><br>

    <button type="submit" class="btn btn-primary btn-lg btn-block">
        <?php echo $i18n['sendform']; ?> form-tunnel.php
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