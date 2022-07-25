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
              <a class="nav-link" id="idTogglable_2-tab" data-bs-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="true">Aplicaciones</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_3-tab" data-bs-toggle="tab" href="#idTogglable_3" role="tab" aria-controls="idTogglable_3" aria-selected="true">Roles</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_4-tab" data-bs-toggle="tab" href="#idTogglable_4" role="tab" aria-controls="idTogglable_4" aria-selected="true">Opciones</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="idTogglable_5-tab" data-bs-toggle="tab" href="#idTogglable_5" role="tab" aria-controls="idTogglable_5" aria-selected="true">Accesos</a>
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
            <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaAplicacion">Crear Aplicacion</button>
                  </div>
                  <table id="dtSistemaAplicacion" class="cell-border" cellspacing="0" width="100%"></table>

                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_3" role="tabpanel" aria-labelledby="idTogglable_3-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">

                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRol">Crear Rol</button>
                  </div>
                  <table id="dtSistemaRol" class="cell-border" cellspacing="0" width="100%"></table>

                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_4" role="tabpanel" aria-labelledby="idTogglable_4-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                   
                  <div class="seccionBtnAccion">
                    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaOpcion">Crear Opcion</button>
                  </div>
                  <table id="dtSistemaOpcion" class="cell-border" cellspacing="0" width="100%"></table>

                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="idTogglable_5" role="tabpanel" aria-labelledby="idTogglable_5-tab">
              <div class="divPanelTogglable">
                <div class="toggle_dentro_panel">
                  
                  <div class="form-group">
                    <select class="form-control" name= "sys_selec_roles" id="sys_selec_roles" data-placeholder="Lista de Roles">
                    </select>
                  </div>
                  <div id="panelAdminRoles" class="criteriosOcultar">
                    <span class="panel-title">Roles - Aplicativos</span>
                    <div>
                      <button type="button" class="btn btn-success btn-dreconstec" id="sys_btn_asignar_app">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Asignar
                      </button>
                      <button type="button" class="btn btn-success btn-dreconstec" id="sys_btn_desvincular_app" disabled="">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Desvincular
                      </button>
                    </div>
                    <table id="sys_dt_roles_app" class="cell-border" cellspacing="0" width="100%">  
                      <thead>
                        <tr>
                          <th><div class="tituloColumnasDT">Cod. Aplicativo</div></th>
                          <th><div class="tituloColumnasDT">Descripción</div></th>
                        </tr>
                      </thead>
                    </table>
                    <hr>
                    <span class="panel-title">Roles - Opciones</span>
                    <div>
                      <button type="button" class="btn btn-success btn-dreconstec" id="sys_btn_asignar_opt">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Asignar
                      </button>
                      <button type="button" class="btn btn-success btn-dreconstec" id="sys_btn_desvincular_opt" disabled="">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Desvincular
                      </button>
                    </div>
                    <table id="sys_dt_roles_option" class="cell-border" cellspacing="0" width="100%">  
                      <thead>
                        <tr>
                          <th><div class="tituloColumnasDT">Cod. Opción</div></th>
                          <th><div class="tituloColumnasDT">Aplicativo</div></th>
                          <th><div class="tituloColumnasDT">Descripción</div></th>
                        </tr>
                      </thead>
                    </table> 
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
<div class="modal fade" id="myModalSistemaEmpresaArchivo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="false">X</span>
        </button>
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11" style="width: 430px;">
            <h4 class="modal-title" id="myModalLabel"><strong>Subir Archivo PDF</strong></h4>
          </div>
        </div>
      </div>
      <form id="formCargaArchivoEmpresa" class="formModalPages" data-toggle="validator" role="form" autocomplete="false" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Consideraciones para Carga de Archivo: </label>
            <div>
              <ul>
                <li> Solo formato <code>.p12</code></li>
                <li> Tamaño máximo por archivo de 3MB</li>
              </ul>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="em_archivo_fact_elec" name="em_archivo_fact_elec" required="">
              <label class="custom-file-label form-control-file" for="customFileLang">Seleccionar Archivo</label>
            </div>
          </div>
          <div class="form-group">
            <label for="em_pass_fct_elec" class="control-label">Contraseña Firma</label>
            <input type="password" class="form-control" id="em_pass_fct_elec" name="em_pass_fct_elec" maxlength="40" required minlength="3">
             <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <label for="em_pass_fct_recon" class="control-label">Confirmar Contraseña Firma</label>
            <input type="password" class="form-control" id="em_pass_fct_recon" name="em_pass_fct_recon" maxlength="40" required minlength="3">
             <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="form-group modal-footer centralFooter">
          <button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>
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