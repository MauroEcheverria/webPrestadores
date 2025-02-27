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
  
  <div class="modal fade" id="myModalAgendaMedicaAdd" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                    <label for="agm_titulo" class="control-label">Cédula</label>
                    <input type="text" class="form-control" id="agm_titulo" name="agm_titulo" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required>
                  </div>
                  <div class="form-group">
                    <label for="usr_nombre_1" class="control-label">Primer Nombre</label>
                    <input type="text" class="form-control" id="usr_nombre_1" name="usr_nombre_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                  </div>
                  <div class="form-group">
                    <label for="usr_apellido_1" class="control-label">Primer Apellido</label>
                    <input type="text" class="form-control" id="usr_apellido_1" name="usr_apellido_1" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                  </div>
                  <div class="form-group">
                    <label for="usr_celular" class="control-label">Celular</label>
                    <input type="text" class="form-control" id="usr_celular" name="usr_celular" maxlength="10" required minlength="3" onkeypress="return soloNumeros(event);">
                  </div>
                  <div class="form-group">
                    <label for="usr_id_empresa" class="control-label">Empresa</label>
                    <select name="usr_id_empresa" id="usr_id_empresa" class="form-control" required style="width: 100%;"></select>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="usr_correo" class="control-label">Correo</label>
                    <input type="email" class="form-control" id="usr_correo" name="usr_correo" maxlength="60" 
                    data-error="Formato de Correo inválido." required oninput="this.value = this.value.toLowerCase()" minlength="6">
                  </div>
                  <div class="form-group">
                    <label for="usr_nombre_2" class="control-label">Segundo Nombre</label>
                    <input type="text" class="form-control" id="usr_nombre_2" name="usr_nombre_2" maxlength="15" minlength="2" required oninput="this.value = this.value.toUpperCase()">
                  </div>
                  <div class="form-group">
                    <label for="usr_apellido_2" class="control-label">Segundo Apellido</label>
                    <input type="text" class="form-control" id="usr_apellido_2" name="usr_apellido_2" maxlength="15" oninput="this.value = this.value.toUpperCase()">
                  </div>
                  <div class="form-group">
                    <label for="usr_id_rol" class="control-label">Tipo Rol</label>
                    <select name="usr_id_rol" id="usr_id_rol" class="form-control" required style="width: 100%;"></select>
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
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
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
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr-master/build/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/dist/index.global.min.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/dct_global.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/agendaMedica.js') }}"></script>
@stop