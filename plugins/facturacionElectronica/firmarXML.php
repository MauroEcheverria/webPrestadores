<?php
$nombre = "../../webPosOperaciones/comprobantesFirmados/".$_POST['clave_acceso'].".xml";
$archivo = fopen($nombre, "w+");
if (fwrite($archivo,$_POST['mensaje'].PHP_EOL)) {
  $data_result["cargaXML"] = "cargaOK";
}
else {
  $data_result["cargaXML"] = "cargaError";
}
echo json_encode($data_result);
fclose($archivo);