<?php
  include("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/sesion.class.php");

  $sesion = new sesion();
  $userSystem = $sesion->get("userSystem");

  if( $userSystem === false ) { 
    $data_template["error_reporting"] = $app_error_reporting;
    $data_template["version_css_js"] = $version_css_js;
    include("login.php");
    tema_login($data_template);
  }
  else {
    header("Location: ../../../webAdministracion/pages/bienvenido");
  } 
?>