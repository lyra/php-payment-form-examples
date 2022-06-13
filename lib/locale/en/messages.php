<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra PHP payment form example. See COPYING.md for license details.
 *
 * @author    Lyra Network <https://www.lyra.com>
 * @copyright Lyra Network
 * @license   http://www.apache.org/licenses/
 */

$i18n = array ();
$i18n['starterkit'] = 'A starter kit for Lyra Payment Form';
/*
 * Languages
 */
$i18n["fr"] = "French";
$i18n["de"] = "German";
$i18n["en"] = "English";
$i18n["es"] = "Spanish";
/*
 * Requirements
 */
$i18n['lang'] = 'Language';
$i18n['contactus'] = 'Contact us';
$i18n['shopid'] = 'Your shop id';
$i18n['requirements'] = 'Requirements';
$i18n['in'] = 'In';
$i18n['certtestprod'] = 'Your key (TEST or PRODUCTION)';
$i18n['modetestprod'] = 'Mode (TEST or PRODUCTION)';
$i18n['platformurl'] = 'Platform URL';
$i18n['debugdesc'] =
    'In order to be redirected straight to the payment gateway, you need to change the <code>debug</code> value of the <code>Config.php</code> file to <code>false</code>.';

/*
 * Order and chechout data
 */
$i18n['formexamples'] = 'Form Examples';
$i18n['checkouttitle'] = 'Review Your Order and Complete Checkout';
$i18n['orderdetails'] = 'Order details';
$i18n['total'] = 'Total';
$i18n['item1'] = 'Item 1.';
$i18n['item2'] = 'Item 2.';
$i18n['amount1'] = 'Price 1.';
$i18n['amount2'] = 'Price 2.';
$i18n['payment'] = 'Payment';
$i18n['stdpayment'] = 'Standard payment.';
$i18n['cbpayment'] = 'Standard payment with card pre-selected';
$i18n['x2payment'] = 'Payment in 2 installments.';
$i18n['x4payment'] = 'Payment in 4 installments.';
$i18n['ecv'] = 'e-Chèques Vacances payment.';
$i18n['redirect_message_defaut'] = 'Redirection to shop in a few seconds...';

/**
 * Example Form fields description
 */
$i18n['lyrasolution'] = 'LYRA PAYMENT SOLUTION IMPLEMENTATION EXAMPLE';
$i18n['info'] = 'INFORMATIONS';
$i18n['usesform'] = 'The payment uses the sending of a payment form to Lyra payment gateway URL.';
$i18n['file'] = 'File';
$i18n['htmlformuse'] =
    'the file <code>html-form.php</code> sends these payment fields to the<code>form-tunnel.php</code>  which fetch these fields to create the payment request.</p><p>These fields are filled with examples, it is up to you to fill them depending on your context and configuration.</p><p><b>Some other fields are available, Lyra support recommends to read the payment form documentation</b> <a href="https://payzen.io">Read the documentation.</a>';
$i18n['beforefirstuse'] =
    'Before the first use you have to fill the <code>shopID</code>, <code>certTest</code>, <code>platform</code> and <code>ctxMode</code> of the <code>config/Config.php</code>.e. This file contains secure data.  <b>This data securing is on your responsibility.</b>';
$i18n['transsettings'] = 'TRANSACTION SETTINGS';
$i18n['clientssettings'] = 'Client personal details';
$i18n['amountdesc'] = 'Order amount set in the smallest currency unit. Cents for EURO. Ex: 1000 for 10 euros';
$i18n['orderdesc'] = 'Order number. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custid'] = 'Customer number. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custfirstname'] =
    'Customer first name. Optional setting. Length of field: 127 characters max - Alphanumeric Type';
$i18n['custlastname'] = 'Customer last name. Optional setting. Length of field: 127 characters max - Alphanumeric Type';
$i18n['custaddress'] = 'Customer address. Optional setting. Length of field: 255 characters max - Alphanumeric Type';
$i18n['custzip'] = 'Customer Zip Code. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custcity'] = 'Customer City. Optional setting. Length of field: 63 characters max - Alphanumeric Type';
$i18n['custcountry'] =
    'Customer Country. Customer country code according to the ISO 3166 norm. Optional setting. Length of field: 2 characters max - Alphanumeric Type';
$i18n['custphone'] = 'Customer Phone Number. Optional setting. Length of field: 32 characters max - Alphanumeric Type';
$i18n['custemail'] = 'Customer Email. Optional setting.';
$i18n['urlreturndesc'] =
    'Default URL to where the buyer will be redirected. If this field has not been transmitted, the Back Office configuration will be taken into account.';
$i18n['redirect'] =
    'delay in seconds before an automatic redirection to the merchant website at the end of an accepted payment.';
$i18n['sendform'] = 'Validate and send the settings by POST mode to the payment gateway';

/*
 * Payment analysis
 */
$i18n['paymentanalysis'] = 'Payment Analysis';
$i18n['ipn'] = 'Instant Payment Notification';
$i18n['ipndesc'] =
    'When the payment is done, the gateway sends some parameters by POST mode to the server URL which analyzes the payment results. First you have to check the signature. If it is correct then you will be able to take the payment parameters into consideration.';
$i18n['returnurl'] = 'Return URLs';
$i18n['clientcomesback'] =
    'When the customer comes back to the shop through one of the return URLs, the payment parameters are sent back depending on the <code>vads_return_mode</code>. Depending on the <code>vads_return_mode</code> setting, the parameters are sent by POST mode, GET mode or not at all.';
$i18n['formreturndesc'] =
    'In this package, the <code>form-return.php</code> file controls the signature and analyzes the payment results. First, the script checks the signature and then analyzes the main fields. It is up to you to adapt the code to your context.';
$i18n['findhelp'] = 'Find Help';
$i18n['supportrecommends'] = 'Lyra support recommends to read the settings analysis documentation on';

/**
 * Debug mode
 */
$i18n['price'] = 'Price';
$i18n['pay'] = 'Pay';
$i18n['displayrealprice'] = 'Display only the price to pay';
$i18n['paymentform'] = 'Payment form';

/**
 * form-return.php
 */
$i18n['formexampleresponse'] = 'Response Example';
$i18n['paymentresponseanalysis'] = 'Response Analysis';
$i18n['responsessettings'] = 'Response Parameters';

$i18n['auth'] = "Autorisation Result";
$i18n['validsign'] = "Valid Signature.";
$i18n['invalidsigndesc'] =
    "Signature Invalide - ne pas prendre en compte le résultat de ce Invalid Signature - do not take this payment result in account";

$i18n['vads_trans_status'] = 'Transaction status';
$i18n['abandoned'] =
    "The payment was abandoned by the customer. The transaction was not created on the gateway and therefore is not visible on the merchant back office.";
$i18n['authorised'] = "The payment is accepted and is waiting to be cashed.";
$i18n['refused'] = "The payment was refused.";
$i18n['tovalidate'] =
    "The transaction is accepted but it is waiting to be manually validated. It is on the merchant responsability to validate the transaction in order that it can be cashed from the back office or by web service request. The transaction can be validated as long as the capture delay is not expired. If the delay expires the payment status change to Expired. This status is definitive.";
$i18n['toauthorise'] =
    "The transaction is waiting for an authorisation. During the payment, just an imprint was made because the capture delay is higher than 7 days. By default the auhorisation demand for the global amount will be made 2 days before the bank deposit date.";
$i18n['expired'] =
    "The transaction expired. This status is definitive, the transaction will not be able to be cashed. A transaction expires when it was created in manual validation or when the capture delay is passed.";
$i18n['cancelled'] =
    "The payment was cancelled through the merchant back offfice or by a web service request. This status is definitive, the transaction will never be cashed.";
$i18n['tovalidate'] =
    "The transaction is waiting for an authorisation and a manual validation. During the payment, just an imprint was made because the capture delay is higher than 7 days and the validation type is « manual validation ». This payment will be able to be cashed only after that the merchant validates it from the back office or by web service request.";
$i18n['captured'] = "The payment was cashed. This status is definitive.";

$i18n['result'] = "Payment Response";
$i18n['00'] = "Payment successfully completed.";
$i18n['02'] = "The merchant must contact the holder’s bank.";
$i18n['05'] = "Payment denied.";
$i18n['17'] = "Cancellation by customer.";
$i18n['30'] = "Request format error. To be linked with the value of the vads_extra_result field.";
$i18n['96'] = "Technical error occurred during payment.";

$i18n['vads_trans_id'] = "Transaction Identifier";
$i18n['vads_amount'] = "Transaction amount expressed in the smallest currency unit (cents for euro).";
$i18n['vads_effective_amount'] = "Effective amount";
$i18n['vads_effective_amount_desc'] = "Payment amount in the currency used for the capture.";

$i18n['vads_payment_config'] = "Type of payment";
$i18n['standard'] = "Single payment.";
$i18n['multi'] = "Installment payment";

$i18n['vads_sequence_number'] = "Transaction sequence number.";

$i18n['vads_auth_result'] = "Code of the authorization request returned by the issuing bank";
$i18n['vads_auth_result_00'] = "Transaction approved or successfully treated.";
$i18n['vads_auth_result_02'] = "Contact the card issuer.";
$i18n['vads_auth_result_03'] = "Invalid acceptor.";
$i18n['vads_auth_result_04'] = "Keep the card.";
$i18n['vads_auth_result_05'] = "Do not honor.";
$i18n['vads_auth_result_07'] = "Keep the card, special conditions.";
$i18n['vads_auth_result_08'] = "Approved after identification.";
$i18n['vads_auth_result_12'] = "Invalid Transaction.";
$i18n['vads_auth_result_13'] = "Invalid Amount.";
$i18n['vads_auth_result_14'] = "Invalid holder number.";
$i18n['vads_auth_result_30'] = "Format error.";
$i18n['vads_auth_result_31'] = "Unknown buying organization identifier.";
$i18n['vads_auth_result_33'] = "Expired card validity date.";
$i18n['vads_auth_result_34'] = "Fraud suspected.";
$i18n['vads_auth_result_41'] = "Lost card.";
$i18n['vads_auth_result_43'] = "Stolen card.";
$i18n['vads_auth_result_51'] = "Insufficient provision or exceeds credit.";
$i18n['vads_auth_result_54'] = "Expired card validity date.";
$i18n['vads_auth_result_56'] = "Card not in database.";
$i18n['vads_auth_result_57'] = "Transaction not allowed for this holder.";
$i18n['vads_auth_result_58'] = "Transaction not allowed from this terminal.";
$i18n['vads_auth_result_59'] = "Fraud suspected.";
$i18n['vads_auth_result_60'] = "The card acceptor must contact buyer.";
$i18n['vads_auth_result_61'] = "Amount over withdrawal limits.";
$i18n['vads_auth_result_63'] = "Does not abide to security rules.";
$i18n['vads_auth_result_68'] = "Response not received or received too late.";
$i18n['vads_auth_result_90'] = "System temporarily stopped.";
$i18n['vads_auth_result_91'] = "Inaccessible card issuer.";
$i18n['vads_auth_result_94'] = "Duplicated transaction.";
$i18n['vads_auth_result_96'] = "Faulty system.";
$i18n['vads_auth_result_97'] = "Global surveillance time out expired.";
$i18n['vads_auth_result_98'] = "Unavailable server, repeat network routing requested.";
$i18n['vads_auth_result_99'] = "Instigator domain incident.";

$i18n['vads_warranty_result'] = "Payment Warranty";
$i18n['vads_warranty_result_yes'] = "Payment is guaranteed.";
$i18n['vads_warranty_result_no'] = "Payment is not guaranteed.";
$i18n['vads_warranty_result_unknown'] = "Payment cannot be guaranteed, due to a technical error.";
$i18n['vads_warranty_result_x'] = "Payment guarantee not applicable.";

$i18n['vads_threeds_status'] = "3DS status";
$i18n['vads_threeds_status_y'] = "3DS Authentified.";
$i18n['vads_threeds_status_n'] = "Authentification Error.";
$i18n['vads_threeds_status_u'] = "Authentification Impossible.";
$i18n['vads_threeds_status_a'] = "Try to authenticate.";
$i18n['vads_threeds_status_x'] = "Non valued.";

$i18n['vads_capture_delay'] = "Capture delay";
$i18n['days'] = "days";

$i18n['vads_validation_mode'] = "Validation Mode";
$i18n['vads_validation_mode_1'] = "Manual Validation";
$i18n['vads_validation_mode_0'] = "Automatic Validation";
$i18n['vads_validation_mode_x'] = "Default configuration of the merchant back office";

$i18n['allReceivedData'] = "Complete Received Data List";