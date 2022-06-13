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
$i18n['starterkit'] = 'Un kit de inicio para el formulario de pago de Lyra';
/*
 * Languages
 */
$i18n["fr"] = "Francés";
$i18n["de"] = "Alemán";
$i18n["en"] = "Inglés";
$i18n["es"] = "Español";

/*
 * Requirements
 */
$i18n['lang'] = 'Idioma';
$i18n['contactus'] = 'Contáctenos';
$i18n['shopid'] = 'Identificador de tienda';
$i18n['requirements'] = 'Requisitos';
$i18n['in'] = 'En';
$i18n['certtestprod'] = 'Su clave (TEST o PRODUCTION)';
$i18n['modetestprod'] = 'Modo de funcionamiento (TEST o PRODUCTION)';
$i18n['platformurl'] = 'URL plataforma de pago';
$i18n['debugdesc'] =
    'Para ser redirigido directamente a la pasarela de pago, debe cambiar el valor de <code>debug</code> del archivo <code>Config.php</code> a <code>false</code>.';
/*
 * Order and chechout data
 */
$i18n['formexamples'] = 'Ejemplos de forma';
$i18n['checkouttitle'] = 'Revise su pedido y complete el pago';
$i18n['orderdetails'] = 'Detalle del pedido';
$i18n['total'] = 'Total';
$i18n['item1'] = 'ít 1.';
$i18n['item2'] = 'ít 2.';
$i18n['amount1'] = 'Precio 1.';
$i18n['amount2'] = 'Precio 2.';
$i18n['payment'] = 'Pago';
$i18n['stdpayment'] = 'Pago estándar';
$i18n['cbpayment'] = 'Pago estándar con tarjeta preseleccionada.';
$i18n['x2payment'] = 'Pago en 2 cuotas.';
$i18n['x4payment'] = 'Pago en 4 cuotas.';
$i18n['ecv'] = 'e-Chèques-Vacances pago.';
$i18n['redirect_message_defaut'] = 'Redirección a la tienda en unos momentos ...';

/**
 * Example Form fields description
 */
$i18n['lyrasolution'] = 'EJEMPLO DE IMPLEMENTACIÓN SOLUCIÓN DE PAGO LYRA';
$i18n['info'] = 'INFORMACIÓN';
$i18n['usesform'] =
    'El pago se basa en el envío de un formulario de pago en HTTPS a la URL de la plataforma de pago Lyra.';
$i18n['file'] = 'El archivo ';
$i18n['htmlformuse'] =
    '<p>El fichero <code>html-form.php</code> envía todos los campos vinculados al pago al fichero <code>form-tunnel.php</code> , que recupera todos estos campos para generar la solicitud de pago.</p><p>Los campos se completan a modo de ejemplo, depende de usted mejorarlos de acuerdo con su contexto.</p><p><b>Otros campos están disponibles, el soporte de Lyra lo invita a leer la documentación relacionada con el formulario de pago.</b> <a href="https://payzen.io">Consulta la documentación</a></p>';
$i18n['beforefirstuse'] =
    'Antes del primer uso debe obligatoriamente rellenar los campos <code>shopID</code>, <code>certTest</code>, <code>platform</code> et <code>ctxMode</code> del fichero<code>config/Config.php</code>. Este archivo contiene datos confidenciales. <b>Proteger estos datos es su responsabilidad.</b>';
$i18n['transsettings'] = 'PARÁMETROS DE TRANSACCIÓN';
$i18n['clientssettings'] = 'Información personal del cliente';
$i18n['amountdesc'] =
    'Cantidad de la orden expresada en la unidad más pequeña de la moneda. Centavos por EURO. Ex : 1000 pour 10 euros.';
$i18n['orderdesc'] =
    'Número de orden. Parámetro opcional Longitud del campo: 32 caracteres como máximo - Tipo alfanumérico.';
$i18n['custid'] =
    'Numero de cliente. Parámetro opcional Longitud del campo: 32 caracteres como máximo - Tipo alfanumérico';
$i18n['custfirstname'] =
    'Nombre del cliente. Parámetro opcional. Longitud del campo: 127 caracteres como máximo - Tipo alfanumérico';
$i18n['custlastname'] =
    'Nombre del cliente. Parámetro opcional. Longitud del campo: 127 caracteres como máximo - Tipo alfanumérico';
$i18n['custaddress'] =
    'Domicilio del cliente. Parámetro opcional Longitud del campo: 255 caracteres como máximo - Tipo alfanumérico';
$i18n['custzip'] =
    'Código postal del cliente. Parámetro opcional Longitud del campo: 32 caracteres como máximo - Tipo alfanumérico';
$i18n['custcity'] =
    'Ciudad del cliente. Parámetro opcional Longitud del campo: 63 caracteres como máximo - Tipo alfanumérico';
$i18n['custcountry'] =
    'País del cliente. Código de país del cliente según ISO 3166. Parámetro opcional. Longitud del campo: 2 caracteres como máximo - Tipo alfanumérico';
$i18n['custphone'] =
    'Teléfono del cliente. Parámetro opcional Longitud del campo: 32 caracteres como máximo - Tipo alfanumérico';
$i18n['custemail'] = 'Correo electrónico del cliente. Parámetro opcional.';
$i18n['urlreturndesc'] =
    'URL a la que se redireccionará de forma predeterminada el comprador después de presionar el botón Volver a la tienda, si las URL vads_url_error, vads_url_refused, vads_url_success o vads_url_cancel no están llenas.';
$i18n['redirect'] =
    'Le permite establecer un retraso en segundos antes de redirigir automáticamente al sitio del comerciante al final de un pago aceptado.';
$i18n['sendform'] = 'PAY => enviar los parámetros a la plataforma de pago ';

/*
 * Payment analysis
 */
$i18n['paymentanalysis'] = 'ANÁLISIS DE PAGO';
$i18n['ipn'] = 'URL de notificación de pago instantáneo';
$i18n['ipndesc'] =
    'Cuando se realiza el pago, la puerta de enlace envía algunos parámetros por modo POST a la URL del servidor que analiza los resultados del pago. Primero tienes que verificar la firma. Si es correcto, podrá tener en cuenta los parámetros de pago.';
$i18n['returnurl'] = 'URL de retorno';
$i18n['clientcomesback'] =
    'Cuando el cliente vuelve a la tienda a través de una de las URL de devolución, los parámetros de pago se devuelven según el <code> vads_return_mode </code>. Dependiendo de la configuración <code> vads_return_mode </code>, los parámetros se envían en modo POST, modo GET o no se envían.';
$i18n['formreturndesc'] =
    'En este paquete, el archivo <code> form-return.php </code> controla la firma y analiza los resultados del pago. Primero, el script verifica la firma y luego analiza los campos principales. Depende de usted adaptar el código a su contexto.';
$i18n['findhelp'] = 'Encontrar ayuda';
$i18n['supportrecommends'] = 'El soporte de Lyra recomienda leer la documentación del análisis de configuración en';

/**
 * Debug mode
 */
$i18n['price'] = 'Precio';
$i18n['pay'] = 'Paga';
$i18n['displayrealprice'] = 'Mostrar solo el precio a pagar';
$i18n['paymentform'] = 'Forma de pago';

/**
 * form-return.php
 */
$i18n['datawithdoclinks'] = 'Datos recibidos con enlaces a la documentación. :';
$i18n['rawdata'] = 'Datos recibidos : ';
$i18n['paymentstatus'] = 'Estado de pago';
$i18n['invalidsign'] = 'FIRMA INVALIDA';

/**
 * form-return.php
 */
$i18n['formexampleresponse'] = 'Respuesta de muestra';
$i18n['paymentresponseanalysis'] = 'Análisis de la respuesta.';
$i18n['responsessettings'] = 'Parámetros de la respuesta';

$i18n['paymentstatus'] = 'Estado de pago';

$i18n['validsign'] = "Firma Válida";
$i18n['invalidsigndesc'] = "Firma inválida: no tenga en cuenta el resultado de este pago.";

$i18n['status'] = "Estatus";
$i18n['abandoned'] =
    "El pago ha sido abandonado por el cliente. La transacción no se creó en la plataforma de pago y, por lo tanto, no es visible en la oficina administrativa del comerciante.";
$i18n['authorised'] = "El pago ha sido aceptado y está pendiente de depósito bancario.";
$i18n['refused'] = "Pago rechazado";
$i18n['tovalidate'] =
    "La transacción ha sido aceptada pero está pendiente de validación manual. Es responsabilidad del comerciante validar la transacción para solicitar al banco al comerciante administrativo o solicitar el servicio web. La transacción se puede validar siempre que no se haya excedido el tiempo de captura. Si se excede este tiempo, el pago cambia al estado Caducado. Este estado caducado es final.";
$i18n['toauthorise'] =
    "La transacción está pendiente de autorización. Al pagar solo se ha hecho una impresión porque el tiempo de la banca es estrictamente mayor a 7 días. Por defecto, la solicitud de autorización para el monto global se realizará el día 2 antes de la fecha de la banca.";
$i18n['expired'] =
    "La transacción ha expirado. Este estado es final, la transacción ya no se puede almacenar en el banco. Una transacción caduca en el caso de una transacción creada en validación manual o cuando ha pasado el retraso de captura.";
$i18n['cancelled'] =
    "La transacción se canceló a través de la oficina administrativa del comerciante o mediante una solicitud de servicio web. Este estado es final, la transacción nunca será depositada.";
$i18n['tovalidate'] =
    'La transacción está pendiente de autorización y esperando la validación manual. Durante el pago solo se ha tomado una impresión porque el tiempo de banca es estrictamente mayor a 7 días y el tipo de validación solicitada es "validación manual". Este pago solo se puede pagar en el banco después de una validación del comerciante desde la oficina administrativa del comerciante o mediante una solicitud de servicios web.';
$i18n['captured'] = "La transacción fue depositada. Este estado es definitivo.";

$i18n['result'] = "Resultado";
$i18n['00'] = "Pago realizado con éxito.";
$i18n['02'] = "El comerciante debe contactar al banco del portador.";
$i18n['05'] = "Pago rechazado.";
$i18n['17'] = "Pago cancelado por el cliente.";
$i18n['30'] = "Error de formato de consulta. Para poner en relación con la valorización del campo vads_extra_result.";
$i18n['96'] = "Error técnico durante el pago.";