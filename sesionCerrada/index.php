<?php
  include("../template/templateHeadContent.php");
  include("../template/templateFooterContent.php");
  require_once("../controller/sesion.class.php");
  require_once("../dctDatabase/Parameter.php");

  $data_template["error_reporting"] = $app_error_reporting;
  $data_template["version_css_js"] = $version_css_js;

  $css_dreconstec = array();
  //$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  //$js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.js'.$data_template["version_css_js"].'"></script>';

  template_head($data_template,$css_dreconstec);
  ?>

  <div class="container">
    <p>Por su seguridad su sesión ha sido cerrada.</p>
    <div class="btn_buscar_por">
      <button type="button" class="btn btn-success" onclick="window.location.href = '../webMain/pages/login/';">Inicio de Sesión</button>
    </div>
  </div>

<?php 
  template_footer($data_template,$js_dreconstec); 
?>