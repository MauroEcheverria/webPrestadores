<div class="seccionBtnAccion">
    <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaVinculacion">Crear</button>
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
                        <label for="slcEmpresaFVinc " class="control-label">Empresa</label>
                        <select name="slcEmpresaFVinc" id="slcEmpresaFVinc" class="form-control empCamposNoEditables slcEmpresa"></select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                

            </div>
        </div>
    <?php } ?>
</div>

<table id="dtVinculaciones" class="cell-border" cellspacing="0" width="100%"></table>

<div class="modal fade" id="myModalVinculacion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modalLogin">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-1">
                        <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
                    </div>
                    <div class="col-md-11">
                        <h4 class="modal-title">Vinculación de Usuarios</h4>
                    </div>
                </div>
            </div>
            <form id="frmVinculacion" class="formModalPages" data-toggle="validator" role="form" utocomplete="false" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                <input type="hidden" name="tipo_form_vinc" id="tipo_form_vinc">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slcEmpresaP " class="control-label">Empresa</label>
                                <select name="slcEmpresaP" id="slcEmpresaP" class="form-control empCamposNoEditables slcEmpresa" required></select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group camposVisibles">
                                <label for="slcEstadoUsrVinc" class="control-label">Estado</label>
                                <select name="slcEstadoUsrVinc" id="slcEstadoUsrVinc" class="form-control camposVisibles" required>
                                    <option value="">Selecione una opción</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slcUsuariosVinc" class="control-label">Usuarios</label>
                                <select name="slcUsuariosVinc" id="slcUsuariosVinc" class="form-control empCamposNoEditables slcEmpresa" required></select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="slcEstablecimientoVinc " class="control-label">Establecimiento</label>
                                    <select name="slcEstablecimientoVinc" id="slcEstablecimientoVinc" class="form-control empCamposNoEditables" required></select>
                                    <div class="help-block with-errors"></div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="slcPtoEmisionVinc " class="control-label">Punto Emision</label>
                                    <select name="slcPtoEmisionVinc" id="slcPtoEmisionVinc" class="form-control empCamposNoEditables" required></select>
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
