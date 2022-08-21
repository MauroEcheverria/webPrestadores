function ocultarPaneles() {
  $("#btnTransFacturacion").removeClass('btn-success').addClass('btn-warning');
  $("#btnTransNotasCredito").removeClass('btn-success').addClass('btn-warning');
  $("#btnTransNotasDebito").removeClass('btn-success').addClass('btn-warning');
  $("#btnTransGuiRemision").removeClass('btn-success').addClass('btn-warning');
  $("#btnTransComprobanteRetencion").removeClass('btn-success').addClass('btn-warning');
  $("#btnTransEstadoTransaccion").removeClass('btn-success').addClass('btn-warning');
  $('#transFacturacion').fadeOut(0);
  $('#transNotasCredito').fadeOut(0);
  $('#transNotasDebito').fadeOut(0);
  $('#transGuiRemision').fadeOut(0);
  $('#transComprobanteRetencion').fadeOut(0);
  $('#transEstadoTransaccion').fadeOut(0);
}
$(document).ready(function() {
  if($('div#appTransaccionesFlag').hasClass('appTransaccionesFlag')) {
    $("body").addClass('sidebar-collapse');
    $.ajax({
      url: '../../beans/POSTransacciones/verificarFacturaCabecera.php',
      type: 'POST',
      data:{ 'csrf' : $("#csrf").val() },
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "si_transaccion":
            $('#cli_identificacion').prop("disabled",false);
            $('#btn_cli_identificacion').prop("disabled",false);
            $('#fop_id_forma_pago').prop("disabled",false);
            $('#prs_id_prod_serv').prop("disabled",false);
            break;
          case "no_transaccion":
            $('#cli_identificacion').prop("disabled",true);
            $('#btn_cli_identificacion').prop("disabled",true);
            $('#fop_id_forma_pago').prop("disabled",true);
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
      $.ajax({
        url: '../../beans/POSTransacciones/guardarPOSTransGenerarFactura.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formPOSTransGenerarFactura").serialize(),
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
        aTargets: [1,2,3,4,6,7,8,9]
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
        d.asdasdasd = $('#cli_identificacion').val()
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
            $('#cli_identificacion').prop("disabled",false);
            $('#btn_cli_identificacion').prop("disabled",false);
            $('#fop_id_forma_pago').prop("disabled",false);
            $('#prs_id_prod_serv').prop("disabled",false);
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
});