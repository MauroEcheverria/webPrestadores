/* 
Author Joel Jalón
 */
function fnDtVinculaciones() {
  window.dtVinculaciones = $('#dtVinculaciones').DataTable( {
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
        aTargets: [1,2,3,4,5,6,7,8]
      },
      {
        //"targets": [0,9],
        "targets": [0,1,2,3],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">uep_id_usuario_epe</div>' },
      { title: '<div class="tituloColumnasDT">emp_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">est_id_empresa_establecimiento</div>' },
      { title: '<div class="tituloColumnasDT">epe_id_empresa_punto_emision</div>' },
      { title: '<div class="tituloColumnasDT">Código Usuario</div>' },
      { title: '<div class="tituloColumnasDT">Usuario</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Establecimiento</div>' },
      { title: '<div class="tituloColumnasDT">Punto Emisión</div>' },
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
      url:'../../beans/POSAdministracion/obtenerVinculaciones.php',
      type: "post",
      //dataType: 'html',
      data: function ( d ) {
        d.slcEmpresa = $('#slcEmpresaFVinc').val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    
    createdRow: function ( row, data, index ) {
      if ( data[9] == 1 ) {
        $('td', row).eq(5).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      else{
          $('td', row).eq(5).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }

    }
    
  });
}

function cargarSlcUsuarios(){
    
    $.ajax({
      url: '../../beans/POSAdministracion/cargarSelectUsuarios.php',
      type: 'POST',
      data:"slcEmpresaVinc="+$("#slcEmpresaVinc").val(),
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcUsuariosVinc").empty().prepend(result.catag);
            $('#slcUsuariosVinc').val("");
            break;
          case "error_negocio":
              //dtVinculaciones.ajax.reload();
              //modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              toastr.warning(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
              break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
    
}

function cargarSlcEstablecimientoVinc(){
    
    $.ajax({
      url: '../../beans/POSAdministracion/cargarSelectEstablecimientos.php',
      type: 'POST',
      data:"slcEmpresaPe="+$('#slcEmpresaVinc').val(),
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcEstablecimientoVinc").empty().prepend(result.catag);
            $('#slcEstablecimientoVinc').val("");
            break;
          case "error_negocio":
              //dtSistemaEstablecimiento.ajax.reload();
              toastr.warning(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
              break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
}

function cargarSlcPtosEmision(){
    
    $.ajax({
      url: '../../beans/POSAdministracion/cargarSelectPtosEmision.php',
      type: 'POST',
      data:"slcEmpresaPe="+$('#slcEmpresaVinc').val()+"&slcEstablecimiento="+$('#slcEstablecimientoVinc').val(),
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcPtoEmisionVinc").empty().prepend(result.catag);
            $('#slcPtoEmisionVinc').val("");
            break;
          case "error_negocio":
              //dtSistemaEstablecimiento.ajax.reload();
              toastr.warning(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
              break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
}



$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#tabVinculacion") {
      fnDtVinculaciones();
    }
  });
  
  $("#slcEmpresaFVinc").change( function () {
    dtVinculaciones.ajax.reload();
  });
  
 $('#btnNuevaVinculacion').click( function () {
    $('#myModalVinculacion').modal('show');
    $("#slcUsuariosVinc").empty();
    $("#slcEstablecimientoVinc").empty();
    $("#slcPtoEmisionVinc").empty();
    document.getElementById("frmVinculacion").reset();
    $(".empCamposNoEditables").attr("disabled",false);
    $(".camposVisibles").hide().attr("required",false);
    $('#tipo_form_vinc').val("New");
            
  });

  
$("#slcEmpresaVinc").change( function () {
    $("#slcUsuariosVinc").empty();
    $("#slcEstablecimientoVinc").empty();
    if ($("#slcEmpresaVinc").val() == null || $("#slcEmpresaVinc").val() == ""){
        return;
    }
    cargarSlcUsuarios();
    cargarSlcEstablecimientoVinc();
  });

$("#slcEstablecimientoVinc").change( function () {
    $("#slcPtoEmisionVinc").empty();
    if ($("#slcEstablecimientoVinc").val() == null || $("#slcEstablecimientoVinc").val() == ""){
        return;
    }
    cargarSlcPtosEmision();
  });
  
  $('#dtVinculaciones').on('click','.iconDtSistemaEstablecimientoModificar', function (e) {
    e.preventDefault();
    $('#tipo_form_vinc').val("Old");
    window.temp_uep_id_usuario_epe = dtVinculaciones.row($(this).parents('tr').first()).data()[0];
    
    $('#slcEmpresaVinc').val(dtVinculaciones.row($(this).parents('tr').first()).data()[1]);
    var slcUsr = dtVinculaciones.row($(this).parents('tr').first()).data()[4];
    var slcEstbl = dtVinculaciones.row($(this).parents('tr').first()).data()[2];
    var slcPtoEm = dtVinculaciones.row($(this).parents('tr').first()).data()[3];
    
    $.ajax({
      url: '../../beans/POSAdministracion/cargarSelectUsuarios.php',
      type: 'POST',
      data:"slcEmpresaVinc="+$("#slcEmpresaVinc").val(),
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcUsuariosVinc").empty().prepend(result.catag);
            $('#slcUsuariosVinc').val(slcUsr);
            break;
          case "error_negocio":
              toastr.warning(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
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
      data:"slcEmpresaPe="+$('#slcEmpresaVinc').val(),
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcEstablecimientoVinc").empty().prepend(result.catag);
            $('#slcEstablecimientoVinc').val(slcEstbl);
                $.ajax({
                    url: '../../beans/POSAdministracion/cargarSelectPtosEmision.php',
                    type: 'POST',
                    data:"slcEmpresaPe="+$('#slcEmpresaVinc').val()+"&slcEstablecimiento="+$('#slcEstablecimientoVinc').val(),
                    dataType: 'html',
                    success: function(result){
                      var result = eval('('+result+')');
                      switch (result.message) {
                        case "saveOK":
                          $("#slcPtoEmisionVinc").empty().prepend(result.catag);
                          $('#slcPtoEmisionVinc').val(slcPtoEm);
                          break;
                        case "error_negocio":
                            //dtSistemaEstablecimiento.ajax.reload();
                            toastr.warning(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
                            break;
                        default:
                          $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
                          $('#myModalErrorGeneral').modal('show');
                          break;
                      }
                    }
                  });
            break;
          case "error_negocio":
              toastr.warning(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
              break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
    
    $('#slcEstadoUsrVinc').val(dtVinculaciones.row($(this).parents('tr').first()).data()[9]);
    $(".empCamposNoEditables").attr("disabled",true);
    $(".camposVisibles").show().attr("required",true);
    
    $('#myModalVinculacion').modal('show');

  });

$('#frmVinculacion').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      
      var myform = $('#frmVinculacion');
      
      if ($('#tipo_form_vinc').val() == "Old") {
          var disabled = myform.find(':input:disabled').removeAttr('disabled');
          var serialized = myform.serialize();
          disabled.attr('disabled','disabled');
          
        $params = serialized+"&uep_id_usuario_epe="+temp_uep_id_usuario_epe;
      }
      else {
        $params = myform.serialize();
      }
      
      $.ajax({
        url: '../../beans/POSAdministracion/guardarVinculacion.php',
        type: 'POST',
        dataType: 'html',
        //data:$params+"&Impuestos="+JSON.stringify(arrayData),
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          if (result.message !== 'error_negocio')
          {
              $('#myModalVinculacion').modal('hide');
          }
            
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_vinc').val("Old");
              //toastr.success(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
              dtVinculaciones.ajax.reload();
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;  
            case "error_negocio":
              //modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              toastr.warning(result.dataModal_3,null,{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
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
  

$(document).ready(function() { //----------------------- Ini Ready function ------------------------------------------
 cargarSelectEmpresas();// ya viene en el js de productos
}); //----------------------- Fin Ready function ------------------------------------------