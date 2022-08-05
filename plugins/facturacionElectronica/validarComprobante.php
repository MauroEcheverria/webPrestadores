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

if (!empty($result['estado'])) {
  $sri_estado = utf8_decode($result['estado']);
}
else {
  $sri_estado = "";
}
if (!empty($result['comprobantes']['comprobante']['claveAcceso'])) {
  $sri_clave_acceso = utf8_decode($result['comprobantes']['comprobante']['claveAcceso']);
}
else {
  $sri_clave_acceso = "";
}
if (!empty($result['comprobantes']['comprobante']['mensajes']['mensaje']['mensaje'])) {
  $sri_mensaje = utf8_decode($result['comprobantes']['comprobante']['mensajes']['mensaje']['mensaje']);
}
else {
  $sri_mensaje = "";
}
if (!empty($result['comprobantes']['comprobante']['mensajes']['mensaje']['identificador'])) {
  $sri_identificador = utf8_decode($result['comprobantes']['comprobante']['mensajes']['mensaje']['identificador']);
}
else {
  $sri_identificador = "";
}
if (!empty($result['comprobantes']['comprobante']['mensajes']['mensaje']['informacionAdicional'])) {
  $sri_info_adicional = utf8_decode($result['comprobantes']['comprobante']['mensajes']['mensaje']['informacionAdicional']);
}
else {
  $sri_info_adicional = "";
}

$data_result["sri_estado"] = $sri_estado;
$data_result["sri_clave_acceso"] = $sri_clave_acceso;
$data_result["sri_mensaje"] = $sri_mensaje;
$data_result["sri_identificador"] = $sri_identificador;
$data_result["sri_info_adicional"] = $sri_info_adicional;

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
    else if ($result['estado'] == 'DEVUELTA') {
    	unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso'].".xml");
    	unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso']."_firmada.xml");
    	$data_result["message"] = "se_elimina_archivos";
    	echo json_encode($data_result);
    }
    else {
      unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso'].".xml");
      unlink("../../webPosOperaciones/comprobantesTransacciones/".$result['comprobantes']['comprobante']['claveAcceso']."_firmada.xml");
      $data_result["message"] = "validacion_no_identificada";
      echo json_encode($data_result);
    }
  }
}