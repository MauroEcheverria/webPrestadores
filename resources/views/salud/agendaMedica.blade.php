@extends('adminlte::page')

@section('title', 'Agenda Médica')

@section('content_header') &nbsp; @stop

@section('content')
	<input type="hidden" value="{{ route('agendaMedica.proceso_1') }}" id="getDataTableAgendaMedica" class="dct_main">
  <div class="card">
    <div class="card-header">
      <span class="panel-title"><b>Agenda Médica</b></span>
    </div>
    <div class="card-body">
      <button type="button" id="testbtn" class="btn btn-info btn-dreconstec" data-dismiss="modal">Añadir</button>
      <div id='calendar'></div>
    </div>
  </div>
  
  <div class="modal fade" id="myModalAgendaMedicaAdd" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modalLogin">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
            </div>
            <div class="col-md-11">
              <h4 class="modal-title">Añadir Evento</h4>
            </div>
          </div>
        </div>
        <form data-action="{{route('agendaMedica.guardar_agenda')}}" method="POST" id="formAgendaMedicaAdd" class="formModalPages" data-toggle="validator" role="form" novalidate>
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="xxxxxxxx" class="control-label">Médico</label>
                  <select name="xxxxxxxx" id="xxxxxxxx" class="form-control" required style="width: 100%;"></select>
                </div>
                <div class="form-group">
                  <label for="agm_titulo" class="control-label">Cédula Paciente</label>
                  <input type="text" class="form-control" id="agm_titulo" name="agm_titulo" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="yyyyyy" class="control-label">Especialidad</label>
                  <select name="yyyyyy" id="yyyyyy" class="form-control" required style="width: 100%;"></select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label cal_label">Nombres Paciente:&nbsp;</label><span class="cal_data" id="id_agm_titulo">Mauro Echeverria asd asdkl ñlasd</span><br>
              <label class="control-label cal_label">Correo paciente:&nbsp;</label><span class="cal_data" id="id_agm_titulo"> asdsa asdsa sa as d</span><br>
              <label class="control-label cal_label">Contacto paciente:&nbsp;</label><span class="cal_data" id="id_agm_titulo">0960939030</span><br>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="xxxxxxxx" class="control-label">Timpo de agenda</label>
                  <select name="xxxxxxxx" id="xxxxxxxx" class="form-control" required style="width: 100%;">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                    <option value="60">60</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="xxxxxxxx" class="control-label">Fecha Cita</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="xxxxxxxx" class="control-label">Timpo de atención</label>
                  <select name="xxxxxxxx" id="xxxxxxxx" class="form-control" required style="width: 100%;">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                    <option value="60">60</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="agm_titulo" class="control-label">Detalle</label>
                  <input type="text" class="form-control" id="agm_titulo" name="agm_titulo" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required>
                </div>
                <div class="form-group">
                  <label for="xxxxxxxx" class="control-label">Hora Desde</label>
                  <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
                      <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-clock"></i></div>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="xxxxxxxx" class="control-label">Hora Hasta</label>
                  <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3" disabled/>
                      <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-clock"></i></div>
                      </div>
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
  <div class="modal fade" id="myModalAgendaMedicaEdit" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modalLogin">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="{{ asset('vendor/dct_sistema/dist/img/modal_visto.png') }}" width="30px" heigth="20px">
            </div>
            <div class="col-md-11">
              <h4 class="modal-title">Visualización de Evento</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">
          <div>
            <label class="control-label cal_label">Evento:&nbsp;</label><span class="cal_data" id="id_agm_titulo"></span>
          </div>
          <div>
            <label class="control-label cal_label">Desde:&nbsp;</label><span class="cal_data" id="id_agm_fecha_inicio"></span>
          </div>
          <div>
            <label class="control-label cal_label">Hasta:&nbsp;</label><span class="cal_data" id="id_agm_fecha_final"></span>
          </div>
          <div>
            <label class="control-label cal_label">Correo:&nbsp;</label><span class="cal_data" id="id_agm_correo_paciente"></span>
          </div>
          <div>
            <label class="control-label cal_label">Observación:&nbsp;</label><span class="cal_data" id="id_agm_observacion"></span>
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
    <script src="{{ asset('vendor/fullcalendar/dist/index.global.min.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/dct_global.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/agendaMedica.js') }}"></script>
@stop