@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'dependencias'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-sitemap"></i> Gestión de Dependencias <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a <a href="{{ url('admin/dependencias') }}"><i class="fa fa-sitemap"></i> Gestión de Dependencias</a></li>
      <li class="active">inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">







<div class="row">

<div class="col-lg-12 custyle">
   <div class="panel panel-default">
 
      <div class="panel-heading">
         <strong><i class="fa fa-list"></i> Listado de Dependencias</strong>
      </div>
      <div class="panel-body">
         <a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal"><b>+</b> Agregar nueva dependencia</a>      
         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
      </div>
    
      <div class="ocultar_400px">
      <table class="table table-hover table-condensed" id="dev-table">
         <thead>
            <tr class="active">
               <th>#</th>
               <th>Dependencia</th>
               <th>Siglas</th>
               <th>Responsable</th>
               <th>Creada desde</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
         @foreach ($dependencias as $key => $dep)
            <tr>
               <td>{{$key+1}}</td>
               <td>{{ $dep->depe_nombre }}</td>
               <td>{{ $dep->depe_sigla }}</td>
               <td>{{ ucwords($dep->depe_responsable) }}</td>
               <td>{{ $dep->depe_creacion }}</td> 
               <td align="right">
                  <a href="{{ url('admin/showdepe/'.$dep->depe_id) }}" class="btn btn-warning btn-xs">
                     <i class="fa fa-pencil-square-o"></i> Editar
                  </a>
                  <a href="{{ url('admin/eliminardepe/'.$dep->depe_id) }}" class="btn btn-danger btn-xs">
                     <i class="fa fa-trash-o"></i> Eliminar
                  </a>
               </td>
            </tr>
         @endforeach
         </tbody>
      </table>
      </div>

   </div>
</div>

</div>



<!-- Modal -->
<form name="form1" id="form1" action="registrardepe" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i> Nueva dependencia
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">
               <div class="col-lg-12">
                  <label for="depe_nombre">Nombre de la dependencia *</label>
                  <input type="text" name="depe_nombre" id="depe_nombre" class="form-control input-sm" placeholder="Sistemas" required>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <label for="depe_sigla">Siglas *</label>
                  <input type="text" name="depe_sigla" id="depe_sigla" class="form-control input-sm" placeholder="SIS" required>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <label for="depe_responsable">Responsable</label>
                  <input type="text" name="depe_responsable" id="depe_responsable" class="form-control input-sm" placeholder="Pepito Perez Perez">
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <strong>Nota: </strong> Los campos marcados con asteriscos (*) son obligatorios
               </div>
            </div>

      
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>
</form>

 

@include('cosas_generales.boton_info', array('imagen'=>'lista_depe_admin'))
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