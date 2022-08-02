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
$result = $client->call("autorizacionComprobante", $parametros, "http://ec.gob.sri.ws.autorizacion");

if ($client->fault) {
  $estado = 'ERROR';
  echo serialize($result);
} else {
  $error = $client->getError();
  if ($error) {
    $estado = 'ERROR';
    echo serialize($error);
  } else {
    echo serialize($result);
    if ($result['autorizaciones']['autorizacion']['estado'] != 'AUTORIZADO') {
      $estado = 'NO AUTORIZADO';
    } else {
      $estado = 'AUTORIZADO';
      if (!empty($result['autorizaciones']['autorizacion']['comprobante'])) {
        $comprobante = $client->responseData;
        $simplexml = simplexml_load_string($comprobante);
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $xml = str_replace(['&lt;', '&gt;'], ['<', '>'], $comprobante);

        $nombre = "../../webPosOperaciones/comprobantesElectronicos/".$claveAcceso."_aprobada.xml";
        $file_comprobante = fopen($nombre, "w+");
        if (fwrite($file_comprobante, $xml . PHP_EOL)) {
          $data_result["cargaXML"] = "cargaOK";
        }
        else {
          $data_result["cargaXML"] = "cargaError";
        }
        fclose($file_comprobante);
        
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
      }
    }
  }
}