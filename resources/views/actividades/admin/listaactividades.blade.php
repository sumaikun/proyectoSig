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
<style type="text/css">
 .ui-datepicker-calendar {
    display: none;
    }​

  .calendarbody {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

     

</style>
	<h1><i class="fa fa-plus-circle"></i> Actividades Registradas  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Actividades</a></li>
      <li class="active">registros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

   @include('actividades.sub_views.list')


<!-- Modal -->
<form name="form1" id="form1" action="export_excel" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Filtros
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">Usuario</label>
                    <select class="form-control" name="usuario" >
                      <option value="">Selecciona</option>
                      @foreach($usuarios as $usuario)
                      <option value={{$usuario->usu_id}}> {{$usuario->usu_nombres}} {{$usuario->usu_apellido1}}</option>
                      @endforeach   
                    </select>               
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">año</label>
                  <input type="number" id="datepicker1" onclick="settime()" class="form-control" name="year" />
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">mes</label>
                  <input type="month" class="form-control" onclick="settime2()" id="datemonth" name="month" />
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">empresa</label>
                    <select class="form-control" name="empresa" >
                      <option value="">Selecciona</option>
                        @foreach($empresas as $key=>$value)
                          <option value={{$key}}>{{$value}}</option>
                        @endforeach   
                    </select>
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">No filtrar</label>
                    <input type="checkbox" name="nfilter" >
               </div>
            </div>
      
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;" onclick="unlock()"><i class="fa fa-eraser"></i> <b>Limpiar</b>
            <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i>Exportar</button>
         </div>
      </div>
   </div>
</div>
</form>


</section>
@stop


@section('script')

<script type="text/javascript">


(function(){
    'use strict';
   var $ = jQuery;
   $.fn.extend({
      filterTable: function(){
         return this.each(function(){
            $(this).on('keyup', function(e){
               $('.filterTable_no_results').remove();
               var $this = $(this), search = $this.val().toLowerCase(), target = $this.attr('data-filters'), $target = $(target), $rows = $target.find('tbody tr');
               if(search == '') {
                  $rows.show(); 
               } else {
                  $rows.each(function(){
                     var $this = $(this);
                     $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                  })
                  if($target.find('tbody tr:visible').size() === 0) {
                     var col_count = $target.find('tr').first().find('td').size();
                     var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
                     $target.find('tbody').append(no_results);
                  }
               }
            });
         });
      }
   });
   $('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
   $('[data-action="filter"]').filterTable();
   
   $('.container').on('click', '.panel-heading span.filter', function(e){
      var $this = $(this), 
            $panel = $this.parents('.panel');
      
      $panel.find('.panel-body').slideToggle();
      if($this.css('display') != 'none') {
         $panel.find('.panel-body input').focus();
      }
   });
   $('[data-toggle="tooltip"]').tooltip();
});

 $(function() {
            $('#datepicker1').datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) { 
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                }
            });
        $("#datepicker1").focus(function () {
                $(".ui-datepicker-month").hide();
            });
        });

function settime(){
 
      document.getElementById("datemonth").disabled = true;      
}

function settime2(){  

      document.getElementById("datepicker1").disabled = true;   
    
}    

function unlock(){  

  document.getElementById("datemonth").disabled = false;   
  document.getElementById("datepicker1").disabled = false; 
    
}

 

function look_for_calendar(id)
{
  $("#ajax_content").empty();
  $("#myModal2").modal('show');   
   $.get("activity_calendar/"+id, function(res, sta){
     //$("#ajax_content").append(res);                    
  });
}

$('#myModal2').on('shown.bs.modal', function () {
       $("#calendar").fullCalendar('render');
});

$(document).ready(function() {

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
    
  });

 

</script>
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js') }}
@stop
