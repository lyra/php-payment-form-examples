<?php
/*
 * PayZen VADS payment example
 *
 * @version 0.6
 *
 */

$toolbox = require "payzen.bootstrap.php";

// One can overrides the IPN url configured in the PayZen back-office
//$toolbox->setIpnUrl('[***CHANGE-ME***]');

// One can overrides the return url configured in the PayZen back-office
//$toolbox->setReturnUrl('http://[***CHANGE-ME***]');

// Generation of the data being transmitted to PayZen by HTML form
$formData = $toolbox->getFormData(
  substr(time(), -6)     // a daily-unique transaction id - Change-it to reflect your needs
 , '4300'                // payment amount - Change-it to reflect your needs
 , '978'                 // payment currency code - Change-it to reflect your needs
);


?>
<html>
 <head>
  <title>PayZen Form Payment Example</title>
  <style>
   label {font-weight: bold;width:170px;display:inline-block;text-align:right;padding:2px 10px 2px 0px;}
   input[type=text] {width:350px;}
  </style>
 </head>
 <body>
  <form action="<?php echo $formData['form']['action'] ?>"
        method="<?php echo $formData['form']['method'] ?>"
        enctype="<?php echo $formData['form']['enctype'] ?>"
        accept-charset="<?php echo $formData['form']['accept-charset'] ?>" />
  <?php foreach($formData['fields'] as $name => $value) { ?>
    <label><?php echo $name ?></label>
    <input type="text" readonly="readonly" name="<?php echo $name ?>" value="<?php echo $value ?>" />
   <br />
  <?php } ?> 
   <input type="submit" name="Time To" value="Pay" />
  </form>
 </body>
</html>
