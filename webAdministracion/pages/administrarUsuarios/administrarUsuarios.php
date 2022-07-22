<?php 
  function administrarUsuarios($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/media/css/jquery.dataTables.min.css'.$dataSesion["version_css_js"].'" rel="stylesheet">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css'.$dataSesion["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/media/js/jquery.dataTables.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/webMain.js'.$dataSesion["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container container_main">
        <div class="card">
          <div class="card-header">
            <span class="panel-title"><b>Administración de Usuarios</b></span>
          </div>
          <div class="card-body">
            <div class="seccionBtnAccion">
              <button type="button" class="btn btn-success btn-dreconstec" id="btnUserNuevo">Crear Usuario</button>
            </div>
            <table id="dtUsuarios" class="cell-border" cellspacing="0" width="100%"></table> 
          </div>
        </div>
      </div>
    </section>
  </div>
    
  <div class="modal fade" id="myModalNuevoUser" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modalLogin">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11">
              <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
          </div>
        </div>
        <form id="formUserNew" class="formModalPages" data-toggle="validator" role="form">
          <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
          <div class="modal-body">
            <div class="alert alert-danger poppupAlert" role="alert" id="loginCorreoRegistrado">
              El correo electrónico ingresado ya se encuentra registrado en nuestro sistema. Si tiene inconvenientes favor escribir a info@dreconstec.com
            </div>

            <div class="alert alert-danger poppupAlert" role="alert" id="loginUsuarioRegistrado">
              La cédula o pasaporte ingresado ya se encuentra registrado en nuestro sistema. Si tiene inconvenientes favor escribir a info@dreconstec.com
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="usr_cod_usuario" class="control-label">Cédula</label>
                  <input type="text" class="form-control" id="usr_cod_usuario" name="usr_cod_usuario" maxlength="13" onkeypress="return soloNumeros(event);" required minlength="1">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="usr_nombre_1" class="control-label">Primer Nombre</label>
                  <input type="text" class="form-control" id="usr_nombre_1" name="usr_nombre_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="usr_apellido_1" class="control-label">Primer Apellido</label>
                  <input type="text" class="form-control" id="usr_apellido_1" name="usr_apellido_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="usr_id_rol" class="control-label">Tipo Rol</label>
                  <select name="usr_id_rol" id="usr_id_rol" class="form-control" required style="width: 100%;"></select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="usr_correo" class="control-label">Correo</label>
                  <input type="email" class="form-control" id="usr_correo" name="usr_correo" maxlength="60" 
                  data-error="Formato de Correo inválido." required oninput="this.value = this.value.toLowerCase()" minlength="6">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="usr_nombre_2" class="control-label">Segundo Nombre</label>
                  <input type="text" class="form-control" id="usr_nombre_2" name="usr_nombre_2" maxlength="15" minlength="2" required oninput="this.value = this.value.toUpperCase()">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="usr_apellido_2" class="control-label">Segundo Apellido</label>
                  <input type="text" class="form-control" id="usr_apellido_2" name="usr_apellido_2" maxlength="15" oninput="this.value = this.value.toUpperCase()">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="usr_id_empresa" class="control-label">Empresa</label>
                  <select name="usr_id_empresa" id="usr_id_empresa" class="form-control" required style="width: 100%;"></select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer centralFooter">
            <button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModalEditUser" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modalLogin">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11">
              <h4 class="modal-title">Editar Usuario</h4>
            </div>
          </div>
        </div>
        <form id="formUserMod" class="formModalPages" data-toggle="validator" role="form">
          <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
          <div class="alert alert-danger poppupAlert" role="alert" id="loginCorreoRegistradoEdit">
            El correo electrónico ingresado ya se encuentra registrado en nuestro sistema. Si tiene inconvenientes favor escribir a info@dreconstec.com
          </div>
          <div class="alert alert-danger poppupAlert" role="alert" id="loginUsuarioRegistradoEdit">
            La cédula o pasaporte ingresado ya se encuentra registrado en nuestro sistema. Si tiene inconvenientes favor escribir a info@dreconstec.com
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="" class="control-label">Cédula</label>
              <h3 class="editCedula adminRoles_2"></h3>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="edit_usr_nombre_1" class="control-label">Primer Nombre</label>
                  <input type="text" class="form-control" id="edit_usr_nombre_1" name="edit_usr_nombre_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="edit_usr_apellido_1" class="control-label">Primer Apellido</label>
                  <input type="text" class="form-control" id="edit_usr_apellido_1" name="edit_usr_apellido_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group adminUser_2">
                  <label for="edit_usr_id_rol" class="control-label">Tipo Rol</label>
                  <select name="edit_usr_id_rol" id="edit_usr_id_rol" class="form-control" required style="width: 100%;">
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="edit_usr_estado" class="control-label">Estado</label>
                  <select name="edit_usr_estado" id="edit_usr_estado" class="form-control" required>
                    <option value="">Selecione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group labelUser">
                  <label for="edit_usr_nombre_2" class="control-label">Segundo Nombre</label>
                  <input type="text" class="form-control" id="edit_usr_nombre_2" name="edit_usr_nombre_2" maxlength="15" required minlength="2" oninput="this.value = this.value.toUpperCase()">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group labelUser">
                  <label for="edit_usr_apellido_2" class="control-label">Segundo Apellido</label>
                  <input type="text" class="form-control" id="edit_usr_apellido_2" name="edit_usr_apellido_2" maxlength="15" oninput="this.value = this.value.toUpperCase()">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="edit_usr_id_empresa" class="control-label">Empresa</label>
                  <select name="edit_usr_id_empresa" id="edit_usr_id_empresa" class="form-control" required style="width: 100%;"></select>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="edit_usr_correo" class="control-label">Correo Electrónico</label>
                  <input type="email" class="form-control" id="edit_usr_correo" name="edit_usr_correo" maxlength="60" 
                  required oninput="this.value = this.value.toLowerCase()" minlength="6" data-error="Formato de Correo inválido.">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer centralFooter">
            <div class="form-group">
              <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModalPassUser" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11">
              <h4 class="modal-title">Resetear Contraseña</h4>
            </div>
          </div>
        </div>
        <form id="formUserPass" class="formModalPages" data-toggle="validator" role="form">
          <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
          <div class="modal-body">
                <div class="form-group">
                  <label for="" class="control-label">Cédula:</label>
                  <h3 class="passCedula adminRoles_2"></h3>
                </div>
                <div class="form-group">
                  <label for="" class="control-label">Nombres:</label>
                  <h3 class="passNombres adminRoles_2"></h3>
                </div>
                <div><span>La contraseña se reseteará y será su mismo número de cédula. Al inicio de sesión este le pedirá realizar el respectivo cambio de contraseña para así personalizarlo a su preferencia.</span></div><br>
          </div>
          <div class="modal-footer centralFooter">
            <div class="form-group">
              <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-warning">Resetear</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>