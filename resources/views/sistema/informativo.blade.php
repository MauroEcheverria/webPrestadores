@extends('adminlte::page')

@section('title', 'Informativo')

@section('content_header') &nbsp; @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="centrarContenido">
                    <img src="{{ asset('vendor/dct_sistema/dist/img/dct_error_page.png') }}" class="img-fluid" alt="Responsive image">
                </div>
            </div>
            <div class="col-md-12">
               
                    <h3><i class="fas fa-exclamation-triangle text-info"></i> Oops! Acceso no permitido.</h3>
                    <div>
                        <span class="inf_text">Informativo:</span><span>
                            @if ($accion["acceso"] == "usuario_inactivo")
                                No puede acceder a esta sección de la página WEB su usuario se encuentra inactiva.
                            @elseif ($accion["acceso"] == "contrasena_inactiva")
                                No puede acceder a esta sección de la página WEB su contraseña se encuentra inactiva.
                            @elseif ($accion["acceso"] == "expiro_contrasena")
                                No puede acceder a esta sección de la página WEB ya que su contraseña ha expirado.
                            @elseif ($accion["acceso"] == "correo_no_validado")
                                No puede acceder a esta sección de la página WEB ya que su correo no ha sido validado.
                            @elseif ($accion["acceso"] == "empresa_inactiva")
                                No puede acceder a esta sección de la página WEB ya que su empresa se encuentra inactiva.
                            @elseif ($accion["acceso"] == "licencia_caducada")
                                No puede acceder a esta sección de la página WEB ya que su licencia de uso del aplicativo ha caducado.
                            @elseif ($accion["acceso"] == "rol_inactivo")
                                No puede acceder a esta sección de la página WEB ya que el rol al que desea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "opcion_inactiva")
                                No puede acceder a esta sección de la página WEB ya que el módulo al que desea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "aplicativo_inactivo")
                                No puede acceder a esta sección de la página WEB ya que el módulo principal al que desea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "empresa_aplicativo_inactivo")
                                No puede acceder a esta sección de la página WEB ya que el módulo principal al que desea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "rol_aplicativo_inactivo")
                                No puede acceder a esta sección de la página WEB ya que el módulo principal al que desea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "rol_opcion_inactivo")
                                No puede acceder a esta sección de la página WEB ya que su autorización esta inactiva.
                            @else
                                Opción no registrada, favor contactárse con el administrador del sitio WEB. Cod Error # 001
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="inf_link"> Mientras tanto, puede volver al <a href="{{ url('/dashboard') }}">Página Principal.</a></span>
                    </div>
             
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/toastr-master/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dct_sistema/dist/css/dct_global.css') }}" />
@stop

@section('js')
    <script src="{{ asset('vendor/toastr-master/build/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/dct_global.js') }}"></script>
@stop