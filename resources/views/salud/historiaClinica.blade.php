@extends('adminlte::page')

@section('title', 'Historial Clínico')

@section('content_header') &nbsp; @stop

@section('content')
    <h1>historiaClinica.blade</h1>
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