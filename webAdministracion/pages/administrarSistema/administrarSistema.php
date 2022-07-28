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
              <a class="nav-link" id="idTogglable_2-tab" data-bs-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="false">Aplicaciones</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_3-tab" data-bs-toggle="tab" href="#idTogglable_3" role="tab" aria-controls="idTogglable_3" aria-selected="false">Opciones</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_4-tab" data-bs-toggle="tab" href="#idTogglable_4" role="tab" aria-controls="idTogglable_4" aria-selected="true">Roles</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_5-tab" data-bs-toggle="tab" href="#idTogglable_5" role="tab" aria-controls="idTogglable_5" aria-selected="true">Empresa - Aplicativo</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_6-tab" data-bs-toggle="tab" href="#idTogglable_6" role="tab" aria-controls="idTogglable_6" aria-selected="true">Rol - Aplicativo</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_7-tab" data-bs-toggle="tab" href="#idTogglable_7" role="tab" aria-controls="idTogglable_7" aria-selected="true">Rol - Opción</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaEmpresa">Crear</button>
                  </div>
                  <table id="dtSistemaEmpresa" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                  </div>
                  <table id="dtSistemaAplicacion" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_3" role="tabpanel" aria-labelledby="idTogglable_3-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                  </div>
                  <table id="dtSistemaOpcion" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_4" role="tabpanel" aria-labelledby="idTogglable_4-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRol">Crear</button>
                  </div>
                  <table id="dtSistemaRol" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_5" role="tabpanel" aria-labelledby="idTogglable_5-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaEmpresaAplicativo">Crear</button>
                  </div>
                  <table id="dtSistemaEmpresaAplicativo" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_6" role="tabpanel" aria-labelledby="idTogglable_6-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRolAplicativo">Crear</button>
                  </div>
                  <table id="dtSistemaRolAplicativo" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_7" role="tabpanel" aria-labelledby="idTogglable_7-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevoSistemaRolOpcion">Crear</button>
                  </div>
                  <table id="dtSistemaRolOpcion" class="cell-border" cellspacing="0" width="100%"></table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
        <input type="hidden" name="tipo_form_sist_empre" id="tipo_form_sist_empre">
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
<div class="modal fade" id="myModalSistemaRol" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Gestión de Roles</h4>
          </div>
        </div>
      </div>
      <form id="formSistemaRol" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <input type="hidden" name="tipo_form_sist_rol" id="tipo_form_sist_rol">
        <div class="modal-body">
          <div class="form-group">
            <label for="rol_rol " class="control-label">Rol</label>
            <input type="text" class="form-control" id="rol_rol" name="rol_rol" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="rol_estado" class="control-label">Estado</label>
            <select name="rol_estado" id="rol_estado" class="form-control" required>
              <option value="">Selecione una opción</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <div class="help-block with-errors"></div>
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
<div class="modal fade" id="myModalSistemaAplicacion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Gestión de Aplicativo</h4>
          </div>
        </div>
      </div>
      <form id="formSistemaAplicacion" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <input type="hidden" name="tipo_form_sist_apl" id="tipo_form_sist_apl">
        <div class="modal-body">
          <div class="form-group">
            <label for="apl_aplicacion " class="control-label">Aplicativo</label>
            <input type="text" class="form-control" id="apl_aplicacion" name="apl_aplicacion" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="apl_estado" class="control-label">Estado</label>
            <select name="apl_estado" id="apl_estado" class="form-control" required>
              <option value="">Selecione una opción</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <div class="help-block with-errors"></div>
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
<div class="modal fade" id="myModalSistemaOpcion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Gestión de Opciones</h4>
          </div>
        </div>
      </div>
      <form id="formSistemaOpcion" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <input type="hidden" name="tipo_form_sist_opc" id="tipo_form_sist_opc">
        <div class="modal-body">
          <div class="form-group">
            <label for="opc_opcion " class="control-label">Opción</label>
            <input type="text" class="form-control" id="opc_opcion" name="opc_opcion" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="opc_estado" class="control-label">Estado</label>
            <select name="opc_estado" id="opc_estado" class="form-control" required>
              <option value="">Selecione una opción</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <div class="help-block with-errors"></div>
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
<div class="modal fade" id="myModalSistemaEmpresaAplicativo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Gestión de Empresa Aplicativo</h4>
          </div>
        </div>
      </div>
      <form id="formSistemaEmpresaAplicativo" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <input type="hidden" name="tipo_form_sist_emp_apl" id="tipo_form_sist_emp_apl">
        <div class="modal-body">
          <div class="form-group">
            <label for="emp_empresa_1" class="control-label">Empresa</label>
            <input type="text" class="form-control" id="emp_empresa_1" name="emp_empresa_1" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="apl_aplicacion_1" class="control-label">Aplicación</label>
            <input type="text" class="form-control" id="apl_aplicacion_1" name="apl_aplicacion_1" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="ape_estado" class="control-label">Estado</label>
            <select name="ape_estado" id="ape_estado" class="form-control" required>
              <option value="">Selecione una opción</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <div class="help-block with-errors"></div>
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
<div class="modal fade" id="myModalSistemaRolAplicativo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Gestión de Rol Aplicativo</h4>
          </div>
        </div>
      </div>
      <form id="formSistemaRolAplicativo" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <input type="hidden" name="tipo_form_sist_rol_apl" id="tipo_form_sist_rol_apl">
        <div class="modal-body">
          <div class="form-group">
            <label for="rol_rol_2" class="control-label">Rol</label>
            <input type="text" class="form-control" id="rol_rol_2" name="rol_rol_2" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="apl_aplicacion_2" class="control-label">Aplicación</label>
            <input type="text" class="form-control" id="apl_aplicacion_2" name="apl_aplicacion_2" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="rla_estado" class="control-label">Estado</label>
            <select name="rla_estado" id="rla_estado" class="form-control" required>
              <option value="">Selecione una opción</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <div class="help-block with-errors"></div>
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
<div class="modal fade" id="myModalSistemaRolOpcion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Gestión de Rol Opción</h4>
          </div>
        </div>
      </div>
      <form id="formSistemaRolOpcion" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <input type="hidden" name="tipo_form_sist_rol_opc" id="tipo_form_sist_rol_opc">
        <div class="modal-body">
          <div class="form-group">
            <label for="rol_rol_3" class="control-label">Rol</label>
            <input type="text" class="form-control" id="rol_rol_3" name="rol_rol_3" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="opc_opcion_3" class="control-label">Opción</label>
            <input type="text" class="form-control" id="opc_opcion_3" name="opc_opcion_3" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="rlo_estado" class="control-label">Estado</label>
            <select name="rlo_estado" id="rlo_estado" class="form-control" required>
              <option value="">Selecione una opción</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <div class="help-block with-errors"></div>
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