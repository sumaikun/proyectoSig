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
      defaultDate: '{{$registro->fecha_ingreso}}',
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function() {
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
      },
      selectable: true,
      selectHelper: true,
      select: function(start, end) {        
        var comparestart = new Date('{{$registro->fecha_ingreso}}');
        var comparefinish = new Date('{{$registro->fecha_salida}}');
        //console.log("fecha: "+start+" compare:"+compare.getTime());
        var eventData;
        if(start >=comparestart.getTime() &&  end <= comparefinish.getTime()){
            var title = modal_calendar();

            if (title) {
              $("#tempdate").val(start);
            /*eventData = {            
              title: title,
              start: start,
              color  : '#A2897B',            
              end: end
            };

            $('#calendar').fullCalendar('renderEvent', eventData, true);*/ // stick? = true
          }  
        }        
        $('#calendar').fullCalendar('unselect');
      }
    });


  });
  $(document).ready(function() {

    var myCalendar = $('#calendar');      

    var myEvent = {
      title: "Alquiler",
      allDay: true,
      start: '{{$registro->fecha_ingreso}}',
      end: '{{$registro->fecha_salida}}' 
    };        

    myCalendar.fullCalendar('renderEvent', myEvent, true);    
  });

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



</style>   
<section class="content" style="margin-top: -5px;">
   <div class="col-lg-9">
      <div style="background-color: white;">     
        <div id='wrap' style="width:100%;height:100%;">      
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
          <td style="text-align: center"> <input type="date" name="fecha1" onblur="update_calendar()" value="{{$registro->fecha_ingreso}}"></td>          
        </tr>
         <tr>
          <td style="text-align: center">Fecha de devolución</td>          
        </tr>
        <tr>
          <td style="text-align: center"> <input type="date" name="fecha2" onblur="update_calendar()" value="{{$registro->fecha_salida}}"></td>          
        </tr>
         <tr>
          <td style="text-align: center">Valor Estandar</td>          
        </tr>
        <tr>
          <td style="text-align: center">$<input type="number" name="valor" onblur="update_calendar()" value="{{$registro->valor}}"></td>          
        </tr>
         <tr>
          <td style="text-align: center">Valor Receso</td>          
        </tr>
        <tr>
          <td style="text-align: center">$<input type="number" name="valor2" onblur="update_calendar()" value="{{$registro->valor2}}"></td>          
        </tr>
          <input type="hidden" name="cantidad_v" value="{{$registro->cantidad_valor2}}">
         <tr>
          <td style="text-align: center">Valor total</td>          
        </tr>
        <tr>
          <td style="text-align: center"> <span id="total">{{psig\Helpers\Metodos::asDollars((int)psig\Helpers\horas_minutos::taking_away_days($registro->fecha_salida,$registro->fecha_ingreso)*$registro->valor)}}</span> </td>          
        </tr>
        <tr>
          <td style="text-align: center"><button onclick="update_data()" class="btn btn-warning">Guardar</button></td>          
        </tr>    
      </tbody>
    </table>
  </div>      
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Opciones de calendario en alquiler</h4>
      </div>
      <div class="modal-body">        
        <button class="btn btn-primary form-control" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">¿Es un dia de receso?</button>
        <br>
          <div class="collapse" id="collapseExample">
          <div class="card card-block">
              <div class="form-group">
                    <label class="form-control">Si</label><input type="radio" class="form-control" name="day" value="si">
                    <label class="form-control">No</label><input type="radio" class="form-control" name="day" value="no" checked>
              </div>        
          </div>
        </div>

        <button class="btn btn-primary form-control" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">Crear Anotación</button>
        <br>
          <div class="collapse" id="collapseExample2">
          <div class="card card-block">
              <div class="form-group">
                    <label class="form-control">Anotación</label>
                    <textarea  class="form-control" name="day" ></textarea>                    
              </div>        
          </div>
        </div>
      </div>
      <input type="hidden" id="tempdate" value="">
      <div class="modal-footer">
        <button type="button" onclick="modal_form()"  class="btn btn-success" data-dismiss="modal">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@stop



<script>

  Number.prototype.format = function(n, x, s, c) {
      var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
          num = this.toFixed(Math.max(0, ~~n));

      return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
  };

  function update_calendar()
  {
    console.log($("input[name='fecha1']").val());
    var myCalendar = $('#calendar');
    myCalendar.fullCalendar('removeEvents');
     myEvent = {
      title: "Alquiler",
      allDay: true,
      start: $("input[name='fecha1']").val(),
      end: $("input[name='fecha2']").val() 
    };        

    myCalendar.fullCalendar('renderEvent', myEvent, true);
    $("#total").empty();
    var vtotal = taking_away_days()*$("input[name='valor']").val();
    $("#total").append("$"+vtotal.format(2, 3, '.', ','));

  }


  function taking_away_days()
  {
    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
    var firstDate = new Date($("input[name='fecha2']").val());
    var secondDate = new Date($("input[name='fecha1']").val());
    var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));  
    return diffDays;
  }


  function update_data()
  {
      $.get("modify_rent_data/"+{{$registro->id}}+"/"+$("input[name='fecha2']").val()+"/"+$("input[name='fecha1']").val()+"/"+$("input[name='valor']").val()+"/"+$("input[name='valor2']").val()+"/"+$("input[name='cantidad_v']").val(), function(res, sta){
        if(res == "denied")
        {
          alert('El valor de receso no puede ser mayor al valor estandar');
        }
        else{
          alert('datos modificados con éxito');  
        }
        
      });
  }

  function modal_calendar()
  {
    $("#myModal").modal("show");
    return "check";
  }

  function modal_form()
  {
    dateObj = $("#tempdate").val();
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();

    newdate = year + "/" + month + "/" + day;
    console.log("date "+newdate);
    
    $.post("calendar_options", {} ,function(data){
          alert(data);
      });
  }
  
  //https://codepen.io/subodhghulaxe/pen/myxyJg
</script>


