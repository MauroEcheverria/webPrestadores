document.addEventListener('DOMContentLoaded', function () {

  window.agm_id_agenda = null;
  var calendarEl = document.getElementById('calendar');
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
      $("#id_agm_titulo").empty().prepend(info.event.title);
      $("#id_agm_fecha_inicio").empty().prepend(info.event.extendedProps.desde);
      $("#id_agm_fecha_final").empty().prepend(info.event.extendedProps.hasta);
      $("#id_agm_correo_paciente").empty().prepend(info.event.extendedProps.correo_paciente);
      $("#id_agm_observacion").empty().prepend(info.event.extendedProps.observacion);
      $('#myModalAgendaMedicaEdit').modal('show');
    },
  });
  calendar.render();

  $("#testbtn").on("click", function () {
    $('#myModalAgendaMedicaAdd').modal('show');
  });

  /*$('#av_fecha_ampliacion').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd',
    language: 'es',
    datesDisabled: result,
  });
  $('#av_fecha_ampliacion').datepicker('setDate', new Date());*/

  $(function () {
    $('#reservationdate').datetimepicker({
      /*format: 'YYYY-MM-DD HH:mm:ss',*/
      format: 'YYYY-MM-DD',
      locale: 'es-us',
      minDate: '2025-01-01',
      maxDate: '2025-03-31',
      sideBySide: true,
      defaultDate: moment().format('YYYY-MM-DD'),
      disabledDates: ["2025-03-15", "2025-03-20"]
    });
  });
  $('#reservationdate').datetimepicker({ format: 'YYYY-MM-DD', date: '2025-02-05' });

  $('#datetimepicker3').datetimepicker({
    format: 'LT',
    locale: 'es-us',
    disabledHours: [10, 11]
  });
  $('#datetimepicker3').datetimepicker('date', moment('20:10', 'HH:mm'));


  document.getElementById("formAgendaMedicaAdd").addEventListener("submit", function (event) {
    event.preventDefault();
    if (this.checkValidity() === false) {
      event.stopPropagation();
      this.classList.add("was-validated");
    }
    else {
      $.ajax({
        url: $("#formAgendaMedicaAdd").attr('data-action'),
        type: 'POST',
        dataType: 'html',
        data: $("#formAgendaMedicaAdd").serialize(),
        success: function (result) {
          var result = eval('(' + result + ')');
          $('#myModalAgendaMedicaAdd').modal('hide');
          switch (result.message) {
            case "saveOK":
              calendar.refetchEvents();
              $("#formAgendaMedicaAdd").trigger("reset");
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

});
