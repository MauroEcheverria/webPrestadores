<?php 
  function transacciones($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../dist/css/webPOSTransacciones.css'.$dataSesion["version_css_js"].'">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/facturacionElectronica/js/fiddle.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/facturacionElectronica/js/buffer.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/facturacionElectronica/js/forge.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/webPOSTransacciones.js'.$dataSesion["version_css_js"].'"></script>';


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
                <a class="nav-link active" id="idTogglable_1-tab" data-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="false">Facturación</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_2-tab" data-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="false">Anulaciones</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_3-tab" data-toggle="tab" href="#idTogglable_3" role="tab" aria-controls="idTogglable_3" aria-selected="false">Notas de Credito</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">


                    <form id="formPOSTransGenerarFactura" class="formModalPages" data-toggle="validator" role="form">
                      <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                      <input type="hidden" name="tipoComprobante" value="1">
                      <div class="modal-footer centralFooter">
                        <button type="submit" class="btn btn-success btn-dreconstec">Guardar Factura</button>
                      </div>
                    </form>

                    <form id="formPOSTransGenerarNotaCredito" class="formModalPages" data-toggle="validator" role="form">
                      <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                      <input type="hidden" name="tipoComprobante" value="4">
                      <div class="modal-footer centralFooter">
                        <button type="submit" class="btn btn-success btn-dreconstec">Guardar Nota Credito</button>
                      </div>
                    </form>

                    <form id="formPOSTransGenerarNotaDebito" class="formModalPages" data-toggle="validator" role="form">
                      <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                      <input type="hidden" name="tipoComprobante" value="5">
                      <div class="modal-footer centralFooter">
                        <button type="submit" class="btn btn-success btn-dreconstec">Guardar Nota Debito</button>
                      </div>
                    </form>

                    <form id="formPOSTransGenerarGuiaRemision" class="formModalPages" data-toggle="validator" role="form">
                      <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                      <input type="hidden" name="tipoComprobante" value="6">
                      <div class="modal-footer centralFooter">
                        <button type="submit" class="btn btn-success btn-dreconstec">Guardar Guia Remision</button>
                      </div>
                    </form>

                    <form id="formPOSTransGenerarRetencion" class="formModalPages" data-toggle="validator" role="form">
                      <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                      <input type="hidden" name="tipoComprobante" value="7">
                      <div class="modal-footer centralFooter">
                        <button type="submit" class="btn btn-success btn-dreconstec">Guardar Retencion</button>
                      </div>
                    </form>


                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">
                    Anulaciones
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="idTogglable_3" role="tabpanel" aria-labelledby="idTogglable_3-tab">
                <div class="divPanelTogglable">
                  <div class="toggle_dentro_panel">
                    Notas de Credito
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="modal fade" id="myModalRegistroTransacciones" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <i class='fas fa-spinner fa-spin fa-2x'></i>
            </div>
            <div class="col-md-11">
              <h4 class="modal-title">Informe de Proceso</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <div id="dataPOSTransacciones"></div>
        </div>
        <div class="modal-footer centralFooter">
          <button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal" 
          id="idCerrarRegistroTransacciones">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>