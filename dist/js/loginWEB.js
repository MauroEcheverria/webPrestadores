function soloNumeros(e) {
  var key = window.event ? e.which : e.charCode;
  if (key == 8) {
    return true;
  }
  if (key !== undefined && key === 0) {
    return true;
  }
  var patron = /[0-9]/;
  var tecla_final = String.fromCharCode(key);
  return patron.test(tecla_final);
}
function validateOnlyNumber(evt) {
  var theEvent = evt || window.event;
  if (theEvent.type === 'paste') {
    key = event.clipboardData.getData('text/plain');
  } else {
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4) {
  $("#putIconModalgeneric").empty().prepend(dataModal_1);
  $("#putTitleModalgeneric").empty().prepend(dataModal_2);
  $("#putMessaggeModalgeneric").empty().prepend(dataModal_3);
  $("#putButtonModalgeneric").empty().prepend(dataModal_4);
  $('#modalGenericoInfo').modal('show');
}
$(document).ready(function() { 

  $('#loading').hide();  
  $(document)
  .ajaxStart(function(){$('#loading').show();})
  .ajaxStop(function(){$('#loading').hide();});
  
  $('#btnFormLogin').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/login.php',
        type: 'POST',
        dataType: 'html',
        data:$('#btnFormLogin').serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "accesoPermitido":
              window.location = "../bienvenido";
              break;
            case "accesoPermitidoExpirePass":
              $("h3#idPassCedula").empty().prepend(result.cod_system_user);
              $("h3#idPassNombres").empty().prepend(result.complete_names);
              $('#myModalExpirePass').modal('show');
              break;
            case "errorCaptcha":
            case "accesoEnOtraPc":
            case "usuarioInactivo":
            case "licenciaAgotada":
            case "empresaInactiva":
            case "rolInactivo":
            case "statusPassFalse":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "cedulaNoRegistrada":
              $("#inputUser").val("");
              $("#inputPassword").val("");
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "claveNoIgual":
              $("#inputPassword").focus().val("");
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1000");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
  
  $('#inputUser,#inputPassword').keypress(function(e){
    if(e.which == 13){
      $('#btnFormLogin').click();
    }
  });

  $('#formExpirePass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/expirarPassLogin.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formExpirePass").serialize()+"&cod_system_user="+
        $('#idPassCedula').text()+"&valPaciente="+
        $.md5($('#passPassNew').val(),'M@rut0')+"&valPacienteAnt="+
        $.md5($('#passPassAnt').val(),'M@rut0'),
        success: function(result){
          var result = eval('('+result+')');
          document.getElementById('formExpirePass').reset();
          $('#myModal_expire_pass').modal('hide');
          switch (result.message) {
            case "updateOk":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "updateError":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "passRegistradaAnteriormentes":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "passOriginalError":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1001");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });

  $('#formReestaPass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/saveRestarPass.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formReestaPass").serialize(),
        success: function(result){
          var result = eval('('+result+')');
          document.getElementById('formReestaPass').reset();
          switch (result.message) {
            case "saveOK":
              if (result.existeCuenta == "SI") { 
                if (result.tokenActivo == "NO") {
                    if (result.correoEnviado == "SI") {
                      var dataModal_1 = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
                      var dataModal_2 = 'Información';
                      var dataModal_3 = 'Se ha enviado una notificación a su cuenta de correo electrónico <span class="linkCorreo">'+result.usr_correo+'</span> con las instrucciones para que pueda ingresar su nueva contraseña.<br><p><strong>Favor revisar su bandeja de entrada o spam.</strong></p>';
                      var dataModal_4 = '<button type="button" class="btn btn-success" onClick="location.href = '+"'"+'../login'+"'"+'">Cerrar</button>';
                      modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
                    }
                    else {
                      var dataModal_1 = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                      var dataModal_2 = 'Información';
                      var dataModal_3 = 'No se pudo enviar el correo con su clave de acceso. Intentelo de nuevo por favor.';
                      var dataModal_4 = '<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>';
                      modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
                    } 
                }
                else {
                  var dataModal_1 = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                  var dataModal_2 = 'Información';
                  var dataModal_3 = 'Aún tiene un ticket vigente, revise su correo electrónico y siga los pasos indicados.';
                  var dataModal_4 = '<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>';
                  modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
                }
              }
              else {
                var dataModal_1 = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                var dataModal_2 = 'Información';
                var dataModal_3 = 'No se encontró ningún usuario que coincida con ese número de cédula';
                var dataModal_4 = '<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>';
                modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
              }
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1002");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
  $('#formTokenReestaPass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
        $.ajax({
          url: '../../beans/manejoSistema/saveTokenRestarPass.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formTokenReestaPass").serialize(),
          success: function(result){
            var result = eval('('+result+')');
            document.getElementById('formTokenReestaPass').reset();
            switch (result.message) {
              case "saveOK":
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              case "passRegistradaAnteriormentes":
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              case "tokenNoRegistrado":
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              default:
              $("span#idCodErrorGeneral").empty().prepend("1003");
              $('#myModalErrorGeneral').modal('show');
                break;
            }
          }
        });
    }
  });
  $('#idModalRegistro').click( function (e) {
    e.preventDefault();
    $('#myModalRegistro').modal('show');
  });
});