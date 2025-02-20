@extends('adminlte::page')

@section('title', 'Agenda Médica')

@section('content_header') &nbsp; @stop

@section('content')
  	<div class="row">
	    <div class="col-md-3">
	    	<div class="card">
		      <div class="card-header">
		          <span class="panel-title"><b>Parámetros</b></span>
		      </div>
		      <div class="card-body">
		         
		      </div>
		    </div>
	    </div>
	    <div class="col-md-9">
	    	<div class="card">
		      <div class="card-header">
		        <span class="panel-title"><b>Agenda Médica</b></span>
		      </div>
		      <div class="card-body">
    				<div id='calendar'></div>
		      </div>
		    </div>
	    </div>
	  </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr-master/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dct_sistema/dist/css/dct_global.css') }}" />
    <style type="text/css">
    #calendar a {
    	color: unset;
    }
    </style>
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr-master/build/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/dist/index.global.min.js') }}"></script>
    <script src="{{ asset('vendor/dct_sistema/dist/js/dct_global.js') }}"></script>

    <script>
			var fechaInicio = moment().format('YYYY-MM-DD');
			var fechaFin = (moment().add(30,'days')).format('YYYY-MM-DD');

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {



        	locale: 'es',
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

		      allDaySlot : false,
          slotDuration:'00:15:00',

		      initialView: 'dayGridMonth',
		      validRange: {
				    start: '2025-01-01',
            end: moment(fechaFin).add(10, 'years').format('YYYY-MM-DD')
				  },
		      initialDate: '2025-01-10',
		      navLinks: true, // can click day/week names to navigate views
		      editable: false,
		      selectable: true,
		      dayMaxEvents: true,
		      selectMirror: true,
      		nowIndicator: true,
		      events: [
		        {
		          title: 'Business Lunch',
		          start: '2025-01-03T13:00:00',
		          constraint: 'businessHours'
		        },
		        {
		          title: 'Conference',
		          start: '2025-01-11',
		          end: '2025-01-13'
		        },
		        {
		          title: 'Meeting',
		          start: '2025-01-12T10:30:00',
		          end: '2025-01-12T12:30:00'
		        },
		        {
		          title: 'Lunch',
		          start: '2025-01-12T12:00:00'
		        },
		        {
		          title: 'Meeting',
		          start: '2025-01-12T14:30:00'
		        },
		        {
		          title: 'Happy Hour',
		          start: '2025-01-12T17:30:00'
		        },
		        {
		          title: 'Dinner',
		          start: '2025-01-12T20:00:00'
		        },
		        {
		          title: 'Birthday Party',
		          start: '2025-01-13T07:00:00'
		        },
		        {
		          title: 'Click for Google',
		          url: '#',
		          start: '2025-01-28'
		        },
		        {
		          title: 'Meeting',
		          start: '2025-01-13T11:00:00',
		          constraint: 'availableForMeeting', // defined below
		          color: '#257e4a'
		        },
		        {
		          title: 'Conference',
		          start: '2025-01-18',
		          end: '2025-01-20'
		        },
		        {
		          title: 'Party',
		          start: '2025-01-29T20:00:00'
		        },

		        // areas where "Meeting" must be dropped
		        {
		          groupId: 'availableForMeeting',
		          start: '2025-01-11T10:00:00',
		          end: '2025-01-11T16:00:00',
		          display: 'background'
		        },
		        {
		          groupId: 'availableForMeeting',
		          start: '2025-01-13T10:00:00',
		          end: '2025-01-13T16:00:00',
		          display: 'background'
		        },

		        // red areas where no events can be dropped
		        {
		          start: '2025-01-24',
		          end: '2025-01-28',
		          overlap: false,
		          display: 'background',
		          color: '#ff9f89'
		        },
		        {
		          start: '2025-01-06',
		          end: '2025-01-08',
		          overlap: false,
		          display: 'background',
		          color: '#ff9f89'
		        },
		        {
		          title: 'All Day Event',
		          start: '2025-02-01',
		        },
		        {
		          title: 'Long Event',
		          start: '2025-02-07',
		          end: '2025-02-10'
		        },
		        {
		          groupId: 999,
		          title: 'Repeating Event',
		          start: '2025-02-09T16:00:00'
		        },
		        {
		          groupId: 999,
		          title: 'Repeating Event',
		          start: '2025-02-16T16:00:00'
		        },
		        {
		          title: 'Conference',
		          start: '2025-02-11',
		          end: '2025-02-13'
		        },
		        {
		          title: 'Meeting',
		          start: '2025-02-12T10:30:00',
		          end: '2025-02-12T12:30:00'
		        },
		        {
		          title: 'Lunch',
		          start: '2025-02-12T12:00:00'
		        },
		        {
		          title: 'Meeting',
		          start: '2025-02-12T14:30:00'
		        },
		        {
		          title: 'Happy Hour',
		          start: '2025-02-12T17:30:00'
		        },
		        {
		          title: 'Dinner',
		          start: '2025-02-12T20:00:00'
		        },
		        {
		          title: 'Birthday Party',
		          start: '2025-02-13T07:00:00'
		        },
		        {
		          title: 'Click for Google',
		          url: '#',
		          start: '2025-02-28'
		        }
		      ],
		      eventClick: function(info){
		      	//console.log(info);
            //alert('Event: ' + info.event.title);
				    //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
				    //alert('View: ' + info.view.type);

				    // change the border color just for fun
				    //info.el.style.borderColor = 'red';
	        }
        });
        calendar.render();
      });
    </script>
@stop