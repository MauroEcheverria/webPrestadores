

<div class="modal fade" id="myModalPuntoEmision" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modalLogin">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
                        </div>
                        <div class="col-md-11">
                            <h4 class="modal-title">Gestión Puntos de Emisión</h4>
                        </div>
                    </div>
                </div>
                <form id="frmPuntoEmision" class="formModalPages" data-toggle="validator" role="form" utocomplete="false" enctype="multipart/form-data">
                    <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                    <input type="hidden" name="tipo_form_pe" id="tipo_form_pe">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="peCodigo" class="control-label">Código</label>
                                    <input type="text" class="form-control" id="peCodigo" name="peCodigo" maxlength="60" minlength="1" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="peDescripcion" class="control-label">Nombre</label>
                                    <input type="text" class="form-control" id="peDescripcion" name="peDescripcion" maxlength="300" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group camposVisibles">
                                    <label for="slcEstadoPe" class="control-label">Estado</label>
                                    <select name="slcEstadoPe" id="slcEstadoPe" class="form-control camposVisibles" required>
                                      <option value="">Selecione una opción</option>
                                      <option value="1">Activo</option>
                                      <option value="0">Inactivo</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                  </div>


                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slcEmpresaPe " class="control-label">Empresa</label>
                                    <select name="slcEmpresaPe" id="slcEmpresaPe" class="form-control empCamposNoEditables" required></select>
                                    <div class="help-block with-errors"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="slcEstablecimiento " class="control-label">Establecimiento</label>
                                    <select name="slcEstablecimiento" id="slcEstablecimiento" class="form-control empCamposNoEditables" required></select>
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