<?php
  function tema_login($data_template){
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Parameter.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php");
  include("../../../dialogs/modalViews.php");
  
  $css_dreconstec = array();
  //$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.js'.$data_template["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/loginWEB.js'.$data_template["version_css_js"].'"></script>';

  template_head($data_template, $css_dreconstec);
?>
  <main class="form-signin">
    <form id="btnFormLogin" class="form-group" method="post" data-toggle="validator" role="form" autocomplete="off">
      <img class="mb-4" src="../../../dist/img/dreconstec_2.png" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Inicio de Sesión</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="inputUser" id="inputUser">
        <label for="floatingInput">Cédula Identidad</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
        <label for="floatingPassword">Contraseña</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <a href="../login/olvidoSuContrasena.php" class="olvidoContrasena">¿Olvidó su contraseña?</a>
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Acceder</button>
    </form>
  </main>

  <div class="modal fade" id="myModalRegistroOk" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/visto.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11 adminContra_3">
              <h4 class="modal-title" id="myModalLabel">Terminos y Condiciones</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">
            <strong>
            El registro se guardó  correctamente y de manera adicional se ha enviado a su correo un link para poder activar su cuenta.
            <br>Favor revisar su bandeja de entrada o spam.
            </strong>   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModalExpirePass" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11 adminContra_3">
              <h4 class="modal-title" id="myModalLabel">Cambio de Contraseña</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">
            <form id="formExpirePass" class="formModalPages" data-toggle="validator" role="form">
              <input type="hidden" name="_token" value="<?php echo $dataSesion['getToken']; ?>">
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
                <div id="">
                  <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
                  <ul>
                      <li id="reset_letter" class="invalid_pass">Al menos debería tener <strong>una letra</strong></li>
                      <li id="reset_capital" class="invalid_pass">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                      <li id="reset_number" class="invalid_pass">Al menos debería tener <strong>un número</strong></li>
                      <li id="reset_length" class="invalid_pass">Debe tener <strong>5 carácteres</strong> como mínimo</li>
                  </ul>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-default btn-estandar-dreconstec" id="idBtnSaveValidar">Guardar</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal_expire_pass" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11 adminContra_3">
              <h4 class="modal-title" id="myModalLabel">Cambio de Contraseña</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">
            <form id="formExpirePass" class="formModalPages" data-toggle="validator" role="form">
              <input type="hidden" name="_token" value="<?php echo $dataSesion['getToken']; ?>">
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
                <div id="">
                  <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
                  <ul>
                      <li id="reset_letter" class="invalid_pass">Al menos debería tener <strong>una letra</strong></li>
                      <li id="reset_capital" class="invalid_pass">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                      <li id="reset_number" class="invalid_pass">Al menos debería tener <strong>un número</strong></li>
                      <li id="reset_length" class="invalid_pass">Debe tener <strong>5 carácteres</strong> como mínimo</li>
                  </ul>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-default btn-estandar-dreconstec" id="idBtnSaveValidar">Guardar</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

<?php
  modalViews();
  template_footer($data_template, $js_dreconstec); }
?>