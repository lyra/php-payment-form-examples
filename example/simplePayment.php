<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PayZen VADS Starter Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      padding-top: 70px;
      /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script
    src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script
    src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
  .form-control{max-width:320px;}
</style>
</head>

<body style="padding: 0;">


<!-- Page Content -->
<div class="container">

  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="page-header">PayZen VADS Starter Template</h1>
      <?php
      /*
       * PayZen VADS payment example
       *
       * @version 0.6
       *
       */
      $toolbox = require "../lib/payzenBootstrap.php";

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
      <form  class="form-horizontal" action="<?php echo $formData['form']['action'] ?>"
            method="<?php echo $formData['form']['method'] ?>"
            enctype="<?php echo $formData['form']['enctype'] ?>"
            accept-charset="<?php echo $formData['form']['accept-charset'] ?>" >
      <?php foreach($formData['fields'] as $name => $value) { ?>
      <div class="form-group">
        <label for="<?php echo $name ?>" class="col-sm-2 control-label"><?php echo $name ?></label>
        <div class="col-sm-10">
          <input class="form-control" type="text" readonly="readonly" name="<?php echo $name ?>" value="<?php echo $value ?>" />
        </div>
       </div>
      <?php } ?>
      <input type="submit" class="btn btn-default btn-lg btn-success" name="Time To" value="Pay" />
      </form>
    </div>
  </div>
  <!-- /.row -->

</div>
<!-- /.container -->

<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
