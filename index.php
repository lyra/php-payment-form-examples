<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra PHP payment form example. See COPYING.md for license details.
 *
 * @author    Lyra Network <https://www.lyra.com>
 * @copyright Lyra Network
 * @license   http://www.apache.org/licenses/
 */

session_start();

// I18N support information here.
if (isset($_GET['lang'])) {
    $lang = $_GET["lang"];
} elseif (isset($_SESSION["lang"])) {
    $lang = $_SESSION["lang"];
} else {
    $lang = 'en';
}

// Save language preference for future page requests.
$_SESSION["lang"] = $lang;
include implode(DIRECTORY_SEPARATOR, ['lib', 'locale', $lang, 'messages.php']);

if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (! empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ||
        $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';

    $site_url_full = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $uri_parts = explode('?', $site_url_full);
    $site_url = (isset($uri_parts[0])) ? $uri_parts[0] : $site_url_full;
} else {
    $site_url = 'http://localhost:8888';
}

require_once 'config/Config.php';
$configuration = new Config();
$iframe = false;
$target = '';
if ($configuration->getConfigParam('action_mode') == 'IFRAME') {
    $iframe = true;
    $target = 'target="payframe"';
}

?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title>PHP PAYMENT FORM EXEMPLE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Lyra</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo $i18n['contactus']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a target="_blank" href="https://www.lyra.com/support/">English</a></li>
                        <li><a target="_blank" href="https://www.lyra.com/fr/support/">French</a></li>
                        <li><a target="_blank" href="https://www.lyra.com/de/support/">German</a></li>
                        <li><a target="_blank" href="https://www.lyra.com/br/suporte/">Portugese</a></li>
                        <li><a target="_blank" href="https://www.lyra.com/es/contacto/">Spanish</a></li>
                    </ul>
                </li>
                <li>
                    <a target="_blank" href="https://github.com/lyra">Github</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo strtoupper($lang); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $site_url; ?>?lang=fr"><?php echo $i18n["fr"]; ?></a></li>
                        <li><a href="<?php echo $site_url; ?>?lang=en"><?php echo $i18n["en"]; ?></a></li>
                        <li><a href="<?php echo $site_url; ?>?lang=de"><?php echo $i18n["de"]; ?></a></li>
                        <li><a href="<?php echo $site_url; ?>?lang=es"><?php echo $i18n["es"]; ?></a></li>
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
            <h1>LYRA PHP PAYMENT FORM</h1>
            <p class="lead"><?php echo $i18n['starterkit'] ?> </p>
            <h2><?php echo $i18n['requirements']; ?>:</h2>
            <ul>
                <li>PHP (5.4 +)</li>
                <li><?php echo $i18n['in']; ?> <code>config/Config.php :</code>
                    <ul>
                        <li><?php echo $i18n['shopid']; ?> </li>
                        <li><?php echo $i18n['certtestprod']; ?> </li>
                        <li><?php echo $i18n['modetestprod']; ?> </li>
                        <li><?php echo $i18n['platformurl']; ?> </li>
                        <li><?php echo $i18n['debugdesc']; ?></li>
                    </ul>
                </li>
            </ul>

            <h2><?php echo $i18n['formexamples']; ?> </h2>
            <h2 style="text-align: center;"><?php $i18n['checkouttitle']; ?></h2>
            <form class="form-horizontal" role="form" action="standard-payment.php" method="post" id="checkout_form"
                  onsubmit="return checkmode();" <?php echo $target; ?>>
                <button type="button" class="accordion"><?php echo $i18n['orderdetails']; ?></button>
                <div class="panel">
                    <div class="col-md-9">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    <ul>
                                        <li><?php echo $i18n['item1']; ?></li>
                                        <li><?php echo $i18n['item2']; ?></li>
                                        <li>...</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li><?php echo $i18n['amount1']; ?></li>
                                        <li><?php echo $i18n['amount2']; ?></li>
                                        <li>...</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <div style="text-align: center;">
                            <h3><?php echo $i18n['total']; ?></h3>
                            <input class="forminput" style="color: #293c7a; text-align: center;" type="number"
                                   name="amount" id="amount" value="1000" required="true" min="0">
                            <label for="amount"><?php echo $i18n['amountdesc']; ?></label>
                            <select class="forminput" name="currency" id="currency">
                                <option value="978" selected>EUR</option>
                                <option value="840">USD</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="button" class="accordion"><?php echo $i18n['clientssettings']; ?></button>
                <div class="panel">
                    <input type="hidden" id="lang_code" name="lang_code" value="<?php echo $lang ?>">
                    <label style="width: 10%" for="order_id">order_id</label>
                    <input class="forminput" type="text" id="order_id" name="order_id" value="123456">
                    <label style="width: 60%" for="order_id"><?php echo $i18n['orderdesc']; ?></label><br>

                    <label style="width: 10%" for="cust_id">cust_id</label>
                    <input class="forminput" type="text" id="cust_id" name="cust_id" value="2380">
                    <label style="width: 60%" for="cust_id"><?php echo $i18n['custid']; ?></label><br>


                    <label style="width: 10%" for="cust_email">cust_email</label>
                    <input class="forminput" type="text" id="cust_email" name="cust_email" value="henri@gmail.com">
                    <label style="width: 60%" for="cust_email"><?php echo $i18n['custemail']; ?></label><br>

                    <label style="width: 10%" for="cust_first_name">cust_first_name</label>
                    <input class="forminput" type="text" id="cust_first_name" name="cust_first_name" value="Henri">
                    <label style="width: 60%" for="cust_first_name"><?php echo $i18n['custfirstname']; ?></label><br>

                    <label style="width: 10%" for="cust_last_name">cust_last_name</label>
                    <input class="forminput" type="text" id="cust_last_name" name="cust_last_name" value="Durand">
                    <label style="width: 60%" for="cust_last_name"><?php echo $i18n['custlastname']; ?></label><br>

                    <label style="width: 10%" for="cust_address">cust_address</label>
                    <input class="forminput" type="text" id="cust_address" name="cust_address" value="Bd Paul Pïcot">
                    <label style="width: 60%" for="cust_address"><?php echo $i18n['custaddress']; ?></label><br>

                    <label style="width: 10%" for="cust_city">cust_city</label>
                    <input class="forminput" type="text" id="cust_city" name="cust_city" value="TOULON">
                    <label style="width: 60%" for="cust_city"><?php echo $i18n['custcity']; ?></label><br>

                    <label style="width: 10%" for="cust_zip">cust_zip</label>
                    <input class="forminput" type="text" id="cust_zip" name="cust_zip" value="83200">
                    <label style="width: 60%" for="cust_zip"><?php echo $i18n['custzip']; ?></label><br>

                    <label style="width: 10%" for="cust_country">cust_country</label>
                    <input class="forminput" type="text" id="cust_country" name="cust_country" value="FR">
                    <label style="width: 60%" for="cust_country"><?php echo $i18n['custcountry']; ?></label><br>

                    <label style="width: 10%" for="cust_phone">cust_phone</label>
                    <input class="forminput" type="text" id="cust_phone" name="cust_phone" value="06002822672">
                    <label style="width: 60%" for="cust_phone"><?php echo $i18n['custphone']; ?></label><br>
                </div>

                <button type="button" class="accordion"><?php echo $i18n['payment']; ?></button>
                <div class="panel">
                    <div>
                        <input type="radio" id="paymentmethod" name="paymentmethod" value="standard"
                               checked> <?php echo $i18n['stdpayment']; ?><br>
                        <input type="radio" id="paymentmethod" name="paymentmethod"
                               value="multi2"> <?php echo $i18n['x2payment']; ?><br>
                        <input type="radio" id="paymentmethod" name="paymentmethod"
                               value="multi4"> <?php echo $i18n['x4payment']; ?><br>
                        <input type="radio" id="paymentmethod" name="paymentmethod"
                               value="echequesvacancespayment"> <?php echo $i18n['ecv']; ?><br>
                        <input type="radio" id="paymentmethod" name="paymentmethod"
                               value="cbpayment"> <?php echo $i18n['cbpayment']; ?>
                    </div>
                </div>

                <?php if ($iframe) { ?> <div id="iframeHolder"></div> <?php } ?>

                <button class="forminput" id="submitButton" type="submit" form="checkout_form" value="Submit"
                        action=""><?php echo $i18n['sendform']; ?></button>

                <script type="text/javascript">
                    function checkmode() {
                        var paymentmethod = $('input:radio[name="paymentmethod"]:checked').val();
                        var actionfile = '';
                        switch (paymentmethod) {
                            case 'standard':
                                actionfile = "example/standard-payment.php";
                                break;
                            case 'multi2':
                                actionfile = "example/2installment-payment.php";
                                break;
                            case 'multi4':
                                actionfile = "example/4installment-payment.php";
                                break;
                            case 'echequesvacancespayment':
                                actionfile = "example/e-cheques-vacances-payment.php";
                                break;
                            case 'cbpayment':
                                actionfile = "example/preselected-card-payment.php";
                                break;
                            default:
                                actionfile = "example/standard-payment.php";
                        }
                        document.getElementById("checkout_form").action = actionfile;
                        <?php if ($iframe) { ?>
                        //disable the submit button
                        enableSubmitButton();
                        $('#iframeHolder').html('<iframe name="payframe" src="' + actionfile + '" width="50%" height="550" scrolling="yes" /> <div style="float:right;"><button class="close" type="button" onclick="removeIframe();">X</button></div>');
                        <?php } ?>
                    }

                    <?php if ($iframe) { ?>
                    function removeIframe() {
                        $('#iframeHolder').html('');
                        //disable the submit button
                        enableSubmitButton();
                    }

                    function diableSubmitButton() {
                        $('#iframeHolder').html('');
                        //enable the submit button
                        $("#submitButton").attr("disabled", true);
                    }

                    function enableSubmitButton() {
                        $('#iframeHolder').html('');
                        //enable the submit button
                        $("#submitButton").attr("disabled", false);
                    }
                    <?php } ?>
                </script>
            </form>

            <h2><?php echo $i18n['paymentanalysis']; ?> </h2>
            <div id="Info">
                <strong><?php echo $i18n['ipn']; ?> </strong><br/>
                <p><?php echo $i18n['ipndesc']; ?> </p>

                <strong><?php echo $i18n['returnurl']; ?> </strong><br/>
                <p><?php echo $i18n['clientcomesback']; ?> </p>
                <p><?php echo $i18n['formreturndesc']; ?> </p>
            </div>

            <h2><?php echo $i18n['findhelp']; ?> </h2>
            <p><strong><?php echo $i18n['supportrecommends']; ?> </strong> <a href="https://payzen.io" target="_blank">
                    payzen.io</a></p>
        </div>
    </div>
    <!-- /.row -->
</div>

<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>