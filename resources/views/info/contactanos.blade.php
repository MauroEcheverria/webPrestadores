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
        <div class="row rowContact centrarAll">
          <div class="col-xs-3 col-sm-3 col-md-3 columnIconContac">
            <a href="https://api.whatsapp.com/send?phone=+593960939030&text=Hola...!!!%20Necesito%20saber%20de%20sus%20servicios." target="_blank">
              <img src="../images/logos/dreconstec_whatsapp.svg" class="imgLogosContact" alt="Dreconstec WhatsAPP">
            </a>
          </div>
          <div class="col-xs-3 col-sm-3 col-md-3 columnIconContac">
            <a href="https://www.instagram.com/dreconstec" target="_blank">
              <img src="../images/logos/dreconstec_instagram.svg" class="imgLogosContact" alt="Dreconstec Instagram">
            </a>
          </div>
          <div class="col-xs-3 col-sm-3 col-md-3 columnIconContac">
            <a href="https://www.facebook.com/dreconstec" target="_blank">
              <img src="../images/logos/dreconstec_facebook.svg" class="imgLogosContact" alt="Dreconstec Facebook">
            </a>
          </div>
          <div class="col-xs-3 col-sm-3 col-md-3 columnIconContac">
            <a href="https://twitter.com/dreconstec" target="_blank">
              <img src="../images/logos/dreconstec_twitter.svg" class="imgLogosContact" alt="Dreconstec Twitter">
            </a>
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
            <input type="submit" value="Enviar" class="btn-form btnMarginContact">
          </div>
        </form>
      </div>

    </div>
  </main>
  <div class="modal fade" id="dctModalSendOk" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
          <div class="">
            <img src="../images/it_service/dreconstec_ok.png" width="30px" heigth="20px">
            <h4 class="modal-title infoModalContact" id="myModalLabel">Información</h4>
          </div>
	      </div>
	      <div class="modal-body"><strong>Gracias. Su mensaje ha sido enviado exitosamente, en momentos nos comunicaremos con usted.</strong></div>
	      <div class="modal-footer" style="text-align: -webkit-center;">
	        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="redireccionarDreConsTec();">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
@endsection