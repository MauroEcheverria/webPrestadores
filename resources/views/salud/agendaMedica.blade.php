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
                <div class="form-group adminUser_2">
                  <label for="xxxxxxxx" class="control-label">Médico</label>
                  <select name="xxxxxxxx" id="xxxxxxxx" class="form-control" required style="width: 100%;"></select>
                </div>
                <div class="form-group">
                  <label for="agm_titulo" class="control-label">Cédula Paciente</label>
                  <input type="text" class="form-control" id="agm_titulo" name="agm_titulo" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required>
                </div>
                <div class="form-group">
                  <label class="control-label cal_label">Nombres Paciente:&nbsp;</label><span class="cal_data" id="id_agm_titulo"></span>
                </div>
                <div class="form-group">
                  <label for="agm_titulo" class="control-label">Fecha</label>
                  <div class="input-group date">
                    <input type="text" class="form-control pull-right" id="av_fecha_ampliacion" name="av_fecha_ampliacion" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="agm_titulo" class="control-label">Hora</label>
                  <div class="input-group date">
                  
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group adminUser_2">
                  <label for="yyyyyy" class="control-label">Especialidad</label>
                  <select name="yyyyyy" id="yyyyyy" class="form-control" required style="width: 100%;"></select>
                </div>
                <div class="form-group">
                  <label for="usr_correo" class="control-label">Correo</label>
                  <input type="email" class="form-control" id="usr_correo" name="usr_correo" maxlength="60" data-error="Formato de Correo inválido." required oninput="this.value = this.value.toLowerCase()" minlength="6">
                </div>  
                <div class="form-group">
                  <label class="control-label cal_label">Fecha Nacimiento:&nbsp;</label><span class="cal_data" id="id_agm_titulo"></span>
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
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
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
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr-master/build/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/dist/index.global.min.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/dct_global.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/agendaMedica.js') }}"></script>
@stop