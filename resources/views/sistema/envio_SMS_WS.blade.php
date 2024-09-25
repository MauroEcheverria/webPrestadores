@extends('adminlte::page')

@section('title', 'Envio de SMS WhatsApp')

@section('content_header') &nbsp; @stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <span class="panel-title"><b>Envio de SMS WhatsApp</b></span>
            </div>
            <div class="card-body">
                <form action="{{route('envioSMS_WS.proceso_1')}}" method="POST" id="formUserNew" class="formModalPages" data-toggle="validator" role="form" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="ws_celular" class="control-label">Celular</label>
                        <input type="text" class="form-control" id="ws_celular" name="ws_celular" maxlength="13" minlength="8" onkeypress="return soloNumeros(event);" required>
                        <div class="invalid-feedback">
                            Por favor, ingrese el dato solicitado.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ws_mensaje" class="control-label">Mensaje</label>
                        <input type="text" class="form-control" id="ws_mensaje" name="ws_mensaje" maxlength="15" required minlength="3" oninput="this.value = this.value.toUpperCase()">
                        <div class="invalid-feedback">
                            Por favor, ingrese el dato solicitado.
                        </div>
                    </div>
                    <div class="form-group">
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
@stop