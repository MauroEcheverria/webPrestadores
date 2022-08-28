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
        aTargets: [1,2,3,4,5,6,7,8]
      },
      {
        //"targets": [0,9],
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

if($('div#appAdministrarEstablecimiento').hasClass('appAdministrarEstablecimiento')) {
    fnSistemaEstablecimiento();
}

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
            $(".empCamposNoEditables").attr("disabled","false");
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
          if (result.message !== 'error_negocio')
          {
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
    $(".empCamposNoEditables").attr("disabled","true");
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