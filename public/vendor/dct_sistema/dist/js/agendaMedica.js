var fechaInicio = moment().format('YYYY-MM-DD');
var fechaFin = (moment().add(30,'days')).format('YYYY-MM-DD');

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    allDaySlot : false,
    slotDuration:'00:30:00',
    height: 600,
    locale: 'es',
    initialView: 'dayGridMonth',
    initialDate: '2025-01-10',
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
      end: moment(fechaFin).add(10, 'years').format('YYYY-MM-DD')
    },
    eventSources: {
        url: $("#getDataTableAgendaMedica").val(),
        type: 'GET',
        error: function() {
          alert('there was an error while fetching events!');
        }
    },
    eventColor: '#378006',
    eventClick: function(info){
      info.jsEvent.preventDefault();
      console.log('title: ' + info.event.title);
      console.log(info.event.extendedProps.descriptionMau);
      /*if (info.event.id) {
        var event = calendar.getEventById(info.event.id);
        event.remove();
      }*/
    },
  });
  calendar.render();

  $("#testbtn").on("click", function(){
    $('#myModalAgendaMedicaAdd').modal('show');
    /*calendar.addEvent({
      id: '123',
      title: 'Third Event',
      start: '2025-01-11T10:30:00',
      end: '2025-01-11T12:30:00'
    });*/
    
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
