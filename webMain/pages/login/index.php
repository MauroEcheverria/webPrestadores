<?php
  include("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/sesion.class.php");

  $sesion = new sesion();
  $userSystem = $sesion->get("userSystem");
  $linkTemp = $sesion->get("linkTemp");

  if( $userSystem === false ) { 
    $varLogin=0;
  }
  else {
    $varLogin=1;
  }

  $data_template["varLogin"] = $varLogin;
	$data_template["linkTemp"] = $linkTemp;
	$data_template["error_reporting"] = $app_error_reporting;

  include("login.php");
  tema_login($data_template);
?>