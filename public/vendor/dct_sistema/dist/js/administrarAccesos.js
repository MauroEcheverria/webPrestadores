function fnSistemaEmpresa() {
  dtSistemaEmpresa = $('#dtSistemaEmpresa').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [1, 2, 3, 13, 14, 15, 16, 17, 18]
      },
      {
        "targets": [0, 4, 5, 6, 7, 8, 9, 10, 11, 12, 19],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">emp_id_empresa</div>' },
      { title: '<div class="tituloColumnasDT">RUC</div>' },
      { title: '<div class="tituloColumnasDT">Empresa</div>' },
      { title: '<div class="tituloColumnasDT">Nombre comercial</div>' },
      { title: '<div class="tituloColumnasDT">Cont. especial</div>' },
      { title: '<div class="tituloColumnasDT">dir_matriz</div>' },
      { title: '<div class="tituloColumnasDT">ser_fact</div>' },
      { title: '<div class="tituloColumnasDT">ser_nc</div>' },
      { title: '<div class="tituloColumnasDT">ser_nd</div>' },
      { title: '<div class="tituloColumnasDT">ser_guia_remision</div>' },
      { title: '<div class="tituloColumnasDT">ser_ret</div>' },
      { title: '<div class="tituloColumnasDT">lleva_cont</div>' },
      { title: '<div class="tituloColumnasDT">tipo_amb</div>' },
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
          acciones = '<a class="iconDtSistemaEmpresaModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[1, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaEmpresa").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        //$('#btnNuevaSistemaEmpresa').fadeIn();
        return json.data;
      },
      timeout: 60000
    },

    createdRow: function (row, data, index) {
      if (data[17] == 1) {
        $('td', row).eq(7).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[17] == 0) {
        $('td', row).eq(7).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }

  });
}
function fnSistemaRol() {
  dtSistemaRol = $('#dtSistemaRol').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [1, 2, 3]
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
          acciones = '<a class="iconDtSistemaRolModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[1, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaRol").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[2] == 1) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[2] == 0) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaAplicacion() {
  dtSistemaAplicacion = $('#dtSistemaAplicacion').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [1, 2, 3, 4, 5, 6, 7]
      },
      {
        "targets": [0, 4, 5],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">apl_id_aplicacion</div>' },
      { title: '<div class="tituloColumnasDT">Aplicación</div>' },
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
          acciones = '<a class="iconDtSistemaAplicacionModificar" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[1, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaAplicacion").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[6] == 1) {
        $('td', row).eq(3).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[6] == 0) {
        $('td', row).eq(3).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaOpcion() {
  dtSistemaOpcion = $('#dtSistemaOpcion').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [1, 2, 3, 4, 5]
      },
      {
        "targets": [0, 3],
        "visible": false,
        "searchable": false
      }
    ],
    columns: [
      { title: '<div class="tituloColumnasDT">opc_id_opcion</div>' },
      { title: '<div class="tituloColumnasDT">Opción</div>' },
      { title: '<div class="tituloColumnasDT">Aplicación</div>' },
      { title: '<div class="tituloColumnasDT">Orden</div>' },
      { title: '<div class="tituloColumnasDT">Estado</div>' },
      {
        title: '<div class="tituloColumnasDT">Acciones</div>',
        width: "80",
        mRender: function (data, type, row) {
          var acciones = '';
          acciones = '<a class="iconDtSistemaOpcionModificar" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[2, "asc"], [1, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaOpcion").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[4] == 1) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[4] == 0) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaRol() {
  dtSistemaRol = $('#dtSistemaRol').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [1, 2, 3]
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
          acciones = '<a class="iconDtSistemaRolModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[1, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaRol").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[2] == 1) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[2] == 0) {
        $('td', row).eq(1).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaEmpresaAplicativo() {
  dtSistemaEmpresaAplicativo = $('#dtSistemaEmpresaAplicativo').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [2, 3, 4, 5]
      },
      {
        "targets": [0, 1],
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
          acciones = '<a class="iconDtSistemaEmpresaAplicativoModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[2, "asc"], [3, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaEmpresaAplicativo").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[4] == 1) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[4] == 0) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaRolAplicativo() {
  dtSistemaRolAplicativo = $('#dtSistemaRolAplicativo').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [2, 3, 4, 5]
      },
      {
        "targets": [0, 1],
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
          acciones = '<a class="iconDtSistemaRolAplicativoModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[2, "asc"], [3, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaRolAplicativo").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[4] == 1) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[4] == 0) {
        $('td', row).eq(2).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
function fnSistemaRolOpcion() {
  dtSistemaRolOpcion = $('#dtSistemaRolOpcion').DataTable({
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
        sClass: "centrarContenido",
        aTargets: [2, 3, 4, 5, 6]
      },
      {
        "targets": [0, 1],
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
          acciones = '<a class="iconDtSistemaRolOpcionModificar cursorPointerDT" title="Editar registro"><i class="fas fa-edit iconDTicon"></i></a>';
          return acciones
        }
      },
    ],
    oLanguage: { sUrl: $("#oLanguageDataTable").val() },
    lengthMenu: [5, 10, 15, 20, 30],
    order: [[2, "asc"], [3, "asc"], [4, "asc"]],
    ajax: {
      url: $("#getDataTableSistemaRolOpcion").val(),
      type: "post",
      data: function (d) {
        d._token = $("#getTokenRender").val();
      },
      dataSrc: function (json) {
        return json.data;
      },
      timeout: 60000
    },
    createdRow: function (row, data, index) {
      if (data[5] == 1) {
        $('td', row).eq(3).html("<div align='center'><div style='display:none;'>Activo</div><img id='okEvalu' src='../../../vendor/dct_sistema/dist/img/x-visto.png' style='width: 17px;'/></div>");
      }
      if (data[5] == 0) {
        $('td', row).eq(3).html("<div align='center'><div style='display:none;'>Inactivo</div><img id='errorEvalu'src='../../../vendor/dct_sistema/dist/img/x-error.png' style='width: 17px;'/></div>");
      }
    }
  });
}
document.addEventListener('DOMContentLoaded', function () {
  window.dtSistemaEmpresa = null;
  window.dtSistemaRol = null;
  window.dtSistemaAplicacion = null;
  window.dtSistemaOpcion = null;
  window.dtSistemaRol = null;
  window.dtSistemaEmpresaAplicativo = null;
  window.dtSistemaRolAplicativo = null;
  window.dtSistemaRolOpcion = null;
  if ($('div#appAdministrarSistema').hasClass('appAdministrarSistema')) {
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
    url: $("#getDataSelect").val(),
    type: 'POST',
    dataType: 'html',
    data: { _token: $("#getTokenRender").val() },
    success: function (result) {
      var result = eval('(' + result + ')');
      switch (result.message) {
        case "saveOK":
          $("select#ctg_id_catalogo").empty().prepend(result.dataCatalogos);
          $("select#emp_empresa_1").empty().prepend(result.dataEmpresas);
          $("select#rol_rol_2").empty().prepend(result.dataRoles);
          $("select#rol_rol_3").empty().prepend(result.dataRoles);
          break;
        default:
          toastrMostarError("AA_1");
          break;
      }
    }
  });
  $('#btnNuevaSistemaEmpresa').click(function () {
    $('#tipo_form_sist_empre').val("New");
    $('#ctg_id_catalogo').val("");
    $('#myModalSistemaEmpresa').modal('show');
    document.getElementById("formSistemaEmpresa").reset();
    $(".empCamposNoEditables").attr("disabled", false);
  });
  $('#btnNuevaSistemaRol').click(function () {
    document.getElementById("formSistemaRol").reset();
    $('#tipo_form_sist_rol').val("New");
    $('#rol_estado').val("1").prop("disabled", true);
    $('#rol_rol').prop("disabled", false).prop("required", true);
    $('#myModalSistemaRol').modal('show');
  });
  $('#btnNuevaSistemaEmpresaAplicativo').click(function () {
    document.getElementById("formSistemaEmpresaAplicativo").reset();
    $('#tipo_form_sist_emp_apl').val("New");
    $('#ape_estado').val("1").prop("disabled", true);
    $('#emp_empresa_1').prop("disabled", false).prop("required", true);
    $('#apl_aplicacion_1').prop("disabled", true).prop("required", true);
    $('#myModalSistemaEmpresaAplicativo').modal('show');
  });
  $('#btnNuevaSistemaRolAplicativo').click(function () {
    document.getElementById("formSistemaRolAplicativo").reset();
    $('#tipo_form_sist_rol_apl').val("New");
    $('#rla_estado').val("1").prop("disabled", true);
    $('#rol_rol_2').prop("disabled", false).prop("required", true);
    $('#apl_aplicacion_2').prop("disabled", true).prop("required", true);
    $('#myModalSistemaRolAplicativo').modal('show');
  });
  $('#btnNuevaSistemaRolOpcion').click(function () {
    document.getElementById("formSistemaRolOpcion").reset();
    $('#tipo_form_sist_rol_opc').val("New");
    $('#rlo_estado').val("1").prop("disabled", true);
    $('#rol_rol_3').prop("disabled", false).prop("required", true);
    $('#opc_opcion_3').prop("disabled", true).prop("required", true);
    $('#myModalSistemaRolOpcion').modal('show');
  });
  $('#dtSistemaEmpresa').on('click', '.iconDtSistemaEmpresaModificar', function (e) {
    e.preventDefault();
    window.temp_emp_id_empresa_1 = dtSistemaEmpresa.row($(this).parents('tr').first()).data()[0];
    window.temp_ctg_id_catalogo_1 = dtSistemaEmpresa.row($(this).parents('tr').first()).data()[19];
    $('#emp_empresa').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[2]);
    $('#emp_ruc').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[1]);
    $('#emp_estado').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[17]);
    $('#emp_vigencia_desde').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[13]);
    $('#emp_vigencia_hasta').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[14]);
    //$('#emp_vigencia_desde').datepicker('setDate', dtSistemaEmpresa.row($(this).parents('tr').first()).data()[13]);
    //$('#emp_vigencia_hasta').datepicker('setDate', dtSistemaEmpresa.row($(this).parents('tr').first()).data()[14]);
    $('#ctg_id_catalogo').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[19]);
    $('#emp_nom_comercial').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[3]);
    $('#emp_contrib_especial').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[4]);
    $('#emp_direccion_matriz').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[5]);
    $('#emp_ser_fact').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[6]);
    $('#emp_ser_ncred').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[7]);
    $('#emp_guia_remision').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[8]);
    $('#emp_ser_ndeb').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[9]);
    $('#emp_ser_ret').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[10]);
    $('#emp_obli_contabilidad').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[11]);
    $('#em_tipo_ambiente').val(dtSistemaEmpresa.row($(this).parents('tr').first()).data()[12]);
    $('#tipo_form_sist_empre').val("Old");
    $(".empCamposNoEditables").attr("disabled", "true");
    $('#myModalSistemaEmpresa').modal('show');
  });
  $('#dtSistemaRol').on('click', '.iconDtSistemaRolModificar', function (e) {
    e.preventDefault();
    window.temp_rol_id_rol_1 = dtSistemaRol.row($(this).parents('tr').first()).data()[0];
    $('#rol_rol').val(dtSistemaRol.row($(this).parents('tr').first()).data()[1]).prop("disabled", true).prop("required", false);
    $('#rol_estado').val(dtSistemaRol.row($(this).parents('tr').first()).data()[2]).prop("disabled", false);
    $('#tipo_form_sist_rol').val("Old");
    $('#myModalSistemaRol').modal('show');
  });
  $('#dtSistemaAplicacion').on('click', '.iconDtSistemaAplicacionModificar', function (e) {
    e.preventDefault();
    window.temp_apl_id_aplicacion_1 = dtSistemaAplicacion.row($(this).parents('tr').first()).data()[0];
    $('#apl_aplicacion').val(dtSistemaAplicacion.row($(this).parents('tr').first()).data()[1]).prop("disabled", true).prop("required", false);
    $('#apl_estado').val(dtSistemaAplicacion.row($(this).parents('tr').first()).data()[6]);
    $('#tipo_form_sist_apl').val("Old");
    $('#myModalSistemaAplicacion').modal('show');
  });
  $('#dtSistemaOpcion').on('click', '.iconDtSistemaOpcionModificar', function (e) {
    e.preventDefault();
    window.temp_opc_id_opcion_1 = dtSistemaOpcion.row($(this).parents('tr').first()).data()[0];
    $('#opc_opcion').val(dtSistemaOpcion.row($(this).parents('tr').first()).data()[1]).prop("disabled", true).prop("required", false);
    $('#opc_estado').val(dtSistemaOpcion.row($(this).parents('tr').first()).data()[4]);
    $('#tipo_form_sist_opc').val("Old");
    $('#myModalSistemaOpcion').modal('show');
  });
  $('#dtSistemaEmpresaAplicativo').on('click', '.iconDtSistemaEmpresaAplicativoModificar', function (e) {
    e.preventDefault();
    window.temp_ape_id_empresa_1 = dtSistemaEmpresaAplicativo.row($(this).parents('tr').first()).data()[0];
    window.temp_ape_id_aplicacion_1 = dtSistemaEmpresaAplicativo.row($(this).parents('tr').first()).data()[1];
    window.temp_ape_estado_1 = dtSistemaEmpresaAplicativo.row($(this).parents('tr').first()).data()[4]
    $('#emp_empresa_1').val(temp_ape_id_empresa_1).prop("disabled", true).prop("required", false);
    $('#ape_estado').val(temp_ape_estado_1).prop("disabled", false);
    $.ajax({
      url: $("#cargaSistemaEmpresaAplicativo").val(),
      type: 'POST',
      dataType: 'html',
      data: { 'dataSelect': $("#emp_empresa_1").val(), 'dataEdit': 'edit', '_token': $("#getTokenRender").val() },
      success: function (result) {
        var result = eval('(' + result + ')');
        switch (result.message) {
          case "saveOK":
            $("#apl_aplicacion_1").empty().prepend(result.dataEmpresaAplicacion).prop("disabled", false);
            $('#apl_aplicacion_1').val(temp_ape_id_aplicacion_1).prop("disabled", true).prop("required", false);
            $('#tipo_form_sist_emp_apl').val("Old");
            $('#myModalSistemaEmpresaAplicativo').modal('show');
            break;
          default:
            toastrMostarError("AA_2");
            break;
        }
      }
    });
    $('#myModalSistemaEmpresaAplicativo').modal('show');
  });
  $('#dtSistemaRolAplicativo').on('click', '.iconDtSistemaRolAplicativoModificar', function (e) {
    e.preventDefault();
    window.temp_rla_id_rol_2 = dtSistemaRolAplicativo.row($(this).parents('tr').first()).data()[0];
    window.temp_rla_id_aplicacion_2 = dtSistemaRolAplicativo.row($(this).parents('tr').first()).data()[1];
    window.temp_rla_estado_2 = dtSistemaRolAplicativo.row($(this).parents('tr').first()).data()[4]
    $('#rol_rol_2').val(temp_rla_id_rol_2).prop("disabled", true).prop("required", false);
    $('#rla_estado').val(temp_rla_estado_2).prop("disabled", false);
    $.ajax({
      url: $("#cargaSistemaRolAplicativo").val(),
      type: 'POST',
      dataType: 'html',
      data: { 'dataSelect': $("#rol_rol_2").val(), 'dataEdit': 'edit', '_token': $("#getTokenRender").val() },
      success: function (result) {
        var result = eval('(' + result + ')');
        switch (result.message) {
          case "saveOK":
            $("#apl_aplicacion_2").empty().prepend(result.dataRolAplicacion).prop("disabled", false);
            $('#apl_aplicacion_2').val(temp_rla_id_aplicacion_2).prop("disabled", true).prop("required", false);
            $('#tipo_form_sist_rol_apl').val("Old");
            $('#myModalSistemaRolAplicativo').modal('show');
            break;
          default:
            toastrMostarError("AA_3");
            break;
        }
      }
    });
    $('#myModalSistemaRolAplicativo').modal('show');
  });
  $('#dtSistemaRolOpcion').on('click', '.iconDtSistemaRolOpcionModificar', function (e) {
    e.preventDefault();
    window.temp_rlo_id_rol_3 = dtSistemaRolOpcion.row($(this).parents('tr').first()).data()[0];
    window.temp_rlo_id_opcion_3 = dtSistemaRolOpcion.row($(this).parents('tr').first()).data()[1];
    window.temp_rlo_estado_3 = dtSistemaRolOpcion.row($(this).parents('tr').first()).data()[5]
    $('#rol_rol_3').val(temp_rlo_id_rol_3).prop("disabled", true).prop("required", false);
    $('#rlo_estado').val(temp_rlo_estado_3).prop("disabled", false);
    $.ajax({
      url: $("#cargaSistemaRolOpcion").val(),
      type: 'POST',
      dataType: 'html',
      data: { 'dataSelect': temp_rlo_id_rol_3, 'dataEdit': 'edit', '_token': $("#getTokenRender").val() },
      success: function (result) {
        var result = eval('(' + result + ')');
        switch (result.message) {
          case "saveOK":
            $("#opc_opcion_3").empty().prepend(result.dataRolOpcion);
            $('#opc_opcion_3').val(temp_rlo_id_opcion_3).prop("disabled", true).prop("required", false);
            $('#tipo_form_sist_rol_opc').val("Old");
            $('#myModalSistemaRolOpcion').modal('show');
            break;
          default:
            toastrMostarError("AA_4");
            break;
        }
      }
    });
  });
  $('#rol_rol_3').change(function () {
    if ($("#rol_rol_3").val() != "") {
      $.ajax({
        url: $("#cargaSistemaRolOpcion").val(),
        type: 'POST',
        dataType: 'html',
        data: { 'dataSelect': $("#rol_rol_3").val(), 'dataEdit': 'new', '_token': $("#getTokenRender").val() },
        success: function (result) {
          var result = eval('(' + result + ')');
          switch (result.message) {
            case "saveOK":
              $("#opc_opcion_3").empty().prepend(result.dataRolOpcion).prop("disabled", false);
              break;
            default:
              toastrMostarError("AA_5");
              break;
          }
        }
      });
    }
  });
  document.getElementById("formSistemaRolOpcion").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      if ($('#tipo_form_sist_rol_opc').val() == "Old") {
        $params = $('#formSistemaRolOpcion').serialize() + "&rol_rol_3=" + temp_rlo_id_rol_3 + "&opc_opcion_3=" + temp_rlo_id_opcion_3;
        $mensaje = "😄 El registro fue actualizado correctamente. ✅";
      }
      else {
        $params = $('#formSistemaRolOpcion').serialize();
        $mensaje = "😄 El registro fue creado correctamente. ✅";
      }
      $.ajax({
        url: $("#formSistemaRolOpcion").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $params,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalSistemaRolOpcion').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtSistemaRolOpcion.ajax.reload();
              $("#formSistemaRolOpcion").trigger("reset");
              toastrSuccess($mensaje);
              break;
            default:
              toastrMostarError("AA_6");
              break;
          }
        }
      });
    }
  }, false);
  $('#rol_rol_2').change(function () {
    if ($("#rol_rol_2").val() != "") {
      $.ajax({
        url: $("#cargaSistemaRolAplicativo").val(),
        type: 'POST',
        dataType: 'html',
        data: { 'dataSelect': $("#rol_rol_2").val(), 'dataEdit': 'new', '_token': $("#getTokenRender").val() },
        success: function (result) {
          var result = eval('(' + result + ')');
          switch (result.message) {
            case "saveOK":
              $("#apl_aplicacion_2").empty().prepend(result.dataRolAplicacion).prop("disabled", false);
              break;
            default:
              toastrMostarError("AA_7");
              break;
          }
        }
      });
    }
  });
  document.getElementById("formSistemaRolAplicativo").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      if ($('#tipo_form_sist_rol_apl').val() == "Old") {
        $params = $('#formSistemaRolAplicativo').serialize() + "&rol_rol_2=" + temp_rla_id_rol_2 + "&apl_aplicacion_2=" + temp_rla_id_aplicacion_2;
        $mensaje = "😄 El registro fue actualizado correctamente. ✅";
      }
      else {
        $params = $('#formSistemaRolAplicativo').serialize();
        $mensaje = "😄 El registro fue creado correctamente. ✅";
      }
      $.ajax({
        url: $("#formSistemaRolAplicativo").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $params,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalSistemaRolAplicativo').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtSistemaRolAplicativo.ajax.reload();
              $("#formSistemaRolAplicativo").trigger("reset");
              toastrSuccess($mensaje);
              break;
            default:
              toastrMostarError("AA_8");
              break;
          }
        }
      });
    }
  }, false);
  $('#emp_empresa_1').change(function () {
    if ($("#emp_empresa_1").val() != "") {
      $.ajax({
        url: $("#cargaSistemaEmpresaAplicativo").val(),
        type: 'POST',
        dataType: 'html',
        data: { 'dataSelect': $("#emp_empresa_1").val(), 'dataEdit': 'new', '_token': $("#getTokenRender").val() },
        success: function (result) {
          var result = eval('(' + result + ')');
          switch (result.message) {
            case "saveOK":
              $("#apl_aplicacion_1").empty().prepend(result.dataEmpresaAplicacion).prop("disabled", false);
              break;
            default:
              toastrMostarError("AA_9");
              break;
          }
        }
      });
    }
  });
  document.getElementById("formSistemaEmpresaAplicativo").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      if ($('#tipo_form_sist_emp_apl').val() == "Old") {
        $params = $('#formSistemaEmpresaAplicativo').serialize() + "&emp_empresa_1=" + temp_ape_id_empresa_1 + "&apl_aplicacion_1=" + temp_ape_id_aplicacion_1;
        $mensaje = "😄 El registro fue actualizado correctamente. ✅";
      }
      else {
        $params = $('#formSistemaEmpresaAplicativo').serialize();
        $mensaje = "😄 El registro fue creado correctamente. ✅";
      }
      $.ajax({
        url: $("#formSistemaEmpresaAplicativo").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $params,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalSistemaEmpresaAplicativo').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtSistemaEmpresaAplicativo.ajax.reload();
              $("#formSistemaEmpresaAplicativo").trigger("reset");
              toastrSuccess($mensaje);
              break;
            default:
              toastrMostarError("AA_10");
              break;
          }
        }
      });
    }
  }, false);
  document.getElementById("formSistemaRol").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      if ($('#tipo_form_sist_rol').val() == "Old") {
        $params = $('#formSistemaRol').serialize() + "&rol_rol=" + temp_rol_id_rol_1;
        $mensaje = "😄 El registro fue actualizado correctamente. ✅";
      }
      else {
        $params = $('#formSistemaRol').serialize();
        $mensaje = "😄 El registro fue creado correctamente. ✅";
      }
      $.ajax({
        url: $("#formSistemaRol").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $params,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalSistemaRol').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtSistemaRol.ajax.reload();
              $("#formSistemaRol").trigger("reset");
              toastrSuccess($mensaje);
              break;
            default:
              toastrMostarError("AA_11");
              break;
          }
        }
      });
    }
  }, false);
  document.getElementById("formSistemaOpcion").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      if ($('#tipo_form_sist_opc').val() == "Old") {
        $params = $('#formSistemaOpcion').serialize() + "&opc_opcion=" + temp_opc_id_opcion_1;
        $mensaje = "😄 El registro fue actualizado correctamente. ✅";
      }
      else {
        $params = $('#formSistemaOpcion').serialize();
        $mensaje = "😄 El registro fue creado correctamente. ✅";
      }
      $.ajax({
        url: $("#formSistemaOpcion").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $params,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalSistemaOpcion').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtSistemaOpcion.ajax.reload();
              $("#formSistemaOpcion").trigger("reset");
              toastrSuccess($mensaje);
              break;
            default:
              toastrMostarError("AA_12");
              break;
          }
        }
      });
    }
  }, false);
  document.getElementById("formSistemaAplicacion").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      if ($('#tipo_form_sist_apl').val() == "Old") {
        $params = $('#formSistemaAplicacion').serialize() + "&apl_aplicacion=" + temp_apl_id_aplicacion_1;
        $mensaje = "😄 El registro fue actualizado correctamente. ✅";
      }
      else {
        $params = $('#formSistemaAplicacion').serialize();
        $mensaje = "😄 El registro fue creado correctamente. ✅";
      }
      $.ajax({
        url: $("#formSistemaAplicacion").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $params,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalSistemaAplicacion').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtSistemaAplicacion.ajax.reload();
              $("#formSistemaAplicacion").trigger("reset");
              toastrSuccess($mensaje);
              break;
            default:
              toastrMostarError("AA_13");
              break;
          }
        }
      });
    }
  }, false);
  document.getElementById("formSistemaEmpresa").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      if ($('#tipo_form_sist_empre').val() == "Old") {
        $params = $('#formSistemaEmpresa').serialize() + "&emp_id_empresa=" + temp_emp_id_empresa_1;
        $mensaje = "😄 El registro fue actualizado correctamente. ✅";
      }
      else {
        $params = $('#formSistemaEmpresa').serialize();
        $mensaje = "😄 El registro fue creado correctamente. ✅";
      }
      $.ajax({
        url: $("#formSistemaEmpresa").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $params,
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalSistemaEmpresa').modal('hide');
          switch (result.message) {
            case "saveOK":
              dtSistemaEmpresa.ajax.reload();
              $("#formSistemaEmpresa").trigger("reset");
              toastrSuccess($mensaje);
              break;
            default:
              toastrMostarError("AA_14");
              break;
          }
        }
      });
    }
  }, false);
});