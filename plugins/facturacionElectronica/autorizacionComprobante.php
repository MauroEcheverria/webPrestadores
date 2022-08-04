<?php
require_once('nusoap.php');
require_once('generarPDF.php');

$claveAcceso = $_POST['claveAcceso'];
$servicio = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl";
$parametros = array();
$parametros['claveAccesoComprobante'] = $claveAcceso;
$client = new nusoap_client($servicio);
$error = $client->getError();
$client->soap_defencoding = 'utf-8';
$result = $client->call("autorizacionComprobante",$parametros,"http://ec.gob.sri.ws.autorizacion");
$data_result["dataValidacion"] = $result;

if ($client->fault) {
  $data_result["message"] = "error_client_default";
  echo json_encode($data_result);
} else {
  if ($client->getError()) {
    $data_result["message"] = "error_client_get_error";
    echo json_encode($data_result);
  } else {

    if ($result['autorizaciones']['autorizacion']['estado'] == 'AUTORIZADO') {

      /*ACTUALIZAR FACTURA CON LOS DATOS DEL SRI
      $result['autorizaciones']['autorizacion']['fechaAutorizacion']
      $result['claveAccesoConsultada']*/

      $comprobante = $client->responseData;
      $xml = str_replace(['&lt;', '&gt;'], ['<', '>'], $comprobante);

      $nombre = "../../webPosOperaciones/comprobantesTransacciones/".$claveAcceso."_aprobada.xml";
      $file_comprobante = fopen($nombre, "w+");
      if (fwrite($file_comprobante, $xml . PHP_EOL)) {
        $data_result["cargaXML"] = "cargaOK";
      }
      else {
        $data_result["cargaXML"] = "cargaError";
      }
      fclose($file_comprobante);

      //unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['claveAccesoConsultada'].".xml");
      //unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['claveAccesoConsultada']."_firmada.xml");
      
      $dataComprobante = simplexml_load_string($result['autorizaciones']['autorizacion']['comprobante']);
      if ($dataComprobante->infoFactura) {
        $facturaPDF = new generarPDF();
        $facturaPDF->facturaPDF($dataComprobante, $claveAcceso);
      }
      if ($dataComprobante->infoNotaCredito) {
        $facturaPDF = new generarPDF();
        $facturaPDF->notaCreditoPDF($dataComprobante, $claveAcceso);
      }
      if ($dataComprobante->infoCompRetencion) {
        $facturaPDF = new generarPDF();
        $facturaPDF->comprobanteRetencionPDF($dataComprobante, $claveAcceso);
      }
      if ($dataComprobante->infoGuiaRemision) {
        $facturaPDF = new generarPDF();
        $facturaPDF->guiaRemisionPDF($dataComprobante, $claveAcceso);
      }
      if ($dataComprobante->infoNotaDebito) {
        $facturaPDF = new generarPDF();
        $facturaPDF->notaDebitoPDF($dataComprobante, $claveAcceso);
      }

      $data_result["message_1"] = "autorizacion_comprobante_correcta";
      $data_result["message_2"] = "se_elimina_archivos";
      echo json_encode($data_result);
    }
    else if ($result['autorizaciones']['autorizacion']['estado'] == 'NO AUTORIZADO') {

      echo json_encode($data_result);
    }
    else {
      $data_result["message"] = "autorizacion_no_identificada";
      echo json_encode($data_result);
    }
    

  }
}