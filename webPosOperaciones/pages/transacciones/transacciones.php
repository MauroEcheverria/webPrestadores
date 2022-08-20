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
  <div id="appTransaccionesFlag" class="appTransaccionesFlag"></div>
  <div class="content-wrapper">
    <section class="content">
      <div class="container container_main container_transaccion">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <span class="panel-title"><b>Datos de Comprobante</b></span>
              </div>
              <div class="card-body">

                  <div class="row">
                    <div class="col-md-8">
                      <div><span style="color: #6c757d; font-size: 18px;">Usuario: </span><span>Mauro Echeverria</span></div>
                      <div><span style="color: #6c757d; font-size: 18px;">Establecimiento: </span><span>Esteros</span></div>
                      <div><span style="color: #6c757d; font-size: 18px;">Punto Emision: </span><span>Caja 1</span></div>
                    </div>
                    <div class="col-md-4">
                      <a class="btn btn-app">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                    </div>
                  </div>
                  <br>


                  



                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="cli_identificacion" class="control-label">Cédula</label>
                        <input type="text" class="form-control" id="cli_identificacion" name="cli_identificacion" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required value="1308041134">
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="fop_id_forma_pago" class="control-label">Forma de Pago</label>
                        <select name="fop_id_forma_pago" id="fop_id_forma_pago" class="form-control" required>
                          <option value="">Selecione Establecimiento</option>
                          <option value="20" selected>OTROS CON UTILIZACIÓN DEL SISTEMA FINANCIERO</option>
                        </select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="est_id_empresa_establecimiento" class="control-label">Productos/Servicios</label>
                        <select name="est_id_empresa_establecimiento" id="est_id_empresa_establecimiento" class="form-control" required>
                          <option value="">Selecione Establecimiento</option>
                          <option value="1" selected>Activo</option>
                        </select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
  
                  </div>
                  
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <span class="panel-title"><b>Detalle de Comprobante</b></span>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9">
                    <div class="row">
                      <div class="col-md-6">
                        <span style="color: #6c757d; font-size: 21px;">Cliente: </span><span>Mauro Echeverria</span>
                      </div>
                      <div class="col-md-6">
                        <span style="color: #6c757d; font-size: 21px;">Telefono: </span><span>0960939030</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <span style="color: #6c757d; font-size: 21px;">Direccion: </span><span>Los Esteros</span>
                      </div>
                      <div class="col-md-6">
                        <span style="color: #6c757d; font-size: 21px;">Correo: </span><span>algld@dfdf.vom</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">

                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted" style="font-size: 23px;">Total</span>
                        <span class="info-box-number text-center text-muted mb-0" style="font-size: 30px; margin-top: -20px;">$ 1.999,99</span>
                      </div>
                    </div>

                  </div>
                </div>
                <br>
                <table class="table table-striped">
                  <thead>
                    <tr class="centrarContent">
                      <th scope="col">Códico Item</th>
                      <th scope="col">Decripcion</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Precio Unitario</th>
                      <th scope="col">Sub Total</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="centrarContent">C2015</td>
                      <td>Rinnes 3 1/2</td>
                      <td class="centrarContent">2</td>
                      <td class="derechaContent">1.23</td>
                      <td class="derechaContent">3.69</td>
                      <td class="centrarContent">
                        <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="centrarContent">C2015</td>
                      <td>Rinnes 3 1/2</td>
                      <td class="centrarContent">2</td>
                      <td class="derechaContent">1.23</td>
                      <td class="derechaContent">3.69</td>
                      <td class="centrarContent">
                        <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div style="text-align: right;">
                  <div style="margin: 10px 135px 20px 500px;">
                    <div>
                      <span style="color: #6c757d; font-size: 21px;">Base Imponible 0: </span><span>$ 15362.00</span>
                    </div>
                    <div>
                      <span style="color: #6c757d; font-size: 21px;">Base Imponible 12%: </span><span>$ 15362.00</span>
                    </div>
                    <div>
                      <span style="color: #6c757d; font-size: 21px;">IVA: </span><span>$ 15362.00</span>
                    </div>
                    <div>
                      <span style="color: #6c757d; font-size: 21px;">ICE: </span><span>$ 15362.00</span>
                    </div>
                    <div>
                      <span style="color: #6c757d; font-size: 21px;">TOTAL: </span><span>$ 15362.00</span>
                    </div>
                  </div>
                </div>

                <div class="modal-footer centralFooter">
                  <button type="submit" class="btn btn-block bg-gradient-success btn-lg" style="width: 200PX;">Enviar Pago</button>
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