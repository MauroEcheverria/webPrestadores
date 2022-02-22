<?php
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Parameter.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php");
  include("../../../dialogs/modalViews.php");

  app_error_reporting($app_error_reporting);
  $data_template["error_reporting"] = $app_error_reporting;
  $data_template["version_css_js"] = $version_css_js;
  
  $css_dreconstec = array();
  //$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.js'.$data_template["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/loginWEB.js'.$data_template["version_css_js"].'"></script>';

  template_head($data_template, $css_dreconstec);
?>
  
  <div class="container container_main centrarContent">
    <section class="sectionDataTable">
      <div class="panel panel-primary widthDataTable" style="width: 50%;">
        <div class="panel-heading tablePanelHeading">
            <h3 class="labelEvoluciones">Reestablecer Contraseña</h3>
        </div>
        <div class="panel-body" align="center">
          <form id="formReestaPass" class="formModalPages" data-toggle="validator" role="form">
            <div class="form-group">
              <label for="cedOlvPass" class="control-label">Ingrese su cédula</label>
              <input type="text" class="form-control inputOlvidoPass" id="cedOlvPass" name="cedOlvPass" required 
              maxlength="10" onkeypress='validateOnlyNumber(event)'>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-xs-12 col-md-6">
                  <button type="button" class="btn btn-default btn-estandar-dreconstec" onClick="location.href = '../login'">Regresar</button>
                </div>
                <div class="col-xs-12 col-md-6">
                  <button type="submit" class="btn btn-default btn-estandar-dreconstec">Reestablecer</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

<?php
  modalViews();
  template_footer($data_template, $js_dreconstec);
?>