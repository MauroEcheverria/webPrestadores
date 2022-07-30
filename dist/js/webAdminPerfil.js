$(document).ready(function() {
  $(".select2").select2({
    maximumSelectionLength: 20
  });
  $('#adi_fecha_nacimiento').datepicker({
    singleDatePicker: true,
    showDropdowns: true,
    autoclose: true,
    format: 'yyyy-mm-dd',
    language: 'es',
    /*startDate: '+0d',*/
    endDate: '+0d',
  });
  $.ajax({
    url: '../../beans/manejoSistema/obtenerProvincia.php',
    type: 'POST',
    dataType: 'html',
    success: function(result){
      var result = eval('('+result+')');
      switch (result.message) {
        case "saveOK":
          $("select#adi_provincia").empty().prepend(result.rpta);
          if (result.data_count == 0) {
            $('#tipo_form').val("New");
            $("#adi_provincia").val("").trigger("change");
          }
          else {
            $('#tipo_form').val("Old");
            $('#adi_provincia').val(result.data_row["adi_provincia"]).trigger("change");
            $params = {'adi_provincia':$('#adi_provincia').val(),'adi_canton':result.data_row["adi_canton"],'adi_parroquia':result.data_row["adi_parroquia"]};
            $.ajax({
              url: '../../beans/manejoSistema/obtenerCanton.php',
              type: 'POST',
              dataType: 'html',
              data:$params,
              success: function(result){
                var result = eval('('+result+')');
                switch (result.message) {
                  case "saveOK":
                    $("select#adi_canton").empty().prepend(result.rpta);
                    $('#adi_canton').val(result.adi_canton).trigger("change");
                    $params = {'adi_canton':$('#adi_canton').val(), 'adi_provincia':$('#adi_provincia').val(),'adi_parroquia':result.adi_parroquia};
                      $.ajax({
                        url: '../../beans/manejoSistema/obtenerParroquia.php',
                        type: 'POST',
                        dataType: 'html',
                        data:$params,
                        success: function(result){
                          var result = eval('('+result+')');
                          switch (result.message) {
                            case "saveOK":
                              $("select#adi_parroquia").empty().prepend(result.rpta);
                              $('#adi_parroquia').val(result.adi_parroquia).trigger("change");
                              break;
                            default:
                              $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
                              $('#myModalErrorGeneral').modal('show');
                              break;
                          }
                        }
                      });
                    break;
                  default:
                    $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
                    $('#myModalErrorGeneral').modal('show');
                    break;
                }
              }
            });
            $('#adi_direccion').val(result.data_row["adi_direccion"]);
            $('#adi_referencia').val(result.data_row["adi_referencia"]);
            $('#adi_fecha_nacimiento').val(result.data_row["adi_fecha_nacimiento"]);
            $('#adi_fecha_nacimiento').datepicker('setDate', result.data_row["adi_fecha_nacimiento"]);
            $('#adi_estado_civil').val(result.data_row["adi_estado_civil"]);
            $('#adi_celular').val(result.data_row["adi_celular"]);
            $('#adi_instruccion').val(result.data_row["adi_instruccion"]);
            $('#adi_tipo_sangre').val(result.data_row["adi_tipo_sangre"]);
            $('#adi_sexo').val(result.data_row["adi_sexo"]);
          }
          break;
        default:
          $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
          $('#myModalErrorGeneral').modal('show');
          break;
      }    
    }
  });
  $('#adi_provincia').change( function () {
    $params = {'adi_provincia':$('#adi_provincia').val()};
    $.ajax({
      url: '../../beans/manejoSistema/obtenerCanton.php',
      type: 'POST',
      dataType: 'html',
      data:$params,
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("select#adi_canton").empty().prepend(result.rpta);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#adi_canton').change( function () {
    $params = {'adi_canton':$('#adi_canton').val(), 'adi_provincia':$('#adi_provincia').val()};
    $.ajax({
      url: '../../beans/manejoSistema/obtenerParroquia.php',
      type: 'POST',
      dataType: 'html',
      data:$params,
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("select#adi_parroquia").empty().prepend(result.rpta);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#formAdminPerfil').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $params = $('#formAdminPerfil').serialize();
      $.ajax({
        url: '../../beans/manejoSistema/guardarAdministrarPerfil.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
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
  $('#formExpirePassPerfil').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if(flagEstatusPass == 1){
        $.ajax({
          url: '../../beans/manejoSistema/expirarPassAdminPerfil.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formExpirePassPerfil").serialize(),
          success: function(result){
            var result = eval('('+result+')');
            document.getElementById('formExpirePassPerfil').reset();
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
        var dataModal_4 = '<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>';
        modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4);
      }
    }
  });
});