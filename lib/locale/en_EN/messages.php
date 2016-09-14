<?php
$i18n = array();
$i18n['starterkit']= 'A starter kit with your PayZen Payment Form';
$i18n['lang']= 'Language';$i18n['contactus']= 'Contact us';
$i18n['shopid']= 'Your SHOP ID';
$i18n['requirements']= 'Requirements';
$i18n['in']= 'In';
$i18n['certtestprod']= 'Your Certificate (TEST or PRODUCTION)';
$i18n['modetestprod']= 'Mode (TEST or PRODUCTION)';
$i18n['platformurl']= 'Platform URL';
$i18n['formexamples']= 'Form Examples';
$i18n['htmlform']= 'Html form with client\'s informations and return URL';
$i18n['simpleform']= 'Simple Form';
$i18n['simpleformextended']= 'Simple form with card pre-selected and return URL';
$i18n['installment']= 'Installment payment';
$i18n['deferred']= 'Deferred payment';
$i18n['monthsub']= 'Monthly subscription';
$i18n['authwithoutcapt'] = 'Authorization without capture';
$i18n['sepa']= 'Sepa';
$i18n['ecv']= 'E-chèques vacances';
$i18n['simpleformboots']= 'Simple Form with Bootstrap';
$i18n['paymentanalysis']= 'PAYMENT ANALYSIS';
$i18n['ipn']= 'Instant Payment Notification';
$i18n['ipndesc']= 'When the payment is done, the gateway sends some parameters by POST mode to the server URL which analyzes the payment results. First you have to check the signature. If it is correct then you will be able to take the payment parameters into consideration.';
$i18n['returnurl']= 'Return URLs';
$i18n['clientcomesback']= 'When the customer comes back to the shop through one of the return URLs, the payment parameters are sent back depending on the <code>vads_return_mode</code>. Depending on the <code>vads_return_mode</code> setting, the parameters are sent by POST mode, GET mode or not at all.';
$i18n['formreturndesc']= 'In this package, the <code>form-return.php</code> file controls the signature and analyzes the payment results. First the script checks the signature and then analyzes the main fields. It is up to you to adapt the code to your context.';
$i18n['findhelp']= 'Find HELP';
$i18n['supportrecommends']= 'The PAYZEN support recommends to read the settings analysis documentation on';

/**
 * html form
 */
$i18n['payzensolution'] = 'PAYZEN PAYMENT SOLUTION IMPLEMENTATION EXAMPLE';
$i18n['info'] = 'INFORMATIONS';
$i18n['usesform'] = 'The payment uses the sending of a payment form to PAYZEN payment gateway URL.';
$i18n['file'] = 'File';
$i18n['htmlformuse'] = 'the file <code>html-form.php</code> sends these payment fields to the<code>form-tunnel.php</code>  which fetch these fields to create the payment request.</p><p>These fields are filled with examples, it is up to you to fill them depending on your context and configuration.</p><p><b>Some other fields are available, PAYZEN support recommends to read the payment form documentation</b> <a href="https://payzen.io">Read the documentation.</a>';
$i18n['beforefirstuse'] = 'Before the first use you have to fill the <code>shopID</code>, <code>certTest</code>, <code>platform</code> and <code>ctxMode</code> of the <code>config/config.php</code>.e. This file contains secure data.  <b>This data securing is on your responsibility.</b>';
$i18n['transsettings'] = 'TRANSACTION SETTINGS';
$i18n['clientssettings'] = 'CLIENT SETTINGS';
$i18n['amountdesc'] = 'Order amount set in the smallest currency unit. Cents for EURO. Ex: 1000 for 10 euros';
$i18n['orderdesc'] = 'Order number. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custid'] = 'Customer number. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custname'] = 'Customer name. Optional setting. Length of field: 127 characters max - Alphanumeric Type';
$i18n['custaddress'] = 'Customer address. Optional setting. Length of field: 255 characters max - Alphanumeric Type';
$i18n['custzip'] = 'Customer Postal Code. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custcity'] = 'Customer City. Optional setting. Length of field: 63 characters max - Alphanumeric Type';
$i18n['custcountry'] = 'Customer Country. Customer country code according to the ISO 3166 norm. Optional setting. Length of field: 2 characters max - Alphanumeric Type';
$i18n['custphone'] = 'Customer Phone Number. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custemail'] = 'Customer Email. Optional setting.';
$i18n['urlreturndesc'] = 'Default URL to where the buyer will be redirected. If this field has not been transmitted, the Back Office configuration will be taken into account.';
$i18n['redirect'] = 'delay in seconds before an automatic redirection to the merchant website at the end of an accepted payment.';
$i18n['sendform'] = 'Validate and send the settings  <br>by POST mode to';

/**
 * bootrstrap simple form
 */
$i18n['price'] = 'Price';
$i18n['pay'] = 'Pay';
$i18n['displayrealprice'] = 'Display only the price to pay';
$i18n['paymentform'] = 'Payment form';

/**
 * form-return.php
 */
$i18n['datawithdoclinks'] = 'Data returned with documentation links :';
$i18n['rawdata'] = 'Raw data :';
$i18n['paymentstatus'] = 'Payment status';
$i18n['invalidsign'] = 'INVALID SIGNATURE';

/**
 * form-tunnel.php
 */
$i18n['datasent'] = 'BELOW IS THE DATA WHICH WILL BE SENT TO THE GATEWAY';
$i18n['note'] = 'NOTE:';
$i18n['debugdesc'] = 'In order to be redirected straight to the payment gateway, you need to change the debug value of the config.php file to false.:';
$i18n['nopostdata'] = 'no POST data has been sent';