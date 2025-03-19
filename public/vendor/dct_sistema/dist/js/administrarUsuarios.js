document.addEventListener('DOMContentLoaded', function () {
  window.dtUsuarios = $('#dtUsuarios').DataTable({
    bRetrive: true,
    processing: false,
    serverSide: false,
    bDestroy: true,
    responsive: false,
    paging: true,
    searching: true,
    scrollX: true,
    aoColumnDefs: [
      {
        sClass: "centrarContenido",
        aTargets: [0, 3, 4, 5, 6, 10, 11]
      },
      {
        "targets": [9, 10, 12, 13, 14, 15],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">Cédula</div>' },
      { title: '<div class="tituloColumnasDT">Nombres</div>' },
      { title: '<div class="tituloColumnasDT">Correo</div>' },
      { title: '<div class="tituloColumnasDT">Célular</div>' },
      { title: '<div class="tituloColumnasDT">Rol Asignado</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Estado Usuario</div>' },
      { title: '<div class="tituloColumnasDT">Estado Contraseña</div>' },
      { title: '<div class="tituloColumnasDT">Verificación Correo</div>' },
      { title: '<div class="tituloColumnasDT">usr_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">usr_id_rol</div>' },
      {
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones = '<a class="iconDtUsuariosModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          acciones += '<span class="iconDTsep">|</span>';
          acciones += '<a class="icondtUsuariosResetear cursorPointerDT" title="Resetear contraseña"><i class="fas fa-sync iconDTicon"></i></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[1, "asc"]],
    ajax: {
      url: $("#getDataTableUsuarios").val(),
      type: 'POST',
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        $('#btnUserNuevo').fadeIn();
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[6] == 1) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[6] == 0) {
        $('td', row).eq(6).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
      if (data[7] == 1) {
        $('td', row).eq(7).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[7] == 0) {
        $('td', row).eq(7).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
      if (data[8] == 1) {
        $('td', row).eq(8).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[8] == 0) {
        $('td', row).eq(8).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
  $('#dtUsuarios').on('click', '.iconDtUsuariosModificar', function (e) {
    e.preventDefault();
    window.temp_usr_cod_usuario_1 = dtUsuarios.row($(this).parents('tr').first()).data()[0];
    $("h3.editCedula").empty().prepend(dtUsuarios.row($(this).parents('tr').first()).data()[0]);
    $('#edit_usr_correo').val(dtUsuarios.row($(this).parents('tr').first()).data()[2]);
    $('#edit_usr_celular').val(dtUsuarios.row($(this).parents('tr').first()).data()[3]);
    $('#edit_usr_estado').val(dtUsuarios.row($(this).parents('tr').first()).data()[6]);
    $('#edit_usr_id_empresa').val(dtUsuarios.row($(this).parents('tr').first()).data()[9]);
    $("#edit_usr_id_rol").val(dtUsuarios.row($(this).parents('tr').first()).data()[10]);
    $('#edit_usr_nombre_1').val(dtUsuarios.row($(this).parents('tr').first()).data()[12]);
    $('#edit_usr_nombre_2').val(dtUsuarios.row($(this).parents('tr').first()).data()[13]);
    $('#edit_usr_apellido_1').val(dtUsuarios.row($(this).parents('tr').first()).data()[14]);
    $('#edit_usr_apellido_2').val(dtUsuarios.row($(this).parents('tr').first()).data()[15]);
    $('#myModalEditUser').modal('show');
  });
  $('#dtUsuarios').on('click', '.icondtUsuariosResetear', function (e) {
    e.preventDefault();
    window.temp_usr_cod_usuario_2 = dtUsuarios.row($(this).parents('tr').first()).data()[0];
    $('#myModalPassUser').modal('show');
    $("h3.passCedula").empty(); $("h3.passCedula").prepend(temp_usr_cod_usuario_2);
    $("h3.passNombres").empty(); $("h3.passNombres").prepend(dtUsuarios.row($(this).parents('tr').first()).data()[1]);
  });
  $.ajax({
    url: $("#getEmpresaRoles").val(),
    type: 'POST',
    dataType: 'html',
    data: { _token: $("#getTokenRender").val() },
    success: function (result) {
      var result = eval('(' + result + ')');
      switch (result.message) {
        case "saveOK":
          $("#usr_id_rol,#edit_usr_id_rol").empty().prepend(result.dataRoles);
          $("#usr_id_empresa,#edit_usr_id_empresa").empty().prepend(result.dataEmpresas);
          break;
        default:
          toastrMostarError("AU_1");
          break;
      }
    }
  });
  $('#btnUserNuevo').click(function () {
    $('#myModalNuevoUser').modal('show');
    document.getElementById("formUserNew").reset();
  });
  $('#usr_cod_usuario').change(function () {
    if ($("#usr_cod_usuario").val() != "") {
      var dataForm = {
        usr_cod_usuario: $("#usr_cod_usuario").val(),
        _token: $("#getTokenRender").val()
      };
      $.ajax({
        url: $("#getCedulaRepetida").val(),
        type: 'POST',
        dataType: 'html',
        data: dataForm,
        success: function (result) {
          var result = eval('(' + result + ')');
          switch (result.message) {
            case "saveOK":
              break;
            case "dataRepetida":
              $("#usr_cod_usuario").val("").focus();
              $("#loginUsuarioRegistrado").show();
              ocultarPoppupAlert();
              return false;
              break;
            default:
              toastrMostarError("AU_2");
              break;
          }
        }
      });
    }
  });
  $('#usr_correo').change(function () {
    if ($("#usr_correo").val() != "") {
      var dataForm = {
        usr_correo: $("#usr_correo").val(),
        _token: $("#getTokenRender").val()
      };
      $.ajax({
        url: $("#getCorreoRepetido").val(),
        type: 'POST',
        dataType: 'html',
        data: dataForm,
        success: function (result) {
          var result = eval('(' + result + ')');
          switch (result.message) {
            case "saveOK":
              break;
            case "dataRepetida":
              $("#usr_correo").val("").focus();
              $("#loginCorreoRegistrado").show();
              ocultarPoppupAlert();
              return false;
              break;
            default:
              toastrMostarError("AU_3");
              break;
          }
        }
      });
    }
  });
  document.getElementById("formUserNew").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      $.ajax({
        url: $("#formUserNew").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $("#formUserNew").serialize(),
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalNuevoUser').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtUsuarios.ajax.reload();
              $("#formUserNew").trigger("reset");
              toastrSuccess("😄 El registro fue guardado correctamente. ✅");
              break;
            case "saveError":
              toastrMostarError("AU_4");
              break;
          }
        }
      });
    }
  }, false);

  document.getElementById("formUserMod").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      $.ajax({
        url: $("#formUserMod").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $("#formUserMod").serialize() + "&usr_cod_usuario=" + temp_usr_cod_usuario_1,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalEditUser').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtUsuarios.ajax.reload();
              $("#formUserMod").trigger("reset");
              toastrSuccess("😄 El registro fue actualizado correctamente. ✅");
              break;
            case "saveError":
              toastrMostarError("AU_5");
              break;
          }
        }
      });
    }
  }, false);

  document.getElementById("formUserPass").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      $.ajax({
        url: $("#formUserPass").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $("#formUserPass").serialize() + "&usr_cod_usuario=" + temp_usr_cod_usuario_2,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalPassUser').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtUsuarios.ajax.reload();
              $("#formUserPass").trigger("reset");
              toastrSuccess("😄 El registro fue guardado correctamente. ✅");
              break;
            case "saveError":
              toastrMostarError("AU_6");
              break;
          }
        }
      });
    }
  }, false);
});