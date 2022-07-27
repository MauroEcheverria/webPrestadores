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
          acciones  = '<a class="iconDtSistemaEmpresaModificar" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          acciones += '<span class="iconDTsep">|</span>';
          acciones += '<a class="iconDtSistemaEmpresaFirmaEdit" title="Asignar Firma Electrónica"><i class="fas fa-file-invoice-dollar iconDTicon"></i></i></a>';
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
          acciones  = '<a class="iconDtSistemaRolModificar" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
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
        aTargets: [0,3,4,5,6,9]
      },
      {
        "targets": [7,8,10,11,12,13],
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
      { title: '<div class="tituloColumnasDT">usr_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">usr_id_rol</div>' },
      { 
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones  = '<a class="iconDtUsuariosModificar" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          acciones += '<span class="iconDTsep">|</span>';
          acciones += '<a class="icondtUsuariosResetear" title="Resetear contraseña"><i class="fas fa-sync iconDTicon"></i></i></a>';
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
          if (result.message == "userError") {
            $("#usr_cod_usuario").val("").focus();
            $("#loginUsuarioRegistrado").show();
            ocultarPoppupAlert();
            return false;
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
          if (result.message == "userError") {
            $("#usr_correo").val("").focus();
            $("#loginCorreoRegistrado").show();
            ocultarPoppupAlert();
            return false;
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
          if (result.message == "userError") {
            $("#edit_usr_correo").val("").focus();
            $("#loginCorreoRegistradoEdit").show();
            ocultarPoppupAlert();
            return false;
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
              $("span#idCodErrorGeneral").empty().prepend("1402");
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
    $('#edit_usr_id_empresa').val(dtUsuarios.row($(this).parents('tr').first()).data()[7]);
    $("#edit_usr_id_rol").val(dtUsuarios.row($(this).parents('tr').first()).data()[8]);
    $('#edit_usr_nombre_1').val(dtUsuarios.row($(this).parents('tr').first()).data()[10]);
    $('#edit_usr_nombre_2').val(dtUsuarios.row($(this).parents('tr').first()).data()[11]);
    $('#edit_usr_apellido_1').val(dtUsuarios.row($(this).parents('tr').first()).data()[12]);
    $('#edit_usr_apellido_2').val(dtUsuarios.row($(this).parents('tr').first()).data()[13]);
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
              $("span#idCodErrorGeneral").empty().prepend("1403");
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
                  $("span#idCodErrorGeneral").empty().prepend("1404");
                  $('#myModalErrorGeneral').modal('show');
                break;
            }
          }
      });
    }
  });
  $('#formExpirePassPerfil').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/expirarPassAdminPerfil.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formExpirePassPerfil").serialize()+"&cod_system_user="+
        $('#idPassCedula').val()+"&valPaciente="+
        $.md5($('#passPassNew').val(),'M@rut0')+"&valPacienteAnt="+
        $.md5($('#passPassAnt').val(),'M@rut0'),
        success: function(result){
          var result = eval('('+result+')');
          document.getElementById('formExpirePassPerfil').reset();
          $('#myModal_expire_pass').modal('hide');
          switch (result.message) {
            case "updateOk":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "updateError":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "passRegistradaAnteriormentes":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "passOriginalError":
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1405");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
  if($('span#selectAdminRoles').hasClass('selectAdminRolesClass')) {
    $.ajax({
      url: '../../beans/manejoSistema/obtenerRolEmpresa.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("select#sys_selec_roles").empty().prepend(result.roles);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend("2515");
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
    $("#sys_selec_roles").change(function() {
      window.sys_id_app = null;
      window.table_sys_id_app = $('#sys_dt_roles_app').DataTable( {
        bRetrive: true,
        processing: true,
        serverSide: false,
        bDestroy: true,
        responsive: false,
        paging: true,
        searching: true,
        scrollX: true,
        aoColumnDefs: [{ sClass: "centrarContent", aTargets: [0]}],
        oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
        lengthMenu: [5,10,15,20,30],
        order: [[ 0, "asc" ]],
        ajax:{
          url:'../../beans/manejoSistema/getSysRolesApp.php',
          type: "post",
          data: function ( d ) {
            d.sys_selec_roles = $("#sys_selec_roles").val();
          },
          dataSrc: function (json) {
            return json.data;
          }
        }
      });
      $('#sys_dt_roles_app tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            sys_id_app = null;
            $(this).removeClass('selected');
            $('#sys_btn_desvincular_app').prop("disabled", true);
        }
        else {
            sys_id_app = $('td', this).eq(0).text();
            table_sys_id_app.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            if (sys_id_app != "Ningún dato disponible en esta tabla") {
              $('#sys_btn_desvincular_app').prop("disabled", false);
            }
        }
      });
      window.sys_id_opt = null;
      window.table_sys_id_opt = $('#sys_dt_roles_option').DataTable( {
        bRetrive: true,
        processing: true,
        serverSide: false,
        bDestroy: true,
        responsive: false,
        paging: true,
        searching: true,
        scrollX: true,
        aoColumnDefs: [{ sClass: "centrarContent", aTargets: [0]}],
        oLanguage: {sUrl:"../../../plugins/DataTables/media/spanish.json"},
        lengthMenu: [10,15,20,30],
        order: [[ 1, "asc" ]],
        ajax:{
          url:'../../beans/manejoSistema/getSysRolesOpt.php',
          type: "post",
          data: function ( d ) {
            d.sys_selec_roles = $("#sys_selec_roles").val();
          },
          dataSrc: function (json) {
            return json.data;
          }
        }
      });
      $('#sys_dt_roles_option tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            sys_id_opt = null;
            $(this).removeClass('selected');
            $('#sys_btn_desvincular_opt').prop("disabled", true);
        }
        else {
            sys_id_opt = $('td', this).eq(0).text();
            table_sys_id_opt.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            if (sys_id_opt != "Ningún dato disponible en esta tabla") {
              $('#sys_btn_desvincular_opt').prop("disabled", false);
            }
        }
      });
      $("div#panelAdminRoles").removeClass("criteriosOcultar").addClass("criteriosMostrar");
    });
  }
  $('#sys_btn_asignar_app').click( function () {
    $.ajax({
      url: '../../beans/manejoSistema/obtenerAppUser.php',
      type: 'POST',
      dataType: 'html',
      data:{ 'sys_selec_roles' : $("#sys_selec_roles").val() },
      success: function(result){
        getApp = JSON.parse(result);
        var newApp = "";
        for (var i = 0; i <= getApp.length - 1; i++) {
          newApp += "<option value='"+getApp[i][0]+"'>"+getApp[i][1]+"</option>";
        }
        $("select#sys_selec_app").empty(); $("select#sys_selec_app").prepend(newApp);
        $("h3.passSysRoles").empty(); $("h3.passSysRoles").prepend($("#sys_selec_roles :selected").text());
        $('#myModalSysRoleApp').modal('show');
      }
    });
  });
  $('#sys_btn_desvincular_app').click( function () {
    if (sys_id_app != null) {
      $.ajax({
        url: '../../beans/manejoSistema/deleteRoleApp.php',
        type: 'POST',
        dataType: 'html',
        data:{'sys_selec_roles':$("#sys_selec_roles").val(),'sys_id_app':sys_id_app },
        success: function(result){  
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              table_sys_id_app.ajax.reload();
              table_sys_id_opt.ajax.reload();
              $('#sys_btn_desvincular_app').prop("disabled", true);
              var sms_dataModal_1 = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
              var sms_dataModal_2 = 'Información';
              var sms_dataModal_3 = 'Desvinculación realizada con éxito.';
              var sms_dataModal_4 = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
              modalGenerico(sms_dataModal_1,sms_dataModal_2,sms_dataModal_3,sms_dataModal_4);
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1406");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
    else{
      $('#myModalNoSelected').modal('show');
    }
  });
  $('#formSysApp').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/saveRoleApp.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formSysApp").serialize()+"&sys_selec_roles="+$("#sys_selec_roles").val(),
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSysRoleApp').modal('hide');
          switch (result.message) {
            case "saveOK":
              table_sys_id_app.ajax.reload();
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1407");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
  $('#sys_btn_asignar_opt').click( function () {
    $.ajax({
      url: '../../beans/manejoSistema/obtenerOptionUser.php',
      type: 'POST',
      dataType: 'html',
      data:{ 'sys_selec_roles' : $("#sys_selec_roles").val() },
      success: function(result){
        getApp = JSON.parse(result);
        var newApp = "";
        for (var i = 0; i <= getApp.length - 1; i++) {
          newApp += "<option value='"+getApp[i][0]+"'>"+getApp[i][1]+" - "+getApp[i][2]+"</option>";
        }
        $("select#sys_selec_option").empty(); $("select#sys_selec_option").prepend(newApp);
        $("h3.passSysRoles").empty(); $("h3.passSysRoles").prepend($("#sys_selec_roles :selected").text());
        $('#myModalSysRoleOpt').modal('show');
      }
    });
  });
  $('#formSysOption').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/saveRoleOption.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formSysOption").serialize()+"&sys_selec_roles="+$("#sys_selec_roles").val(),
        success: function(result){
          var result = eval('('+result+')');
          $('#myModalSysRoleOpt').modal('hide');
          switch (result.message) {
            case "saveOK":
              table_sys_id_opt.ajax.reload();
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1408");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
  });
  $('#sys_btn_desvincular_opt').click( function () {
    if (sys_id_opt != null) {
      $.ajax({
        url: '../../beans/manejoSistema/deleteRoleOption.php',
        type: 'POST',
        dataType: 'html',
        data:{'sys_selec_roles':$("#sys_selec_roles").val(),'sys_id_opt':sys_id_opt },
        success: function(result){  
          var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              table_sys_id_opt.ajax.reload();
              $('#sys_btn_desvincular_opt').prop("disabled", true);
              var sms_dataModal_1 = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
              var sms_dataModal_2 = 'Información';
              var sms_dataModal_3 = 'Desvinculación realizada con éxito.';
              var sms_dataModal_4 = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
              modalGenerico(sms_dataModal_1,sms_dataModal_2,sms_dataModal_3,sms_dataModal_4);
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1409");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    }
    else{
      $('#myModalNoSelected').modal('show');
    }
  });
  if($('div#appAdministrarSistema').hasClass('appAdministrarSistema')) {
    fnSistemaEmpresa();
  }
  $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href")
    if (target == "#idTogglable_1") {
      fnSistemaEmpresa();
    }
    if (target == "#idTogglable_3") {
      fnSistemaRol();
    }
    if (target == "#idTogglable_5") {
      //fnSistemaOpcion();
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
    $('#tipo_form').val("Old");
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
            $("span#idCodErrorGeneral").empty().prepend("2515");
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#dtSistemaEmpresa').on('click','.iconDtSistemaEmpresaFirmaEdit', function (e) {
    e.preventDefault();
    window.temp_emp_id_empresa_2 = dtSistemaEmpresa.row($(this).parents('tr').first()).data()[0];
    window.temp_emp_ruc_2 = dtSistemaEmpresa.row($(this).parents('tr').first()).data()[1];
    document.getElementById("formCargaArchivoEmpresa").reset();
    $('#myModalSistemaEmpresaArchivo').modal('show');
  });
  $('#em_archivo_fact_elec').change( function () {
    if ($("#em_archivo_fact_elec").val() != "") {
      $('.custom-file-input').next('.form-control-file').addClass("selected").html($("#em_archivo_fact_elec").val());
    }
  });
  $('#formSistemaEmpresa').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      if ($('#tipo_form').val() == "Old") {
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
              $('#tipo_form').val("Old");
            case "token_csrf_error":
            case "error_admin_perfil":
              dtSistemaEmpresa.ajax.reload();
              modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            default:
                $("span#idCodErrorGeneral").empty().prepend("1404");
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
            $('#tipo_form').val("New");
            $("#ctg_id_catalogo").empty().prepend(result.catag);
            $('#ctg_id_catalogo').val("");
            $('#myModalSistemaEmpresa').modal('show');
            document.getElementById("formSistemaEmpresa").reset();
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend("2515");
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#formCargaArchivoEmpresa').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      var formData = new FormData(this);
      var files = $('#em_archivo_fact_elec')[0].files;
      if(files.length > 0 ){
        formData.append('em_archivo_fact_elec',files[0]);
        formData.append('em_pass_fct_elec',$('#em_pass_fct_elec').val());
        formData.append('emp_id_empresa',temp_emp_id_empresa_2);
        formData.append('emp_ruc',temp_emp_ruc_2);
        $.ajax({
          url: '../../beans/manejoSistema/cargaArchivoEmpresa.php',
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
                dtSistemaEmpresa.ajax.reload();
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
                break;
              default:
                $("span#idCodErrorGeneral").empty().prepend("2515");
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

});