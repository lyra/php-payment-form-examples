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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo gettext('Contact us'); ?> <span class="caret"></span></a>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo gettext('Language'); ?> <span class="caret"></span></a>
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
        <div class="col-lg-12">
            <h1>VADS PAYMENT PHP</h1>
            <p class="lead"><?php echo gettext('A starter kit with your PayZen Payment Form'); ?> </p>

                <h2><?php echo _('Requirements'); ?> :</h2>

                <ul>
                    <li>PHP (5.4 +)</li>
                    <li><?php echo _('In'); ?> <code>config/config.php :</code>
                        <ul>
                            <li><?php echo gettext('Your SHOP ID'); ?> </li>
                            <li><?php echo gettext('Your Certificate (TEST or PRODUCTION)'); ?></li>
                            <li><?php echo gettext('Mode (TEST or PRODUCTION)'); ?></li>
                            <li><?php echo gettext('Platform URL'); ?></li>
                        </ul>
                    </li>

                </ul>

            <h2><?php echo gettext('Form Examples'); ?></h2>
            <ul>
                <li><a href="example/simple-form.php"><?php echo gettext('Simple Form'); ?></a></li>
                <li><a href="example/simple-form-with-card-preselected.php"><?php echo gettext('Simple form with card pre-selected and return URL'); ?></a></li>
                <li><a href="example/html-form.php"><?php echo gettext('Html form'); ?></a></li>
                <li><a href="example/installment-payment.php"><?php echo gettext('Installment payment'); ?></a></li>
                <li><a href="example/deferred-payment.php"><?php echo gettext('Deferred payment'); ?></a></li>
                <li><a href="example/authorization-without-capture.php"><?php echo gettext('Authorization without capture'); ?></a></li>
                <li><a href="example/subscription.php"><?php echo gettext('Monthly subscription'); ?></a></li>
                <li><a href="example/sepa.php"><?php echo gettext('Sepa'); ?></a></li>
                <li><a href="example/e-cheques-vacances.php"><?php echo gettext('E-chèques vacances'); ?></a></li>
                <li><a href="example/bootstrap-simple-form.php"><?php echo gettext('Simple Form with Bootstrap'); ?></a></li>
            </ul>

            <h2><?php echo gettext('PAYMENT ANALYSIS'); ?></h2>
            <div id="Info">
                <strong><?php echo gettext('Instant Payment Notification | ipn-return.php'); ?></strong><br />
                <p><?php echo gettext('When the payment is done, the gateway sends some parameters by POST mode to the server URL which analyzes the payment results. First you have to check the signature. If it is correct then you will be able to take the payment parameters into consideration.'); ?></p>

                <strong>form-return.php</strong><br />
                <p><?php echo gettext('In this package, the <code>form-return.php</code> file controls the signature and analyzes the payment results. First the script checks the signature and then analyzes the main fields. It is up to you to adapt the code to your context.'); ?></p>

                <strong><?php echo gettext('Return URLs'); ?></strong><br />
                <p><?php echo gettext('When the customer comes back to the shop through one of the return URLs, the payment parameters are sent back depending on the <code>vads_return_mode</code>. Depending on the <code>vads_return_mode</code> setting, the parameters are sent by POST mode, GET mode or not at all.'); ?></p>

            </div>

            <h2><?php echo gettext('Find HELP'); ?></h2>
            <p><strong><?php echo gettext('The PAYZEN support recommends to read the settings analysis documentation'); ?></strong> <a href="https://payzen.io" target="_blank">on payzen.io</a></p>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

</body>
</html>