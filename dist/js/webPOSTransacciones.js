$(document).ready(function() {
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#idTogglable_1") {
      
    }
    if (target == "#idTogglable_2") {
      
    }
    if (target == "#idTogglable_3") {
      
    }
  });
  $('#formPOSTransaccionesNuevo').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/POSTransacciones/guardarPOSTransaccione.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formPOSTransaccionesNuevo").serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              obtenerComprobanteFirmado_sri(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_factura,1);
            case "token_csrf_error":
              //modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              /*$("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
              $('#myModalErrorGeneral').modal('show');*/
              break;
          }
        }
      });
    }
  });
});