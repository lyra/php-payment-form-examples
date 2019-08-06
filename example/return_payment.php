<?php
    // Load gateway response.
    require_once '../payment/entity/PaymentProcessor.php';
    //Module configuration parameters

    $paymentProcessor = new PaymentProcessor();
    $message = $paymentProcessor->checkResponse($_REQUEST);
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Retour du paiement</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="form-style-3">
        <form method="POST" >
            <fieldset><legend>Résumé</legend>
                    <label for="auth"><span>Notification</span><input name="auth" value="Success" type="text" class="input-field" disabled/></label>
                    <label for="ctx_mode"><span>ctx_mode</span><input name="ctx_mode" value="<?php echo $message; ?>" type="text" class="input-field" disabled/></label>
            </fieldset>
        </form>
</body>
</html>