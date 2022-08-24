<?php 
  function transacciones($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 

  $css_dreconstec = array();
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/bootstrap-daterangepicker/daterangepicker.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/media/css/jquery.dataTables.min.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/select2/dist/css/select2.min.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../dist/css/webPOSTransacciones.css'.$dataSesion["version_css_js"].'">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/moment/min/moment.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-daterangepicker/daterangepicker.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/media/js/jquery.dataTables.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/select2/dist/js/select2.full.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/facturacionElectronica/js/fiddle.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/facturacionElectronica/js/buffer.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/facturacionElectronica/js/forge.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/webPOSTransacciones.js'.$dataSesion["version_css_js"].'"></script>';

  template_head($pdo,$dataSesion,$css_dreconstec);
?>
  <div id="appTransaccionesFlag" class="appTransaccionesFlag"></div>
  <input type="hidden" name="csrf" id="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
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
                      <div><span class="labelIdentificacion">Usuario: </span><span class="dataIdentificacion">Mauro Echeverría</span></div>
                      <div><span class="labelIdentificacion">Establecimiento: </span><span class="dataIdentificacion">Esteros</span></div>
                      <div><span class="labelIdentificacion">Punto Emisión: </span><span class="dataIdentificacion">Caja 1</span></div>
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-info" id="btnPosNuevaFactura" title="Nueva factura"><i class="fas fa-plus"></i></button>
                      <button type="button" class="btn btn-danger" id="btnPosDesctarFactura" title="Descartar Factura"><i class="fas fa-trash"></i></button>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="cli_identificacion" class="control-label">Identificación</label> <a href="#" style="font-size: 10px;" id="idConsumidorFinal">(Consumidor Final)</a>
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control" id="cli_identificacion" name="cli_identificacion" onkeypress="return soloNumeros(event);" required disabled>
                          <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat" disabled id="btn_cli_identificacion"><i class="fas fa-search"></i></button>
                          </span>
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="ftr_id_forma_pago" class="control-label">Forma de Pago</label>
                        <select name="ftr_id_forma_pago" id="ftr_id_forma_pago" class="form-control" required disabled></select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="prs_id_prod_serv" class="control-label">Productos/Servicios</label>
                        <select name="prs_id_prod_serv" id="prs_id_prod_serv" class="form-control select2" required disabled>
                          <option value="">Seleccione Establecimiento</option>
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
                    <div class="solo_main" id="dataCliente">
                      <div class="row">
                        <div class="col-md-6">
                          <span class="labelIdentificacion">Identificación: </span>
                          <span class="dataIdentificacion" id="dataCliIdentificacion"></span>
                        </div>
                        <div class="col-md-6">
                          <span class="labelIdentificacion">Teléfono: </span><span class="dataIdentificacion" id="dataCliTelefono"></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <span class="labelIdentificacion">Nombres: </span><span class="dataIdentificacion" id="dataCliNombres"></span>
                        </div>
                        <div class="col-md-6">
                          <span class="labelIdentificacion">Correo: </span><span class="dataIdentificacion" id="dataCliCorreo"></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <span class="labelIdentificacion">Dirección: </span><span class="dataIdentificacion" id="dataCliDireccion"></span>
                        </div>
                        <div class="col-md-6">
                          <span class="labelIdentificacion">Placa: </span><span class="dataIdentificacion" id="dataCliPlaca"></span>
                        </div>
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
                      <th scope="col">Código</th>
                      <th scope="col">Descripción</th>
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
  <div class="modal fade" id="myModalClienteNoRegistrado" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
        <form id="formClienteNoRegistrado" class="formModalPages" data-toggle="validator" role="form">
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
                  <label for="cli_identificacion" class="control-label">Cédula</label>
                  <input type="text" class="form-control" id="cli_identificacion" name="cli_identificacion" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="cli_nombre_1" class="control-label">Primer Nombre</label>
                  <input type="text" class="form-control" id="cli_nombre_1" name="cli_nombre_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="cli_apellido_1" class="control-label">Primer Apellido</label>
                  <input type="text" class="form-control" id="cli_apellido_1" name="cli_apellido_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="cli_direccion" class="control-label">Dirección</label>
                  <select name="cli_direccion" id="cli_direccion" class="form-control" required style="width: 100%;"></select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cli_correo" class="control-label">Correo</label>
                  <input type="email" class="form-control" id="cli_correo" name="cli_correo" maxlength="60" 
                  data-error="Formato de Correo inválido." required oninput="this.value = this.value.toLowerCase()" minlength="6">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="cli_nombre_2" class="control-label">Segundo Nombre</label>
                  <input type="text" class="form-control" id="cli_nombre_2" name="cli_nombre_2" maxlength="15" minlength="2" required oninput="this.value = this.value.toUpperCase()">
                   <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="cli_apellido_2" class="control-label">Segundo Apellido</label>
                  <input type="text" class="form-control" id="cli_apellido_2" name="cli_apellido_2" maxlength="15" oninput="this.value = this.value.toUpperCase()">
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                  <label for="cli_telefono" class="control-label">Convencional/Celular</label>
                  <select name="cli_telefono" id="cli_telefono" class="form-control" required style="width: 100%;"></select>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer centralFooter">
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