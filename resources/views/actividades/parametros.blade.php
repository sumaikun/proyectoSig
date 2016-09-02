@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'cargos'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-puzzle-piece"></i> Parametros <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/cargos') }}"><i class="fa fa-puzzle-piece"></i> Parametros </a></li>
      <li class="active">inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<div class="col-lg-10 col-lg-offset-1 custyle">
   <div class="panel panel-default">
 
      <div class="panel-heading">
         <strong><i class="fa fa-list"></i> Actividades-Empresas</strong>
      </div>

      
      <div class="panel-body">
         <a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal"><b>+</b> Agregar nueva actividad</a>

         <p>&nbsp&nbsp&nbspº&nbsp&nbsp<p>

         <a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal2"><b>+</b> Agregar nueva Empresa</a><p><br></p>    

         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtro" />
      </div>
         
         <div class="table-responsive ocultar_400px">
         <table class="table table-hover table-condensed" id="dev-table">
         <thead>
            <tr class="active">
               <th>#</th>
               <th>ID</th>
               <th>Nombre del cargo</th>
               <th>Perfil del cargo</th>
               <th></th>
            </tr>
         </thead>
         <tbody>
         @foreach ($cargos as $key => $cargo)
            <tr>
               <td></td>
               <td></td>
               <td><a href="#"><span class="label label-info">Ver perfil <i class="fa fa-book"></i></span> </a></td>
               <td align="right">
                  <a href="{{ url('admin/showcargo/'.$cargo->carg_id) }}" class="btn btn-warning btn-xs">
                     <i class="fa fa-pencil-square-o"></i> Editar
                  </a>
                  <a href="{{ url('admin/eliminarcargo/'.$cargo->carg_id) }}" class="btn btn-danger btn-xs">
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
<form name="form1" id="form1" action="registraractividad" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Nueva actividad
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">Nombre</label>
                  <input type="text" name="carg_nombre" id="carg_nombre" class="form-control input-sm" placeholder="Actividad" autofocus required>
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


<!-- Modal2 -->
<form name="form1" id="form1" action="registrarcargo" method="post">
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Nueva empresa
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">Nombre</label>
                  <input type="text" name="carg_nombre" id="carg_nombre" class="form-control input-sm" placeholder="Empresa" autofocus required>
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


@include('cosas_generales.boton_info', array('imagen'=>'lista_cargos_admin'))
</section>
@stop


@section('script')
<script type="text/javascript">


function validar_update(){


   if($('#carg_id').val()==''){
      alert("No ha seleccionado ningun cargo!");
      return false;
   }else if(!confirm("Está seguro de actualizar el cargo?")){
      return false;
   }

   return true;
}




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
