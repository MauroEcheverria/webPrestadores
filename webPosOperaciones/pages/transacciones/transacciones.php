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
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/toastr-master/build/toastr.min.css'.$dataSesion["version_css_js"].'">';
  $css_dreconstec[] = '<link rel="stylesheet" href="../../../dist/css/webPOSTransacciones.css'.$dataSesion["version_css_js"].'">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/moment/min/moment.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-daterangepicker/daterangepicker.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/media/js/jquery.dataTables.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/select2/dist/js/select2.full.min.js'.$dataSesion["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../plugins/toastr-master/build/toastr.min.js'.$dataSesion["version_css_js"].'"></script>';
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
                  <div class="col-md-4 centrarContent">
                    <button type="button" class="btn btn-info" id="btnPosNuevaFactura" title="Nuevo Comprobante"><i class="fas fa-plus"></i></button>    
                  </div>
                </div>

                <div id="transPanel_1" class="solo_main">
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="cli_identificacion" class="control-label">Identificación</label> <a href="#" style="font-size: 10px;" id="idConsumidorFinal">(Consumidor Final)</a>
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control" id="cli_identificacion" name="cli_identificacion" required disabled style="font-size: 15px !important;">
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
                  <hr>
                  <div class="centrarContent"><strong>Ingreso de Ítems</strong></div>
                  <form id="formItemComprobante" class="formModalPages" data-toggle="validator" role="form">
                    <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
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
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group centrarContent">
                          <label for="fdt_cantidad" class="control-label">Cantidad</label>
                          <input type="number" class="form-control" id="fdt_cantidad" name="fdt_cantidad" onkeypress="return soloNumeros(event);" 
                          required style="font-size: 30px !important;">
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <button type="submit" class="btn btn-success btn-dreconstec btnItemComprobante">Añadir <br><i class="fas fa-cart-plus"></i></button>
                        </div>
                      </div>
                    </div> 
                  </form>
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
                    <div class="solo_main" id="transPanel_2">
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
                        <span class="info-box-text text-center text-muted posTotalLabel">Total</span>
                        <span class="info-box-number text-center text-muted mb-0 posTotalCant">
                        $ <span id="pos_total_comprobante_1">0,00</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="transPanel_3" class="solo_main">
                  <button type="button" class="btn btn-danger btn_descartar_item" id="btnPosDescartarItems" title="Descartar Factura"><i class="fas fa-trash"></i> Descartar Ítems</button>
                  <div id="idTablaProductoServicio"></div>
                  <div style="text-align: right;">
                    <div>
                      <span class="detalle_numerico_1">Base imponible <span id="pos_porcentaje_iva"></span>%: </span><span class="detalle_numerico_2" id="pos_base_imp_diff">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">Base imponible 0%: </span><span class="detalle_numerico_2" id="pos_base_imp_iva_0">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">Base imponible no sujeto IVA: </span><span class="detalle_numerico_2" id="pos_base_imp_iva_no_sujeto">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">Base imponible excento IVA: </span><span class="detalle_numerico_2" id="pos_base_imp_iva_exento">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">Descuento: </span><span class="detalle_numerico_2" id="pos_total_descuento">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">Subtotal: </span><span class="detalle_numerico_2" id="pos_total_sub_total">0.00</span>
                    </div>  
                    <div>
                      <span class="detalle_numerico_1">IVA: </span><span class="detalle_numerico_2" id="pos_total_iva">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">ICE: </span><span class="detalle_numerico_2" id="pos_total_ice">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">IRBPNR: </span><span class="detalle_numerico_2" id="pos_total_irbpnr">0.00</span>
                    </div>
                    <div>
                      <span class="detalle_numerico_1">Valor Total: </span><span class="detalle_numerico_2" id="pos_total_comprobante_2">0.00</span>
                    </div>
                  </div>
                  <div class="modal-footer centralFooter">
                    <form id="formPOSTransGenerarFactura" class="formModalPages" data-toggle="validator" role="form">
                      <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                      <button type="submit" class="btn btn-success btn-dreconstec">Enviar Pago</button>
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
  <div class="modal fade" id="myModalRegistroTransacciones" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
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
  <div class="modal fade" id="myConfirmarClienteNoRegistrado" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="false">X</span>
        </button>
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11" style="width: 430px;">
            <h4 class="modal-title" id="myModalLabel">Información</h4>
          </div>
        </div>
      </div>
      <div class="modal-body"><strong>Cliente NO registrado, desea registrarlo?</strong></div>
      <div class="modal-footer centralFooter">
        <button type="button" class="btn btn-warning" id="btnNoRegistrarClienteNoRegistrado"><stron>No</stron></button>
        <button type="button" class="btn btn-warning" id="btnConfirmarClienteNoRegistrado"><stron>Si</stron></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myConfirmarDescartarItems" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="false">X</span>
        </button>
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11" style="width: 430px;">
            <h4 class="modal-title" id="myModalLabel">Información</h4>
          </div>
        </div>
      </div>
      <div class="modal-body"><strong>Esta seguro que desea descartar todos los ítems ingresados?</strong></div>
      <div class="modal-footer centralFooter">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><stron>No</stron></button>
        <button type="button" class="btn btn-warning" id="btnConfirmarDescartarItems"><stron>Si</stron></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalClienteNoRegistrado" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-1">
            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
          </div>
          <div class="col-md-11">
            <h4 class="modal-title">Registro de nuevo cliente</h4>
          </div>
        </div>
      </div>
      <form id="formClienteNoRegistrado" class="formModalPages" data-toggle="validator" role="form">
        <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
        <div class="modal-body">
          <div class="alert alert-danger poppupAlert" role="alert" id="loginCorreoRegistrado">
            El correo electrónico ingresado ya se encuentra registrado en nuestro sistema.
          </div>
          <div class="alert alert-danger poppupAlert" role="alert" id="loginUsuarioRegistrado">
            La identificación ingresada ya se encuentra registrado en nuestro sistema.
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="cli_tipo_identificacion" class="control-label">Tipo identificación</label>
                <select name="cli_tipo_identificacion" id="cli_tipo_identificacion" class="form-control" required style="width: 100%;"></select>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_identificacion_form" class="control-label">Identificación</label>
                <input type="text" class="form-control" id="cli_identificacion_form" name="cli_identificacion_form" onkeypress="return soloNumeros(event);" required minlength="8" maxlength="13">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_nombre_1" class="control-label">Primer Nombre</label>
                <input type="text" class="form-control" id="cli_nombre_1" name="cli_nombre_1" maxlength="10" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                 <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_apellido_1" class="control-label">Primer Apellido</label>
                <input type="text" class="form-control" id="cli_apellido_1" name="cli_apellido_1" maxlength="10" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_correo" class="control-label">Correo</label>
                <input type="email" class="form-control" id="cli_correo" name="cli_correo" maxlength="50" data-error="Formato de Correo inválido." required oninput="this.value = this.value.toLowerCase()" minlength="6">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cli_direccion" class="control-label">Dirección</label>
                <input type="text" class="form-control" id="cli_direccion" name="cli_direccion" maxlength="150" minlength="2" oninput="this.value = this.value.toUpperCase()">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_nombre_2" class="control-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="cli_nombre_2" name="cli_nombre_2" maxlength="10" minlength="2" oninput="this.value = this.value.toUpperCase()">
                 <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_apellido_2" class="control-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="cli_apellido_2" name="cli_apellido_2" maxlength="10" oninput="this.value = this.value.toUpperCase()">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_telefono" class="control-label">Convencional/Celular</label>
                <input type="text" class="form-control" id="cli_telefono" name="cli_telefono" maxlength="10" minlength="8" onkeypress="return soloNumeros(event);">
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label for="cli_placa" class="control-label">Número de Placa</label>
                <input type="text" class="form-control" id="cli_placa" name="cli_placa" maxlength="8" minlength="6" oninput="this.value = this.value.toUpperCase()">
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