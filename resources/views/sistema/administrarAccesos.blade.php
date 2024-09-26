@extends('adminlte::page')

@section('title', 'Administración de Usuarios')

@section('content_header') &nbsp; @stop

@section('content')
    <div id="appAdministrarSistema" class="appAdministrarSistema"></div>
    <input type="hidden" value="{{ asset('vendor/datatables/spanish.json') }}" id="oLanguageDataTable" class="dct_main">
    <div class="container">
        <div class="card">
            <div class="card-header">
            <span class="panel-title"><b>Administración de Accesos</b></span>
            </div>
            <div class="card-body">
            <ul class="nav nav-tabs dct_pestanas" role="tablist">
                <li class="nav-item" role="presentation">
                <a class="nav-link active" id="idTogglable_1-tab" data-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="false">Empresas</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_2-tab" data-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="false">Aplicaciones</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_3-tab" data-toggle="tab" href="#idTogglable_3" role="tab" aria-controls="idTogglable_3" aria-selected="false">Opciones</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_4-tab" data-toggle="tab" href="#idTogglable_4" role="tab" aria-controls="idTogglable_4" aria-selected="true">Roles</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_5-tab" data-toggle="tab" href="#idTogglable_5" role="tab" aria-controls="idTogglable_5" aria-selected="true">Empresa - Aplicativo</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_6-tab" data-toggle="tab" href="#idTogglable_6" role="tab" aria-controls="idTogglable_6" aria-selected="true">Rol - Aplicativo</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="idTogglable_7-tab" data-toggle="tab" href="#idTogglable_7" role="tab" aria-controls="idTogglable_7" aria-selected="true">Rol - Opción</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
                <div class="divPanelTogglable">
                    <div class="toggle_dentro_panel">
                    <div class="seccionDtBtnAccion">
                        <button type="button" class="btn btn-success btn-dreconstec dct_main" id="btnNuevaSistemaEmpresa">Crear</button>
                    </div>
                    <input type="hidden" value="{{ route('administrarAccesos.proceso_1') }}" id="getDataTableSistemaEmpresa" class="dct_main">
                    <table id="dtSistemaEmpresa" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
                <div class="divPanelTogglable">
                    <div class="toggle_dentro_panel">
                        <input type="hidden" value="{{ route('administrarAccesos.proceso_2') }}" id="getDataTableSistemaAplicacion" class="dct_main">
                        <table id="dtSistemaAplicacion" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="idTogglable_3" role="tabpanel" aria-labelledby="idTogglable_3-tab">
                <div class="divPanelTogglable">
                    <div class="toggle_dentro_panel">
                        <input type="hidden" value="{{ route('administrarAccesos.proceso_3') }}" id="getDataTableSistemaOpcion" class="dct_main">
                        <table id="dtSistemaOpcion" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="idTogglable_4" role="tabpanel" aria-labelledby="idTogglable_4-tab">
                <div class="divPanelTogglable">
                    <div class="toggle_dentro_panel">
                        <div class="seccionDtBtnAccion">
                            <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRol">Crear</button>
                        </div>
                        <input type="hidden" value="{{ route('administrarAccesos.proceso_4') }}" id="getDataTableSistemaRol" class="dct_main">
                        <table id="dtSistemaRol" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="idTogglable_5" role="tabpanel" aria-labelledby="idTogglable_5-tab">
                <div class="divPanelTogglable">
                    <div class="toggle_dentro_panel">
                        <div class="seccionDtBtnAccion">
                            <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaEmpresaAplicativo">Crear</button>
                        </div>
                        <input type="hidden" value="{{ route('administrarAccesos.proceso_5') }}" id="getDataTableSistemaEmpresaAplicativo" class="dct_main">
                        <table id="dtSistemaEmpresaAplicativo" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="idTogglable_6" role="tabpanel" aria-labelledby="idTogglable_6-tab">
                <div class="divPanelTogglable">
                    <div class="toggle_dentro_panel">
                        <div class="seccionDtBtnAccion">
                            <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRolAplicativo">Crear</button>
                        </div>
                        <input type="hidden" value="{{ route('administrarAccesos.proceso_6') }}" id="getDataTableSistemaRolAplicativo" class="dct_main">
                        <table id="dtSistemaRolAplicativo" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                </div>
                <div class="tab-pane fade" id="idTogglable_7" role="tabpanel" aria-labelledby="idTogglable_7-tab">
                <div class="divPanelTogglable">
                    <div class="toggle_dentro_panel">
                        <div class="seccionDtBtnAccion">
                            <button type="button" class="btn btn-success btn-dreconstec" id="btnNuevaSistemaRolOpcion">Crear</button>
                        </div>
                        <input type="hidden" value="{{ route('administrarAccesos.proceso_7') }}" id="getDataTableSistemaRolOpcion" class="dct_main">
                        <table id="dtSistemaRolOpcion" class="cell-border" cellspacing="0" width="100%"></table>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ route('administrarAccesos.proceso_8') }}" id="getDataSelect" class="dct_main">
    <div class="modal fade" id="myModalSistemaEmpresa" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modalLogin">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                <div class="col-md-1">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
                </div>
                <div class="col-md-11">
                    <h4 class="modal-title">Gestión de Empresa</h4>
                </div>
                </div>
            </div>
            <form data-action="{{route('administrarAccesos.proceso_18')}}" method="POST" id="formSistemaEmpresa" class="formModalPages" data-toggle="validator" role="form" novalidate enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipo_form_sist_empre" id="tipo_form_sist_empre">
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="emp_ruc" class="control-label">RUC</label>
                        <input type="text" class="form-control" id="emp_ruc" name="emp_ruc" maxlength="13" minlength="13" onkeypress="return soloNumeros(event);" required>
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="emp_empresa" class="control-label">Nombres/Razón Social</label>
                        <input type="text" class="form-control" id="emp_empresa" name="emp_empresa" maxlength="300" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="emp_nom_comercial" class="control-label">Nombre Comercial</label>
                        <input type="text" class="form-control" id="emp_nom_comercial" name="emp_nom_comercial" maxlength="300" minlength="3" oninput="this.value = this.value.toUpperCase()">
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                        <div class="form-group">
                            <label for="emp_contrib_especial" class="control-label">Contribuyente Especial</label>
                            <select name="emp_contrib_especial" id="emp_contrib_especial" class="form-control" required>
                            <option value="">Selecione una opción</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                            </select>
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                    
                    <div class="form-group">
                            <label for="emp_direccion_matriz" class="control-label">Dirección Matriz</label>
                            <input type="text" class="form-control" id="emp_direccion_matriz" name="emp_direccion_matriz" required maxlength="300" minlength="3" oninput="this.value = this.value.toUpperCase()">
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        
                        <div class="form-group">
                            <label for="ser_factura_serie" class="control-label">Serial Factura</label>
                            <input type="text" class="form-control empCamposNoEditables" id="ser_factura_serie" name="ser_factura_serie" maxlength="11" minlength="1"  onkeypress="return soloNumeros(event);" required>
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                            <div class="form-group">
                            <label for="ser_nota_credito_serie" class="control-label">Serial Nota Crédito</label>
                            <input type="text" class="form-control empCamposNoEditables" id="ser_nota_credito_serie" name="ser_nota_credito_serie" maxlength="11" minlength="1"  onkeypress="return soloNumeros(event);" required>
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ser_guia_remision_serie" class="control-label">Serial Guía Remisión</label>
                            <input type="text" class="form-control empCamposNoEditables" id="ser_guia_remision_serie" name="ser_guia_remision_serie" maxlength="11" minlength="1"  onkeypress="return soloNumeros(event);" required>
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ser_nota_debito_serie" class="control-label">Serial Nota Débito</label>
                            <input type="text" class="form-control empCamposNoEditables" id="ser_nota_debito_serie" name="ser_nota_debito_serie" maxlength="11" minlength="1"  onkeypress="return soloNumeros(event);" required>
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ser_comp_ret_serie" class="control-label">Serial Comprobante Retención</label>
                            <input type="text" class="form-control empCamposNoEditables" id="ser_comp_ret_serie" name="ser_comp_ret_serie" maxlength="11" minlength="1"  onkeypress="return soloNumeros(event);" required>
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="emp_obli_contabilidad" class="control-label">Obligado a llevar contabilidad</label>
                            <select name="emp_obli_contabilidad" id="emp_obli_contabilidad" class="form-control" required>
                            <option value="">Selecione una opción</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                            </select>
                            <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="contspan">Logo Empresa: </span>
                            <p>Consideraciones para carga de archivo: </p>
                            <div>
                            <ul>
                                <li> Solo formato <code>.jpg</code> o <code>.png</code></li>
                                <li> Tamaño máximo del archivo: 1MB</li>
                            </ul>
                            </div>
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="em_logo_empresa" name="em_logo_empresa" required="true">
                            <label class="custom-file-label form-control-file" for="em_logo_empresa">Seleccionar Archivo</label>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="em_tipo_ambiente" class="control-label">Tipo Ambiente</label>
                        <select name="em_tipo_ambiente" id="em_tipo_ambiente" class="form-control" required>
                        <option value="">Selecione una opción</option>
                        <option value="1" selected="">PRUEBAS</option>
                        <option value="2">PRODUCCION</option>
                        </select>
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="ctg_id_catalogo" class="control-label">Tipo Plan</label>
                        <select name="ctg_id_catalogo" id="ctg_id_catalogo" class="form-control" required></select>
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="emp_estado" class="control-label">Estado</label>
                        <select name="emp_estado" id="emp_estado" class="form-control" required>
                        <option value="">Selecione una opción</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                        </select>
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                        <div class="form-group">
                        <label for="emp_vigencia_desde" class="control-label">Vigencia Desde</label>
                        <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-calendar-alt"></i></span>
                        <input type="text" class="form-control pull-right" id="emp_vigencia_desde" name="emp_vigencia_desde" required>
                        </div>
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="emp_vigencia_hasta" class="control-label">Vigencia Hasta</label>
                        <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-calendar-alt"></i></span>
                        <input type="text" class="form-control pull-right" id="emp_vigencia_hasta" name="emp_vigencia_hasta" required>
                        </div>
                        <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer centralFooter">
                <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalSistemaRol" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                <div class="col-md-1">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
                </div>
                <div class="col-md-11">
                    <h4 class="modal-title">Gestión de Roles</h4>
                </div>
                </div>
            </div>
            <form data-action="{{route('administrarAccesos.proceso_15')}}" method="POST" id="formSistemaRol" class="formModalPages" data-toggle="validator" role="form" novalidate>
                @csrf
                <input type="hidden" name="tipo_form_sist_rol" id="tipo_form_sist_rol">
                <div class="modal-body">
                <div class="form-group">
                    <label for="rol_rol" class="control-label">Rol</label>
                    <input type="text" class="form-control" id="rol_rol" name="rol_rol" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()" require>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="rol_estado" class="control-label">Estado</label>
                    <select name="rol_estado" id="rol_estado" class="form-control" required>
                    <option value="">Selecione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                </div>
                <div class="modal-footer centralFooter">
                <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalSistemaEmpresaAplicativo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                <div class="col-md-1">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
                </div>
                <div class="col-md-11">
                    <h4 class="modal-title">Gestión de Empresa Aplicativo</h4>
                </div>
                </div>
            </div>
            <input type="hidden" value="{{ route('administrarAccesos.proceso_13') }}" id="cargaSistemaEmpresaAplicativo" class="dct_main">
            <form data-action="{{route('administrarAccesos.proceso_14')}}" method="POST" id="formSistemaEmpresaAplicativo" class="formModalPages" data-toggle="validator" role="form" novalidate>
                @csrf
                <input type="hidden" name="tipo_form_sist_emp_apl" id="tipo_form_sist_emp_apl">
                <div class="modal-body">
                <div class="form-group">
                    <label for="emp_empresa_1" class="control-label">Empresa</label>
                    <select name="emp_empresa_1" id="emp_empresa_1" class="form-control" required></select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="apl_aplicacion_1" class="control-label">Aplicación</label>
                    <select name="apl_aplicacion_1" id="apl_aplicacion_1" class="form-control" required></select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="ape_estado" class="control-label">Estado</label>
                    <select name="ape_estado" id="ape_estado" class="form-control" required>
                    <option value="">Selecione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                </div>
                <div class="modal-footer centralFooter">
                <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalSistemaRolAplicativo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                <div class="col-md-1">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
                </div>
                <div class="col-md-11">
                    <h4 class="modal-title">Gestión de Rol Aplicativo</h4>
                </div>
                </div>
            </div>
            <input type="hidden" value="{{ route('administrarAccesos.proceso_11') }}" id="cargaSistemaRolAplicativo" class="dct_main">
            <form data-action="{{route('administrarAccesos.proceso_12')}}" method="POST" id="formSistemaRolAplicativo" class="formModalPages" data-toggle="validator" role="form" novalidate>
                @csrf
                <input type="hidden" name="tipo_form_sist_rol_apl" id="tipo_form_sist_rol_apl">
                <div class="modal-body">
                <div class="form-group">
                    <label for="rol_rol_2" class="control-label">Rol</label>
                    <select name="rol_rol_2" id="rol_rol_2" class="form-control" required></select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="apl_aplicacion_2" class="control-label">Aplicación</label>
                    <select name="apl_aplicacion_2" id="apl_aplicacion_2" class="form-control" required></select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="rla_estado" class="control-label">Estado</label>
                    <select name="rla_estado" id="rla_estado" class="form-control" required>
                    <option value="">Selecione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                </div>
                <div class="modal-footer centralFooter">
                <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalSistemaRolOpcion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                <div class="col-md-1">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
                </div>
                <div class="col-md-11">
                    <h4 class="modal-title">Gestión de Rol Opción</h4>
                </div>
                </div>
            </div>
            <input type="hidden" value="{{ route('administrarAccesos.proceso_9') }}" id="cargaSistemaRolOpcion" class="dct_main">
            <form data-action="{{route('administrarAccesos.proceso_10')}}" method="POST" id="formSistemaRolOpcion" class="formModalPages" data-toggle="validator" role="form" novalidate>
                @csrf
                <input type="hidden" name="tipo_form_sist_rol_opc" id="tipo_form_sist_rol_opc">
                <div class="modal-body">
                <div class="form-group">
                    <label for="rol_rol_3" class="control-label">Rol</label>
                    <select name="rol_rol_3" id="rol_rol_3" class="form-control" required></select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="opc_opcion_3" class="control-label">Opción</label>
                    <select name="opc_opcion_3" id="opc_opcion_3" class="form-control" required></select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="rlo_estado" class="control-label">Estado</label>
                    <select name="rlo_estado" id="rlo_estado" class="form-control" required>
                    <option value="">Selecione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                </div>
                <div class="modal-footer centralFooter">
                <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalSistemaAplicacion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                <div class="col-md-1">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
                </div>
                <div class="col-md-11">
                    <h4 class="modal-title">Gestión de Aplicativo</h4>
                </div>
                </div>
            </div>
            <form data-action="{{route('administrarAccesos.proceso_17')}}" method="POST" id="formSistemaAplicacion" class="formModalPages" data-toggle="validator" role="form" novalidate>
                @csrf
                <input type="hidden" name="tipo_form_sist_apl" id="tipo_form_sist_apl">
                <div class="modal-body">
                <div class="form-group">
                    <label for="apl_aplicacion" class="control-label">Aplicativo</label>
                    <input type="text" class="form-control" id="apl_aplicacion" name="apl_aplicacion" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="apl_estado" class="control-label">Estado</label>
                    <select name="apl_estado" id="apl_estado" class="form-control" required>
                    <option value="">Selecione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                </div>
                <div class="modal-footer centralFooter">
                <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalSistemaOpcion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                <div class="col-md-1">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
                </div>
                <div class="col-md-11">
                    <h4 class="modal-title">Gestión de Opciones</h4>
                </div>
                </div>
            </div>
            <form data-action="{{route('administrarAccesos.proceso_16')}}" method="POST" id="formSistemaOpcion" class="formModalPages" data-toggle="validator" role="form" novalidate>
                @csrf    
                <input type="hidden" name="tipo_form_sist_opc" id="tipo_form_sist_opc">
                <div class="modal-body">
                <div class="form-group">
                    <label for="opc_opcion" class="control-label">Opción</label>
                    <input type="text" class="form-control" id="opc_opcion" name="opc_opcion" maxlength="30" minlength="5" oninput="this.value = this.value.toUpperCase()">
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                <div class="form-group">
                    <label for="opc_estado" class="control-label">Estado</label>
                    <select name="opc_estado" id="opc_estado" class="form-control" required>
                    <option value="">Selecione una opción</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                                Debe ingresar/seleccionar un valor valido.
                            </div>
                </div>
                </div>
                <div class="modal-footer centralFooter">
                <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                </div>
            </form>
            </div>
        </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr-master/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dct_sistema/dist/css/dct_global.css') }}" />
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr-master/build/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/dct_global.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/administrarAccesos.js') }}"></script>
@stop