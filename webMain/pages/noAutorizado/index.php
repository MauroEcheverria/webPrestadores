<?php 
  function noAutorizado($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  //$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  //$js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.js'.$data_template["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        <div class="centrarContent">
          <img src="../../../dist/img/exclamation.png" style="width: 100px;">
        </div>
        <div>No tiene autorización para acceder a esta sección de la web.</div>
        <div class="btn_buscar_por">
          <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../../';">Principal</button>
        </div>
        
      </div>
    </section>
  </div>
  
<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>