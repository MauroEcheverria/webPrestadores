@extends('adminlte::page')

@section('title', 'Agenda Médica')

@section('content_header') @stop

@section('content')
    <input type="hidden" value="{{ route('agendaMedica.proceso_1') }}" id="getDataTableAgendaMedica" class="dct_main">
    <div class="card">
        <div class="card-header">
            <span class="panel-title"><b>Agenda Médica</b></span>
        </div>
        <div class="card-body">
            <button type="button" id="idCrearEvento" class="btn btn-info btn-dreconstec" data-dismiss="modal">Añadir
                Evento</button>
            <div id='calendar'></div>
        </div>
    </div>

    <div class="modal fade" id="myModalAgendaMedicaAdd" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px"
                                heigth="20px">
                        </div>
                        <div class="col-md-11">
                            <h4 class="modal-title">Añadir Evento</h4>
                        </div>
                    </div>
                </div>
                <form data-action="{{ route('agendaMedica.guardar_agenda') }}" method="POST" id="formAgendaMedicaNuevo"
                    class="formModalPages" data-toggle="validator" role="form" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usr_cod_usuario" class="control-label">Médico</label>
                                    <select name="usr_cod_usuario" id="usr_cod_usuario" class="form-control"
                                        style="width: 100%;"></select>
                                </div>
                                <div class="form-group">
                                    <label for="pct_id_paciente" class="control-label">Cédula Paciente</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" class="form-control" id="pct_id_paciente"
                                            name="pct_id_paciente" maxlength="13" minlength="8" required
                                            data-inputmask='"mask": "9999999999"' data-mask
                                            style="font-weight: 600;font-size: 17px !important;">
                                        <div class="input-group-append id_buscar_cedula_agenda"
                                            data-target="#pct_id_paciente">
                                            <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="esp_id_especialidad" class="control-label">Especialidad</label>
                                    <select name="esp_id_especialidad" id="esp_id_especialidad" class="form-control"
                                        style="width: 100%;"></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;">
                            <span class="control-label cal_label">Nombres Paciente:</span><span class="cal_data"
                                id="pct_nombres">Mauro Vinicio Echeverria Chuguli</span><br>
                            <span class="control-label cal_label">Correo paciente:</span><span class="cal_data"
                                id="pct_correo">maurovinicio.echeverria@gmail.com</span><br>
                            <span class="control-label cal_label">Contacto paciente:</span><span class="cal_data"
                                id="pct_telefono">0960939030</span><br>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agm_tipo" class="control-label">Tipo Evento</label>
                                    <select name="agm_tipo" id="agm_tipo" class="form-control" required
                                        style="width: 100%;">
                                        <option value="" selected>Seleccione Opción</option>
                                        <option value="CM">Cita Médica</option>
                                        <option value="CS">Cita Subsecuente</option>
                                        <option value="CT">Consultoria</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agm_fecha_inicio" class="control-label">Fecha Cita</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            name="agm_fecha_inicio" data-target="#agm_fecha_inicio"
                                            id="agm_fecha_inicio" />
                                        <div class="input-group-append" data-target="#agm_fecha_inicio"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="agm_intervalo" class="control-label">Tiempo de atención (Minutos)</label>
                                    <select name="agm_intervalo" id="agm_intervalo" class="form-control" required
                                        style="width: 100%;">
                                        <option value="" selected>Seleccione Opción</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                        <option value="60">60</option>
                                        <option value="90">90</option>
                                        <option value="120">120</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agm_motivo" class="control-label">Motivo</label>
                                    <input type="text" class="form-control" id="agm_motivo" name="agm_motivo"
                                        maxlength="60" minlength="8" required>
                                </div>
                                <div class="form-group">
                                    <label for="agm_hora_inicio" class="control-label">Hora Desde</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            name="agm_hora_inicio" data-target="#agm_hora_inicio" id="agm_hora_inicio" />
                                        <div class="input-group-append" data-target="#agm_hora_inicio"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="agm_hora_final" class="control-label">Hora Hasta</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            name="agm_hora_final" data-target="#agm_hora_final" required
                                            id="agm_hora_final" />
                                        <div class="input-group-append" data-target="#agm_hora_final"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agm_observacion" class="control-label">Observación</label>
                            <textarea class="form-control" rows="2" cols="40" id="agm_observacion" name="agm_observacion"
                                maxlength="1000" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer centralFooter">
                        <button type="button" class="btn btn-warning btn-dreconstec"
                            data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success btn-dreconstec">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalAgendaMedicaEdit" role="dialog" aria-labelledby="myModalLabel"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modalLogin">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px"
                                heigth="20px">
                        </div>
                        <div class="col-md-11">
                            <h4 class="modal-title">Visualización de Evento</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div>
                        <span class="control-label cal_label">Paciente:</span><span class="cal_data"
                            id="id_pct_id_paciente"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Médico:</span><span class="cal_data"
                            id="id_usr_cod_usuario"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Especialidad:</span><span class="cal_data"
                            id="id_esp_id_especialidad"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Tipo Evento:</span><span class="cal_data"
                            id="id_agm_tipo"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Motivo:</span><span class="cal_data"
                            id="id_agm_motivo"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Desde:</span><span class="cal_data"
                            id="id_agm_fecha_inicio"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Hasta:</span><span class="cal_data"
                            id="id_agm_fecha_final"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Observación:</span><span class="cal_data"
                            id="id_agm_observacion"></span>
                    </div>
                    <div>
                        <span class="control-label cal_label">Estado:</span><span class="cal_data"
                            id="id_agm_estado"></span>
                    </div>
                </div>
                <div class="modal-footer centralFooter">
                    <button type="button" class="btn btn-info btn-dreconstec">Editar Evento</button>
                    <button type="button" class="btn btn-danger btn-dreconstec">Eliminar Evento</button>
                    <br>
                    <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/tempusdominus/css/tempusdominus-bootstrap-4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr-master/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dct_sistema/dist/css/dct_global.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/dct_sistema/dist/css/agendaMedica.css') }}" />
    <style type="text/css">
        #calendar a {
            color: unset;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr-master/build/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/dist/index.global.min.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/dct_global.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/agendaMedica.js') }}"></script>
@stop
