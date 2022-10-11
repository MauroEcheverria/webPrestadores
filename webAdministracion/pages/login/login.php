<?php
  function tema_login($data_template){
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Parameter.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php");
  include("../../../dialogs/modalViews.php");
  
  $css_dreconstec = array();

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js'.$data_template["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/loginWEB.js'.$data_template["version_css_js"].'"></script>';

  template_head($data_template, $css_dreconstec);
?>

  <div class="row">
    <div class="col-md-8">
      <div><img src="../../../dist/img/portada_1.jpg" style="width: 100%;" /></div>
    </div>
    <div class="col-md-4">
      <div class="login-box">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Inicio de Sesión</p>
            <form id="formLoginSesion" class="needs-validation" novalidate method="post" data-toggle="validator" role="form" autocomplete="off">
              <input type="hidden" name="linkTemp" id="linkTemp" value="<?php echo $data_template["linkTemp"]; ?>">
              <input type="hidden" name="csrf" value="<?php echo $data_template["token_csrf"]; ?>">
              <div class="form-group">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Cédula Identidad" name="inputUser" id="inputUser" required="">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                  <div class="invalid-feedback">
                    Por favor ingrese su cédula de identidad
                  </div>
                  <div class="valid-feedback"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Contraseña" name="inputPassword" id="inputPassword" required="">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <div class="invalid-feedback">
                    Por favor ingrese su contraseña
                  </div>
                  <div class="valid-feedback"></div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Acceder</button>
              </div>
            </form>
            <p class="mb-1">
              <a href="#" id="idOlvidoContrasena">¿Olvidó su contraseña?</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>   

  <div class="modal fade" id="myModalExpirePass" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row width_100">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11 adminContra_3">
              <h4 class="modal-title" id="myModalLabel">Cambio de Contraseña</h4>
            </div>
          </div>
        </div>
        <form id="formExpirePass" class="formModalPages" data-toggle="validator" role="form">
          <div class="modal-body">
            <input type="hidden" name="csrf" value="<?php echo $data_template['token_csrf']; ?>">
            <div class="form-group">
              <label for="" class="control-label">Cédula:</label>
              <h3 id="idPassCedula" class="adminRoles_2"></h3>
            </div>
            <div class="form-group">
              <label for="" class="control-label">Nombres:</label>
              <h3 id="idPassNombres" class="adminRoles_2"></h3>
            </div>
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
            <div class="alert alert-danger poppupAlert" role="alert" id="modal_rest_verify">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div>
                <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
                <ul>
                    <li id="reset_letter" class="invalid_pass">Al menos debería tener <strong>una letra</strong></li>
                    <li id="reset_capital" class="invalid_pass">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                    <li id="reset_number" class="invalid_pass">Al menos debería tener <strong>un número</strong></li>
                    <li id="reset_length" class="invalid_pass">Debe tener <strong>5 carácteres</strong> como mínimo</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="modal-footer centralFooter">
            <div class="form-group">
              <button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-warning btn-dreconstec">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModalOlvidoContrasena" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row width_100">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11 adminContra_3">
              <h4 class="modal-title" id="myModalLabel">Reestablecimiento de Contraseña</h4>
            </div>
          </div>
        </div>
        <form id="formReestaPass" class="formModalPages" data-toggle="validator" role="form">
          <div class="modal-body">
            <input type="hidden" name="csrf" value="<?php echo $data_template['token_csrf']; ?>">
            <div class="form-group">
              <label for="cedOlvPass" class="control-label">Ingrese su cédula</label>
              <input type="text" class="form-control inputOlvidoPass" id="cedOlvPass" name="cedOlvPass" required maxlength="13" onkeypress='validateOnlyNumber(event)'>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="modal-footer centralFooter">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-12 col-md-6">
                  <button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>
                </div>
                <div class="col-xs-12 col-md-6">
                  <button type="submit" class="btn btn-success btn-dreconstec">Reestablecer</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
  modalViews();
  template_footer($data_template, $js_dreconstec); }
?>