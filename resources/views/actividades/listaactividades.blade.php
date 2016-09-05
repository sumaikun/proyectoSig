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
	<h1><i class="fa fa-plus-circle"></i> Actividades Registradas  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Actividades</a></li>
      <li class="active">registros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">



<div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading">
         <h3 class="panel-title"><i class="fa fa-list"></i> Listado de usuarios</h3>
      </div>
      <div class="panel-body">
         <!--<a href="{{ url('admin/nuevousuario') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Agregar Usuario</a>-->
         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="buscador" />
      </div>
         
         <div class="table-responsive ocultar_400px">
         <table class="table table-hover table-condensed" id="dev-table">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Fecha</strong></th>
                  <th><strong>Actividad</strong></th>                  
                  <th><strong>Empresa</strong></th>
                  <th><strong>Filial</strong></th>
                  <th><strong>Subcontratistas</strong></th>
                  <th><strong>Horas</strong></th>
                  <th><strong>Descripción</strong></th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
            
            @foreach($registros as $registro)
               <tr>
                  <td></td>
                  <td>{{ucwords ($registro->fecha)}}</td>
                  <td>{{ucwords ($registro->tp_actividad)}}</td>              
                  <td>{{$registro->tp_empresa}}</td>
                  <td>{{ucwords ($registro->filial)}}</td>
                  <td>{{ucwords ($registro->subcontratista)}}</td>
                  <td>{{ucwords ($registro->horas)}}</td>
                  <td>{{$registro->descripcion}}</td>
                  <td>
                     <a class='btn btn-warning btn-xs' href="{{ url('admin/actividades/edit/'.$registro->id) }}">
                        <i class="fa fa-pencil-square-o"></i> Editar
                     </a> 
                  </td>

               </tr>
            
            @endforeach
            </tbody>
         </table>
         </div>

   </div>
</div>





@include('cosas_generales.boton_info', array('imagen'=>'listado_usuario_admin'))
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

</script>
@stop
