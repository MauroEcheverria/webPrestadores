<?php 
  function registroFirmaEC($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/webRegistroFirmaEC.js'.$dataSesion["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container container_main">
        <div class="card">
          <div class="card-header">
            <span class="panel-title"><b>Administración de Firma Electrónica</b></span>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="idTogglable_1-tab" data-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="false">Firma Registrada</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_2-tab" data-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="true">Registrar Firma</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">
                    <div id="idContenidoFirmaEC"></div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">

                    <form id="formCargaArchivoEmpresa" class="formModalPages" data-toggle="validator" role="form" autocomplete="false" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="form-group">
                          <label class="control-label">Consideraciones para carga de archivo: </label>
                          <div>
                            <ul>
                              <li> Solo formato <code>.p12</code></li>
                              <li> Tamaño máximo por archivo de 2MB</li>
                            </ul>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="em_archivo_fact_elec" name="em_archivo_fact_elec" required="">
                            <label class="custom-file-label form-control-file" for="customFileLang">Seleccionar Archivo</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="em_pass_fct_elec" class="control-label">Contraseña Firma Electrónica</label>
                          <input type="password" class="form-control" id="em_pass_fct_elec" name="em_pass_fct_elec" maxlength="40" required minlength="3">
                           <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="em_pass_fct_recon" class="control-label">Confirmar Contraseña Firma</label>
                          <input type="password" class="form-control" id="em_pass_fct_recon" name="em_pass_fct_recon" maxlength="40" required minlength="3"
                          data-match="#em_pass_fct_elec" data-match-error="Las contraseñas no coinciden.">
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
            </div>






                      



          </div>
        </div>
      </div>
    </section>
  </div>
<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>