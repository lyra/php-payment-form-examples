<?php
/**
 * Created by PhpStorm.
 * User: dfieffe
 * Date: 21/12/2015
 * Time: 16:52
 */

function the_payment_response(){

  echo "<h1>VALID SIGNATURE</h1>";
  if (isset($_REQUEST['vads_trans_status'])) echo "<b>"._('Status')."</b> (vads_trans_status): ".$_REQUEST['vads_trans_status']."<br/>";
  if (isset($_REQUEST['vads_trans_status'])) switch ($_REQUEST['vads_trans_status']) {
    case "ABANDONED":
      echo _('The payment was abandonned by the customer. The transaction was not created on the gateway and therefore is not visible on the merchant back office.');
      break;
    case "AUTHORISED":
      echo _('The payment is accepted and is waiting to be cashed.');
      break;
    case "REFUSED":
      echo _('The payment was refused.');
      break;
    case "AUTHORISED_TO_VALIDATE":
      echo _('The transaction is accepted but it is waiting to be manually validated. It is on the merchant responsability to validate the transaction in order that it can be cashed from the back office or by web service request. The transaction can be validated as long as the capture delay is not expired. If the delay expires the payment status change to Expired. This status is definitive.');
      break;
    case "WAITING_AUTHORISATION":
      echo _('The transaction is waiting for an authorisation. During the payment, just an imprint was made because the capture delay is higher than 7 days. By default the auhorisation demand for the global amount will be made 2 days before the bank deposit date.');
      break;
    case "EXPIRED":
      echo _('The transaction expired. This status is definitive, the transaction will not be able to be cashed. A transaction expires when it was created in manual validation or when the capture delay is passed.');
      break;
    case "CANCELLED":
      echo _('The payment was cancelled through the merchant back offfice or by a web service request. This status is definitive, the transaction will never be cashed.');
      break;
    case "WAITING_AUTHORISATION_TO_VALIDATE":
      echo _('The transaction is waiting for an authorisation and a manual validation. During the payment, just an imprint was made because the capture delay is higher than 7 days and the validation type is « manual validation ». This payment will be able to be cashed only after that the merchant validates it from the back office or by web service request.');
      break;
    case "CAPTURED":
      echo _('The payment was cashed. This status is definitive.');
      break;
  }

  if (isset($_REQUEST['vads_result'])) echo "<br/><br/><b>"._('Result')."</b> (vads_result): ".$_REQUEST['vads_result']."<br/>";
  if (isset($_REQUEST['vads_result'])) switch ($_REQUEST['vads_result']) {
    case "00":
      echo _('Payment successfully completed.');
      break;
    case "02":
      echo _('The merchant must contact the holder’s bank.');
      break;
    case "05":
      echo _('Payment denied.');
      break;
    case "17":
      echo _('Cancellation by customer.');
      break;
    case "30":
      echo _('Request format error. To be linked with the value of the vads_extra_result field.');
      break;
    case "96":
      echo _('Technical error occurred during payment.');
      break;
  }

  if (isset($_REQUEST['vads_trans_id'])) echo "<br/><br/><b>"._('ID')."</b> (vads_trans_id): ".$_REQUEST['vads_trans_id'];

  if (isset($_REQUEST['vads_amount'])) echo "<br/><br/><b>"._('amount')."</b> (vads_amount): ".$_REQUEST['vads_amount'];

  if (isset($_REQUEST['vads_effective_amount'])) echo "<br/><br/><b>"._('Effective amount')."</b> (vads_effective_amount): ".$_REQUEST['vads_effective_amount'];

  if (isset($_REQUEST['vads_payment_config'])) echo "<br/><br/><b>"._('Payment Type')."</b> (vads_payment_config): ".$_REQUEST['vads_payment_config']."<br/>";
  if (isset($_REQUEST['vads_payment_config'])) switch ($_REQUEST['vads_payment_config']) {
    case "SINGLE":
      echo _('Unique Payment.');
      break;
  }

  if (isset($_REQUEST['vads_sequence_number'])) echo "<br/><br/><b>"._('Sequence Number')."</b> (vads_sequence_number): ".$_REQUEST['vads_sequence_number'];

  if (isset($_REQUEST['vads_auth_result'])) echo "<br/><br/><b>"._('Authorisation Result')."</b> (vads_auth_result): ".$_REQUEST['vads_auth_result']."<br/>";
  if (isset($_REQUEST['vads_auth_result'])) switch ($_REQUEST['vads_auth_result']) {
    case '00':
      echo _('Transaction approved or successfully treated.');
      break;
    case '02':
      echo _('Contact the card issuer.');
      break;
    case '03':
      echo _('Invalid acceptor.');
      break;
    case '04':
      echo _('Keep the card.');
      break;
    case '05':
      echo _('Do not honor.');
      break;
    case '07':
      echo _('Keep the card, special conditions.');
      break;
    case '08':
      echo _('Approved after identification.');
      break;
    case '12':
      echo _('Invalid Transaction.');
      break;
    case '13':
      echo _('Invalid Amount.');
      break;
    case '14':
      echo _('Invalid holder number.');
      break;
    case '30':
      echo _('Format error.');
      break;
    case '31':
      echo _('Unknown buying organization identifier.');
      break;
    case '33':
      echo _('Expired card validity date.');
      break;
    case '34':
      echo _('Fraud suspected.');
      break;
    case '41':
      echo _('Lost card.');
      break;
    case '43':
      echo _('Stolen card.');
      break;
    case '51':
      echo _('Insufficient provision or exceeds credit.');
      break;
    case '54':
      echo _('Expired card validity date.');
      break;
    case '56':
      echo _('Card not in database.');
      break;
    case '57':
      echo _('Transaction not allowed for this holder.');
      break;
    case '58':
      echo _('Transaction not allowed from this terminal.');
      break;
    case '59':
      echo _('Fraud suspected.');
      break;
    case '60':
      echo _('The card acceptor must contact buyer.');
      break;
    case '61':
      echo _('Amount over withdrawal limits.');
      break;
    case '63':
      echo _('Does not abide to security rules.');
      break;
    case '68':
      echo _('Response not received or received too late.');
      break;
    case '90':
      echo _('System temporarily stopped.');
      break;
    case '91':
      echo _('Inaccessible card issuer.');
      break;
    case '96':
      echo _('Duplicated transaction.');
      break;
    case '94':
      echo _('Faulty system.');
      break;
    case '97':
      echo _('Global surveillance time out expired.');
      break;
    case '98':
      echo _('Unavailable server, repeat network routing requested.');
      break;
    case '99':
      echo _('Instigator domain incident.');
      break;
  }


  if (isset($_REQUEST['vads_warranty_result'])) echo "<br/><br/><b>"._('Payment Warranty')."</b> (vads_warranty_result): ".$_REQUEST['vads_warranty_result']."<br/>";
  if (isset($_REQUEST['vads_warranty_result'])) switch ($_REQUEST['vads_warranty_result']) {
    case "YES":
      echo _('Payment is guaranteed.');
      break;
    case "NO":
      echo _('Payment is not guaranteed.');
      break;
    case "UNKNOWN":
      echo _('Payment cannot be guaranteed, due to a technical error.');
      break;
    default:
      echo _('Payment guarantee not applicable.');
      break;
  }

  if (isset($_REQUEST['vads_threeds_status'])) echo "<br/><br/><b>"._('Statut 3DS')."</b> (vads_threeds_status): ".$_REQUEST['vads_threeds_status']."<br/>";
  if (isset($_REQUEST['vads_threeds_status'])) switch ($_REQUEST['vads_threeds_status']) {
    case "Y":
      echo _('3DS Authentified.');
      break;
    case "N":
      echo _('Authentification Error.');
      break;
    case "U":
      echo _('Authentification Impossible.');
      break;
    case "A":
      echo _('Try to authenticate.');
      break;
    default:
      echo _('Non valued.');
      break;
  }

  if (isset($_REQUEST['vads_capture_delay'])) echo "<br/><br/><b>"._('Capture delay')."</b> (vads_capture_delay): ".$_REQUEST['vads_capture_delay']." "._('days');

  if (isset($_REQUEST['vads_validation_mode'])) echo "<br/><br/><b>"._('Validation Mode')."</b> (vads_validation_mode): ".$_REQUEST['vads_validation_mode']."<br/>";
  if (isset($_REQUEST['vads_validation_mode'])) switch ($_REQUEST['vads_validation_mode']) {
    case 1:
      echo _('Manual Validation');
      break;
    case 0:
      echo _('Automatic Validation');
      break;
    default:
      echo _('Default configuration of the merchant back office');
      break;

  }
}