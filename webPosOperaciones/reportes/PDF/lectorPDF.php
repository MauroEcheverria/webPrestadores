<?php
	$filename = "../../comprobantesAutorizados/".$_POST["ftr_sri_clave_acceso"].".pdf";
	header("Content-type: application/pdf");
	header("Content-Length: " . filesize($filename));
	readfile($filename);
?> 