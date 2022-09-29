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
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Establecimiento</div>' },
      { title: '<div class="tituloColumnasDT">Punto Emisión</div>' },
      { title: '<div class="tituloColumnasDT">Código Usuario</div>' },
      { title: '<div class="tituloColumnasDT">Usuario</div>' },
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

function cargarSelectEmpresas(){
    
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerEmpresas.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $('#tipo_form_vinc').val("New");
            $(".slcEmpresa").empty().prepend(result.catag);
            $('.slcEmpresa').val("");
            break;
          case "error_negocio":
              //dtProductos.ajax.reload();
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


$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#tabVinculacion") {
      fnDtVinculaciones();
    }
  });
  
 $('#btnNuevaVinculacion').click( function () {
    $('#myModalVinculacion').modal('show');
    document.getElementById("frmVinculacion").reset();
    $(".empCamposNoEditables").attr("disabled",false);
    $(".camposVisibles").hide().attr("required",false);
    $('#tipo_form_vinc').val("New");
            
  });

$("#slcEmpresaF").change( function () {
    dtProductos.ajax.reload();
  });


