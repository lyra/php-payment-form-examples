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
$domain = 'messages';
$folder = "lib/locale";
$encoding = "UTF-8";

if($lang == 'fr_FR'){
    include 'lib/locale/fr_FR/messages.php';
} else {
    include 'lib/locale/en_EN/messages.php';
}
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
        <div class="col-lg-12">
            <h1>VADS PAYMENT PHP</h1>
            <p class="lead"><?php echo $i18n['starterkit'] ?> </p>

                <h2><?php echo $i18n['requirements']; ?> :</h2>

                <ul>
                    <li>PHP (5.4 +)</li>
                    <li><?php echo $i18n['in']; ?> <code>config/config.php :</code>
                        <ul>
                            <li><?php echo $i18n['shopid']; ?> </li>
                            <li><?php echo $i18n['certtestprod']; ?> </li>
                            <li><?php echo $i18n['modetestprod']; ?> </li>
                            <li><?php echo $i18n['platformurl']; ?> </li>
                        </ul>
                    </li>

                </ul>

            <h2><?php echo $i18n['formexamples']; ?> </h2>
            <ul>
                <li><a href="example/html-form.php"><?php echo $i18n['htmlform']; ?> </a></li>
                <li><a href="example/simple-form.php"><?php echo $i18n['simpleform']; ?> </a></li>
                <li><a href="example/simple-form-with-card-preselected.php"><?php echo $i18n['simpleformextended']; ?> </a></li>
                <li><a href="example/installment-payment.php"><?php echo $i18n['installment']; ?> </a></li>
                <li><a href="example/deferred-payment.php"><?php echo $i18n['deferred']; ?> </a></li>
                <li><a href="example/authorization-without-capture.php"><?php echo $i18n['authwithoutcapt']; ?> </a></li>
                <li><a href="example/subscription.php"><?php echo $i18n['monthsub']; ?> </a></li>
                <li><a href="example/sepa.php"><?php echo $i18n['sepa']; ?> </a></li>
                <li><a href="example/e-cheques-vacances.php"><?php echo $i18n['ecv']; ?> </a></li>
                <li><a href="example/bootstrap-simple-form.php"><?php echo $i18n['simpleformboots']; ?> </a></li>
            </ul>

            <h2><?php echo $i18n['paymentanalysis']; ?> </h2>
            <div id="Info">
                <strong><?php echo $i18n['ipn']; ?> <code>ipn-return.php</code></strong><br />
                <p><?php echo $i18n['ipndesc']; ?> </p>

                <strong><?php echo $i18n['returnurl']; ?> </strong><code>form-return.php</code><br />
                <p><?php echo $i18n['clientcomesback']; ?> </p>
                <p><?php echo $i18n['formreturndesc']; ?> </p>
            </div>

            <h2><?php echo $i18n['findhelp']; ?> </h2>
            <p><strong><?php echo $i18n['supportrecommends']; ?> </strong> <a href="https://payzen.io" target="_blank"> payzen.io</a></p>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

</body>
</html>