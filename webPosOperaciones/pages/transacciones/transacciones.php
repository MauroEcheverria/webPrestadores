<?php 
  function transacciones($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/bootstrap-daterangepicker/daterangepicker.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/media/css/jquery.dataTables.min.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../dist/css/webPOSTransacciones.css'.$dataSesion["version_css_js"].'">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/moment/min/moment.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-daterangepicker/daterangepicker.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/media/js/jquery.dataTables.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js'.$dataSesion["version_css_js"].'"></script>';
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
            <span class="panel-title"><b>Administración de Transacciones</b></span>
          </div>
          <div class="card-body">

            <div class="row centrarContent">
              <div class="col-xs-6 col-md-6 btn-transaccion-panel">
                <div class="row">
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <button class="btn btn-success btn-transaccion" id="btnTransFacturacion">Facturación</button>
                  </div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <button class="btn btn-warning btn-transaccion" id="btnTransNotasCredito">Notas de Credito</button>
                  </div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <button class="btn btn-warning btn-transaccion" id="btnTransNotasDebito">Notas de Debito</button>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-md-6 btn-transaccion-panel">
                <div class="row">
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <button class="btn btn-warning btn-transaccion" id="btnTransGuiRemision">Guia de Remisión</button>
                  </div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <button class="btn btn-warning btn-transaccion" id="btnTransComprobanteRetencion">Comprobante de Retención</button>
                  </div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <button class="btn btn-warning btn-transaccion" id="btnTransEstadoTransaccion">Estado de Transacciones</button>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="tabContentTrans" id="transFacturacion">
              <form id="formPOSTransGenerarFactura" class="formModalPages" data-toggle="validator" role="form">
                <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                <div class="form-group">
                  <label for="cli_identificacion" class="control-label">Cédula</label>
                  <input type="text" class="form-control" id="cli_identificacion" name="cli_identificacion" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required value="1308041134">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="fop_id_forma_pago" class="control-label">Forma de Pago</label>
                  <select name="fop_id_forma_pago" id="fop_id_forma_pago" class="form-control" required>
                    <option value="">Selecione Establecimiento</option>
                    <option value="20" selected>OTROS CON UTILIZACIÓN DEL SISTEMA FINANCIERO</option>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="est_id_empresa_establecimiento" class="control-label">Establecimiento</label>
                  <select name="est_id_empresa_establecimiento" id="est_id_empresa_establecimiento" class="form-control" required>
                    <option value="">Selecione Establecimiento</option>
                    <option value="1" selected>Activo</option>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="epe_id_empresa_punto_emision" class="control-label">Punto Emisión</label>
                  <select name="epe_id_empresa_punto_emision" id="epe_id_empresa_punto_emision" class="form-control" required>
                    <option value="">Selecione Punto Emisión</option>
                    <option value="1" selected>Activo</option>
                  </select>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="modal-footer centralFooter">
                  <button type="submit" class="btn btn-success btn-dreconstec">Guardar Factura</button>
                </div>
              </form>
            </div>
            <div class="tabContentTrans solo_main" id="transNotasCredito">
              <form id="formPOSTransGenerarNotaCredito" class="formModalPages" data-toggle="validator" role="form">
                <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                <input type="hidden" name="tipoComprobante" value="4">
                  <button type="submit" class="btn btn-success btn-dreconstec">Guardar Nota Credito</button>
              </form>
            </div>
            <div class="tabContentTrans solo_main" id="transNotasDebito">
              <form id="formPOSTransGenerarNotaDebito" class="formModalPages" data-toggle="validator" role="form">
                <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                <input type="hidden" name="tipoComprobante" value="5">
                  <button type="submit" class="btn btn-success btn-dreconstec">Guardar Nota Debito</button>
              </form>
            </div>
            <div class="tabContentTrans solo_main" id="transGuiRemision">
              <form id="formPOSTransGenerarGuiaRemision" class="formModalPages" data-toggle="validator" role="form">
                <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                <input type="hidden" name="tipoComprobante" value="6">
                  <button type="submit" class="btn btn-success btn-dreconstec">Guardar Guia Remision</button>
              </form>
            </div>
            <div class="tabContentTrans solo_main" id="transComprobanteRetencion">
              <form id="formPOSTransGenerarRetencion" class="formModalPages" data-toggle="validator" role="form">
                <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                <input type="hidden" name="tipoComprobante" value="7">
                  <button type="submit" class="btn btn-success btn-dreconstec">Guardar Retencion</button>
              </form>
            </div>
            <div class="tabContentTrans solo_main" id="transEstadoTransaccion">
              <div class="container">
                <hr>
                <h3 class="centrarContent">Estado de Transacciones</h3>
                <form id="formIngEgrDesdeHastaSuministros" data-toggle="validator" role="form">
                  <div class="form-group">
                    <label>Rango de fecha y hora:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="trans_desde_hasta" name="trans_desde_hasta" required="">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group centrarContent">
                    <button type="submit" class="misBotones btn btn-primary">Consultar</button>
                  </div>
                </form>
                <div>
                  <table id="dtEstadoTransaccion" class="cell-border" cellspacing="0" width="100%"></table> 
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