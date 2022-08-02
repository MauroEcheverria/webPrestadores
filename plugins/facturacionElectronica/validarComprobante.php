<?php
require_once('nusoap.php');
header("Content-Type: text/plain");

$content = file_get_contents("../../webPosOperaciones/comprobantesElectronicos/".$_POST["claveAcceso"]."_firmada.xml");
$mensaje = base64_encode($content);

$claveAcceso = $_POST['claveAcceso'];

$servicio = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl";
$parametros = array();
$parametros['xml'] = $mensaje;

$client = new nusoap_client($servicio);
$client->soap_defencoding = 'utf-8';
$result = $client->call("validarComprobante", $parametros, "http://ec.gob.sri.ws.recepcion");
echo serialize($result);