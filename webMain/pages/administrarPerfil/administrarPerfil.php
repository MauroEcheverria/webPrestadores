<?php 
  function administrarPerfil($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  //$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../dist/js/webMain.js'.$dataSesion["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="idTogglable_1-tab" data-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="false">Datos Personales</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="idTogglable_2-tab" data-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="true">Actualizar Contraseña</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
            <div class="divPanelTogglable">
              <div class="card">
                <div class="card-header">
                  <span class="panel-title"><b>Actualizar Perfil</b></span>
                </div>
                <div class="card-body">
                  <form id="formAdminPerfil" data-toggle="validator" role="form">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="pct_provincia" class="control-label">Provincia</label><br/>
                          <select class="form-control select2" name="pct_provincia" id="pct_provincia" style="width: 100%" required></select>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_canton" class="control-label">Cantón</label><br/>
                          <select class="form-control select2" name="pct_canton" id="pct_canton" style="width: 100%" required></select>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_parroquia" class="control-label">Parroquia</label><br/>
                          <select class="form-control select2" name="pct_parroquia" id="pct_parroquia" style="width: 100%" required></select>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_direccion" class="control-label">Dirección exacta</label>
                          <input class="form-control" type="text" name="pct_direccion" id="pct_direccion" 
                          required maxlength="80" />
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_referencia" class="control-label">Referencia</label>
                          <input class="form-control" type="text" name="pct_referencia" id="pct_referencia" 
                          required maxlength="50" />
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="pct_estado_civil" class="control-label">Estado Civil</label>
                          <select class="form-control" name="pct_estado_civil" id="pct_estado_civil" required>
                            <option value="">Seleccione una opción</option>
                            <option value="CASADO/A">CASADO/A</option>
                            <option value="DIVORCIADO/A">DIVORCIADO/A</option>
                            <option value="SOLTERO/A">SOLTERO/A</option>
                            <option value="VIUDO/A">VIUDO/A</option>
                          </select>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_telefono" class="control-label">Teléfono Convencional / Celular</label>
                          <input class="form-control" type="text" onkeypress="return soloNumeros(event);" name="pct_telefono" id="pct_telefono" maxlength="10" required=""/>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_instruccion" class="control-label">Instrucción</label>
                          <select class="form-control" name="pct_instruccion" id="pct_instruccion" required>
                            <option value="">Seleccione una opción</option>
                            <option value="BASICA">BASICA</option>
                            <option value="PRIMARIA">PRIMARIA</option>
                            <option value="SECUNDARIA">SECUNDARIA</option>
                            <option value="SUPERIOR">SUPERIOR</option>
                            <option value="NINGUNA">NINGUNA</option>
                          </select>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_tipo_sangre" class="control-label">Tipo de Sangre</label>
                          <select class="form-control" name="pct_tipo_sangre" id="pct_tipo_sangre" required>
                            <option value="">Seleccione una opción</option>
                            <option value="A +">A +</option>
                            <option value="O +">O +</option>
                            <option value="B +">B +</option>
                            <option value="AB +">AB +</option>
                            <option value="A -">A -</option>
                            <option value="O -">O -</option>
                            <option value="B -">B -</option>
                            <option value="AB -">AB -</option>
                            <option value="DESCONOCE">DESCONOCE</option>
                          </select>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="pct_sexo" class="control-label">Sexo</label>
                          <select class="form-control" name="pct_sexo" id="pct_sexo" required>
                            <option value="">Seleccione una opción</option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group centrarContent">
                      <button type="submit" class="btn btn-default btn-estandar-dreconstec">Guardar</button>
                    </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
            <div class="divPanelTogglable">
              <div class="card">
                <div class="card-header">
                  <span class="panel-title"><b>Cambio de Contraseña</b></span>
                </div>
                <div class="card-body">
                  <form id="formExpirePassPerfil" data-toggle="validator" role="form">
                    <div class="form-group">
                      <label for="passPassAnt" class="control-label">Contraseña Antigua:</label>
                      <input type="password" class="form-control" id="passPassAnt" name="passPassAnt" required maxlength="15">
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label for="passPassNew" class="control-label">Nueva Contraseña:</label>
                      <input type="password" class="form-control" id="passPassNew" name="passPassNew" required maxlength="15" minlength="5">
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                      <label for="passRepPass" class="control-label">Repita Contraseña:</label>
                      <input type="password" class="form-control" id="passRepPass" name="passRepPass" data-match="#passPassNew" data-match-error="Las contraseñas no coinciden." required maxlength="15" minlength="5">
                      <div class="help-block with-errors"></div>
                    </div>
                    <div class="alert alert-danger poppupAlert" role="alert" id="modal_pass_verify">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <div id="">
                        <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
                        <ul>
                            <li id="letter" class="invalid_pass">Al menos debería tener <strong>una letra</strong></li>
                            <li id="capital" class="invalid_pass">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                            <li id="number" class="invalid_pass">Al menos debería tener <strong>un número</strong></li>
                            <li id="length" class="invalid_pass">Debe tener <strong>5 carácteres</strong> como mínimo</li>
                        </ul>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group centrarContent">
                      <button type="submit" class="btn btn-default btn-estandar-dreconstec" id="idBtnSaveValidar">Guardar</button>
                    </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
  <div class="poppupAlert" id="alertNewClaveParametros">
    <a href="#" class="close aAlert" data-dismiss="alert">&times;</a>
    <strong>La clave debe cumplir todos los parámetros.
  </div>
<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>