$(document).ready(function() {
 
});
var fechaInicio = moment().format('YYYY-MM-DD');
var fechaFin = (moment().add(30,'days')).format('YYYY-MM-DD');

/*
CREATE TABLE `dct_salud_tbl_agenda_medica` (
  `agm_id_agenda` bigint(20) NOT NULL,
  `pct_id_paciente` bigint(20) NOT NULL,
  `emp_id_empresa` int(11) NOT NULL,
  `esp_id_especialidad` int(11) NOT NULL,
  `usr_cod_usuario` varchar(12) NOT NULL,
  `agm_iden_uni` varchar(15),
  `agm_fecha_inicio` varchar(10),
  `agm_hora_inicio` varchar(8),
  `agm_fecha_final` varchar(10),
  `agm_hora_final` varchar(8),
  `agm_background_color` varchar(10),
  `agm_border_color` varchar(10),
  `agm_observacion` varchar(100),
  `agm_estado` varchar(1) NOT NULL,
  `agm_usuario_creacion` varchar(12) DEFAULT NULL,
  `agm_fecha_creacion` timestamp NULL DEFAULT NULL,
  `agm_ip_creacion` varchar(100) DEFAULT NULL,
  `agm_usuario_modificacion` varchar(12) DEFAULT NULL,
  `agm_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `agm_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

ALTER TABLE `dct_salud_tbl_agenda_medica`
  ADD PRIMARY KEY (`agm_id_agenda`);
  
  ALTER TABLE `dct_salud_tbl_agenda_medica`
  MODIFY `agm_id_agenda` bigint(20) NOT NULL AUTO_INCREMENT;

*/

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
    $('#myModalNuevoUser').modal('show');
    /*calendar.addEvent({
      id: '123',
      title: 'Third Event',
      start: '2025-01-11T10:30:00',
      end: '2025-01-11T12:30:00'
    });*/
    calendar.refetchEvents();
  });

  /*
var event = calendar.getEventById('a') // an event object!
var start = event.start // a property (a Date object)
console.log(start.toISOString()) // "2018-09-01T00:00:00.000Z"
  */

});
