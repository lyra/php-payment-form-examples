<?php
session_start();
//language
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PayZen - VADS PAYMENT PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="lib/acc.css">

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>

<body>
<h2 style="text-align: center;">
    Review Your Order and Complete Checkout
</h2>

<form class="form-horizontal" role="form" action="payment_router.php" method="post" id="payment_form" onsubmit="return checkmode();">
    <button type="button" class="accordion">Order details</button>
    <div class="panel">
      <div class="col-md-9">
          <table class="table table-striped">
              <tr>
                  <td>
                      <ul>
                          <li>Stickers.</li>
                          <li>Coloring pen.</li>
                      </ul>
                  </td>
                  <td>
                    <ul>
                          <li>$10.00</li>
                          <li>$20.00</li>
                    </ul>
                  </td>
              </tr>
          </table>
      </div>
      <div class="col-md-3">
          <div style="text-align: center;">
              <h3>Order Total</h3>
              <h3><span style="color:green; text-align: center;">$30.00</span></h3>
          </div>
      </div>
    </div>

    <button type="button" class="accordion">Client information</button>
    <div class="panel">
      <p>Lorem ipsum...</p>
    </div>

    <button type="button" class="accordion">Payment Method</button>
    <div class="panel">
        <div>
          <input type="radio" id="paymentmethod" name="paymentmethod" value="standard" checked> Payment par carte bancaire.<br>
          <input type="radio" id="paymentmethod" name="paymentmethod" value="multi"> Payment en plusieurs fois par carte bancaire.<br>
          <input type="radio" id="paymentmethod" name="paymentmethod" value="deferred"> Payment différé en plusieurs fois par carte bancaire.<br>
          <input type="radio" id="paymentmethod" name="paymentmethod" value="iframe"> Payment par iframe.
        </div>
    </div>

    <?php require_once '../config/config.php';
          $configuration = new ModuleConfiguration();
          $iframe = ($configuration->getConfigParam('action_mode') == 'IFRAME');
          if ($iframe) {
     ?>
            <div id="iframeHolder"></div>
    <?php } ?>

    <button id="submitButton" type="submit" form="payment_form" value="Submit" action="">Submit</button>

    <?php if ($iframe) { ?>
      <script type="text/javascript">
          function checkmode() {
            //disable the submit button
            $("#submitButton").attr("disabled", true);

            $('#iframeHolder').html('<iframe name="payframe" src="iframe-payment.php" width="600" height="550" scrolling="yes" /> <div style="float:right;"><button type="button" value = "x" height="30" width="30" onclick="window.parent.removeIframe();"/></div>');
            return false;
          }
      </script>
    <?php }else{ ?>
      <script type="text/javascript">
          function checkmode() {}
      </script>
    <?php } ?>
</form>

<script type="text/javascript" src="lib/acc.js"></script>
</body>
</html>