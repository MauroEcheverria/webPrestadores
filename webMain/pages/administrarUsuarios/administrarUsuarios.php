<?php 
function administrarUsuarios($pdo,$dataSesion){ 
include("../../../template/templateHead.php");
include("../../../template/templateFooter.php");
include("../../../dialogs/modalViews.php"); 
template_head($pdo,$dataSesion); modalViews();?>
<script src="../../../dist/js/webMain.js?v1.1"></script>
<script src="../../../dist/js/jquery.md5.js"></script>
<div class="container container_main">
  <section class="sectionDataTable contentNegocio">
    <div class="card">
      <div class="card-header">
          <span class="panel-title"><b>Administración de Usuarios</b></span>
      </div>
      <div class="card-body">
        <div class="buttonDataTable">
          <button type="button" class="btn btn-default btn-estandar-dreconstec" id="btnUserNuevo">Crear Usuario</button>
        </div>
          <table id="dtUsuarios" class="cell-border" cellspacing="0" width="100%"></table> 
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
            <img src="../../../dist/img/visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11 adminContra_3">
            <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form id="formUserNew" class="formModalPages" data-toggle="validator" role="form">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="newCedula" class="control-label">Cédula</label>
                <input type="text" class="form-control" id="newCedula" name="newCedula" maxlength="13" 
                onkeypress="return soloNumeros(event);" required minlength="1">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="usr_nombre_1" class="control-label">Primer Nombre</label>
                <input type="text" class="form-control" id="usr_nombre_1" name="usr_nombre_1" maxlength="15" required minlength="3">
                 <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="usr_apellido_1" class="control-label">Primer Apellido</label>
                <input type="text" class="form-control" id="usr_apellido_1" name="usr_apellido_1" maxlength="15" required minlength="3">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="newNacimiento" class="control-label">Fecha de Nacimiento (yyyy-mm-dd)</label>
                <input type="mail" class="form-control" id="newNacimiento" name="newNacimiento" required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group adminUser_2">
                <label for="newRol" class="control-label">Tipo Rol</label>
                <select name="newRol" id="newRol" class="form-control adminUser_1" required style="width: 100%;"></select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="newCorreo" class="control-label">Correo</label>
                <input type="email" class="form-control" id="newCorreo" name="newCorreo" maxlength="60" 
                data-error="Formato de Correo inválido." required oninput="this.value = this.value.toLowerCase()" minlength="6">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="usr_nombre_2" class="control-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="usr_nombre_2" name="usr_nombre_2" maxlength="15" required minlength="2">
                 <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="usr_apellido_2" class="control-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="usr_apellido_2" name="usr_apellido_2" maxlength="15">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="usr_sexo" class="control-label">Sexo</label>
                <select class="form-control" id="usr_sexo" name="usr_sexo" required>
                  <option value="">Sexo</option>
                  <option value="H">Hombre</option>
                  <option value="M">Mujer</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="usr_telefono" class="control-label">Teléfono/Convencional</label>
                <input type="text" class="form-control" id="usr_telefono" name="usr_telefono" maxlength="10" 
                onkeypress="return soloNumeros(event);">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-default btn-estandar-dreconstec">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalEditUser" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11 adminContra_3">
            <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form id="formUserMod" class="formModalPages" data-toggle="validator" role="form">

          <div class="form-group">
            <label for="" class="control-label">Cédula</label>
            <h3 class="editCedula adminRoles_2"></h3>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_usr_nombre_1" class="control-label">Primer Nombre</label>
                <input type="text" class="form-control" id="edit_usr_nombre_1" name="edit_usr_nombre_1" maxlength="15" required minlength="3">
                 <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="edit_usr_apellido_1" class="control-label">Primer Apellido</label>
                <input type="text" class="form-control" id="edit_usr_apellido_1" name="edit_usr_apellido_1" maxlength="15" required minlength="3">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="editNacimiento" class="control-label">Fecha de Nacimiento (yyyy-mm-dd)</label>
                <input type="text" class="form-control" id="editNacimiento" name="editNacimiento" required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group adminUser_2">
                <label for="editRol" class="control-label">Tipo Rol</label>
                <select name="editRol" id="editRol" class="form-control" required style="width: 100%;">
                </select>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="editEstado" class="control-label">Estado</label>
                <select name="editEstado" id="editEstado" class="form-control" required>
                  <option value="TRUE" selected>Activo</option>
                  <option value="FALSE" selected>Inactivo</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group labelUser">
                <label for="edit_usr_nombre_2" class="control-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="edit_usr_nombre_2" name="edit_usr_nombre_2" maxlength="15" required minlength="2">
                 <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="edit_usr_apellido_2" class="control-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="edit_usr_apellido_2" name="edit_usr_apellido_2" maxlength="15">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="editCorreo" class="control-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="editCorreo" name="editCorreo" maxlength="60" 
                required oninput="this.value = this.value.toLowerCase()" minlength="6" data-error="Formato de Correo inválido.">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="edit_usr_sexo" class="control-label">Sexo</label>
                <select class="form-control" id="edit_usr_sexo" name="edit_usr_sexo" required>
                  <option value="">Sexo</option>
                  <option value="H">Hombre</option>
                  <option value="M">Mujer</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group labelUser">
                <label for="edit_usr_telefono" class="control-label">Teléfono/Convencional</label>
                <input type="text" class="form-control" id="edit_usr_telefono" name="edit_usr_telefono" maxlength="10" 
                onkeypress="return soloNumeros(event);">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

              
          <div class="form-group">
            <button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-default btn-estandar-dreconstec">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalPassUser" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11 adminContra_3">
            <h4 class="modal-title" id="myModalLabel">Resetear Contraseña</h4>
          </div>
        </div>
      </div>
      <div class="modal-body">
          <form id="formUserPass" class="formModalPages" data-toggle="validator" role="form">
            <div class="form-group">
              <label for="" class="control-label">Cédula:</label>
              <h3 class="passCedula adminRoles_2"></h3>
            </div>
            <div class="form-group">
              <label for="" class="control-label">Nombres:</label>
              <h3 class="passNombres adminRoles_2"></h3>
            </div>
            <div><span>La contraseña se reseteará y será su mismo número de cédula. Al inicio de sesión este le pedirá realizar el respectivo cambio de contraseña para así personalizarlo a su preferencia.</span></div><br>
            <div class="form-group">
              <button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-default btn-estandar-dreconstec">Resetear</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
<div class="poppupAlert" id="alertNewCedulaRepet">
    <a href="#" class="close aAlert" data-dismiss="alert">&times;</a>
    <strong>Por Favor.</strong> Ha ingresado una cédula ya registrada.
</div>
<div class="poppupAlert" id="alertCedulaNOValida">
    <a href="#" class="close aAlert" data-dismiss="alert">&times;</a>
    <strong>Por Favor.</strong> Ingrese una cédula válida.
</div>
<?php template_footer(); } ?>