<?php 
  function principal($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  //$css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/select2/dist/css/select2.min.css'.$dataSesion["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  //$js_dreconstec[] = '<script src="../../../dist/js/webAdministracion.js'.$dataSesion["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container container_main">
        principal
      </div>
    </section>
  </div>
    
 
<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>