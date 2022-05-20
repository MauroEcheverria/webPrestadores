<?php 
  function noAutorizado($pdo,$dataSesion){ 
  include("../../../template/templateHead.php");
  include("../../../template/templateFooter.php");
  include("../../../dialogs/modalViews.php"); 
  $css_dreconstec = array();
  $js_dreconstec = array();
  template_head($pdo,$dataSesion,$css_dreconstec);

  switch ($dataSesion["codigoValidacion"]) {
    case 'usuarioInactivo':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Su sesión ha sido cerrada debido a que su usuario ha sido inactivado.');</script>";
      break;
    case 'contrasenaInactiva':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Su sesión ha sido cerrada debido a que su contraseña ha sido bloqueada.');</script>";
      break;
    case 'expiroContrasena':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Su sesión ha sido cerrada debido a que su contraseña ha expirado.');</script>";
      break;
    case 'aplicativoInactivo':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Lo sentimos, el aplicativo al que desea acceder se encuentra inactivo.');</script>";
      break;
    case 'rolInactivo':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Lo sentimos, su rol se encuentra inactivo.');</script>";
      break;
    case 'empresaInactiva':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Lo sentimos, la empresa a la que pertenece se encuentra inactiva en el sistema.');</script>";
      break;
    case 'licenciaCaducada':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Lo sentimos, la licencia de uso del sistema ha caducado.');</script>";
      break;
    case 'moduloInactivo':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Lo sentimos, el módulo al que desea acceder se encuentra inactivo.');</script>";
      break;
    case 'noPosseeAccesoOpcion':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Lo sentimos, no posee acceso para ingresar al módulo solicitado.');</script>";
      break;
    case 'ingresoOtraPC':
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Su sesión ha sido cerrada ya que ha iniciado sesión en otro computador.');</script>";
      break;
    default:
      $js_dreconstec[] = "<script type='text/javascript'>$('#textBeansValidaAcceso').empty().append('Se ha detectado un error al procesar la solicitud requerida. Código de error: 777, por favor enviar un correo electrónico a <strong>info@dreconstec.com</strong> indicando la novedad presentada.');</script>";
      break;
  }

  $js_dreconstec[] = "<script type='text/javascript'>$('#modalBeansValidaAcceso').modal('show');</script>"; 

?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container container_main"></div>
    </section>
  </div>
  <div class="modal fade" id="modalBeansValidaAcceso" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_error.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11" style="width: 430px;">
              <h4 class="modal-title">Información</h4>
            </div>
          </div>
        </div>
        <div class="modal-body"><strong><span id="textBeansValidaAcceso"></span></strong></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onClick="location.href = '../../../controller/cerrarSesion.php'">Salir</button>
        </div>
      </div>
    </div>
  </div>
<?php 
  modalViews();
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>