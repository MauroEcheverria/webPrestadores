function fnSistemaEstablecimiento() {
  window.dtSistemaEstablecimiento = $('#dtSistemaEstablecimiento').DataTable( {
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
      { title: '<div class="tituloColumnasDT">est_id_empresa_establecimiento</div>' },
      { title: '<div class="tituloColumnasDT">emp_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Código</div>' },
      { title: '<div class="tituloColumnasDT">Dirección</div>' },
      { title: '<div class="tituloColumnasDT">Nombre de Establecimiento</div>' },
      { title: '<div class="tituloColumnasDT">Matriz</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaEstablecimientoModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/POSAdministracion/obtenerSistemaEstablecimiento.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    
    createdRow: function ( row, data, index ) {
      if ( data[7] == 1 ) {
        $('td', row).eq(5).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      else{
          $('td', row).eq(5).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
      
      if ( data[6] == 1 ) {
        $('td', row).eq(4).html("<div align='center'><div style='display:none;'>1</div><img id='estMatriz' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      else{
          $('td', row).eq(4).html("<div align='center'><div style='display:none;'>0</div></div>");
      }
    }
    
  });
}

function fnPuntosEmision() {
  window.dtPuntosEmision = $('#dtPuntosEmision').DataTable( {
    bRetrive: true,
    processing: true,
    serverSide: false,
    bDestroy: true,
    responsive: true,
    paging: true,
    searching: true,
    scrollX: true,
    aoColumnDefs: [
      { 
        sClass: "centrarContent", 
        aTargets: [2,3,4,5,6,7]
      },
      {
        //"targets": [0,9],
        "targets": [0,1,2],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">epe_id_empresa_punto_emision</div>' },
      { title: '<div class="tituloColumnasDT">epe_id_empresa_establecimiento</div>' },
      { title: '<div class="tituloColumnasDT">emp_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Establecimiento</div>' },
      { title: '<div class="tituloColumnasDT">Punto Emision</div>' },
      { title: '<div class="tituloColumnasDT">Código</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaEstablecimientoModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones;
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/POSAdministracion/obtenerPuntosEmision.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    
    createdRow: function ( row, data, index ) {
      if ( data[7] == 1 ) {
        $('td', row).eq(4).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      else{
          $('td', row).eq(4).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
    
  });
}

if($('div#appAdministrarEstablecimiento').hasClass('appAdministrarEstablecimiento')) {
    fnSistemaEstablecimiento();
}

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#idTogglable_1") {
      fnSistemaEstablecimiento();
    }
    if (target == "#idTogglable_2") {
      fnPuntosEmision();
    }
  });

$('#btnNuevoEstablecimiento').click( function () {
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerEmpresas.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $('#tipo_form_est').val("New");
            $("#slcEmpresa").empty().prepend(result.catag);
            $('#slcEmpresa').val("");
            $('#myModalEstablecimiento').modal('show');
            document.getElementById("formEstablecimiento").reset();
            $(".empCamposNoEditables").attr("disabled",false);
            $(".camposVisibles").hide().attr("required",false);
            break;
          case "error_negocio":
              //dtSistemaEstablecimiento.ajax.reload();
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
  
$('#btnNuevoPtoEmision').click( function () {
    $("#slcEstablecimiento").empty();
            
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerEmpresas.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $('#tipo_form_pe').val("New");
            $("#slcEmpresaPe").empty().prepend(result.catag);
            $('#slcEmpresaPe').val("");
            $('#myModalPuntoEmision').modal('show');
            document.getElementById("frmPuntoEmision").reset();
            $(".empCamposNoEditables").attr("disabled",false);
            $(".camposVisibles").hide().attr("required",false);
            break;
          case "error_negocio":
              //dtSistemaEstablecimiento.ajax.reload();
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
  
$('#slcEmpresaPe').change( function () {
    $("#slcEstablecimiento").empty();
    
    if ($('#slcEmpresaPe').val()=="")
            return;

    $.ajax({
      url: '../../beans/POSAdministracion/cargarSelectEstablecimientos.php',
      type: 'POST',
      data:"slcEmpresaPe="+$('#slcEmpresaPe').val(),
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcEstablecimiento").empty().prepend(result.catag);
            $('#slcEstablecimiento').val("");
            break;
          case "error_negocio":
              //dtSistemaEstablecimiento.ajax.reload();
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
  
  $('#formEstablecimiento').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      
      var chkMatriz = $('#chkMatriz').is(":checked") ? 1 : 0;
      var myform = $('#formEstablecimiento');
      
      if ($('#tipo_form_est').val() == "Old") {
          var disabled = myform.find(':input:disabled').removeAttr('disabled');
          var serialized = myform.serialize();
          disabled.attr('disabled','disabled');
          
        $params = serialized+"&id_establecimiento="+temp_emp_id_establecimiento;
      }
      else {
        $params = myform.serialize();
      }
      $.ajax({
        url: '../../beans/POSAdministracion/guardarEstablecimiento.php',
        type: 'POST',
        dataType: 'html',
        data:$params+"&chkMatriz="+chkMatriz,
        success: function(result){
          var result = eval('('+result+')');
          if (result.message !== 'error_negocio') {
            $('#myModalEstablecimiento').modal('hide');
          }
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_est').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaEstablecimiento.ajax.reload();
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "error_negocio":
              //dtSistemaEstablecimiento.ajax.reload();
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
  
  $('#frmPuntoEmision').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      
      var myform = $('#frmPuntoEmision');
      
      if ($('#tipo_form_pe').val() == "Old") {
          var disabled = myform.find(':input:disabled').removeAttr('disabled');
          var serialized = myform.serialize();
          disabled.attr('disabled','disabled');
          
        $params = serialized+"&peIdPuntoEmision="+temp_peIdPuntoEmision;
      }
      else {
        $params = myform.serialize();
      }
      $.ajax({
        url: '../../beans/POSAdministracion/guardarPuntoEmision.php',
        type: 'POST',
        dataType: 'html',
        data:$params+"&chkMatriz="+chkMatriz,
        success: function(result){
          var result = eval('('+result+')');
          if (result.message !== 'error_negocio')
          {
              $('#myModalPuntoEmision').modal('hide');
          }
            
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_pe').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtPuntosEmision.ajax.reload();
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "error_negocio":
              //dtSistemaEstablecimiento.ajax.reload();
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
  
  $('#dtSistemaEstablecimiento').on('click','.iconDtSistemaEstablecimientoModificar', function (e) {
    e.preventDefault();
    window.temp_emp_id_establecimiento = dtSistemaEstablecimiento.row($(this).parents('tr').first()).data()[0];
    window.temp_emp_id_empresa = dtSistemaEstablecimiento.row($(this).parents('tr').first()).data()[1];
    $('#estCodigo').val(dtSistemaEstablecimiento.row($(this).parents('tr').first()).data()[3]);
    $('#estDireccion').val(dtSistemaEstablecimiento.row($(this).parents('tr').first()).data()[4]);
    $('#estNombre').val(dtSistemaEstablecimiento.row($(this).parents('tr').first()).data()[5]);
    
    $("#chkMatriz").prop("checked",(dtSistemaEstablecimiento.row($(this).parents('tr').first()).data()[6]) == 1 ? true : false);
    $('#slcEstado').val(dtSistemaEstablecimiento.row($(this).parents('tr').first()).data()[7]);

    $('#tipo_form_est').val("Old");
    $(".empCamposNoEditables").attr("disabled",true);
    $(".camposVisibles").show().attr("required",true);
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerEmpresas.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcEmpresa").empty().prepend(result.catag);
            $('#slcEmpresa').val(temp_emp_id_empresa);
            $('#myModalEstablecimiento').modal('show');
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });

  });
  
  $('#dtPuntosEmision').on('click','.iconDtSistemaEstablecimientoModificar', function (e) {
    e.preventDefault();
    window.temp_peIdPuntoEmision = dtPuntosEmision.row($(this).parents('tr').first()).data()[0];
    var peIdEstablecimiento = dtPuntosEmision.row($(this).parents('tr').first()).data()[1];
    var peIdEmpresa = dtPuntosEmision.row($(this).parents('tr').first()).data()[2];
    $('#peCodigo').val(dtPuntosEmision.row($(this).parents('tr').first()).data()[6]);
    $('#peDescripcion').val(dtPuntosEmision.row($(this).parents('tr').first()).data()[5]);
    
    $('#slcEstadoPe').val(dtPuntosEmision.row($(this).parents('tr').first()).data()[7]);

    $('#tipo_form_pe').val("Old");
    $(".empCamposNoEditables").attr("disabled",true);
    $(".camposVisibles").show().attr("required",true);
    
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerEmpresas.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcEmpresaPe").empty().prepend(result.catag);
            $('#slcEmpresaPe').val(peIdEmpresa);
            
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
    $.ajax({
      url: '../../beans/POSAdministracion/cargarSelectEstablecimientos.php',
      type: 'POST',
      dataType: 'html',
      data:"slcEmpresaPe="+peIdEmpresa,
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcEstablecimiento").empty().prepend(result.catag);
            $('#slcEstablecimiento').val(peIdEstablecimiento);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
    $('#myModalPuntoEmision').modal('show');

  });
  
  
$(document).ready(function() { //----------------------- Ini Ready function ------------------------------------------
 //fnPuntosEmision();
}); //----------------------- Fin Ready function ------------------------------------------