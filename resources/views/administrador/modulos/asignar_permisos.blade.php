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
	<h1><i class="fa fa-plus-circle"></i> Asignar Permisos funcionalidades de usuario<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li class="active">Asignar Permisos</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<form action="reg_per_fun" name="form1" id="form1" method="post">

<div class="col-lg-6">
	
<h3>funciones</h3>
<div class="well" style="max-height: 300px;overflow: auto;">
	<ul class="list-group checked-list-box">
   @foreach($funciones as $funcion)
   	<li class="list-group-item">
			<div class="radio">
         	<input type="radio" name="idfuncion" id="{{$funcion->fun_id}}" value="{{$funcion->fun_id}}" onclick="buscar_permisos_fun(this.value)" required>
            <label for="{{$funcion->fun_id}}"> <strong>{{ucwords ($funcion->fun_nombre)}}</strong> <small>{{ucwords ($funcion->fun_detalle)}}</small></label>
         </div>
      </li>
   @endforeach
  	</ul>
</div>

</div>




<div class="col-lg-6" ng-controller="Conpermisos">

<div class="well well-sm">
<div class="row">

<div class="col-lg-6">
   <div class="checkbox checkbox-circle checkbox-success">
      <input id="colocar" name="colocar" type="checkbox" onclick="gestcheckall(true)">
      <label for="colocar"><strong>Asignar a todos</strong></label>
   </div>
</div>

<div class="col-lg-6">
   <div class="checkbox checkbox-circle checkbox-danger pull-right">
      <input id="quitar" name="quitar" type="checkbox" onclick="gestcheckall(false)">
      <label for="quitar"><strong>Quitar a todos</strong></label>
   </div>
</div>

</div>
</div>

<div class="panel panel-primary">
      <div class="panel-heading">
         <h3 class="panel-title"><i class="fa fa-list"></i> Listado de usuarios</h3>
      </div>
      <div class="panel-body">
         <div class="input-group">
            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar" />
            <span class="input-group-addon" id="basic-addon2">@grupo-sig.com</span>
         </div>
      </div>
         
         <div class="table-responsive ocultar_400px">
         <table class="table table-hover table-condensed" id="dev-table">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Nombres</strong></th>
                  <th><strong>Apellido1</strong></th>
                  <th><strong>Apellido2</strong></th>
                  <th><strong>Email</strong></th>
                  <!-- <th><strong>Usuario</strong></th> -->
               </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
               <tr>
                  <td>
                     <input type="checkbox" name="{{$usuario->usu_id.'u'}}" id="{{$usuario->usu_id.'u'}}" class="checkall" value="{{$usuario->usu_id}}">
                  </td>
                  <td>{{$usuario->usu_nombres}}</td>
                  <td>{{$usuario->usu_apellido1}}</td>
                  <td>{{$usuario->usu_apellido2}}</td>
                  <td>{{$usuario->usu_email}}</td>
               </tr>
            @endforeach
            </tbody>
         </table>
         </div>

   </div>

<!-- <div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-users"></i> <strong>Usuarios</strong></h3>
   </div>
   <div class="panel-body">
   
      <div class="well well-sm">
         <div class="row">
            <div class="col-lg-12">
               <div class="input-group">
                  <input type="text" ng-model="filtro" class="form-control input-sm text-center" placeholder="rromero" aria-describedby="basic-addon2">
                  <span class="input-group-addon" id="basic-addon2">@grupo-sig.com</span>
               </div>
            </div>
         </div>
      </div>
 
      <div class="col-lg-12">
         <div class="ocultar_300px">
            <div class="checkbox">
               <ul class="list-group">
                  <li class="list-group-item" ng-repeat="usuario in usuarios | filter:filtro">
                     <input type="checkbox" name="@{{usuario.usu_id+'u'}}" id="@{{usuario.usu_id+'u'}}" class="checkall" value="@{{usuario.usu_id}}">
                     <label for="@{{usuario.usu_id+'u'}}"><b>@{{usuario.usu_usuario}}</b> @{{usuario.usu_nombres}} @{{usuario.usu_apellido1}} @{{usuario.usu_apellido2}}</label>
                  </li>
               </ul>
            </div>
         </div>
      </div> 

   </div>
</div> -->

<!-- <div class="col-lg-6">
   <button type="button" onclick="reestablecer()" id="rest" class="btn btn-warning btn-block"><i class="fa fa-floppy-o"></i> Restablecer permisos</button>
</div> -->
<div class="col-lg-6">
   <button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
</div>

</div>

</form>

</section>
@stop


@section('script')
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js') }}
{{ HTML::script('admin/js/main_angular.js') }}
<script type="text/javascript">
// funciones que se ejecutan al inicio de la carga de la pagina
// $(function() {
// 	alert("hola");
// });


// funciones quitar y colocar todos los documentos
function gestcheckall(ban){
   if(ban==true){
      $('#quitar').prop( "checked", false );
      $('.checkall').prop( "checked", true );
   }else{
      if(ban==false){
         $('#colocar').prop( "checked", false );
         $('.checkall').prop( "checked", false );
      }
   }
}




function buscar_permisos_fun(funid){

   $.post("buscar_permiso_fun_json",{funid:funid},function(data){

      // esta linea es para activar el boton Restablecer permisos
      $("#rest").prop('disabled', false);
      
      if(data.length == 0 ){
            $('.checkall').attr("checked", false);
      }else{
         $.each(data,function(clave,valor) {
            if(valor.perfun_permiso==1){
               $('#'+valor.usu_id+'u').prop('checked' , true);
            }else{
               $('#'+valor.usu_id+'u').prop('checked' , false);
            }       
         });

      }

   });

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
