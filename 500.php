<?php  
  include("template/templateHeadIndex.php");
  include("template/templateFooterIndex.php");
  require_once("dctDatabase/Parameter.php");
  $data_template["error_reporting"] = $app_error_reporting;
  $data_template["version_css_js"] = $version_css_js;
  $css_dreconstec = array();
  $js_dreconstec = array();
  template_head($data_template,$css_dreconstec);
?>
<main>
  <div class="content-wrapper">
    <section class="content">
      <div class="container container_main centrarContent">
        <div class="error-page">
          <div class="row">
            <div class="col-md-3">
              <h2 class="headline text-danger">500</h2>
            </div>
            <div class="col-md-9">
              <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Algo salió mal.</h3>
                <p>
                  Trabajaremos para solucionarlo de inmediato. Mientras tanto, puede volver al <a href="webAdministracion/pages/principal/">panel de control.</a>
                </p>
              </div>
            </div>
          </div>
          <div class="row centrarContent">
            <div class="col-md-12">
              <img src="dist/img/dct_error_page.png" class="img-fluid" alt="Responsive image">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
<?php
  template_footer($data_template,$js_dreconstec);
?>