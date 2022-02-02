<?php
 tema_login();
  function tema_login(){
  include("../template/templateHeadContent.php");
  include("../template/templateFooterContent.php");
  include("../template/templateServices.php");
  require_once("../controller/sesion.class.php");
  require_once("../dctDatabase/Parameter.php");
  $sesion = new sesion();
  $userSystem = $sesion->get("userSystem"); 
  if( $userSystem === false ) { 
    $varLogin=0;
  }
  else {
    $varLogin=1;
  }
  $data_template["varLogin"] = $varLogin;
  $data_template["error_reporting"] = $app_error_reporting;
  template_head($data_template);?>

  <div class="container">
    <p>Por su seguridad su sesión ha sido cerrada.</p>
    <div class="btn_buscar_por">
      <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../webMain/pages/login/';">Inicio de Sesión</button>
    </div>
  </div>

<?php template_footer(); }?>