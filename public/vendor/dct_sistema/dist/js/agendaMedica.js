function inicializarTiempos() {
  $('#agm_hora_inicio,#agm_hora_final').datetimepicker('date', moment('08:00', 'HH:mm'))
  $('#agm_fecha_inicio').datetimepicker('defaultDate', moment().format('YYYY-MM-DD'))
}

document.addEventListener('DOMContentLoaded', function () {

  $('[data-mask]').inputmask()

  window.agm_id_agenda = null
  var calendarEl = document.getElementById('calendar')
  var calendar = new FullCalendar.Calendar(calendarEl, {
    allDaySlot: false,
    slotDuration: '00:30:00',
    locale: 'es',
    initialView: 'dayGridMonth',
    initialDate: moment().format('YYYY-MM-DD'),
    navLinks: true, // can click day/week names to navigate views
    editable: false,
    selectable: true,
    dayMaxEvents: true,
    selectMirror: true,
    nowIndicator: true,
    buttonText: {
      today: 'Hoy',
      multiMonthYear: 'Año',
      month: 'Mes',
      week: 'Semana',
      day: 'Día',
      today: 'Hoy',
      list: 'Lista',
    },
    headerToolbar: {
      left: 'prevYear,prev,next,nextYear today',
      center: 'title',
      right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    validRange: {
      start: '2025-01-01',
      end: moment().add(1, 'years').format('YYYY-MM-DD')
    },
    eventSources: {
      url: $("#getDataTableAgendaMedica").val(),
      type: 'GET',
      data: {
        _token: $("#getTokenRender").val(),
      },
      error: function () {
        alert('there was an error while fetching events!');
      },
    },
    eventClick: function (info) {
      info.jsEvent.preventDefault();
      agm_id_agenda = info.event.id;
      console.log("🚀 ~ document.addEventListener ~ agm_id_agenda:", agm_id_agenda)
      $("#id_agm_motivo").empty().prepend(info.event.title);
      $("#id_agm_fecha_inicio").empty().prepend(info.event.extendedProps.desde);
      $("#id_agm_fecha_final").empty().prepend(info.event.extendedProps.hasta);
      $("#id_agm_tipo").empty().prepend(info.event.extendedProps.tipo);
      $("#id_agm_observacion").empty().prepend(info.event.extendedProps.observacion);
      $("#id_agm_estado").empty().prepend(info.event.extendedProps.estado);
      $('#myModalAgendaMedicaEdit').modal('show');
    },
  })
  calendar.render()

  $('#agm_fecha_inicio').datetimepicker({
    format: 'YYYY-MM-DD',
    locale: 'es-us',
    minDate: '2025-01-01',
    maxDate: '2025-03-31',
    sideBySide: true,
    defaultDate: moment().format('YYYY-MM-DD'),
    /*disabledDates: ["2025-03-15", "2025-03-20"]*/
  })

  $('#agm_hora_inicio,#agm_hora_final').datetimepicker({
    format: 'HH:mm',
    locale: 'es-us',
    date: moment('08:00', 'HH:mm'),
    /*disabledHours: [10, 11]*/
  })

  $("#idCrearEvento").on("click", function () {
    document.getElementById('formAgendaMedicaNuevo').reset();
    inicializarTiempos()
    $('#myModalAgendaMedicaAdd').modal('show');
  })

  $(".id_buscar_cedula_agenda").on("click", function () {
    if ($('#pct_id_paciente').val() != "") {
      alert("Busco Cédula.")
    }
  })

  $('#agm_intervalo').change(function () {
    if ($('#agm_intervalo').val() != "") {
      const agm_hora_inicio = moment($('#agm_fecha_inicio').val() + " " + $('#agm_hora_inicio').val() + ":00.000");
      $('#agm_hora_final').datetimepicker('date', agm_hora_inicio.add($('#agm_intervalo').val(), 'm').format('HH:mm'))
    }
  })

  $('#agm_hora_inicio').on('change.datetimepicker', function () {
    if ($('#agm_intervalo').val() != "") {
      const agm_hora_inicio = moment($('#agm_fecha_inicio').val() + " " + $('#agm_hora_inicio').val() + ":00.000");
      $('#agm_hora_final').datetimepicker('date', agm_hora_inicio.add($('#agm_intervalo').val(), 'm').format('HH:mm'))
    }
  });

  document.getElementById("formAgendaMedicaNuevo").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      $.ajax({
        url: $("#formAgendaMedicaNuevo").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $("#formAgendaMedicaNuevo").serialize(),
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalAgendaMedicaAdd').modal('hide');
          switch (result.message) {
            case "saveOK":
              calendar.refetchEvents();
              $("#formAgendaMedicaNuevo").trigger("reset");
              toastrSuccess("😄 El registro fue guardado correctamente. ✅");
              break;
            case "saveError":
              toastrMostarError("Error al guardar la información");
              break;
            case "exitForException":
              toastrMostarError("Salida por Excepción.");
              break;
          }
        }
      })
    }
  }, false)

})
