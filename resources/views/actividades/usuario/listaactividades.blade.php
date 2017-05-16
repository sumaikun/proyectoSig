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

function look_for_list(id,year)
{
  $.get("activity_list/"+id+"/"+$("select[name=year_list]").val(), function(res, sta){
      $("#ajax_content2").empty();
      $("#myModal4").modal('show');
      $("#ajax_content2").append(res);
      $('#sample').DataTable({
       "bSort": false,
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
       },
       fixedHeader: {
            header: true
        },"pageLength": 25
      });
  });
}

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

function edit_register(id)
{
  $.get("reg_edit/"+id, function(res, sta){
      $("input[name=id]").val(id);
      $("select[name=actividad]").val(res.tp_actividad);
      $("select[name=empresa]").val(res.tp_empresa);
      $("input[name=fecha]").val(res.fecha);
      $("input[name=filial]").val(res.filial);
      $("input[name=subcontratista]").val(res.subcontratista);
      $("input[name=hini]").val(res.hora_inicio);
      $("input[name=hfin]").val(res.hora_final);
      $("#descripcion").empty();     
      $("#descripcion").append(res.descripcion);    
     });
  $('#myModal5').modal('show');
}

function validate_date()
{  
  $("#hfin").prop( "disabled", false );
  $("#hfin").prop( "min", $("#hini").val());
}

function big_text_edit(elem){
   $("td").css("white-space","nowrap");
   $(elem).css("white-space","normal");
   
}

$(document).on("submit","#form1",function(e){
  $("#hfin").prop( "disabled", false );
  $("#myModal5").modal('hide');  
  e.preventDefault();           
     var route = "updateactividad";
     var token = $("#token").val();
     var datastring = $("#form1").serialize();        
       $.ajax({
          url: route,  
          headers: {'X-CSRF-TOKEN': token},
          type: 'POST',
          dataType: 'html',     
          data: datastring,          
          success: function(data)
          {
             $("#form1").trigger('reset');   
             $("#hfin").prop( "disabled", true );
             alert(data);
             $("#myModal3").modal('hide');
             $("#myModal4").modal('hide');
          },
          error: function(data)
          {
            alert("ha ocurrido un error") ;
          }       
      });   
});
</script>
@stop
