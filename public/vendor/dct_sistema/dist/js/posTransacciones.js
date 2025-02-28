function renderizarProductoServicio() {
  $.ajax({
    url: $("#obtenerDataProductoServicio").val(),
    type: 'POST',
    dataType: 'html',
    data:{ _token:$("#getTokenRender").val() },
    success: function(result){
      var result = eval('('+result+')');
      switch (result.message) {
        case "saveOK":
          if (result.pos_cant_item >= 1) {
              $("#idTablaProductoServicio").empty().prepend(result.data_tabla);
              $("#pos_total_comprobante_1,#pos_total_comprobante_2").empty().prepend(result.pos_total_comprobante);
              $("#pos_porcentaje_iva").empty().prepend(result.pos_porcentaje_iva);
              $("#pos_base_imp_diff").empty().prepend(result.pos_base_imp_diff);
              $("#pos_base_imp_iva_0").empty().prepend(result.pos_base_imp_iva_0);
              $("#pos_base_imp_iva_no_sujeto").empty().prepend(result.pos_base_imp_iva_no_sujeto);
              $("#pos_base_imp_iva_exento").empty().prepend(result.pos_base_imp_iva_exento);
              $("#pos_total_descuento").empty().prepend(result.pos_total_descuento);
              $("#pos_total_sub_total").empty().prepend(result.pos_total_sub_total);
              $("#pos_total_iva").empty().prepend(result.pos_total_iva);
              $("#pos_total_ice").empty().prepend(result.pos_total_ice);
              $("#pos_total_irbpnr").empty().prepend(result.pos_total_irbpnr);
              $('.refDetalleItemProceso').click(function() {
              var idClicked = this.id;
              alert("Se visualizará el detalle del Ítem: "+idClicked);
            });
            $('.refDescartarItemProceso').click(function() {
              var idClicked = this.id;
              //inactivarProductoServicio($('#'+idClicked+' span').text());
            });
            $('.fdt_cantidad_tbl').change(function() {
              var idClicked = this.id;
              idProdServ = idClicked.split("_");
              //actualizarProductoServicio(idProdServ[1],$("#"+idClicked).val());
            });
            $('#transPanel_3').removeClass('dct_main');
          }
          else {
            $('#transPanel_3').addClass('dct_main');
          }
          break;
        default:
          toastrMostarError("PF_1");
          break;
      }
    }
  });
}
document.addEventListener('DOMContentLoaded', function() {
  $(".select2").select2({ maximumSelectionLength: 20 });
  $('#cli_identificacion').keypress(function(e){
    if( e.which == 13 ){
      if( $('#cli_identificacion').val() != "" ){
        if( $('#cli_identificacion').val().length >= 8 ){
          $('#btn_cli_identificacion').click();
        }
        else {
          toastr.warning('El número ingresado debe contener más de 8 dígitos.',null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
        }
      }
      else {
        toastr.warning('Debe ingresar un número de identificación.',null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
      }
    }
  });
  if($('div#appTransaccionesFlag').hasClass('appTransaccionesFlag')) {
    $("body").addClass('sidebar-collapse');
    $.ajax({
      url: $("#verificarFacturaCabecera").val(),
      type: 'POST',
      dataType: 'html',
      data:{ _token:$("#getTokenRender").val() },
      success: function(result){
        var result = eval('('+result+')');
        $("#ftr_id_forma_pago").empty().prepend(result.formas_pago);
        $("#cli_tipo_identificacion").empty().prepend(result.tipo_identificacion);
        $("#prs_id_prod_serv").empty().prepend(result.productos_servicios);
        $('#transPanel_2').addClass('dct_main');
        switch (result.message) {
          case "si_transaccion":
            renderizarProductoServicio();
            if (result.data_row.cli_identificacion != null) {
              $('#transPanel_2').removeClass('dct_main');
              //$("#dataTipoIdentifica").empty().prepend("("+result.data_row.cli_tipo_identificacion+")");
              $("#dataCliIdentificacion").empty().prepend(result.data_row.cli_identificacion);
              $("#dataCliNombres").empty().prepend(result.data_row.cli_nombres);
              $("#dataCliCorreo").empty().prepend(result.data_row.cli_correo);
              $("#dataCliDireccion").empty().prepend(result.data_row.cli_direccion);
              $("#dataCliTelefono").empty().prepend(result.data_row.cli_telefono);
              $("#dataCliPlaca").empty().prepend(result.data_row.cli_placa);
              $('#cli_identificacion').val(result.data_row.cli_identificacion);
              $('#ftr_id_forma_pago').val(result.data_row.ftr_id_forma_pago);
            }
            $('#transPanel_1').removeClass('dct_main');
            $('#btnPosNuevaFactura').prop("disabled",true);
            $('#cli_identificacion').prop("disabled",false);
            $('#ftr_id_forma_pago').prop("disabled",false);
            $('#btn_cli_identificacion').prop("disabled",false);
            $('#prs_id_prod_serv').prop("disabled",false);
            toastrSuccess("Se registra una transacción en proceso. ✅");
            break;
          case "no_transaccion":
            $('#transPanel_1').addClass('dct_main');
            $('#transPanel_3').addClass('dct_main');
            $('#btnPosNuevaFactura').prop("disabled",false);
            $('#cli_identificacion').prop("disabled",true);
            $('#btn_cli_identificacion').prop("disabled",true);
            $('#ftr_id_forma_pago').prop("disabled",true);
            $('#prs_id_prod_serv').prop("disabled",true);
            toastrWarning("No se detecta ninguna transacción.");
            break;
          default:
            toastrMostarError("PF_2");
            break;
        }
      }
    });
  }
  $('#trans_desde_hasta').daterangepicker({ 
    "showDropdowns": true,
    "dateLimit": {
      "days": 60
    },
    "locale": {
      "format": "YYYY/MM/DD",
      "separator": " - ",
      "applyLabel": "Consultar",
      "cancelLabel": "Cancelar",
      "fromLabel": "De",
      "toLabel": "Hacia",
      "customRangeLabel": "Personalizado",
      "weekLabel": "S",
      "daysOfWeek": [
          "Do",
          "Lu",
          "Ma",
          "Mi",
          "Ju",
          "Vi",
          "Sá"
      ],
      "monthNames": [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre"
      ],
      "firstDay": 1
    },
    "startDate": moment().format('YYYY-MM-DD'),
    "endDate": (moment().subtract(30,'days')).format('YYYY-MM-DD'),
    "alwaysShowCalendars": true,
    "timePicker": false,
    "timePickerIncrement": 30,
    "timePicker24Hour": true,
    "opens": "center",
    "applyClass": "btn-primary",
    "cancelClass": "btn-danger"
  });
  $('#trans_desde_hasta').val((moment().subtract(30,'days')).format('YYYY-MM-DD')+" - "+moment().format('YYYY-MM-DD'));
  $('#btnPosNuevaFactura').click( function () {
    $.ajax({
      url: $("#generarFacturaCabecera").val(),
      type: 'POST',
      dataType: 'html',
      data:{ _token:$("#getTokenRender").val() },
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            toastrSuccess("Cabecera de comprobante creada exitosamente. ✅");
            $('#cli_identificacion').prop("disabled",false);
            $('#btn_cli_identificacion').prop("disabled",false);
            $('#ftr_id_forma_pago').prop("disabled",false);
            $('#prs_id_prod_serv').prop("disabled",false);
            $('#btnPosNuevaFactura').prop("disabled",true);
            $('#transPanel_1').fadeIn();
            break;
          case "fact_transaccion_registrada":
            toastrWarning("Se detecta una transacción iniciada. Favor refresque la página WEB");
            break;
          default:
            toastrMostarError("PF_3");
            break;
        }
      }
    });
  });
})