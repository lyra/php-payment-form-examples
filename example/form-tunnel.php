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

<?php if(isset($_POST)): ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12" style="max-width: 92%;">
            <br><br>
            <h2><?php echo $i18n['datasent']; ?></h2>
            <p><?php echo $i18n['note']; ?> <br>
                <?php echo $i18n['debugdesc']; ?></p>
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
    $doclink = ($doc_name) ? 'https://payzen.io/'.$lang.'/form-payment/standard-payment/'.$doc_name.'.html': '#';
    $form .= '<tr>';
    $form .= '<td><label for="'. $name. '"><a target="_blank" href="'.$doclink.'">'.$name.'</a></label></td>';
    $form .= '<td><input type="text" readonly="readonly"  name="'.$name.'" value="'.$value.'" /></td>';
    $form .= '</tr>';
}
$form .= '</table>';
$form .= '<input type="submit" name="pay-submit" value="'.'Pay'.'" class="btn btn-primary btn-lg btn-block"/>';
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
    <?php echo $i18n['nopostdata']; ?>
<?php endif; ?>
</body>
</html>
