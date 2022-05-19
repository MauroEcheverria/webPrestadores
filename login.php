<?php
  require_once("controller/sesion.class.php");
  $sesion = new sesion();
  $userSystem = $sesion->get("userSystem"); 
  if( $userSystem === false ) { 
    header("Location: webAdministracion/pages/login");
  }
  else {
    header("Location: webAdministracion/pages/bienvenido");
  }
?>