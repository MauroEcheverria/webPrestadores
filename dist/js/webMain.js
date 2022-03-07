var validation = {
isEmailAddress:function(str) {
   var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   return pattern.test(str);
},
isNotEmpty:function (str) {
   var pattern =/\S+/;
   return pattern.test(str);
},
isNumber:function(str) {
   var pattern = /^\d+$/;
   return pattern.test(str);
},
isSame:function(str1,str2){
  return str1 === str2;
}}; 
function quitaEspacios (myText){
  var myString = myText;
  myString = $.trim( myString );
  return myString;
}
function toUpperCase(texto) {
  texto.value = texto.value.toUpperCase();
}
function validarCedula(cedula_a_Validar) {
  var cad = cedula_a_Validar.trim();
  var total = 0;
  var longitud = cad.length;
  var longcheck = longitud - 1;
  if (cad !== "" && longitud === 10){
    for(i = 0; i < longcheck; i++){
      if (i%2 === 0) {
        var aux = cad.charAt(i) * 2;
        if (aux > 9) aux -= 9;
        total += aux;
      } else {
        total += parseInt(cad.charAt(i));
      }
    }
    total = total % 10 ? 10 - total % 10 : 0;
    if (cad.charAt(longitud-1) == total) {
      return true;
    }else{
      return false;
    }
  }
}
function soloNumeros(e) {
  var key = window.event ? e.which : e.charCode;
  if (key == 8) {
    return true;
  }
  if (key !== undefined && key === 0) {
    return true;
  }
  var patron = /[0-9]/;
  var tecla_final = String.fromCharCode(key);
  return patron.test(tecla_final);
}

var time;
function inicio() { 
  time = setTimeout(function() { 
    $(document).ready(function(e) {
      $.ajax({
        url:'../../../controller/cerrarSesion/inactividad.php',
        type:'POST',
        data:{'linkTemp' : window.location.href },
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
              $('#myModalInactivity').modal('show'); 
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1400");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    });
  },7200000);
}
//3600000 -> 60 min - 7200000
function reset() {
  clearTimeout(time);
  time = setTimeout(function() { 
    $(document).ready(function(e) {
      $.ajax({
        url:'../../../controller/cerrarSesion/inactividad.php',
        type:'POST',
        data:{'linkTemp' : window.location.href },
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
                $('#myModalInactivity').modal('show'); 
              break;
            default:
              $("span#idCodErrorGeneral").empty().prepend("1401");
              $('#myModalErrorGeneral').modal('show');
              break;
          }
        }
      });
    });
  },7200000);
}
function modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4) {
  $("#putIconModalgeneric").empty().prepend(dataModal_1);
  $("#putTitleModalgeneric").empty().prepend(dataModal_2);
  $("#putMessaggeModalgeneric").empty().prepend(dataModal_3);
  $("#putButtonModalgeneric").empty().prepend(dataModal_4);
  $('#modalGenericoInfo').modal('show');
}
$(document).ready(function() {

	$(".aAlert").click(function(){
    $(this).parent().hide();
    return false;
  });

  window.setTimeout(function(){
    $('.poppupAlert').fadeOut('slow');
  },3000);

  /*$('[data-mask]').inputmask();*/

  $(".select2,#sys_selec_option").select2({
    maximumSelectionLength: 20
  });

  /*$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  });*/

  /*$('.timepicker').timepicker({
    showInputs: false,
    showMeridian: false
  });*/

  $('#newNacimiento,#editNacimiento').datepicker({
    singleDatePicker: true,
    showDropdowns: true,
    autoclose: true,
    format: 'yyyy-mm-dd',
    language: 'es',
    /*startDate: '+0d',*/
    endDate: '+0d',
  });

  $('#loading').hide();  
  $(document)
  .ajaxStart(function(){$('#loading').show();})
  .ajaxStop(function(){$('#loading').hide();});

  window.id_dt_cedula = null;
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
        "targets": [7,8],
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
          acciones += '<a class="icondtUsuariosResetear" title="Resetear contraseña"><i class="far fa-trash-alt iconDTicon"></i></i></a>';
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
    }
  });
  $('#btnUserNuevo').click( function () {
    $('#myModalNuevoUser').modal('show');
    document.getElementById("formUserNew").reset();
    $.ajax({
      url: '../../beans/manejoSistema/obtenerRolEmpresa.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("select#newRol").empty().prepend(result.roles);
            $("select#newEmpresa").empty().prepend(result.empresas);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend("2515");
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
  });
  $('#newCedula').change( function () {
    if ($("#newCedula").val() != "") {
      $.ajax({
        url: '../../../webMain/beans/manejoSistema/validarCedula.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'cedula' : $("#newCedula").val() },
        success: function(result){
          var result = eval('('+result+')');
          if (result.message == "userError") {
            window.setTimeout(function(){
              $('.poppupAlert').fadeOut('slow');
            },3000);
            $("#newCedula").val("").focus();
            $("#loginUsuarioRegistrado").show();
            return false;
          }
        }
      });
    }
  });
  $('#newCorreo').change( function () {
    if ($("#newCorreo").val() != "") {
      $.ajax({
        url: '../../../webMain/beans/manejoSistema/validarCorreo.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'cedula' : $("#newCorreo").val() },
        success: function(result){
          var result = eval('('+result+')');
          if (result.message == "userError") {
            window.setTimeout(function(){
              $('.poppupAlert').fadeOut('slow');
            },3000);
            $("#newCorreo").val("").focus();
            $("#loginCorreoRegistrado").show();
            return false;
          }
        }
      });
    }
  });
  $('#editCorreo').change( function () {
    if ($("#editCorreo").val() != "") {
      $.ajax({
        url: '../../../webMain/beans/manejoSistema/validarCorreo.php',
        type: 'POST',
        dataType: 'html',
        data:{ 'cedula' : $("#editCorreo").val() },
        success: function(result){
          var result = eval('('+result+')');
          if (result.message == "userError") {
            window.setTimeout(function(){
              $('.poppupAlert').fadeOut('slow');
            },3000);
            $("#editCorreo").val("").focus();
            $("#loginCorreoRegistradoEdit").show();
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
          switch (result.message) {
            case "saveOK":
                $('#myModalNuevoUser').modal('hide');
                dtUsuarios.ajax.reload();
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "errorCriterios":
                /* OJO NO QUITAR ESTE ALERT - YA ESTA CORREGIDO ORTOGRAFIA */
                alert("De cumplir con todos los criterios de los campos solicitados.");
              break;
            default:
              $('#myModalNuevoUser').modal('hide');
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
    window.id_dt_cedula = dtUsuarios.row($(this).parents('tr').first()).data()[0];
    var dt_nombres = dtUsuarios.row($(this).parents('tr').first()).data()[1];
    var dt_correo = dtUsuarios.row($(this).parents('tr').first()).data()[2];
    var dt_role = dtUsuarios.row($(this).parents('tr').first()).data()[3];
    var dt_estado = dtUsuarios.row($(this).parents('tr').first()).data()[5];
    var dt_cod_unidad = dtUsuarios.row($(this).parents('tr').first()).data()[7];
    var dt_nacimiento = dtUsuarios.row($(this).parents('tr').first()).data()[8];
    var dt_sexo = dtUsuarios.row($(this).parents('tr').first()).data()[9];
    var dt_telefono = dtUsuarios.row($(this).parents('tr').first()).data()[10];
    $("h3.editCedula").empty(); $("h3.editCedula").prepend(id_dt_cedula);
    $('#editCorreo').val(dt_correo);
    $('#editNacimiento').val(dt_nacimiento);
    $('#edit_usr_sexo').val(dt_sexo);
    $('#edit_usr_telefono').val(dt_telefono);
    if (dt_estado == 1) {document.getElementById("editEstado").value = "TRUE"}
    if (dt_estado == 0) {document.getElementById("editEstado").value = "FALSE"}
    $.ajax({
      url: '../../beans/manejoSistema/obtenerRolEmpresa.php',
      type: 'POST',
      dataType: 'html',
      success: function(result){
        var result = eval('('+result+')');
        switch (result.message) {
          case "saveOK":
            $("select#editRol").empty().prepend(result.roles);
            break;
          default:
            $("span#idCodErrorGeneral").empty().prepend("2515");
            $('#myModalErrorGeneral').modal('show');
            break;
        }
      }
    });
    $.ajax({
      url: '../../beans/manejoSistema/obtenerNombres.php',
      type: 'POST',
      dataType: 'html',
      data:{ 'id_dt_cedula' : id_dt_cedula },
      success: function(result){
        var result = eval('('+result+')');
        $('#edit_usr_nombre_1').val(result.data_row[0].usr_nombre_1);
        $('#edit_usr_nombre_2').val(result.data_row[0].usr_nombre_2);
        $('#edit_usr_apellido_1').val(result.data_row[0].usr_apellido_1);
        $('#edit_usr_apellido_2').val(result.data_row[0].usr_apellido_2);
      }
    });
    $('#myModalEditUser').modal('show');
  });
  $('#formUserMod').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
        url: '../../beans/manejoSistema/actualizarUsuario.php',
        type: 'POST',
        dataType: 'html',
        data:$("#formUserMod").serialize()+"&editCedula="+id_dt_cedula,
        success: function(result){
        var result = eval('('+result+')');
          switch (result.message) {
            case "saveOK":
                $('#myModalEditUser').modal('hide');
                dtUsuarios.ajax.reload();
                modalGenerico(result.dataModal_1,result.dataModal_2,result.dataModal_3,result.dataModal_4);
              break;
            case "errorCriterios":
                /* OJO NO QUITAR ESTE ALERT - YA ESTA CORREGIDO ORTOGRAFIA */
                alert("De cumplir con todos los criterios de los campos solicitados.");
              break;
            default:
              $('#myModalEditUser').modal('hide');
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
    var id_dt_cedula = dtUsuarios.row($(this).parents('tr').first()).data()[0];
    var dt_nombres = dtUsuarios.row($(this).parents('tr').first()).data()[1];
    $('#myModalPassUser').modal('show');
    $("h3.passCedula").empty(); $("h3.passCedula").prepend(id_dt_cedula);
    $("h3.passNombres").empty();  $("h3.passNombres").prepend(dt_nombres);
  });
  $('#formUserPass').validator().on('submit', function (e) {
    if (!e.isDefaultPrevented()) {
      e.preventDefault();
      $.ajax({
          url: '../../beans/manejoSistema/actualizarContrasena.php',
          type: 'POST',
          dataType: 'html',
          data:$("#formUserPass").serialize()+
          "&editCedula="+$("h3.passCedula").text()+
          "&valPaciente="+$.md5($("h3.passCedula").text(),'M@rut0'),
          success: function(result){
          var result = eval('('+result+')');
            $('#myModalPassUser').modal('hide');
            switch (result.message) {
              case "saveOK":
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
              var sms_dataModal_1 = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
              var sms_dataModal_2 = 'Información';
              var sms_dataModal_3 = 'Desvinculación realizada con éxito.';
              var sms_dataModal_4 = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
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
          switch (result.message) {
            case "saveOK":
              table_sys_id_app.ajax.reload();
              $('#myModalSysRoleApp').modal('hide');
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
          switch (result.message) {
            case "saveOK":
              table_sys_id_opt.ajax.reload();
              $('#myModalSysRoleOpt').modal('hide');
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
              var sms_dataModal_1 = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
              var sms_dataModal_2 = 'Información';
              var sms_dataModal_3 = 'Desvinculación realizada con éxito.';
              var sms_dataModal_4 = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
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
});