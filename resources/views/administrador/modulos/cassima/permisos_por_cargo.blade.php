@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1>
      <i class="fa fa-check-circle-o"></i> Permisos por cargos 
   </h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Permisos por cargos</li>
   </ol>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" >


<form action="reg_permisos_por_cargo" id="form1" name="form1" method="post" onsubmit="return validar()">
   
   
<div class="col-lg-6">

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-users"></i> Listado de usuarios</h3>
   </div>
   <div class="panel-body">
      <div class="input-group">
         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar" />
         <span class="input-group-addon" id="basic-addon2">@grupo-sig.com</span>
      </div>
   </div>
   
   <div class="table-responsive ocultar_300px">
      <table class="table table-hover table-condensed" id="dev-table">
      <thead>
         <tr class="active">
            <th><strong>Nombres y apellidos</strong></th>
            <th><strong>Cargo</strong></th>
         </tr>
      </thead>
      <tbody>
      @foreach($usuarios as $usuario)
         <tr>
            <td>
               <input type="radio" name="usu_id" id="{{$usuario->usu_id.'usu'}}" value="{{$usuario->usu_id}}" onclick="buscar_permisos(this.value)" required>
               <label for="{{$usuario->usu_id.'usu'}}">{{$usuario->usu_nombres." ".$usuario->usu_apellido1." ".$usuario->usu_apellido2}}</label>
            </td>
            <td>{{$usuario->cargos->carg_nombre}}</td>
         </tr>
      @endforeach
      </tbody>
      </table>
   </div>
   <div class="panel-footer">
      <!-- <div class="row">
      <div class="col-lg-12">
         <button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      </div> -->
   </div>
</div>

</div>





<div class="col-lg-6">

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-circle-o"></i> Permisos por cargo</h3>
   </div>
   <div class="panel-body">
      <button type="submit" class="btn btn-lg btn-success btn-block">
         <i class="fa fa-floppy-o"></i>
          Asignar permisos por su respectivo cargo
      </button>
   </div>
</div>

</div>


</form>

</section>
@stop



@section('script')
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js') }}
{{ HTML::script('admin/js/main_angular.js') }}
<script type="text/javascript">

function validar(){
   if(!confirm('Está seguro de actualizar los permisos de esta persona?')){
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
