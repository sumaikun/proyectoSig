@extends('usuarios.layouts.layout')


@section('barra_usuario')
  @include('usuarios.layouts.barra_usuario', array('op'=>'inicio'))
@stop


@section('menu_lateral')
  @include('usuarios.layouts.menu_lateral', array('op'=>'inicio'))
@stop


@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop




@section('contenido')

<!-- header de la pagina -->
<section class="content-header">

  <h1><i class="fa fa-plus-circle"></i> Detalles {{$detalles}} <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
    <li><a href="{{ url('usuario/actividades') }}"><i class="fa fa-users"></i> Inventario</a></li>
      <li class="active">Calendario</li>
    </ol>
    <!-- <hr> -->
</section>




<script>

  var recesos = <?php echo json_encode($recesos) ?>;

  var anotaciones = <?php echo json_encode($anotaciones) ?>;

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
      },
      eventClick: function(event) {
          if (event.comentario) {
            modal_anotation(event.comentario,event.id);
            return false;
          }
          if (event.receso)
          {
            delete_receso(event.id);
          }
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

    generate_recesos(recesos);
    generate_anotaciones(anotaciones);

  });

  function generate_recesos(recesos)
  {
      for(var i =0; i<recesos.length; i++)
    {
      Event = {
      title: "Receso",
      allDay: true,
      receso: '1',
      id: recesos[i].id,
      color  : '#DF0101', 
      start: recesos[i].fecha_receso 
      
      };
      $('#calendar').fullCalendar('renderEvent', Event, true);
      console.log(recesos[i]);
    }
  }

  function generate_anotaciones(anotaciones)
  {
    for(var i =0; i<anotaciones.length; i++)
    {
      Event = {
      title: "Anotación",
      allDay: true,
      id: anotaciones[i].id,
      comentario: anotaciones[i].comentario, 
      color  : '#088A08', 
      start: anotaciones[i].fecha_comentario 
        
      };
      
      $('#calendar').fullCalendar('renderEvent', Event, true);
      console.log(anotaciones[i]);
    }
  }

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
          <td style="text-align: center"> <span id="total">{{psig\Helpers\Metodos::asDollars((int)psig\Helpers\horas_minutos::taking_away_days($registro->fecha_salida,$registro->fecha_ingreso)*$registro->valor-($registro->cantidad_valor2*$registro->valor2))}}</span> </td>          
        </tr>
        @if(Session::get('cambiar_alquileres')!=null)
        <tr>
          <td style="text-align: center"><button onclick="update_data()" class="btn btn-warning">Guardar</button></td>  
        </tr>
        @endif
        <tr>
         Cliente: {{$empresas[$registro->id_empresa]}}
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
                    <label class="form-control">Si</label><input type="radio" class="form-control" name="receso" value="si">
                    <label class="form-control">No</label><input type="radio" class="form-control" name="receso" value="no" checked>
              </div>        
          </div>
        </div>

        <button class="btn btn-primary form-control" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">Crear Anotación</button>
        <br>
          <div class="collapse" id="collapseExample2">
          <div class="card card-block">
              <div class="form-group">
                    <label class="form-control">Anotación</label>
                    <textarea  class="form-control" name="anotacion" ></textarea>                    
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
  
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Anotación</h4>
      </div>
      <div class="modal-body">
        <div id="anotation_text"></div>
        <input id="id_deleteanotation" type="hidden">     
      </div>
      <div class="modal-footer">
        <button type="button" onclick="delete_anotation()"  class="btn btn-success" data-dismiss="modal">Eliminar anotación</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


@stop

<?php
  //echo $anotaciones;

?>

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

    update_all_calendar();

    $("#total").empty();
      result1 = taking_away_days()*$("input[name='valor']").val();
      console.log(result1);
      result2 = $("input[name='cantidad_v']").val()*$("input[name='valor2']").val();      
      console.log(result2);
      var vtotal = result1 - result2;
      console.log(vtotal);
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
        alert(res);
        
      });
  }

  function modal_calendar()
  {
    $("#myModal").modal("show");
    $("textarea[name='anotacion']").val("");
    return "check";
  }

  function modal_form()
  {    
    var dateObj = new Date($("#tempdate").val());
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();

    newdate = year + "/" + month + "/" + day;
    console.log("date "+newdate);
    
    var myCalendar = $('#calendar');
    myCalendar.fullCalendar('removeEvents');

    $.post("calendar_options", {alquiler:{{$registro->id}},fecha:newdate,comentario:$("textarea[name='anotacion']").val(),es_receso:$("input[name='receso']:checked").val()} ,function(data){
          alert(data);
          update_all_calendar();
          get_main_event();
      });
    
  }

  function modal_anotation(text,id)
  {
    $("#id_deleteanotation").val(id);
    $("#anotation_text").empty();
    $("#anotation_text").append(text);
    $("#myModal2").modal('show');
  }

  function delete_anotation()
  {
    if(confirm("Desea eliminar la anotación"))
    {
      $.post("delete_anotation", {id:$("#id_deleteanotation").val()} ,function(data){
          alert(data);
            var myCalendar = $('#calendar');
            myCalendar.fullCalendar('removeEvents');
            update_all_calendar();
            get_main_event();
      });
    }
   
  }

  function delete_receso(idres)
  {
    if(confirm("Desea eliminar el dia de receso"))
    {
      $.post("delete_rest", {id:idres} ,function(data){
          alert(data);
          var myCalendar = $('#calendar');
          myCalendar.fullCalendar('removeEvents');
          update_all_calendar();
          get_main_event();
      });
    }
    
  }

  function update_all_calendar()
  {
    $.get("get_all_res/"+{{$registro->id}}, function(res, sta){                 
          var recesos = res.recesos;
          for(var i =0; i<recesos.length; i++)
          {
            Event = {
            title: "Receso",
            allDay: true,
            receso: '1',
            id: recesos[i].id,
            color  : '#DF0101', 
            start: recesos[i].fecha_receso 
            
            };
            $('#calendar').fullCalendar('renderEvent', Event, true);
            console.log(recesos[i]);
          }      
      });
      $.get("get_all_anotations/"+{{$registro->id}}, function(res, sta){  
        console.log(res.anotaciones);      
         var anotaciones = res.anotaciones;
         for(var i =0; i<anotaciones.length; i++)
          {
            Event = {
            title: "Anotación",
            allDay: true,
            id: anotaciones[i].id,
            comentario: anotaciones[i].comentario, 
            color  : '#088A08', 
            start: anotaciones[i].fecha_comentario 
              
            };
            
            $('#calendar').fullCalendar('renderEvent', Event, true);
            console.log(anotaciones[i]);
          }
      });
  }
  function get_main_event()
  {
    $.get("get_main_event/"+{{$registro->id}}, function(res, sta){
      var main = res.main; 
      var myCalendar = $('#calendar');
      
      myEvent = {
        title: "Alquiler",
        allDay: true,
        start: main.fecha_ingreso,
        end: main.fecha_salida 
      };        

      myCalendar.fullCalendar('renderEvent', myEvent, true);
      $("input[name='fecha1']").val(main.fecha_ingreso);
      $("input[name='fecha2']").val(main.fecha_salida);
      $("input[name='cantidad_v']").val(main.cantidad_valor2);

      $("#total").empty();
      console.log(taking_away_days());
      console.log($("input[name='valor']").val());
      console.log($("input[name='cantidad_v']").val());
      console.log($("input[name='valor2']").val());
      result1 = taking_away_days()*$("input[name='valor']").val();
      console.log(result1);
      result2 = $("input[name='cantidad_v']").val()*$("input[name='valor2']").val();      
      console.log(result2);
      var vtotal = result1 - result2;
      console.log(vtotal);
      $("#total").append("$"+vtotal.format(2, 3, '.', ','));
    });
  }
  //https://codepen.io/subodhghulaxe/pen/myxyJg
</script>


