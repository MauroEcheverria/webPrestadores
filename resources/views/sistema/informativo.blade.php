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
                                No puede acceder a esta opción, su usuario se encuentra inactivo.
                            @elseif ($accion["acceso"] == "contrasena_inactiva")
                                No puede acceder a esta opción, su contraseña se encuentra inactiva.
                            @elseif ($accion["acceso"] == "expiro_contrasena")
                                No puede acceder a esta opción, ya que su contraseña ha expirado.
                            @elseif ($accion["acceso"] == "aplicativo_inactivo")
                                No puede acceder a esta opción, ya que el modulo principal al que desea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "rol_inactivo")
                                No puede acceder a esta opción, ya que el rol al que deseea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "empresa_inactiva")
                                No puede acceder a esta opción, ya que su empresa se encuentra inactiva en la WEB.
                            @elseif ($accion["acceso"] == "licencia_caducada")
                                No puede acceder a esta opción, ya que su licencia de uso del paplicativo ha caducado
                            @elseif ($accion["acceso"] == "modulo_inactivo")
                                No puede acceder a esta opción, ya que el modulo al que desea acceder esta inactivo.
                            @elseif ($accion["acceso"] == "no_possee_autorizacion")
                                No posee autorización para acceder a esta sección/módulo de la página WEB.
                            @elseif ($accion["acceso"] == "correo_no_validado")
                                No puede acceder a esta opción, ya que su correo no ha sido validado.
                            @elseif ($accion["acceso"] == "opcion_no_registrada")
                                Opción no registrada, favor contactárse con el administrador del sitio WEB. Cod Error # 001
                            @else
                                Opción no registrada, favor contactárse con el administrador del sitio WEB. Cod Error # 002
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