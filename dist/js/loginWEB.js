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

  $(document)
  .ajaxStart(function(){
    $('.preloader').css('height', '100vh');
    $('.preloader').children().show();
  })
  .ajaxStop(function(){
    $('.preloader').css('height', '0');
    $('.preloader').children().hide();
  });

  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  });
  
  $('#formLoginSesion').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/login.php',
        type: 'POST',
        dataType: 'html',
        data:$('#formLoginSesion').serialize(),
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "accesoPermitido":
              if ($("#linkTemp").val() == "") {
                window.location = "../principal";
              }
              else {
                window.location = $("#linkTemp").val();
              }
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
            case "token_csrf_error":
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
              $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
  $('#inputUser,#inputPassword').keypress(function(e){
    if(e.which == 13){
      $('#formLoginSesion').click();
    }
  });
  $('#formReestaPass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/guardarRestarPass.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formReestaPass").serialize(),
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalOlvidoContrasena').modal('hide');
          document.getElementById('formReestaPass').reset();
          switch (result.message) {
            case "saveOK":
              if (result.existeCuenta == "SI") { 
                if (result.tokenActivo == "NO") {
                    if (result.correoEnviado == "SI") {
                      var dataModal_1 = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
                      var dataModal_2 = 'Información';
                      var dataModal_3 = 'Se ha enviado una notificación a su cuenta de correo electrónico <span class="linkCorreo">'+result.usr_correo+'</span> con las instrucciones para que pueda ingresar su nueva contraseña.<br><p><strong>Favor revisar su bandeja de entrada o spam.</strong></p>';
                      var dataModal_4 = '<button type="button" class="btn btn-success btn-dreconstec" onClick="location.href = '+"'"+'../login'+"'"+'">Cerrar</button>';
                      modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
                    }
                    else {
                      var dataModal_1 = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                      var dataModal_2 = 'Información';
                      var dataModal_3 = 'No se pudo enviar el correo con su clave de acceso. Intentelo de nuevo por favor.';
                      var dataModal_4 = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
                      modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
                    } 
                }
                else {
                  var dataModal_1 = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                  var dataModal_2 = 'Información';
                  var dataModal_3 = 'Aún tiene un ticket vigente, revise su correo electrónico y siga los pasos indicados.';
                  var dataModal_4 = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
                  modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
                }
              }
              else {
                var dataModal_1 = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                var dataModal_2 = 'Información';
                var dataModal_3 = 'No se encontró ningún usuario que coincida con ese número de cédula';
                var dataModal_4 = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
                modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
              }
              break;
            case "token_csrf_error":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
  $('#idOlvidoContrasena').click( function (e) {
    e.preventDefault();
    $('#myModalOlvidoContrasena').modal('show');
  });
  var flagEstatusPass = 0;
  $('#passPassNew').keyup(function() {
    var pswd = $(this).val();
    var validateLength=false;
    var validateLetter=false;
    var validateCapital=false;
    var validateNumber=false;
    //validate the length
    if ( pswd.length < 8 ) {
      $('#reset_length').removeClass('valid_pass').addClass('invalid_pass');
    } else {
      $('#reset_length').removeClass('invalid_pass').addClass('valid_pass');
      validateLength=true;
    }
    //validate letter
    if ( pswd.match(/[A-z]/) ) {
       $('#reset_letter').removeClass('invalid_pass').addClass('valid_pass');
       validateLetter=true;
    } else {
      $('#reset_letter').removeClass('valid_pass').addClass('invalid_pass');
    }
    //validate capital letter
    if ( pswd.match(/[A-Z]/) ) {
      $('#reset_capital').removeClass('invalid_pass').addClass('valid_pass');
      validateCapital=true;
    } else {
      $('#reset_capital').removeClass('valid_pass').addClass('invalid_pass');
    }
    //validate number
    if ( pswd.match(/\d/) ) {
      $('#reset_number').removeClass('invalid_pass').addClass('valid_pass');
      validateNumber=true;
    } else {
      $('#reset_number').removeClass('valid_pass').addClass('invalid_pass');
    }
    if(validateLength === true && validateLetter === true && validateCapital === true && validateNumber === true) {
      $('#btnSubmitReset').prop("disabled", false);
      flagEstatusPass = 1;
      $('#modal_pass_verify').hide();
      $('#modal_rest_verify').hide();
    }
    else {
      $('#btnSubmitReset').prop("disabled", true);
      flagEstatusPass = 0;
      $('#modal_pass_verify').show();
      $('#modal_rest_verify').show();
    }
  }).focus(function() {
    $('#modal_pass_verify').show();
    $('#modal_rest_verify').show();
  }).blur(function() {
    $('#modal_pass_verify').hide();
    $('#modal_rest_verify').hide();
  });
  $('#formExpirePass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if(flagEstatusPass == 1){
        $.ajax({
          url: '../../beans/manejoSistema/expirarPassLogin.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formExpirePass").serialize()+"&cod_system_user="+$('#idPassCedula').text(),
          success: function(result){
            var result = eval('('+result+')');
            document.getElementById('formExpirePass').reset();
            $('#myModalExpirePass').modal('hide');
            switch (result.message) {
              case "updateOk":
              case "updateError":
              case "passRegistradaAnteriormentes":
              case "passOriginalError":
              case "token_csrf_error":
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              default:
                $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
                $('#myModalErrorGeneral').modal('show');
                break;
            }
          }
        });
      }
      else {
        $('#passPassNew,#passRepPass').val("");
        var dataModal_1 = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
        var dataModal_2 = 'Información';
        var dataModal_3 = 'La contraseña ingresada no cumple con los criterios de seguridad establecidos.';
        var dataModal_4 = '<button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>';
        modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
      } 
    }
  });
  $('#formTokenReestaPass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if(flagEstatusPass == 1){
        $.ajax({
          url: '../../beans/manejoSistema/guardarTokenRestarPass.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formTokenReestaPass").serialize(),
          success: function(result){
            var result = eval('('+result+')');
            document.getElementById('formTokenReestaPass').reset();
            switch (result.message) {
              case "saveOK":
              case "passRegistradaAnteriormentes":
              case "tokenNoRegistrado":
              case "token_csrf_error":
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              default:
                $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
                $('#myModalErrorGeneral').modal('show');
                break;
            }
          }
        });
      }
      else {
        $('#passPassNew,#passRepPass').val("");
        var dataModal_1 = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
        var dataModal_2 = 'Información';
        var dataModal_3 = 'La contraseña ingresada no cumple con los criterios de seguridad establecidos.';
        var dataModal_4 = '<button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>';
        modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
      }
    }
  });
});