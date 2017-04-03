@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'usuarios'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')

<!-- header de la pagina -->
<section class="content-header">

  <h1><i class="fa fa-plus-circle"></i> Detalles  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
    <li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Inventario</a></li>
      <li class="active">Calendario</li>
    </ol>
    <!-- <hr> -->
</section>




<script>

  $(document).ready(function() {


    /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events .fc-event').each(function() {

      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });


    /* initialize the calendar
    -----------------------------------------------------------------*/

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month'
      },
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function() {
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
      }
    });


  });
  /*$(document).ready(function() {
      var myCalendar = $('#calendar');
      myCalendar.fullCalendar({defaultDate: '2017-03-31',
      editable: true,
      eventLimit: true});

    var myEvent = {
      title: "New Event Added",
      allDay: true,
      start: new Date(),
      end: new Date()
    };        

    myCalendar.fullCalendar('renderEvent', myEvent);    
  });*/

</script><!-- Cuerpo de la pagina -->
<style>

.content {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 10px;
  }

  #calendar {
    max-width: 700px;
    margin: 0 auto;
    position: absolute;
    z-index: 1;
  }

  #external-events {
    float: left;
    width: 150px;
    padding: 0 10px;
    border: 1px solid #ccc;
    background: #eee;
    text-align: left;
    position: relative;
    z-index: 2;
    margin-left: 700px;
    margin-top: 200px;f
  }
    
  #external-events h4 {
    font-size: 16px;
    margin-top: 0;
    padding-top: 1em;
  }
    
  #external-events .fc-event {
    margin: 10px 0;
    cursor: pointer;
  }
    
  #external-events p {
    margin: 1.5em 0;
    font-size: 11px;
    color: #666;
  }
    
  #external-events p input {
    margin: 0;
    vertical-align: middle;
  }

</style>   
<section class="content" style="margin-top: -5px;">
   <div class="col-lg-9">
      <div style="background-color: white;">     
        <div id='wrap' style="width:100%;height:100%;">
          <div id='external-events'>
            <h4>picker</h4>
            <div class='fc-event'>fecha inicio</div>
            <div class='fc-event'>fecha final</div>
            <p>
              <input type='checkbox' id='drop-remove' />
              <label for='drop-remove'>remove despues spñtar</label>
            </p>
          </div>
          <div id='calendar'></div>  
        </div>
      </div>      
  </div>
  <div class="col-lg-3">
    <table class="table">
      <thead>
        <tr>
          <th>..</th>
        </tr>  
      </thead>
      <tbody>
        <tr>
          <td style="text-align: center">Fecha de alquiler</td>          
        </tr>
        <tr>
          <td></td>          
        </tr>
         <tr>
          <td style="text-align: center">Fecha de devolución</td>          
        </tr>
        <tr>
          <td></td>          
        </tr>
         <tr>
          <td style="text-align: center">Valor</td>          
        </tr>
        <tr>
          <td></td>          
        </tr>
         <tr>
          <td style="text-align: center">Valor total</td>          
        </tr>
        <tr>
          <td></td>          
        </tr>  
      </tbody>
    </table>
  </div>      
</section>



@stop



<script>
  $('#calendar').fullCalendar({
      defaultDate: '2016-05-12',
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2016-05-01'
        },
        {
          title: 'Long Event',
          start: '2016-05-07',
          end: '2016-05-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2016-05-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2016-05-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2016-05-11',
          end: '2016-05-13'
        },
        {
          title: 'Meeting',
          start: '2016-05-12T10:30:00',
          end: '2016-05-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2016-05-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2016-05-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2016-05-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2016-05-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2016-05-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2016-05-28'
        }
      ]
    });

  //https://codepen.io/subodhghulaxe/pen/myxyJg
    </script>


