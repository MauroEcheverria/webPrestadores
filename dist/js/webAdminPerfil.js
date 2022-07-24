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
      if (result.data_count == 0) {
        $('#tipo_form').val("New");
      }
      else {
        $('#tipo_form').val("Old");
        $('#adi_direccion').val(result.data_row["adi_direccion"]);
      }
      $("select#adi_provincia").empty().prepend(result.rpta);
      $("#adi_provincia").val("").trigger("change");
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