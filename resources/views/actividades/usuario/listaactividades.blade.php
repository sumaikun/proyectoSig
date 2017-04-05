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
	<h1><i class="fa fa-plus-circle"></i> Actividades Registradas  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('usuario/actividades') }}""><i class="fa fa-users"></i> Actividades</a></li>
      <li class="active">registros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

   @include('actividades.sub_views.list')



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
})

$(document).on('hidden.bs.modal', function (event) {
    if ($('.modal:visible').length) {
      $('body').addClass('modal-open');
    }
  });

 var database="";

function look_for_calendar(id)
{
  $("#ajax_content").empty();
  $("#myModal2").modal('show');   
   $.get("activity_calendar/"+id, function(res, sta){

     var myCalendar = $('#calendar');

    if(database!="")
    {
      myCalendar.fullCalendar('removeEventSource', database);  
    }   
    
    myCalendar.fullCalendar('addEventSource', res);
    database = res;                    
  });
}

$('#myModal2').on('shown.bs.modal', function () {
       $("#calendar").fullCalendar('render');
});

$(document).ready(function() {

    $('#calendar').fullCalendar({     
      editable: false,     
      events: [ ],
      eventClick: function(calEvent, jsEvent, view) {
           detail_info(calEvent.fecha,calEvent.id); 
        }
    });
    
  });

function detail_info(fecha,id)
{
  $("#ajax_content").empty();
  
    $.get("detailinfo/"+fecha+"/"+id, function(res, sta){
            $('#myModal3').modal('show');
             $("#ajax_content").append(res);        
            
        });
}


</script>
@stop
