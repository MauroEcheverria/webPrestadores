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

?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container container_main centrarContent">
        <div class="error-page">
          <div class="row">
            <div class="col-md-3">
              <h2 class="headline text-info">403</h2>
            </div>
            <div class="col-md-9">
              <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-info"></i> Oops! Acceso no permitido.</h3>
                <p>
                  <span id="textBeansValidaAcceso"></span> Mientras tanto, puede volver al <a href="../../../webAdministracion/pages/principal/">panel de control.</a>
                </p>
              </div>
            </div>
          </div>
          <div class="row centrarContent">
            <div class="col-md-12">
              <img src="../../../dist/img/dct_error_page.png" class="img-fluid" alt="Responsive image">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php 
  template_footer($pdo,$dataSesion,$js_dreconstec); } 
?>