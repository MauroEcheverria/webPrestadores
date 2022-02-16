<?php
  function tema_login($data_template){
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Parameter.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php");
  include("../../../dialogs/modalViews.php");

  $js_dreconstec = array();
  $js_dreconstec[0] = '<script src="../../../dist/js/loginWEB.js?dct_v_1.1"></script>';
  
  $css_dreconstec = array();
  $css_dreconstec[0] = '<link href="../../../dist/css/dreconstec.css?dct_v_1.1" rel="stylesheet">';

  template_head($data_template, $css_dreconstec);
?>
  <main class="form-signin">
    <form>
      <img class="mb-4" src="../../../dist/img/dreconstec_2.png" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
  </main>

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

  <div class="modal fade" id="myModalRegistro" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-6">
              <img src="../../../dist/img/vistito_m.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-6">
              <h4 class="modal-title" id="myModalLabel">Registro</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <form id="formRegister" class="formModalPages white-popup-block" data-toggle="validator" role="form" autocomplete="false">

            <div class="alert alert-danger poppupAlert" role="alert" id="loginCorreoRegistrado">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              El correo electrónico ingresado ya se encuentra registrado en nuestro sistema. Si tiene inconvenientes favor escribir a info@meditategy.com
            </div>

            <div class="alert alert-danger poppupAlert" role="alert" id="loginUsuarioRegistrado">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              La cédula o pasaporte ingresado ya se encuentra registrado en nuestro sistema. Si tiene inconvenientes favor escribir a info@meditategy.com
            </div>

            <div class="row">
              <div class="col-md-6">
                 <div class="form-group labelUser">
                  <label for="newCedula" class="control-label">Cédula o Pasaporte</label>
                  <input type="text" class="form-control inputLogin" id="newCedula" name="newCedula" maxlength="13" 
                  onkeypress="return soloNumeros(event);" required minlength="1">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group labelUser">
                  <label for="usr_nombre_1" class="control-label">Primer Nombre</label>
                  <input type="text" class="form-control inputLogin" id="usr_nombre_1" name="usr_nombre_1" maxlength="15" required minlength="3">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group labelUser">
                  <label for="usr_apellido_1" class="control-label">Primer Apellido</label>
                  <input type="text" class="form-control inputLogin" id="usr_apellido_1" name="usr_apellido_1" maxlength="15" required minlength="3">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group labelUser">
                  <label for="newNacimiento" class="control-label">Fecha de Nacimiento (yyyy-mm-dd)</label>
                  <input type="mail" class="form-control inputLogin" id="newNacimiento" name="newNacimiento" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group labelUser">
                  <label for="newCorreo" class="control-label">Correo Electrónico</label>
                  <input type="email" class="form-control inputLogin" id="newCorreo" name="newCorreo" maxlength="60" required 
                  oninput="this.value = this.value.toLowerCase()" minlength="6" data-error="Formato de Correo inválido.">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group labelUser">
                  <label for="usr_nombre_2" class="control-label">Segundo Nombre</label>
                  <input type="text" class="form-control inputLogin" id="usr_nombre_2" name="usr_nombre_2" maxlength="15" required minlength="2">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group labelUser">
                  <label for="usr_apellido_2" class="control-label">Segundo Apellido</label>
                  <input type="text" class="form-control inputLogin" id="usr_apellido_2" name="usr_apellido_2" maxlength="15">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group labelUser">
                  <label for="usr_sexo" class="control-label">Sexo</label>
                  <select class="form-control inputLogin" id="usr_sexo" name="usr_sexo" required>
                    <option value="">Sexo</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group labelUser">
                  <label for="newPass" class="control-label">Contraseña</label>
                  <input type="password" class="form-control inputLogin" id="newPass" name="newPass" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group labelUser">
                  <label for="newRepPass" class="control-label">Repita Contraseña</label>
                  <input type="password" class="form-control inputLogin" id="newRepPass" name="newRepPass" data-match="#newPass" 
                  data-match-error="Las contraseñas no coinciden." required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="alert alert-danger poppupAlert" role="alert" id="modal_pass_verify">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div id="">
                <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
                <ul>
                    <li id="login_letter" class="invalid_pass">Al menos debería tener <strong>una letra</strong></li>
                    <li id="login_capital" class="invalid_pass">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                    <li id="login_number" class="invalid_pass">Al menos debería tener <strong>un número</strong></li>
                    <li id="login_length" class="invalid_pass">Debe tener <strong>5 carácteres</strong> como mínimo</li>
                </ul>
              </div>
            </div>
            <hr>
            <div class="checkbox">
              <div class="card">
                <div class="card-header">
                  Término de Servicios y Condiciones de Uso
                </div>
                <div class="card-body">


                  <div class="reg_scroll">
                    
                    <div class="container container_main">

                      <div>
                        <h2>Términos y Condiciones</h2>
                      </div>

                      <?php 

                      $ConnectionDB = new ConnectionDB();
                      $pdo = $ConnectionDB->connect();
                      $sql_ie="SELECT crt_valor_3 FROM dct_parametro_tbl_criterio WHERE crt_cod_criterio = 'MT_TERM_PAC'";
                      $query_ie=$pdo->prepare($sql_ie);
                      $query_ie->execute();
                      $row_ie = $query_ie->fetch(\PDO::FETCH_ASSOC);

                      ?>

                      <h3 class="centrarContent only_underline">Para clientes</h3>
                      <div class="row container_main term_cond">
                        <div class="col-md-12">
                          <p class="justificarTexto">
                          <?php echo $row_ie["crt_valor_3"] ?>
                          </p>
                        </div>
                      </div>
                    </div>

                    <label class="reg_label">
                      <input type="checkbox" value="ok" name="newTerminos" id="newTerminos" class="reg_input" >
                      <label class="reg_span">Yo he leído y estoy de acuerdo con lo Término de Servicios y Condiciones de Uso</label>
                      <div class="help-block with-errors"></div>
                    </label>
                  </div>

                </div>
              </div>
            </div>
            <hr>
            <div class="form-group centrarContent">
              <button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-default btn-estandar-dreconstec" id="btnSubmitNewUser">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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

<?php 
  modalViews();
  template_footer($js_dreconstec); }
?>