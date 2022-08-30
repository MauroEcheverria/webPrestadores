<?php

function administracion($pdo, $dataSesion) {
    include("../../../template/templateHead.php");
    include("../../../template/templateFooter.php");
    include("../../../dialogs/modalViews.php");

    $css_dreconstec = array();
    $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/media/css/jquery.dataTables.min.css' . $dataSesion["version_css_js"] . '" rel="stylesheet">';
    $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css' . $dataSesion["version_css_js"] . '" rel="stylesheet">';
    $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' . $dataSesion["version_css_js"] . '">';

    $js_dreconstec = array();
    $js_dreconstec[] = '<script src="../../../plugins/DataTables/media/js/jquery.dataTables.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../dist/js/webPOSAdministracion.js' . $dataSesion["version_css_js"] . '"></script>';

    template_head($pdo, $dataSesion, $css_dreconstec);
    ?>
    <div id="appAdministrarEstablecimiento" class="appAdministrarEstablecimiento"></div>
    <div class="content-wrapper">
        <section class="content">
            <div class="container container_main">
                <div class="card">
                    <div class="card-header">
                        <span class="panel-title"><b>Administración</b></span>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="idTogglable_1-tab" data-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="false">Establecimientos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="idTogglable_2-tab" data-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="false">Puntos de Emisión</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
                                <div class="divPanelTogglable">
                                    <div class="toggle_dentro_panel">
                                        <div class="seccionBtnAccion">
                                            <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevoEstablecimiento">Crear</button>
                                        </div>
                                        <table id="dtSistemaEstablecimiento" class="cell-border" cellspacing="0" width="100%"></table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
                                <div class="divPanelTogglable">
                                    <div class="toggle_dentro_panel">
                                        <div class="seccionBtnAccion">
                                            <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevoPtoEmision">Crear</button>
                                        </div>
                                        <table id="dtSistemaAplicacion" class="cell-border" cellspacing="0" width="100%"></table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="myModalEstablecimiento" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modalLogin">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">
                        </div>
                        <div class="col-md-11">
                            <h4 class="modal-title">Gestión de Establecimientos</h4>
                        </div>
                    </div>
                </div>
                <form id="formEstablecimiento" class="formModalPages" data-toggle="validator" role="form" utocomplete="false" enctype="multipart/form-data">
                    <input type="hidden" name="csrf" value="<?php echo $dataSesion["token_csrf"]; ?>">
                    <input type="hidden" name="tipo_form_est" id="tipo_form_est">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estCodigo" class="control-label">Código</label>
                                    <input type="text" class="form-control" id="estCodigo" name="estCodigo" maxlength="60" minlength="1" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="estNombre" class="control-label">Nombre</label>
                                    <input type="text" class="form-control" id="estNombre" name="estNombre" maxlength="300" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="slcEstado" class="control-label">Estado</label>
                                    <select name="slcEstado" id="slcEstado" class="form-control" required>
                                      <option value="">Selecione una opción</option>
                                      <option value="1">Activo</option>
                                      <option value="0">Inactivo</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                  </div>


                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slcEmpresa " class="control-label">Empresa</label>
                                    <select name="slcEmpresa" id="slcEmpresa" class="form-control empCamposNoEditables" required></select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label for="estDireccion" class="control-label">Dirección</label>
                                    <input type="text" class="form-control" id="estDireccion" name="estDireccion" maxlength="300" minlength="3" oninput="this.value = this.value.toUpperCase()">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="chkMatriz" value="1">
                                        <label for="chkMatriz" class="custom-control-label">Es Matríz</label>
                                    </div>
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
    template_footer($pdo, $dataSesion, $js_dreconstec);
}
?>