document.addEventListener('DOMContentLoaded', function() {
  window.agm_id_agenda = null;
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    allDaySlot : false,
    slotDuration:'00:30:00',
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
      today:'Hoy',
      multiMonthYear:'Año',
      month:'Mes',
      week:'Semana',
      day:'Día',
      today:'Hoy',
      list:'Lista',
    },
    headerToolbar: {
      left: 'prevYear,prev,next,nextYear today',
      center: 'title',
      right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    validRange: {
      start: '2025-01-01',
      end: moment().add(1,'years').format('YYYY-MM-DD')
    },
    eventSources: {
      url: $("#getDataTableAgendaMedica").val(),
      type: 'GET',
      data: {
        dynamic_value: Math.random(),
        _token : $("#getTokenRender").val(),
        custom_param1 : 'something',
      },
      error: function() {
        alert('there was an error while fetching events!');
      },
    },
    eventClick: function(info){
      info.jsEvent.preventDefault();
      agm_id_agenda = info.event.id;
      console.log(agm_id_agenda);
      console.log(info.event.extendedProps.observacion);
      $('#myModalAgendaMedicaAdd').modal('show');
      /*if (info.event.id) {
        var event = calendar.getEventById(info.event.id);
        event.remove();
      }*/
    },
  });
  calendar.render();

  $("#testbtn").on("click", function(){
    $('#myModalAgendaMedicaAdd').modal('show');

  });

  /*
var event = calendar.getEventById('a') // an event object!
var start = event.start // a property (a Date object)
console.log(start.toISOString()) // "2018-09-01T00:00:00.000Z"
  */
  document.getElementById("formAgendaMedicaAdd").addEventListener("submit", function(event) {
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
        success:function(result) {
          var result = eval('('+result+')');
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
