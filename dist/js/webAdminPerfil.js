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
    url: '../../beans/manejoSistema/putGetProvincia.php',
    type: 'POST',
    dataType: 'html',
    success: function(result){
      var result = eval('('+result+')');
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
          url: '../../beans/manejoSistema/putGetCanton.php',
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
                    url: '../../beans/manejoSistema/putGetParroquia.php',
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
                        case "saveError":
                          console.log("Error al obtener los Items");
                          break;
                      }
                    }
                  });
                break;
              default:
                $("span#idCodErrorGeneral").empty().prepend("2001");
                $('#myModalErrorGeneral').modal('show');
                break;
            }
          }
        });
        $('#adi_direccion').val(result.data_row["adi_direccion"]);
        $('#adi_referencia').val(result.data_row["adi_referencia"]);
        $('#adi_fecha_nacimiento').val(result.data_row["adi_fecha_nacimiento"]);
        $('#adi_estado_civil').val(result.data_row["adi_estado_civil"]);
        $('#adi_celular').val(result.data_row["adi_celular"]);
        $('#adi_instruccion').val(result.data_row["adi_instruccion"]);
        $('#adi_tipo_sangre').val(result.data_row["adi_tipo_sangre"]);
        $('#adi_sexo').val(result.data_row["adi_sexo"]);
      }
      
    }
  });
  $('#adi_provincia').change( function () {
    $params = {'adi_provincia':$('#adi_provincia').val()};
    $.ajax({
      url: '../../beans/manejoSistema/putGetCanton.php',
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
            $("span#idCodErrorGeneral").empty().prepend("2001");
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#adi_canton').change( function () {
    $params = {'adi_canton':$('#adi_canton').val(), 'adi_provincia':$('#adi_provincia').val()};
    $.ajax({
      url: '../../beans/manejoSistema/putGetParroquia.php',
      type: 'POST',
      dataType: 'html',
      data:$params,
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("select#adi_parroquia").empty().prepend(result.rpta);
            break;
          case "saveError":
            console.log("Error al obtener los Items");
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
                $("span#idCodErrorGeneral").empty().prepend("1404");
                $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
});