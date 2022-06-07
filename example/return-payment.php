<?php
session_start();

// I18N support information here.
if (isset($_REQUEST['vads_language'])
    &&
    in_array($_REQUEST['vads_language'],
             array ('en', 'fr'),
             true
    )
) {
    $lang = $_REQUEST["vads_language"];
} else {
    $lang = 'en';
}

// Save language preference.
$_SESSION["lang"] = $lang;
include implode(DIRECTORY_SEPARATOR,
                ['..', 'lib', 'locale', $lang, 'messages.php']
);

if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = ((! empty($_SERVER['HTTPS'])
            &&
            $_SERVER['HTTPS'] !==
            'off') ||
        $_SERVER['SERVER_PORT'] ==
        443) ? 'https://' : 'http://';
    $site_url_full = $protocol .
        $_SERVER['HTTP_HOST'] .
        $_SERVER['REQUEST_URI'];
    $uri_parts = explode('?',
                         $site_url_full
    );
    $site_return_url = (isset($uri_parts[0])) ? $uri_parts[0] : $site_url_full;
    $site_url = preg_replace('/example\/return-payment.php$/',
                             '',
                             $site_return_url
    );
} else {
    $site_url = 'http://localhost:8888/';
}

// Load gateway response.
require_once implode(DIRECTORY_SEPARATOR, ['..', 'init.php']); // loads the autoloader.
$paymentProcessor = new LyraPaymentProcessor();
$authentified = $paymentProcessor->checkResponse($_REQUEST);

$authStatus = ($authentified) ? $i18n['validsign'] : $i18n['invalidsigndesc'];

if ($authentified) {
    // Now the merchant is supposed to compare his order data with the response data and update his database.
    $transStatus = (isset($_REQUEST['vads_trans_status'])) ? $i18n[strtolower($_REQUEST['vads_trans_status'])] : '';

    $authResult = (isset($_REQUEST['vads_auth_result'])
        &&
        ! empty($_REQUEST['vads_auth_result'])) ?
        $i18n['vads_auth_result_' .
        $_REQUEST['vads_auth_result']] : '';

    $result = (isset($_REQUEST['vads_result'])) ? $i18n[$_REQUEST['vads_result']] : '';

    $paymentConfig = '';
    if (isset($_REQUEST['vads_result'])) {
        if (strcmp($_REQUEST['vads_result'],
                   'SINGLE'
        )) {
            $paymentConfig = ':' .
                $i18n['standard'];
        } elseif (substr($_REQUEST['vads_result'],
                         0,
                         strlen('MULTI')
            ) ===
            'MULTI') {
            $paymentConfig = ':' .
                $i18n['multi'];
        }
    }

    $warrantyResult = (isset($_REQUEST['vads_warranty_result']) &&
        ! empty($_REQUEST['vads_warranty_result'])) ?
        $i18n['vads_warranty_result_' .
        strtolower($_REQUEST['vads_warranty_result'])]
        : $i18n['vads_warranty_result_x'];

    $threedsStatus = (isset($_REQUEST['vads_threeds_status']) &&
        ! empty($_REQUEST['vads_threeds_status'])) ?
        $i18n['vads_threeds_status_' .
        strtolower($_REQUEST['vads_threeds_status'])]
        : $i18n['vads_threeds_status_x'];

    $captureDelay = (isset($_REQUEST['vads_capture_delay'])) ?
        $_REQUEST['vads_capture_delay'] .
        " " .
        $i18n['days'] .
        "." : '';

    $validationMode = (isset($_REQUEST['vads_validation_mode']) &&
        ! empty($_REQUEST['vads_validation_mode'])) ?
        $i18n['vads_validation_mode_' .
        strtolower($_REQUEST['vads_validation_mode'])]
        : $i18n['vads_validation_mode_x'];

}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title>PayZen - VADS PAYMENT PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo $i18n['contactus']; ?> <span class="caret"></span></a>
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
                <li>
                    <a href="#"><?php echo strtoupper($lang); ?></a>
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
            <h1><?php echo $i18n['formexampleresponse']; ?> </h1>
            <button type="button" class="accordion"><?php echo "Check Authentification"; ?></button>
            <div class="panel">
                <div class="col-md-9">
                    <table class="table table-striped">
                        <tr>
                            <td> <?php echo $i18n['auth']; ?> </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3">
                    <div style="text-align: center;">
                        <h3><?php echo $authStatus; ?></h3>
                    </div>
                </div>
            </div>
            <?php if ($authentified) { ?>
                <button type="button" class="accordion"><?php echo $i18n['responsessettings']; ?></button>
                <div class="panel">
                    <label style="width: 15%" for="vads_trans_status">vads_trans_status</label>
                    <input class="forminput" type="text" id="vads_trans_status" name="vads_trans_status"
                           value="<?php echo $_REQUEST['vads_trans_status']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_trans_status"><?php echo $i18n['vads_trans_status'] .
                            ' : ' .
                            $transStatus; ?>
                    </label>
                    <br>

                    <label style="width: 15%" for="vads_result">vads_result</label>
                    <input class="forminput" type="text" id="vads_result" name="vads_result"
                           value="<?php echo $_REQUEST['vads_result']; ?>" readonly>
                    <label style="width: 60%" for="vads_result"><?php echo $i18n['result'] .
                            ' : ' .
                            $result; ?></label><br>

                    <label style="width: 15%" for="vads_trans_id">vads_trans_id</label>
                    <input class="forminput" type="text" id="vads_trans_id" name="vads_trans_id"
                           value="<?php echo $_REQUEST['vads_trans_id']; ?>" readonly>
                    <label style="width: 60%" for="vads_trans_id"><?php echo $i18n['vads_trans_id']; ?></label><br>

                    <label style="width: 15%" for="vads_amount">vads_amount</label>
                    <input class="forminput" type="text" id="vads_amount" name="vads_amount"
                           value="<?php echo $_REQUEST['vads_amount']; ?>" readonly>
                    <label style="width: 60%" for="vads_amount"><?php echo $i18n['vads_amount']; ?></label><br>

                    <label style="width: 15%" for="vads_effective_amount">vads_effective_amount</label>
                    <input class="forminput" type="text" id="vads_effective_amount" name="vads_effective_amount"
                           value="<?php echo $_REQUEST['vads_effective_amount']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_effective_amount"><?php echo $i18n['vads_effective_amount'] .
                            $i18n['vads_effective_amount_desc']; ?>
                    </label><br>

                    <label style="width: 15%" for="vads_payment_config">vads_payment_config</label>
                    <input class="forminput" type="text" id="vads_payment_config" name="vads_payment_config"
                           value="<?php echo $_REQUEST['vads_payment_config']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_payment_config"><?php echo $i18n['vads_payment_config'] .
                            ' : ' .
                            $paymentConfig; ?>
                    </label><br>

                    <label style="width: 15%" for="vads_sequence_number">vads_sequence_number</label>
                    <input class="forminput" type="text" id="vads_sequence_number" name="vads_sequence_number"
                           value="<?php echo $_REQUEST['vads_sequence_number']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_sequence_number"><?php echo $i18n['vads_sequence_number'] ?></label><br>

                    <label style="width: 15%" for="vads_auth_result">vads_auth_result</label>
                    <input class="forminput" type="text" id="vads_auth_result" name="vads_auth_result"
                           value="<?php echo $_REQUEST['vads_auth_result']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_auth_result"><?php echo $i18n['vads_auth_result'] .
                            ' : ' .
                            $authResult; ?>
                    </label><br>

                    <label style="width: 15%" for="vads_warranty_result">vads_warranty_result</label>
                    <input class="forminput" type="text" id="vads_warranty_result" name="vads_warranty_result"
                           value="<?php echo $_REQUEST['vads_warranty_result']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_warranty_result"><?php echo $i18n['vads_warranty_result'] .
                            ' : ' .
                            $warrantyResult; ?>
                    </label><br>

                    <label style="width: 15%" for="vads_threeds_status">vads_threeds_status</label>
                    <input class="forminput" type="text" id="vads_threeds_status" name="vads_threeds_status"
                           value="<?php echo $_REQUEST['vads_threeds_status']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_threeds_status"><?php echo $i18n['vads_threeds_status'] .
                            ' : ' .
                            $threedsStatus; ?>
                    </label><br>

                    <label style="width: 15%" for="vads_capture_delay">vads_capture_delay</label>
                    <input class="forminput" type="text" id="vads_capture_delay" name="vads_capture_delay"
                           value="<?php echo $_REQUEST['vads_capture_delay']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_capture_delay"><?php echo $i18n['vads_capture_delay'] .
                            ' : ' .
                            $captureDelay; ?>
                    </label><br>

                    <label style="width: 15%" for="vads_validation_mode">vads_validation_mode</label>
                    <input class="forminput" type="text" id="vads_validation_mode" name="vads_validation_mode"
                           value="<?php echo $_REQUEST['vads_validation_mode']; ?>" readonly>
                    <label style="width: 60%"
                           for="vads_validation_mode"><?php echo $i18n['vads_validation_mode'] .
                            ' : ' .
                            $validationMode; ?>
                    </label><br>
                </div>
                <button type="button" class="accordion"><?php echo $i18n['allReceivedData']; ?></button>
                <div class="panel">
                    <?php
                    foreach ($_REQUEST
                             as
                             $key
                    =>
                             $value)
                    { ?>
                        <label style="width: 20%" for="<?php echo $key; ?>"><?php echo $key; ?></label>
                        <input class="forminput" type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>"
                               value="<?php echo $value; ?>" readonly><br>
                    <?php } ?>
                </div>
            <?php } ?>
            <br/>
            <h1><?php echo $i18n['paymentresponseanalysis']; ?> </h1>
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
</div>

<script type="text/javascript" src="../assets/js/script.js"></script>

</body>
</html>