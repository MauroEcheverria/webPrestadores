function renderizarProductoServicio() {
  $.ajax({
    url: '../../beans/POSTransacciones/obtenerDataProductoServicio.php',
    type: 'POST',
    dataType: 'html',
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
              inactivarProductoServicio($('#'+idClicked+' span').text());
            });
            $('.fdt_cantidad_tbl').change(function() {
              var idClicked = this.id;
              idProdServ = idClicked.split("_");
              actualizarProductoServicio(idProdServ[1],$("#"+idClicked).val());
            });
            $('#transPanel_3').fadeIn();
          }
          else {
            $('#transPanel_3').fadeOut();
          }
          break;
        default:
          alert("Error al realizar la transacción solicitada.");
          break;
      }
    }
  });
}
function actualizarProductoServicio(fdt_id_factura_detalle,fdt_cantidad_tbl) {
  $.ajax({
    url: '../../beans/POSTransacciones/actualizarProductoServicio.php',
    type: 'POST',
    dataType: 'html',
    data: { 
      'fdt_id_factura_detalle' : fdt_id_factura_detalle, 
      'fdt_cantidad_tbl' : fdt_cantidad_tbl},
    success: function(result){
      var result = eval('('+result+')');
      switch (result.message) {
        case "saveOK":
          renderizarProductoServicio();
          break;
        default:
          alert("Error al realizar la transacción solicitada.");
          break;
      }
    }
  });
}
function inactivarProductoServicio(fdt_id_factura_detalle) {
  $.ajax({
    url: '../../beans/POSTransacciones/inactivarProductoServicio.php',
    type: 'POST',
    dataType: 'html',
    data: { 'fdt_id_factura_detalle' : fdt_id_factura_detalle },
    success: function(result){
      var result = eval('('+result+')');
      switch (result.message) {
        case "saveOK":
          renderizarProductoServicio();
          break;
        default:
          alert("Error al realizar la transacción solicitada.");
          break;
      }
    }
  });
}
function focusAnimado (idElemento) {
  setParentTransition('#'+idElemento, 'all', '0s', 'ease', function() {
      $('#'+idElemento).addClass('citaSeleccionada');
  });
  setTimeout(function() {
      setParentTransition('#'+idElemento, 'all', '1s', 'ease', function() {
          $('#'+idElemento).removeClass('citaSeleccionada');
      });
  }); 
  $('#'+idElemento).focus().focusout();
}
function setParentTransition(id, prop, delay, style, callback) {
  $(id).css({'-webkit-transition' : prop + ' ' + delay + ' ' + style});
  $(id).css({'-moz-transition' : prop + ' ' + delay + ' ' + style});
  $(id).css({'-o-transition' : prop + ' ' + delay + ' ' + style});
  $(id).css({'transition' : prop + ' ' + delay + ' ' + style});
  callback();
}
function obtenerDatosCliente(cli_identificacion) {
  if ( cli_identificacion != "") {
    $.ajax({
      url: '../../beans/POSTransacciones/obtenerDatosClientes.php',
      type: 'POST',
      data:{ 'cli_identificacion' : cli_identificacion },
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        $('#transPanel_2').fadeOut();
        if (result.msmData == "siData" && result.message == "saveOK") {
          $('#transPanel_2').fadeIn();
          //$("#dataTipoIdentifica").empty().prepend("("+result.data_row.cli_tipo_identificacion+")");
          $("#dataCliIdentificacion").empty().prepend(result.data_row.cli_identificacion);
          $("#dataCliNombres").empty().prepend(result.data_row.cli_nombres);
          $("#dataCliCorreo").empty().prepend(result.data_row.cli_correo);
          $("#dataCliDireccion").empty().prepend(result.data_row.cli_direccion);
          $("#dataCliTelefono").empty().prepend(result.data_row.cli_telefono);
          $("#dataCliPlaca").empty().prepend(result.data_row.cli_placa);
        }
        else if (result.msmData == "noData") {
          $('#myConfirmarClienteNoRegistrado').modal('show');
        }
        else {
          $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
          $('#myModalErrorGeneral').modal('show');
        }
      }
    });
  }
  else {
    toastr.warning('Debe ingresar un número de identificación.',null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
  }
}
$(document).ready(function() {

  $(".select2").select2({
    maximumSelectionLength: 20
  });

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
      url: '../../beans/POSTransacciones/verificarFacturaCabecera.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        $("#ftr_id_forma_pago").empty().prepend(result.formas_pago);
        $("#cli_tipo_identificacion").empty().prepend(result.tipo_identificacion);
        $("#prs_id_prod_serv").empty().prepend(result.productos_servicios);
        $('#transPanel_2').fadeOut();
        switch (result.message) {
          case "si_transaccion":
            renderizarProductoServicio();
            if (result.data_row.cli_identificacion != null) {
              $('#transPanel_2').fadeIn();
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
            $('#transPanel_1').fadeIn();
            $('#btnPosNuevaFactura').prop("disabled",true);
            $('#cli_identificacion').prop("disabled",false);
            $('#ftr_id_forma_pago').prop("disabled",false);
            $('#btn_cli_identificacion').prop("disabled",false);
            $('#prs_id_prod_serv').prop("disabled",false);
            break;
          case "no_transaccion":
            $('#transPanel_1').fadeOut();
            $('#btnPosNuevaFactura').prop("disabled",false);
            $('#cli_identificacion').prop("disabled",true);
            $('#btn_cli_identificacion').prop("disabled",true);
            $('#ftr_id_forma_pago').prop("disabled",true);
            $('#prs_id_prod_serv').prop("disabled",true);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
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
  $('#formPOSTransGenerarFactura').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      var val_identificacion = 0;
      var val_forma_pago = 0;
      if ($('#cli_identificacion').val() != "") {
        val_identificacion = 1;
      }
      else {
        toastr.warning('Debe ingresar un número de identificación.',null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
      }
      if ($('#ftr_id_forma_pago').val() != "") {
        val_forma_pago = 1;
      }
      else {
        toastr.warning('Debe seleccionar un tipo de forma de pago.',null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
      }
      if ( val_identificacion == 1 && val_forma_pago == 1 ) {
        $.ajax({
          url: '../../beans/POSTransacciones/guardarPOSTransGenerarFactura.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formPOSTransGenerarFactura").serialize()+"&cli_identificacion="+$('#cli_identificacion').val()+"&ftr_id_forma_pago="+$('#ftr_id_forma_pago').val(),
          success: function(result){
          var result = eval('('+result+')');
            switch (result.message) {
              case "saveOK":
                $('#myModalRegistroTransacciones').modal('show');
                $("#dataPOSTransacciones").empty().prepend("");
                $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea registro de transacción en base de datos.</div>" );
                $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea archivo XML.</div>" );
                obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_xml);
                break;
              case "noPoseeFirma":
                $('#myModalRegistroTransacciones').modal('show');
                $("#dataPOSTransacciones").empty().prepend("");
                $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>No posee una firma electrónica registrada en el sistema.</div>" );
                break; 
              case "saveDbError":
                $('#myModalRegistroTransacciones').modal('show');
                $("#dataPOSTransacciones").empty().prepend("");
                $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al guardar registro en base de datos.</div>" );
                break;
              case "saveXmlError":
                $('#myModalRegistroTransacciones').modal('show');
                $("#dataPOSTransacciones").empty().prepend("");
                $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al generar archivo XML.</div>" );
                break;
              case "token_csrf_error":
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              default:
                
                break;
            }
          }
        });
      }
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
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea registro de transacción en base de datos.</div>" );
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea archivo XML.</div>" );
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_xml);
              break;
            case "noPoseeFirma":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>No posee una firma electrónica registrada en el sistema.</div>" );
              break; 
            case "saveDbError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al guardar registro en base de datos.</div>" );
              break;
            case "saveXmlError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al generar archivo XML.</div>" );
              break;
            case "token_csrf_error":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              
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
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea registro de transacción en base de datos.</div>" );
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea archivo XML.</div>" );
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_xml);
              break;
            case "noPoseeFirma":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>No posee una firma electrónica registrada en el sistema.</div>" );
              break; 
            case "saveDbError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al guardar registro en base de datos.</div>" );
              break;
            case "saveXmlError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al generar archivo XML.</div>" );
              break;
            case "token_csrf_error":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              
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
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea registro de transacción en base de datos.</div>" );
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea archivo XML.</div>" );
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_xml);
              break;
            case "noPoseeFirma":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>No posee una firma electrónica registrada en el sistema.</div>" );
              break; 
            case "saveDbError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al guardar registro en base de datos.</div>" );
              break;
            case "saveXmlError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al generar archivo XML.</div>" );
              break;
            case "token_csrf_error":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              
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
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea registro de transacción en base de datos.</div>" );
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se crea archivo XML.</div>" );
              obtenerComprobanteFirmadoSRI(result.clave_acceso_sri,result.ruta_certificado,result.contrasenia_archivo,result.ruta_xml);
              break;
            case "noPoseeFirma":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>No posee una firma electrónica registrada en el sistema.</div>" );
              break; 
            case "saveDbError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al guardar registro en base de datos.</div>" );
              break;
            case "saveXmlError":
              $('#myModalRegistroTransacciones').modal('show');
              $("#dataPOSTransacciones").empty().prepend("");
              $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Error al generar archivo XML.</div>" );
              break;
            case "token_csrf_error":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              
              break;
          }
        }
      });
    }
  });
  var dtEstadoTransaccion = $('#dtEstadoTransaccion').DataTable( {
    bRetrive: true,
    processing: true,
    serverSide: false,
    bDestroy: true,
    responsive: false,
    paging: true,
    searching: true,
    scrollX: true,
    aoColumnDefs: [
      { 
        sClass: "centrarContent", 
        aTargets: [0]
      },
      {
        "targets": [0,1],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">cla_id_clave_acceso</div>' },
      { title: '<div class="tituloColumnasDT">cla_sri_clave_acceso</div>' },
      { title: '<div class="tituloColumnasDT">RUC</div>' },
      { title: '<div class="tituloColumnasDT">Empres</div>' },
      { title: '<div class="tituloColumnasDT">Identificación</div>' },
      { title: '<div class="tituloColumnasDT">Nombre</div>' },
      { title: '<div class="tituloColumnasDT">Fecha Creación</div>' },
      { title: '<div class="tituloColumnasDT">Comprobante</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="icondtEstadoTransaccionModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          acciones += '<span class="iconDTsep">|</span>';
          acciones += '<a class="icondtEstadoTransaccionResetear cursorPointerDT" title="Resetear contraseña"><i class="fas fa-sync iconDTicon"></i></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/POSTransacciones/obtenerClaveAcceso.php',
      type: "post",
      data: function ( d ) {
        d.trans_desde_hasta = $('#trans_desde_hasta').val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      /*if ( data[5] == 1 ) {
        $('td', row).eq(5).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }*/
    }
  });
  $('#btnPosNuevaFactura').click( function () {
    $.ajax({
      url: '../../beans/POSTransacciones/generarFacturaCabecera.php',
      type: 'POST',
      data:{ 'csrf' : $("#csrf").val() },
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            toastr.success('Cabecera de comprobante creada exitosamente.',null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
            $('#cli_identificacion').prop("disabled",false);
            $('#btn_cli_identificacion').prop("disabled",false);
            $('#ftr_id_forma_pago').prop("disabled",false);
            $('#prs_id_prod_serv').prop("disabled",false);
            $('#btnPosNuevaFactura').prop("disabled",true);
            $('#transPanel_1').fadeIn();
            break;
          case "token_csrf_error":
          case "fact_transaccion_registrada":
            modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#btn_cli_identificacion').click( function () {
    obtenerDatosCliente($("#cli_identificacion").val());
  });
  $('#cli_identificacion').change( function () {
    obtenerDatosCliente($("#cli_identificacion").val());
  });
  $('#idConsumidorFinal').click( function (e) {
    e.preventDefault();
    $.ajax({
      url: '../../beans/POSTransacciones/obtenerDatosClientes.php',
      type: 'POST',
      data:{ 'cli_identificacion' : "9999999999999" },
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        $('#transPanel_2').fadeOut();
        if (result.msmData == "siData" && result.message == "saveOK") {
          $('#transPanel_2').fadeIn();
          $("#cli_identificacion").val("9999999999999");
          $("#dataCliIdentificacion").empty().prepend(result.data_row.cli_identificacion);
          $("#dataCliNombres").empty().prepend(result.data_row.cli_nombres);
          $("#dataCliCorreo").empty().prepend(result.data_row.cli_correo);
          $("#dataCliDireccion").empty().prepend(result.data_row.cli_direccion);
          $("#dataCliTelefono").empty().prepend(result.data_row.cli_telefono);
          $("#dataCliPlaca").empty().prepend(result.data_row.cli_placa);
        }
        else if (result.msmData == "noData") {
          $('#myConfirmarClienteNoRegistrado').modal('show');
        }
        else {
          $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
          $('#myModalErrorGeneral').modal('show');
        }
      }
    });
  });
  var testOcultarModalCliente = 0;
  $('#btnConfirmarClienteNoRegistrado').click( function () {
    $('#myConfirmarClienteNoRegistrado').modal('hide');
    testOcultarModalCliente = 1;
    $("#myConfirmarClienteNoRegistrado").on("hidden.bs.modal",function(){
      if (testOcultarModalCliente == 1) {
        document.getElementById("formClienteNoRegistrado").reset();
        $('#cli_identificacion_form').val( $('#cli_identificacion').val());
        $('#myModalClienteNoRegistrado').modal('show');
        testOcultarModalCliente = 0;
      }
    });
  });
  $('#btnNoRegistrarClienteNoRegistrado').click( function () {
    $('#cli_identificacion').val("");
    $('#myConfirmarClienteNoRegistrado').modal('hide');
  });
  $('#ftr_id_forma_pago').change( function () {
    if ($("#ftr_id_forma_pago").val() != "") {
      $.ajax({
        url: '../../beans/POSTransacciones/registrarFormaPago.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'ftr_id_forma_pago' : $("#ftr_id_forma_pago").val() },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
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
  $('#formClienteNoRegistrado').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();

      var validacionIdentificacion = 0;
      switch ($('#cli_tipo_identificacion').val()) {
        case "04":
          
          break;
        case "05":
          
          break;
        case "06":
          
          break;
        case "08":
          
          break;
        default:
          
          break;
      }

      if (validacionIdentificacion == 0) {
        $.ajax({
          url: '../../beans/POSTransacciones/guardarClienteNoRegistrado.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formClienteNoRegistrado").serialize(),
          success: function(result){
          var result = eval('('+result+')');
            $('#myModalClienteNoRegistrado').modal('hide');
            $('#transPanel_2').fadeIn();
            switch (result.message) {
              case "saveOK":
                $('#transPanel_2').fadeIn();
                //$("#dataTipoIdentifica").empty().prepend("("+result.data_row.cli_tipo_identificacion+")");
                $("#dataCliIdentificacion").empty().prepend(result.data_row.cli_identificacion);
                $("#dataCliNombres").empty().prepend(result.data_row.cli_nombres);
                $("#dataCliCorreo").empty().prepend(result.data_row.cli_correo);
                $("#dataCliDireccion").empty().prepend(result.data_row.cli_direccion);
                $("#dataCliTelefono").empty().prepend(result.data_row.cli_telefono);
                $("#dataCliPlaca").empty().prepend(result.data_row.cli_placa);
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                 break;
              case "token_csrf_error":
                  modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              case "errorCriterios":
                  /* OJO NO QUITAR ESTE ALERT - YA ESTA CORREGIDO ORTOGRAFIA */
                  alert("De cumplir con todos los criterios de los campos solicitados.");
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
        alert("La cantidad de dígitos ingresados según el tipo de identificación es inválida. Favor revisar.");
      }

    }
  });
  $('#cli_identificacion_form').change( function () {
    if ($("#cli_identificacion_form").val() != "") {
      $.ajax({
        url: '../../beans/POSTransacciones/validarCedula.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'cli_identificacion_form' : $("#cli_identificacion_form").val() },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              break;
            case "userError":
              $("#cli_identificacion_form").val("").focus();
              $("#loginUsuarioRegistrado").show();
              ocultarPoppupAlert();
              return false;
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
  $('#cli_correo').change( function () {
    if ($("#cli_correo").val() != "") {
      $.ajax({
        url: '../../beans/POSTransacciones/validarCorreo.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'cli_correo' : $("#cli_correo").val() },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              break;
            case "userError":
              $("#cli_correo").val("").focus();
              $("#loginCorreoRegistrado").show();
              ocultarPoppupAlert();
              return false;
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
  $('#formItemComprobante').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/POSTransacciones/guardarItemComprobante.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formItemComprobante").serialize(),
        success: function(result){
          var result = eval('('+result+')');
          $("#prs_id_prod_serv").val("").trigger("change");
          document.getElementById("formItemComprobante").reset();
          $('#transPanel_3').fadeOut();
          switch (result.message) {
            case "saveOK":
              renderizarProductoServicio();
              $('#transPanel_3').fadeIn();
              break;
            case "itemRegistrado":
              $('#transPanel_3').fadeIn();
              focusAnimado("itemCant_"+result.id_item);
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
  $('#btnPosDescartarItems').click( function (e) {
    e.preventDefault();
    $('#myConfirmarDescartarItems').modal('show');
  });
  $('#btnConfirmarDescartarItems').click( function (e) {
    e.preventDefault();
    $.ajax({
      url: '../../beans/POSTransacciones/inactivarProductoServicioTodos.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            renderizarProductoServicio();
            $('#myConfirmarDescartarItems').modal('hide');
            break;
          default:
            alert("Error al realizar la transacción solicitada.");
            break;
        }
      }
    });
  });
  $('#btnEnviarPago').click( function (e) {
    e.preventDefault();
    $('#btnSubmitEnviarPago').click();
  });
});