function fnProductos() {
  window.dtProductos = $('#dtProductos').DataTable( {
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
        "targets": [0,1,11,12,13,14,15,16,19,20,21,22],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">prs_id_prod_serv</div>' },
      { title: '<div class="tituloColumnasDT">emp_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Código Item</div>' },
      { title: '<div class="tituloColumnasDT">Código Auxiliar</div>' },
      { title: '<div class="tituloColumnasDT">Descripcion</div>' },
      { title: '<div class="tituloColumnasDT">Precio Unitario</div>' },
      { title: '<div class="tituloColumnasDT">IVA</div>' },
      { title: '<div class="tituloColumnasDT">ICE</div>' },
      { title: '<div class="tituloColumnasDT">IRBPNR</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { title: '<div class="tituloColumnasDT">prs_iva_cod_impuesto</div>' },
      { title: '<div class="tituloColumnasDT">prs_ice_cod_impuesto</div>' },
      { title: '<div class="tituloColumnasDT">prs_irbpnr_cod_impuesto</div>' },
      { title: '<div class="tituloColumnasDT">prs_iva_cod_tarifa</div>' },
      { title: '<div class="tituloColumnasDT">prs_ice_cod_tarifa</div>' },
      { title: '<div class="tituloColumnasDT">prs_irbpnr_cod_tarifa</div>' },
      { title: '<div class="tituloColumnasDT">Detalle adicional 1</div>' },
      { title: '<div class="tituloColumnasDT">valor</div>' },
      { title: '<div class="tituloColumnasDT">Detalle adicional 2</div>' },
      { title: '<div class="tituloColumnasDT">valor_2</div>' },
      { title: '<div class="tituloColumnasDT">Detalle adicional 3</div>' },
      { title: '<div class="tituloColumnasDT">valor_3</div>' },
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
      url:'../../beans/POSAdministracion/obtenerProductos.php',
      type: "post",
      //dataType: 'html',
      data: function ( d ) {
        d.slcEmpresa = $('#slcEmpresaF').val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    
    createdRow: function ( row, data, index ) {
      if ( data[10] == 1 ) {
        $('td', row).eq(8).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      else{
          $('td', row).eq(8).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
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
            $('#tipo_form_prod').val("New");
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

function cargarSlcImpuestos(){
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerImpuestos.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $('#tipo_form_prod').val("New");
            $("#slcImpuesto").empty().prepend(result.catag);
            $('#slcImpuesto').val("");
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

function cargarSlcTarifaImpuestos(){
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerTarifariosImpuestos.php',
      type: 'POST',
      data:"slcImpuesto="+$("#slcImpuesto").val(),
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#slcTarifaImpuesto").empty().prepend(result.catag);
            $('#slcTarifaImpuesto').val("");
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

function cargarSlcTarifaImpuestos(codigoImpuesto,idSelect){
    $.ajax({
      url: '../../beans/POSAdministracion/obtenerTarifariosImpuestos.php',
      type: 'POST',
      data:"slcImpuesto="+codigoImpuesto,
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#"+idSelect).empty().prepend(result.catag);
            $('#'+idSelect).val("");
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

function cargarSlcIva(){
    cargarSlcTarifaImpuestos(2,"slcIva");
}
function cargarSlcIce(){
    cargarSlcTarifaImpuestos(3,"slcIce");
}
function cargarSlcIbr(){
    cargarSlcTarifaImpuestos(5,"slcIbr");
}

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#idTogglable_3") {
      fnProductos();
    }
  });

$('#btnNuevoProducto').click( function () {
    $('#myModalProductos').modal('show');
    document.getElementById("frmProductos").reset();
    $(".empCamposNoEditables").attr("disabled",false);
    $(".camposVisibles").hide().attr("required",false);
    $('#tipo_form_prod').val("New");
            
  });

$("#slcEmpresaF").change( function () {
    dtProductos.ajax.reload();
  });

$("#slcImpuesto").change( function () {
    $("#slcTarifaImpuesto").empty();
    if ($("#slcImpuesto").val() == null || $("#slcImpuesto").val() == ""){
        return;
    }
    cargarSlcTarifaImpuestos();
  });
  
  $('#dtProductos').on('click','.iconDtSistemaEstablecimientoModificar', function (e) {
    e.preventDefault();
    window.idProdServ = dtProductos.row($(this).parents('tr').first()).data()[0];
    
    $('#slcEmpresaP').val(dtProductos.row($(this).parents('tr').first()).data()[1]);
    $('#pCodigoItem').val(dtProductos.row($(this).parents('tr').first()).data()[3]);
    $('#pCodigoAuxiliar').val(dtProductos.row($(this).parents('tr').first()).data()[4]);
    $('#pDescripcion').val(dtProductos.row($(this).parents('tr').first()).data()[5]);
    $('#pPrecioUnitario').val(dtProductos.row($(this).parents('tr').first()).data()[6]);
    $('#slcEstadoP').val(dtProductos.row($(this).parents('tr').first()).data()[10]);
    $('#slcIva').val(dtProductos.row($(this).parents('tr').first()).data()[14]);
    $('#slcIce').val(dtProductos.row($(this).parents('tr').first()).data()[15]);
    $('#slcIbr').val(dtProductos.row($(this).parents('tr').first()).data()[16]);
    

    $('#pDetalle1').val(dtProductos.row($(this).parents('tr').first()).data()[17]);
    $('#pDetalleValor1').val(dtProductos.row($(this).parents('tr').first()).data()[18]);
    $('#pDetalle2').val(dtProductos.row($(this).parents('tr').first()).data()[19]);
    $('#pDetalleValor2').val(dtProductos.row($(this).parents('tr').first()).data()[20]);
    $('#pDetalle3').val(dtProductos.row($(this).parents('tr').first()).data()[21]);
    $('#pDetalleValor3').val(dtProductos.row($(this).parents('tr').first()).data()[22]);
    
    
    $('#tipo_form_prod').val("Old");
    $(".empCamposNoEditables").attr("disabled",true);
    $(".camposVisibles").show().attr("required",true);
    
    $('#myModalProductos').modal('show');

  });

function agregarImpuesto()
{
    var registroOk = true;
    if (
            ($("#slcImpuesto").val()==null || $("#slcImpuesto").val()=="")
            ||
            ($("#slcTarifaImpuesto").val()==null || $("#slcTarifaImpuesto").val()=="")
            
            )
    {
        return;
    }

    var registros = dtImpuestos.rows().data();
    
    registros.each(function (valorArray) {
             if (valorArray[0] == $("#slcImpuesto").val())
             {
                modalGenerico('<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">',
                                'Información',
                                "El impuesto >>"+$("#slcImpuesto option:selected").text()+"<< \nya se encuentra agregado!.",
                                '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>'
                );
                registroOk=false; 
                return;
             }
             
         });
         
    if (!registroOk) return;
    
    var arrTarifaImp = $("#slcTarifaImpuesto option:selected").text().split("-");
    
    dtImpuestos.rows.add([
        [
            $("#slcImpuesto").val(),
            $("#slcTarifaImpuesto").val(),
            $("#slcImpuesto option:selected").text(),
            arrTarifaImp[0],
            arrTarifaImp[1]
        ]
    ])
    .draw();
}

window.dtImpuestos = $('#dtImpuestos').DataTable({
            searching: false,
            oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
            "columnDefs": [ {
                "targets": -1,
                "data": null,
                "defaultContent": '<a class="quitarRegistro" href="#" title="quitar registro"><img src="../../../dist/img/x-error.png" style="width: 17px;"></a>'
            },
            {
                 "targets": [0,1],
                 "visible": false,
                 "searchable": false
            }
            ],    
            paging: false,
            ordering: false,
            info: false,
//            data: [
//                ["env1","envase 1",3],
//                ["env2","envase 2",10]
//            ],
            columns: [
            { title: "codigo_impuesto" },
            { title: "codigo_tarifa" },
            { title: "impuesto" },
            { title: "tarifa" },
            { title: "descripcion" },
            { title: "" }
        ]
            
     });

//quitar impuesto
    $('#dtImpuestos tbody').on( 'click', '.quitarRegistro', function () {
        dtImpuestos.row($(this).parents('tr')).remove().draw();
    } );


$('#frmProductos').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      
      var myform = $('#frmProductos');
      
      /*
      var arrayImpuestos = dtImpuestos.rows().data();
      var arrayData = []; 
      var idx=0;
      if (arrayImpuestos != null && arrayImpuestos.length > 0)
         {
             arrayImpuestos.each(function(registro){
                 arrayData[idx] = {
                     "codImp" : registro[0],
                     "codTar" : registro[1]
                 }
                idx++;
            });
         }
         */
      
      if ($('#tipo_form_prod').val() == "Old") {
          var disabled = myform.find(':input:disabled').removeAttr('disabled');
          var serialized = myform.serialize();
          disabled.attr('disabled','disabled');
          
        $params = serialized+"&idProducto="+idProdServ;
      }
      else {
        $params = myform.serialize();
      }
      
      $.ajax({
        url: '../../beans/POSAdministracion/guardarProducto.php',
        type: 'POST',
        dataType: 'html',
        //data:$params+"&Impuestos="+JSON.stringify(arrayData),
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          if (result.message !== 'error_negocio')
          {
              $('#myModalProductos').modal('hide');
          }
            
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_prod').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtProductos.ajax.reload();
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
  
$(document).ready(function() { //----------------------- Ini Ready function ------------------------------------------
 cargarSelectEmpresas();
 //cargarSlcImpuestos();
 cargarSlcIva();
 cargarSlcIce();
 cargarSlcIbr();
}); //----------------------- Fin Ready function ------------------------------------------