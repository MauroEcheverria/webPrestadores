function fnContenidoFirmaEC () {
  $.ajax({
    url: '../../beans/manejoFirmaEC/obtenerContenidoFirmaEC.php',
    type: 'POST',
    dataType: 'html',
    success: function(result){
      var result = eval('('+result+')');
      switch (result.message) {
        case "saveOK":
          $("#idContenidoFirmaEC").empty().prepend(result.contenidoFirmaEC);
          break;
        default:
          $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
          $('#myModalErrorGeneral').modal('show');
          break;
      }
    }
  });
}
$(document).ready(function() {
	$('#formCargaArchivoEmpresa').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      var formData = new FormData(this);
      var files = $('#em_archivo_fact_elec')[0].files;
      if(files.length > 0 ){
        formData.append('em_archivo_fact_elec',files[0]);
        formData.append('em_pass_fct_elec',$('#em_pass_fct_elec').val());
        $.ajax({
          url: '../../beans/manejoFirmaEC/cargaArchivoEmpresa.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(result){
            var result = eval('('+result+')');
            document.getElementById("formCargaArchivoEmpresa").reset();
            $('.custom-file-input').next('.form-control-file').addClass("selected").html("");
            $('#myModalSistemaEmpresaArchivo').modal('hide');
            switch (result.message) {
              case "saveOK":
              case "saveError":
              case "extNoPermitida":
              case "tamanoNoPermitida":
              case "noExisteArhivo":
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              default:
                $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
                $('#myModalErrorGeneral').modal('show');
                break;
            }
          },
       });
      }
      else{
        alert("Debe seleccionar un archivo para poder continuar.");
      }
    }
  });
  $('#em_archivo_fact_elec').change( function () {
    if ($("#em_archivo_fact_elec").val() != "") {
      $('.custom-file-input').next('.form-control-file').addClass("selected").html($("#em_archivo_fact_elec").val());
    }
  });
  fnContenidoFirmaEC();
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#idTogglable_1") {
      fnContenidoFirmaEC();
    }
  });
});