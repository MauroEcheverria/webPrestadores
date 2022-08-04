<?php
require_once('nusoap.php');
header("Content-Type: text/plain");

$content = file_get_contents("../../webPosOperaciones/comprobantesTransacciones/".$_POST["claveAcceso"]."_firmada.xml");
$mensaje = base64_encode($content);

$servicio = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl";
$parametros = array();
$parametros['xml'] = $mensaje;

$client = new nusoap_client($servicio);
$client->soap_defencoding = 'utf-8';
$result = $client->call("validarComprobante", $parametros, "http://ec.gob.sri.ws.recepcion"); 
$data_result["dataValidacion"] = $result;

if ($client->fault) {
	$data_result["message"] = "error_client_default";
  echo json_encode($data_result);
} else {
  if ($client->getError()) {
  	$data_result["message"] = "error_client_get_error";
    echo json_encode($data_result);
  } else {
  	if ($result['estado'] == 'RECIBIDA') {
    	$data_result["message"] = "validacion_comprobante_correcta";
    	echo json_encode($data_result);
    }
    else if ($result['estado'] == 'DEVUELTA' && $result['comprobantes']['comprobante']['mensajes']['mensaje']['mensaje'] == "CLAVE ACCESO REGISTRADA") {
    	//unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso'].".xml");
    	//unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso']."_firmada.xml");
    	$data_result["message"] = "se_elimina_archivos";
    	echo json_encode($data_result);
    }
    else {
    //unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso'].".xml");
    //unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso']."_firmada.xml");
    $data_result["message"] = "validacion_no_identificada";
    echo json_encode($data_result);
    }
  }
}