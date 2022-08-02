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
  $('#formPOSTransGenerarFactura').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/POSTransacciones/guardarPOSTransGenerarFactura.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formPOSTransGenerarFactura").serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_factura);
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
  $('#formPOSTransGenerarNotaCredito').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/POSTransacciones/guardarPOSTransGenerarNotaCredito.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formPOSTransGenerarNotaCredito").serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_factura);
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
  $('#formPOSTransGenerarNotaDebito').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/POSTransacciones/guardarPOSTransGenerarNotaDebito.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formPOSTransGenerarNotaDebito").serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_factura);
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
  $('#formPOSTransGenerarGuiaRemision').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/POSTransacciones/guardarPOSTransGenerarGuiaRemision.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formPOSTransGenerarGuiaRemision").serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_factura);
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
  $('#formPOSTransGenerarRetencion').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/POSTransacciones/guardarPOSTransGenerarRetencion.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formPOSTransGenerarRetencion").serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_factura);
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