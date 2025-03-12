@extends('layouts.base_1')
@section('title','ServiDCT | Página Principal')
@section('content')
  <main>
    <div class="container px-4 py-5" id="featured-3">
      <h2 class="pb-2 border-bottom">Contáctanos</h2>
      <div class="centrarAll">
        <div class="full">
          <div class="main_heading contactMain">
            <h2 class="h2Contact">No dudes en consultarnos.</h2>
            <p class="large pContact">Tienes todos estos canales para que tu negocio de un nuevo giro.</p>
          </div>
        </div>
        <form id="dreconstecFormContactar" class="form-consulta" data-toggle="validator" role="form"> 
          <div class="form-group">
            <label>Nombres Completos: <span>*</span></label>
            <input type="text" name="dct_nombre" id="dct_nombre" class="form-control campo-form" required maxlength="50">
            <div class="help-block with-errors errorRedContact"></div>
          </div>
          <div class="form-group">
            <label>Correo Electrónico: <span>*</span></label>
            <input type="email" name="dct_email" id="dct_email" class="form-control campo-form" maxlength="40" data-error="Formato de Correo inválido." required>
            <div class="help-block with-errors errorRedContact dct_email"></div>
          </div>
          <div class="form-group">
            <label>Convencional / Celular: <span>*</span></label>
            <input type="text" name="dct_telefono" id="dct_telefono" class="form-control campo-form" required maxlength="10">
            <div class="help-block with-errors errorRedContact dct_telefono"></div>
          </div>
          <div class="form-group">
            <label>Indíquenos su consulta: <span>*</span></label>
            <textarea name="dct_consulta" id="dct_consulta" class="form-control campo-form" maxlength="400" required></textarea>
            <div class="help-block with-errors errorRedContact"></div>
          </div>
          <div class="form-group">
            <div class="button_Section_cont"> <a class="btn dark_gray_bt" href="contactanos/">Enviar</a></div>
          </div>
        </form>
      </div>
    </div>
  </main>
@endsection