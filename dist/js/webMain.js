function fnSistemaEmpresa() {
  window.dtSistemaEmpresa = $('#dtSistemaEmpresa').DataTable( {
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
        aTargets: [1,3,4,5,6,7,8]
      },
      {
        "targets": [0,9],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">emp_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">RUC</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Vigencia Desde</div>' },
      { title: '<div class="tituloColumnasDT">Vigencia Hasta</div>' },
      { title: '<div class="tituloColumnasDT">Tipo Plan</div>' },
      { title: '<div class="tituloColumnasDT">Archivo Firma Electrónica</div>' },
      { title: '<div class="tituloColumnasDT">Estado </div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaEmpresaModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaEmpresa.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[7] == 1 ) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[7] == 0 ) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaRol() {
  window.dtSistemaRol = $('#dtSistemaRol').DataTable( {
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
        aTargets: [1,2,3]
      },
      {
        "targets": [0],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">apl_id_Rol</div>' },
      { title: '<div class="tituloColumnasDT">Rol</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaRolModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaRol.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[2] == 1 ) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[2] == 0 ) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaAplicacion() {
  window.dtSistemaAplicacion = $('#dtSistemaAplicacion').DataTable( {
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
        aTargets: [3,4,5,6,7,8]
      },
      {
        "targets": [0],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">apl_id_aplicacion</div>' },
      { title: '<div class="tituloColumnasDT">Aplicación</div>' },
      { title: '<div class="tituloColumnasDT">Ruta</div>' },
      { title: '<div class="tituloColumnasDT">Nombre Superior</div>' },
      { title: '<div class="tituloColumnasDT">Nombre Inferior</div>' },
      { title: '<div class="tituloColumnasDT">HTML </div>' },
      { title: '<div class="tituloColumnasDT">Imagen </div>' },
      { title: '<div class="tituloColumnasDT">Estado </div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaAplicacionModificar" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaAplicacion.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[7] == 1 ) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[7] == 0 ) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaOpcion() {
  window.dtSistemaOpcion = $('#dtSistemaOpcion').DataTable( {
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
        aTargets: [1,3,4,5,6]
      },
      {
        "targets": [0,7],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">opc_id_opcion</div>' },
      { title: '<div class="tituloColumnasDT">Opción</div>' },
      { title: '<div class="tituloColumnasDT">Ruta</div>' },
      { title: '<div class="tituloColumnasDT">Aplicación</div>' },
      { title: '<div class="tituloColumnasDT">Orden</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaOpcionModificar" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 3, "asc" ],[ 4, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaOpcion.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[5] == 1 ) {
        $('td', row).eq(4).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[5] == 0 ) {
        $('td', row).eq(4).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaRol() {
  window.dtSistemaRol = $('#dtSistemaRol').DataTable( {
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
        aTargets: [1,2,3]
      },
      {
        "targets": [0],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">apl_id_Rol</div>' },
      { title: '<div class="tituloColumnasDT">Rol</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaRolModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaRol.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[2] == 1 ) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[2] == 0 ) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaEmpresaAplicativo() {
  window.dtSistemaEmpresaAplicativo = $('#dtSistemaEmpresaAplicativo').DataTable( {
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
        aTargets: [4,5]
      },
      {
        "targets": [0,1],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">ape_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">ape_id_aplicacion</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Aplicativo</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaEmpresaAplicativoModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 2, "asc" ],[ 3, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaEmpresaAplicativo.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[4] == 1 ) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[4] == 0 ) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaRolAplicativo() {
  window.dtSistemaRolAplicativo = $('#dtSistemaRolAplicativo').DataTable( {
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
        aTargets: [4,5]
      },
      {
        "targets": [0,1],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">rla_id_rol</div>' },
      { title: '<div class="tituloColumnasDT">rla_id_aplicacion</div>' },
      { title: '<div class="tituloColumnasDT">Rol</div>' },
      { title: '<div class="tituloColumnasDT">Aplicativo</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaRolAplicativoModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 2, "asc" ],[ 3, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaRolAplicativo.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[4] == 1 ) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[4] == 0 ) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaRolOpcion() {
  window.dtSistemaRolOpcion = $('#dtSistemaRolOpcion').DataTable( {
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
        aTargets: [5,6]
      },
      {
        "targets": [0,1],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">rlo_id_rol</div>' },
      { title: '<div class="tituloColumnasDT">rlo_id_opcion</div>' },
      { title: '<div class="tituloColumnasDT">Rol</div>' },
      { title: '<div class="tituloColumnasDT">Aplicativo</div>' },
      { title: '<div class="tituloColumnasDT">Opción</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtSistemaRolOpcionModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 2, "asc" ],[ 3, "asc" ],[ 4, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerSistemaRolOpcion.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[5] == 1 ) {
        $('td', row).eq(3).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[5] == 0 ) {
        $('td', row).eq(3).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
$(document).ready(function() {

  var dtUsuarios = $('#dtUsuarios').DataTable( {
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
        aTargets: [0,3,4,5,6,10]
      },
      {
        "targets": [8,9,11,12,13,14],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">Cédula</div>' },
      { title: '<div class="tituloColumnasDT">Nombres</div>' },
      { title: '<div class="tituloColumnasDT">Correo</div>' },
      { title: '<div class="tituloColumnasDT">Rol Asignado</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Estado Usuario</div>' },
      { title: '<div class="tituloColumnasDT">Estado Contraseña</div>' },
      { title: '<div class="tituloColumnasDT">Estado Correo</div>' },
      { title: '<div class="tituloColumnasDT">usr_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">usr_id_rol</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtUsuariosModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          acciones += '<span class="iconDTsep">|</span>';
          acciones += '<a class="icondtUsuariosResetear cursorPointerDT" title="Resetear contraseña"><i class="fas fa-sync iconDTicon"></i></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
    lengthMenu: [5,10,15,20,30],
    order: [[ 1, "asc" ]],
    ajax:{
      url:'../../beans/manejoSistema/obtenerUsuario.php',
      type: "post",
      data: null,
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function ( row, data, index ) {
      if ( data[5] == 1 ) {
        $('td', row).eq(5).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[5] == 0 ) {
        $('td', row).eq(5).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
      if ( data[6] == 1 ) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[6] == 0 ) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
      if ( data[7] == 1 ) {
        $('td', row).eq(7).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if ( data[7] == 0 ) {
        $('td', row).eq(7).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
  $.ajax({
    url: '../../beans/manejoSistema/obtenerRolEmpresa.php',
    type: 'POST',
    dataType: 'html',
    success: function(result){
      var result = eval('('+result+')');
      switch (result.message) {
        case "saveOK":
          $("#usr_id_rol,#edit_usr_id_rol").empty().prepend(result.roles);
          $("#usr_id_empresa,#edit_usr_id_empresa").empty().prepend(result.empresas);
          break;
        default:
          $("span#idCodErrorGeneral").empty().prepend("2515");
          $('#myModalErrorGeneral').modal('show');
          break;
      }
    }
  });
  $('#btnUserNuevo').click( function () {
    $('#myModalNuevoUser').modal('show');
    document.getElementById("formUserNew").reset();
  });
  $('#usr_cod_usuario').change( function () {
    if ($("#usr_cod_usuario").val() != "") {
      $.ajax({
        url: '../../../webAdministracion/beans/manejoSistema/validarCedula.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'cedula' : $("#usr_cod_usuario").val() },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              break;
            case "userError":
              $("#usr_cod_usuario").val("").focus();
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
  $('#usr_correo').change( function () {
    if ($("#usr_correo").val() != "") {
      $.ajax({
        url: '../../../webAdministracion/beans/manejoSistema/validarCorreo.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'usr_correo' : $("#usr_correo").val(), 'usr_cod_usuario' : $("#usr_cod_usuario").val(), 'tipo_val' : 'NUE' },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              break;
            case "userError":
              $("#usr_correo").val("").focus();
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
  $('#edit_usr_correo').change( function () {
    if ($("#edit_usr_correo").val() != "") {
      $.ajax({
        url: '../../../webAdministracion/beans/manejoSistema/validarCorreo.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'usr_correo' : $("#edit_usr_correo").val(), 'usr_cod_usuario' : temp_usr_cod_usuario_1, 'tipo_val' : 'PAS' },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              break;
            case "userError":
              $("#edit_usr_correo").val("").focus();
              $("#loginCorreoRegistradoEdit").show();
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
  $('#formUserNew').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/guardarUsuario.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formUserNew").serialize(),
        success: function(result){
        var result = eval('('+result+')');
          $('#myModalNuevoUser').modal('hide');
          switch (result.message) {
            case "saveOK":
            case "token_csrf_error":
                dtUsuarios.ajax.reload();
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
  });
  $('#dtUsuarios').on('click','.iconDtUsuariosModificar', function (e) {
    e.preventDefault();
    window.temp_usr_cod_usuario_1 = dtUsuarios.row($(this).parents('tr').first()).data()[0];
    $("h3.editCedula").empty().prepend(dtUsuarios.row($(this).parents('tr').first()).data()[0]);
    $('#edit_usr_correo').val(dtUsuarios.row($(this).parents('tr').first()).data()[2]);
    $('#edit_usr_estado').val(dtUsuarios.row($(this).parents('tr').first()).data()[5]);
    $('#edit_usr_id_empresa').val(dtUsuarios.row($(this).parents('tr').first()).data()[8]);
    $("#edit_usr_id_rol").val(dtUsuarios.row($(this).parents('tr').first()).data()[9]);
    $('#edit_usr_nombre_1').val(dtUsuarios.row($(this).parents('tr').first()).data()[11]);
    $('#edit_usr_nombre_2').val(dtUsuarios.row($(this).parents('tr').first()).data()[12]);
    $('#edit_usr_apellido_1').val(dtUsuarios.row($(this).parents('tr').first()).data()[13]);
    $('#edit_usr_apellido_2').val(dtUsuarios.row($(this).parents('tr').first()).data()[14]);
    $('#myModalEditUser').modal('show');
  });
  $('#formUserMod').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/actualizarUsuario.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formUserMod").serialize()+"&usr_cod_usuario="+temp_usr_cod_usuario_1,
        success: function(result){
        var result = eval('('+result+')');
          $('#myModalEditUser').modal('hide');
          switch (result.message) {
            case "saveOK":
            case "token_csrf_error":
                dtUsuarios.ajax.reload();
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
  });
  $('#dtUsuarios').on('click','.icondtUsuariosResetear', function (e) {
    e.preventDefault();
    window.temp_usr_cod_usuario_2 = dtUsuarios.row($(this).parents('tr').first()).data()[0];
    var dt_nombres = dtUsuarios.row($(this).parents('tr').first()).data()[1];
    $('#myModalPassUser').modal('show');
    $("h3.passCedula").empty(); $("h3.passCedula").prepend(temp_usr_cod_usuario_2);
    $("h3.passNombres").empty();  $("h3.passNombres").prepend(dt_nombres);
  });
  $('#formUserPass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
          url: '../../beans/manejoSistema/actualizarContrasena.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formUserPass").serialize()+"&editCedula="+temp_usr_cod_usuario_2,
          success: function(result){
            var result = eval('('+result+')');
            $('#myModalPassUser').modal('hide');
            switch (result.message) {
              case "saveOK":
              case "token_csrf_error":
                  dtUsuarios.ajax.reload();
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
  if($('div#appAdministrarSistema').hasClass('appAdministrarSistema')) {
    fnSistemaEmpresa();
  }
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#idTogglable_1") {
      fnSistemaEmpresa();
    }
    if (target == "#idTogglable_2") {
      fnSistemaAplicacion();
    }
    if (target == "#idTogglable_3") {
      fnSistemaOpcion();
    }
    if (target == "#idTogglable_4") {
      fnSistemaRol();
    }
    if (target == "#idTogglable_5") {
      fnSistemaEmpresaAplicativo();
    }
    if (target == "#idTogglable_6") {
      fnSistemaRolAplicativo();
    }
    if (target == "#idTogglable_7") {
      fnSistemaRolOpcion();
    }
  });
  $.ajax({
    url: '../../beans/manejoSistema/obtenerEmpAplRolOpc.php',
    type: 'POST',
    dataType: 'html',
    success: function(result){
      var result = eval('('+result+')');
      switch (result.message) {
        case "saveOK":
          $("select#emp_empresa_1").empty().prepend(result.dataEmpresa);
          $("select#rol_rol_2").empty().prepend(result.dataRol);
          $("select#rol_rol_3").empty().prepend(result.dataRol);
          break;
        default:
          $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
          $('#myModalErrorGeneral').modal('show');
          break;
      }
    }
  });
  $('#emp_vigencia_desde,#emp_vigencia_hasta').datepicker({
    singleDatePicker: true,
    showDropdowns: true,
    autoclose: true,
    format: 'yyyy-mm-dd',
    language: 'es',
    /*startDate: '+0d',
    endDate: '+0d',*/
  });
  $('#dtSistemaEmpresa').on('click','.iconDtSistemaEmpresaModificar', function (e) {
    e.preventDefault();
    window.temp_emp_id_empresa_1 = dtSistemaEmpresa.row($(this).parents('tr').first()).data()[0];
    window.temp_ctg_id_catalogo_1 = dtSistemaEmpresa.row($(this).parents('tr').first()).data()[9]
    $('#emp_empresa').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[2]);
    $('#emp_ruc').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[1]);
    $('#emp_estado').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[7]);
    $('#emp_vigencia_desde').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[3]);
    $('#emp_vigencia_hasta').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[4]);
    $('#emp_vigencia_desde').datepicker('setDate', dtSistemaEmpresa.row($(this).parents('tr').first()).data()[3]);
    $('#emp_vigencia_hasta').datepicker('setDate', dtSistemaEmpresa.row($(this).parents('tr').first()).data()[4]);
    $('#tipo_form_sist_empre').val("Old");
    $.ajax({
      url: '../../beans/manejoSistema/obtenerCatalogoEmpresas.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("#ctg_id_catalogo").empty().prepend(result.catag);
            $('#ctg_id_catalogo').val(temp_ctg_id_catalogo_1);
            $('#myModalSistemaEmpresa').modal('show');
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#formSistemaEmpresa').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form_sist_empre').val() == "Old") {
        $params = $('#formSistemaEmpresa').serialize()+"&emp_id_empresa="+temp_emp_id_empresa_1;
      }
      else {
        $params = $('#formSistemaEmpresa').serialize();
      }
      $.ajax({
        url: '../../beans/manejoSistema/guardarSistemaEmpresa.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSistemaEmpresa').modal('hide');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_sist_empre').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaEmpresa.ajax.reload();
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
  $('#btnNuevaSistemaEmpresa').click( function () {
    $.ajax({
      url: '../../beans/manejoSistema/obtenerCatalogoEmpresas.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $('#tipo_form_sist_empre').val("New");
            $("#ctg_id_catalogo").empty().prepend(result.catag);
            $('#ctg_id_catalogo').val("");
            $('#myModalSistemaEmpresa').modal('show');
            document.getElementById("formSistemaEmpresa").reset();
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend(result.numLineaCodigo);
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#dtSistemaRol').on('click','.iconDtSistemaRolModificar', function (e) {
    e.preventDefault();
    window.temp_rol_id_rol_1 = dtSistemaRol.row($(this).parents('tr').first()).data()[0];
    $('#rol_rol').val(dtSistemaRol.row($(this).parents('tr').first()).data()[1]).prop("disabled",true).prop("required",false);
    $('#rol_estado').val(dtSistemaRol.row($(this).parents('tr').first()).data()[2]);
    $('#tipo_form_sist_rol').val("Old");
    $('#myModalSistemaRol').modal('show');
  });
  $('#formSistemaRol').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form_sist_rol').val() == "Old") {
        $params = $('#formSistemaRol').serialize()+"&rol_id_rol="+temp_rol_id_rol_1;
      }
      else {
        $params = $('#formSistemaRol').serialize();
      }
      $.ajax({
        url: '../../beans/manejoSistema/guardarSistemaRol.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSistemaRol').modal('hide');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_sist_rol').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaRol.ajax.reload();
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
  $('#btnNuevaSistemaRol').click( function () {
    document.getElementById("formSistemaRol").reset();
    $('#tipo_form_sist_rol').val("New");
    $('#rol_estado').val("1").prop("disabled",true);
    $('#rol_rol').prop("disabled",false).prop("required",true);
    $('#myModalSistemaRol').modal('show');
  });
  $('#dtSistemaAplicacion').on('click','.iconDtSistemaAplicacionModificar', function (e) {
    e.preventDefault();
    window.temp_apl_id_aplicacion_1 = dtSistemaAplicacion.row($(this).parents('tr').first()).data()[0];
    $('#apl_aplicacion').val(dtSistemaAplicacion.row($(this).parents('tr').first()).data()[1]).prop("disabled",true).prop("required",false);
    $('#apl_estado').val(dtSistemaAplicacion.row($(this).parents('tr').first()).data()[7]);
    $('#tipo_form_sist_apl').val("Old");
    $('#myModalSistemaAplicacion').modal('show');
  });
  $('#formSistemaAplicacion').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form_sist_apl').val() == "Old") {
        $params = $('#formSistemaAplicacion').serialize()+"&apl_id_aplicacion="+temp_apl_id_aplicacion_1;
      }
      else {
        $params = $('#formSistemaAplicacion').serialize();
      }
      $.ajax({
        url: '../../beans/manejoSistema/guardarSistemaAplicacion.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSistemaAplicacion').modal('hide');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_sist_apl').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaAplicacion.ajax.reload();
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
  $('#dtSistemaOpcion').on('click','.iconDtSistemaOpcionModificar', function (e) {
    e.preventDefault();
    window.temp_opc_id_opcion_1 = dtSistemaOpcion.row($(this).parents('tr').first()).data()[0];
    $('#opc_opcion').val(dtSistemaOpcion.row($(this).parents('tr').first()).data()[1]).prop("disabled",true).prop("required",false);
    $('#opc_estado').val(dtSistemaOpcion.row($(this).parents('tr').first()).data()[5]);
    $('#tipo_form_sist_opc').val("Old");
    $('#myModalSistemaOpcion').modal('show');
  });
  $('#formSistemaOpcion').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form_sist_opc').val() == "Old") {
        $params = $('#formSistemaOpcion').serialize()+"&opc_id_opcion="+temp_opc_id_opcion_1;
      }
      else {
        $params = $('#formSistemaOpcion').serialize();
      }
      $.ajax({
        url: '../../beans/manejoSistema/guardarSistemaOpcion.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSistemaOpcion').modal('hide');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_sist_opc').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaOpcion.ajax.reload();
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
  $('#dtSistemaEmpresaAplicativo').on('click','.iconDtSistemaEmpresaAplicativoModificar', function (e) {
    e.preventDefault();
    window.temp_ape_id_empresa_1 = dtSistemaEmpresaAplicativo.row($(this).parents('tr').first()).data()[0];
    window.temp_ape_id_aplicacion_1 = dtSistemaEmpresaAplicativo.row($(this).parents('tr').first()).data()[1];
    $('#emp_empresa_1').val(temp_ape_id_empresa_1).prop("disabled",true).prop("required",false);
    $('#apl_aplicacion_1').val(temp_ape_id_aplicacion_1).prop("disabled",true).prop("required",false);
    $('#ape_estado').val(dtSistemaEmpresaAplicativo.row($(this).parents('tr').first()).data()[4]);
    $('#tipo_form_sist_emp_apl').val("Old");
    $('#myModalSistemaEmpresaAplicativo').modal('show');
  });
  $('#formSistemaEmpresaAplicativo').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form_sist_emp_apl').val() == "Old") {
        $params = $('#formSistemaEmpresaAplicativo').serialize()+"&ape_id_empresa="+temp_ape_id_empresa_1+"&ape_id_aplicacion="+temp_ape_id_aplicacion_1;
      }
      else {
        $params = $('#formSistemaEmpresaAplicativo').serialize();
      }
      $.ajax({
        url: '../../beans/manejoSistema/guardarSistemaEmpresaAplicativo.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSistemaEmpresaAplicativo').modal('hide');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_sist_emp_apl').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaEmpresaAplicativo.ajax.reload();
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
  $('#btnNuevaSistemaEmpresaAplicativo').click( function () {
    document.getElementById("formSistemaEmpresaAplicativo").reset();
    $('#tipo_form_sist_emp_apl').val("New");
    $('#ape_estado').val("1").prop("disabled",true);
    $('#emp_empresa_1').prop("disabled",false).prop("required",true);
    $('#apl_aplicacion_1').prop("disabled",true).prop("required",true);
    $('#myModalSistemaEmpresaAplicativo').modal('show');
  });
  $('#emp_empresa_1').change( function () {
    if ($("#emp_empresa_1").val() != "") {
      $.ajax({
        url: '../../beans/manejoSistema/cargaSistemaEmpresaAplicativo.php',
        type: 'POST',
        dataType: 'html',
        data:{'dataSelect':$("#emp_empresa_1").val()},
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              $("#apl_aplicacion_1").empty().prepend(result.dataSelect).prop("disabled",false);
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
  $('#apl_aplicacion_1').change( function () {
    if ($("#emp_empresa_1").val() != "" && $("#apl_aplicacion_1").val() != "") {
      $.ajax({
        url: '../../../webAdministracion/beans/manejoSistema/validarSistemaEmpresaAplicativo.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'emp_empresa_1' : $("#emp_empresa_1").val(),'apl_aplicacion_1' : $("#apl_aplicacion_1").val() },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "regNulo":
              break;
            case "regRepetido":
              $('#myModalSistemaEmpresaAplicativo').modal('hide');
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
  $('#dtSistemaRolAplicativo').on('click','.iconDtSistemaRolAplicativoModificar', function (e) {
    e.preventDefault();
    window.temp_rla_id_rol_2 = dtSistemaRolAplicativo.row($(this).parents('tr').first()).data()[0];
    window.temp_rla_id_aplicacion_2 = dtSistemaRolAplicativo.row($(this).parents('tr').first()).data()[1];
    $('#rol_rol_2').val(temp_rla_id_rol_2).prop("disabled",true).prop("required",false);
    $('#apl_aplicacion_2').val(temp_rla_id_aplicacion_2).prop("disabled",true).prop("required",false);
    $('#rla_estado').val(dtSistemaRolAplicativo.row($(this).parents('tr').first()).data()[4]);
    $('#tipo_form_sist_rol_apl').val("Old");
    $('#myModalSistemaRolAplicativo').modal('show');
  });
  $('#formSistemaRolAplicativo').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form_sist_rol_apl').val() == "Old") {
        $params = $('#formSistemaRolAplicativo').serialize()+"&rla_id_rol="+temp_rla_id_rol_2+"&rla_id_aplicacion="+temp_rla_id_aplicacion_2;
      }
      else {
        $params = $('#formSistemaRolAplicativo').serialize();
      }
      $.ajax({
        url: '../../beans/manejoSistema/guardarSistemaRolAplicativo.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSistemaRolAplicativo').modal('hide');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_sist_rol_apl').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaRolAplicativo.ajax.reload();
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
  $('#btnNuevaSistemaRolAplicativo').click( function () {
    document.getElementById("formSistemaRolAplicativo").reset();
    $('#tipo_form_sist_rol_apl').val("New");
    $('#rla_estado').val("1").prop("disabled",true);
    $('#rol_rol_2').prop("disabled",false).prop("required",true);
    $('#apl_aplicacion_2').prop("disabled",true).prop("required",true);
    $('#myModalSistemaRolAplicativo').modal('show');
  });
  $('#rol_rol_2').change( function () {
    if ($("#rol_rol_2").val() != "") {
      $.ajax({
        url: '../../beans/manejoSistema/cargaSistemaRolAplicativo.php',
        type: 'POST',
        dataType: 'html',
        data:{'dataSelect':$("#rol_rol_2").val()},
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              $("#apl_aplicacion_2").empty().prepend(result.dataSelect).prop("disabled",false);
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
  $('#apl_aplicacion_2').change( function () {
    if ($("#rol_rol_2").val() != "" && $("#apl_aplicacion_2").val() != "") {
      $.ajax({
        url: '../../../webAdministracion/beans/manejoSistema/validarSistemaRolAplicativo.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'rol_rol_2' : $("#rol_rol_2").val(),'apl_aplicacion_2' : $("#apl_aplicacion_2").val() },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "regNulo":
              break;
            case "regRepetido":
              $('#myModalSistemaRolAplicativo').modal('hide');
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
  $('#dtSistemaRolOpcion').on('click','.iconDtSistemaRolOpcionModificar', function (e) {
    e.preventDefault();
    window.temp_rlo_id_rol_3 = dtSistemaRolOpcion.row($(this).parents('tr').first()).data()[0];
    window.temp_rlo_id_opcion_3 = dtSistemaRolOpcion.row($(this).parents('tr').first()).data()[1];
    $('#rol_rol_3').val(temp_rlo_id_rol_3).prop("disabled",true).prop("required",false);
    $('#opc_opcion_3').val(temp_rlo_id_opcion_3).prop("disabled",true).prop("required",false);
    $('#rlo_estado').val(dtSistemaRolOpcion.row($(this).parents('tr').first()).data()[5]);
    $('#tipo_form_sist_rol_opc').val("Old");
    $('#myModalSistemaRolOpcion').modal('show');
  });
  $('#formSistemaRolOpcion').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form_sist_rol_opc').val() == "Old") {
        $params = $('#formSistemaRolOpcion').serialize()+"&rlo_id_rol="+temp_rlo_id_rol_3+"&rlo_id_opcion="+temp_rlo_id_opcion_3;
      }
      else {
        $params = $('#formSistemaRolOpcion').serialize();
      }
      $.ajax({
        url: '../../beans/manejoSistema/guardarSistemaRolOpcion.php',
        type: 'POST',
        dataType: 'html',
        data:$params,
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSistemaRolOpcion').modal('hide');
          switch (result.message) {
            case "saveOK":
              $('#tipo_form_sist_rol_opc').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaRolOpcion.ajax.reload();
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
  $('#btnNuevaSistemaRolOpcion').click( function () {
    document.getElementById("formSistemaRolOpcion").reset();
    $('#tipo_form_sist_rol_opc').val("New");
    $('#rlo_estado').val("1").prop("disabled",true);
    $('#rol_rol_3').prop("disabled",false).prop("required",true);
    $('#opc_opcion_3').prop("disabled",true).prop("required",true);
    $('#myModalSistemaRolOpcion').modal('show');
  });
  $('#rol_rol_3').change( function () {
    if ($("#rol_rol_3").val() != "") {
      $.ajax({
        url: '../../beans/manejoSistema/cargaSistemaRolOpcion.php',
        type: 'POST',
        dataType: 'html',
        data:{'dataSelect':$("#rol_rol_3").val()},
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              $("#opc_opcion_3").empty().prepend(result.dataSelect).prop("disabled",false);
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
  $('#opc_opcion_3').change( function () {
    if ($("#rol_rol_3").val() != "" && $("#opc_opcion_3").val() != "") {
      $.ajax({
        url: '../../../webAdministracion/beans/manejoSistema/validarSistemaRolOpcion.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'rol_rol_3' : $("#rol_rol_3").val(),'opc_opcion_3' : $("#opc_opcion_3").val() },
        success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
            case "regNulo":
              break;
            case "regRepetido":
              $('#myModalSistemaRolOpcion').modal('hide');
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
  

});