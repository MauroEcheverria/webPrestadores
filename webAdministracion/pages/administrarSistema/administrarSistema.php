<?php 
  function administrarSistema($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/media/css/jquery.dataTables.min.css'.$dataSesion["version_css_js"].'" rel="stylesheet">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css'.$dataSesion["version_css_js"].'" rel="stylesheet">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'.$dataSesion["version_css_js"].'">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/media/js/jquery.dataTables.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/webMain.js'.$dataSesion["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>
<div id="appAdministrarSistema" class="appAdministrarSistema"></div>
<div class="content-wrapper">
  <section class="content">
    <div class="container container_main">
      <div class="card">
        <div class="card-header">
          <span class="panel-title"><b>Administración de Sistema</b></span>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="idTogglable_1-tab" data-bs-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="false">Empresas</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_3-tab" data-bs-toggle="tab" href="#idTogglable_3" role="tab" aria-controls="idTogglable_3" aria-selected="true">Accesos</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaEmpresa">Crear Empresa</button>
                  </div>
                  <table id="dtSistemaEmpresa" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_3" role="tabpanel" aria-labelledby="idTogglable_3-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="centrarContent">
                        <strong>Creación de Roles</strong>
                      </div>
                      <div class="seccionBtnAccion">
                        <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRol">Crear</button>
                      </div>
                      <table id="dtSistemaRol" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                    <div class="col-md-6">
                      <div class="centrarContent">
                        <strong>Vinculo Empresa - Aplicativo</strong>
                      </div>
                      <div class="seccionBtnAccion">
                        <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRol">Crear</button>
                      </div>
                      <table id="dtSistemaEmpresaAplicativo" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                  </div>
                  <div>
                    <strong>Seleccion de Rol</strong>
                    <div>
                      <select class="form-control" name= "sys_selec_roles" id="sys_selec_roles" data-placeholder="Lista de Roles"></select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="centrarContent">
                        <strong>Vinculo Rol - Aplicativo</strong>
                      </div>
                      <div class="seccionBtnAccion">
                        <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRol">Crear</button>
                      </div>
                      <table id="dtSistemaRolAplicativo" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                    <div class="col-md-6">
                      <div class="centrarContent">
                        <strong>Vinculo Rol - Opción</strong>
                      </div>
                      <div class="seccionBtnAccion">
                        <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRol">Crear</button>
                      </div>
                      <table id="dtSistemaRolOpcion" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="myModalSysRoleApp" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Asignación de App según Rol</h4>
          </div>
        </div>
      </div>
      <form id="formSysApp" class="formModalPages" data-toggle="validator" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="" class="control-label">Rol Seleccionado:</label>
            <h3 class="passSysRoles adminRoles_2"></h3>
          </div>
          <div class="form-group">
            <select class="form-control select2" name= "sys_selec_app[]" id="sys_selec_app" data-placeholder="Seleccione una App" multiple="multiple" required="" style="width: 100%;">
            </select>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group">
            <button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn-dreconstec">Asignar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalSysRoleOpt" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Asignación de Opciones según Rol</h4>
          </div>
        </div>
      </div>
      <form id="formSysOption" class="formModalPages" data-toggle="validator" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="" class="control-label">Rol Seleccionado:</label>
            <h3 class="passSysRoles adminRoles_2"></h3>
          </div>
          <div class="form-group">
            <select class="form-control select2" name= "sys_selec_option[]" id="sys_selec_option" data-placeholder="Seleccione una App" multiple="multiple" required="" style="width: 100%;">
            </select>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group">
            <button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn-dreconstec">Asignar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalSistemaEmpresa" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Gestión de Empresa</h4>
          </div>
        </div>
      </div>
      <form id="formSistemaEmpresa" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <input type="hidden" name="tipo_form" id="tipo_form">
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
                <label for="emp_ruc" class="control-label">RUC</label>
                <input type="text" class="form-control" id="emp_ruc" name="emp_ruc" maxlength="13" minlength="13" onkeypress="return soloNumeros(event);" required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="emp_empresa" class="control-label">Empresa</label>
                <input type="text" class="form-control" id="emp_empresa" name="emp_empresa" maxlength="80" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                 <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="emp_vigencia_desde" class="control-label">Vigencia Desde</label>
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-calendar-alt"></i></span>
                  <input type="text" class="form-control pull-right" id="emp_vigencia_desde" name="emp_vigencia_desde" required>
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ctg_id_catalogo " class="control-label">Tipo Plan</label>
                <select name="ctg_id_catalogo" id="ctg_id_catalogo" class="form-control" required></select>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="emp_estado" class="control-label">Estado</label>
                <select name="emp_estado" id="emp_estado" class="form-control" required>
                  <option value="">Selecione una opción</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="emp_vigencia_hasta" class="control-label">Vigencia Hasta</label>
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-calendar-alt"></i></span>
                  <input type="text" class="form-control pull-right" id="emp_vigencia_hasta" name="emp_vigencia_hasta" required>
                </div>
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
<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>