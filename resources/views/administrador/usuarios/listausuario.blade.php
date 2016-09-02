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
	<h1><i class="fa fa-plus-circle"></i> Listado de usuarios <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/usuarios') }}"><i class="fa fa-users"></i> Gestión usuarios</a></li>
      <li class="active">Listado usuario</li>
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
         <a href="{{ url('admin/nuevousuario') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Agregar Usuario</a>
         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
      </div>
         
         <div class="table-responsive ocultar_400px">
         <table class="table table-hover table-condensed" id="dev-table">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Nombres</strong></th>
                  <th><strong>Apellido</strong></th>
                  <!-- <th><strong>Apellido2</strong></th>
                  <th><strong>Email</strong></th> -->
                  <th><strong>Usuario</strong></th>
                  <th><strong>Tipo de usuario</strong></th>
                  <th><strong>Cargo</strong></th>
                  <th><strong>Dependencia</strong></th>
                  <th><strong>Estado</strong></th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach($usuarios as $usuario)
               <tr>
                  <td>{{$i}}</td>
                  <td>{{ucwords ($usuario->usu_nombres)}}</td>
                  <td>{{ucwords ($usuario->usu_apellido1)}}</td>
                  <!-- <td>{{ucwords ($usuario->usu_apellido2)}}</td>
                  <td>{{$usuario->usu_email}}</td> -->
                  <td>{{$usuario->usu_usuario}}</td>
                  <td>{{ucwords ($usuario->roles->rol_nombre)}}</td>
                  <td>{{ucwords ($usuario->cargos->carg_nombre)}}</td>
                  <td>{{ucwords ($usuario->dependencias->depe_nombre)}}</td>
                  <td>{{$usuario->usu_estado}}</td>
                  <td>
                     <a class='btn btn-warning btn-xs' href="{{ url('admin/showusuario/'.$usuario->usu_id) }}">
                        <i class="fa fa-pencil-square-o"></i> Editar
                     </a> 
                  </td>
               </tr>
            <?php $i++; ?>
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
