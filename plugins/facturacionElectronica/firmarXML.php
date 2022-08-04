<?php
$nombre = "../../webPosOperaciones/comprobantesTransacciones/".$_POST['clave_acceso']."_firmada.xml";
$archivo = fopen($nombre, "w+");
if (fwrite($archivo,$_POST['mensaje'].PHP_EOL)) {
  $data_result["cargaXML"] = "cargaOK";
}
else {
  $data_result["cargaXML"] = "cargaError";
}
fclose($archivo);