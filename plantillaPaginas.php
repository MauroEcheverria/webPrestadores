<?php 
  function XXXXXXXXX($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  //$css_dreconstec[] = '<link rel="stylesheet" href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'">';

  $js_dreconstec = array();
  //$js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.js'.$data_template["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">



      </div>
    </section>
  </div>

<?php 
	modalViews();
	template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>