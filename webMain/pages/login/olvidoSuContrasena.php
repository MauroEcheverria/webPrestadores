<?php
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/sesion.class.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php"); 
  include("../../../template/templateServices.php");
  include("../../../dialogs/modalViews.php"); 

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

  template_head($data_template); modalViews();?>
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
  template_services("../../../buscarPor/","../../../webSalud/pages/agendarCita/")
  ?>
<?php template_footer(); ?>