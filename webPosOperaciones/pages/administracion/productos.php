
<div class="seccionBtnAccion">
    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevoProducto">Crear</button>
    <?php 
    $isSuAdmin = (isset($dataSesion["id_role"]) && $dataSesion["id_role"] == 1);
    if ($isSuAdmin) {
    ?>
        <br><br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filtros de Búsqueda</h3>
            </div>

            <div class="card-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="slcEmpresaF " class="control-label">Empresa</label>
                        <select name="slcEmpresaF" id="slcEmpresaF" class="form-control empCamposNoEditables slcEmpresa"></select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                

            </div>
        </div>
    <?php } ?>
    
    

    
</div>
<table id="dtProductos" class="cell-border" cellspacing="0" width="100%"></table>

<div class="modal fade" id="myModalProductos" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modalLogin">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-1">
                        <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
                    </div>
                    <div class="col-md-11">
                        <h4 class="modal-title">Gestión de Productos</h4>
                    </div>
                </div>
            </div>
            <form id="frmProductos" class="formModalPages" data-toggle="validator" role="form" utocomplete="false" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                <input type="hidden" name="tipo_form_prod" id="tipo_form_prod">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slcEmpresaP " class="control-label">Empresa</label>
                                <select name="slcEmpresaP" id="slcEmpresaP" class="form-control empCamposNoEditables slcEmpresa" required></select>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="pCodigoItem" class="control-label">Código item</label>
                                <input type="text" class="form-control" id="pCodigoItem" name="pCodigoItem" maxlength="5" minlength="1" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="pCodigoAuxiliar" class="control-label">Código auxiliar</label>
                                    <input type="text" class="form-control" id="pCodigoAuxiliar" name="pCodigoAuxiliar" maxlength="5" minlength="1" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="pDescripcion" class="control-label">Descripcion</label>
                                <input type="text" class="form-control" id="pDescripcion" name="pDescripcion" maxlength="200" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group camposVisibles">
                                <label for="slcEstadoP" class="control-label">Estado</label>
                                <select name="slcEstadoP" id="slcEstadoP" class="form-control camposVisibles" required>
                                    <option value="">Selecione una opción</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>


                        </div>

                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="pPrecioUnitario" class="control-label">Precio Unitario</label>
                                <input type="text" class="form-control" id="pPrecioUnitario" name="pPrecioUnitario" maxlength="60" onkeypress="return NumCheck(event, this)">
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="slcIva" class="control-label">IVA  - Impuesto al Valor Agregado</label>
                                <select name="slcIva" id="slcIva" class="form-control empCamposNoEditables"></select>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="slcIce" class="control-label">ICE - Impuesto a Consumos Especiales</label>
                                <select name="slcIce" id="slcIce" class="form-control empCamposNoEditables"></select>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="slcIbr" class="control-label">IRBPNR - Impuesto Redimible Botellas Plásticas no Retornables</label>
                                <select name="slcIbr" id="slcIbr" class="form-control empCamposNoEditables"></select>
                                <div class="help-block with-errors"></div>
                            </div>

<!--                            <div class="form-group">
                                <label for="slcImpuesto " class="control-label">Impuesto</label>
                                <select name="slcImpuesto" id="slcImpuesto" class="form-control empCamposNoEditables"></select>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                             <div class="form-group">
                                <label for="slcTarifaImpuesto " class="control-label">Tarifa Impuesto</label>
                                <select name="slcTarifaImpuesto" id="slcTarifaImpuesto" class="form-control empCamposNoEditables"></select>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <button type="button" class="btn btn-block btn-outline-success" onclick="agregarImpuesto();" id="btnPrdAgregarImpuesto">Agregar Impuesto</button>
                            
                                        <table id="dtImpuestos" class="display" style="width:100%;">
                                        </table>-->

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