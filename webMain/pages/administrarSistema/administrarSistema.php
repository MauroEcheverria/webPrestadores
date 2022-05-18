<?php 
  function administrarSistema($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  //$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$dataSesion["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../dist/js/webMain.js'.$dataSesion["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>

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
                <a class="nav-link active" id="idTogglable_1-tab" data-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="false">Empresas</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_2-tab" data-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="true">Aplicaciones</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_3-tab" data-toggle="tab" href="#idTogglable_3" role="tab" aria-controls="idTogglable_3" aria-selected="true">Roles</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_4-tab" data-toggle="tab" href="#idTogglable_4" role="tab" aria-controls="idTogglable_4" aria-selected="true">Opciones</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">

                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">
                    
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="idTogglable_3" role="tabpanel" aria-labelledby="idTogglable_3-tab">
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
              <div class="tab-pane fade" id="idTogglable_4" role="tabpanel" aria-labelledby="idTogglable_4-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">
                    
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
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success">Asignar</button>
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
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success">Asignar</button>
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