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
	<h1><i class="fa fa-check-square-o"></i> Permisos documentos - usuario <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Permisos Doc - Usuario</li>
   </ol>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" >


<form action="reg_permisos_doc_per" onsubmit="return validar()" id="form1" name="form1" method="post">
   
<div class="col-lg-6">

<div class="ocultar">
   <div class="panel-group" id="accordion">
      @foreach ($categorias as $cat)
      <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
               <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}"><i class="fa fa-folder-open-o"></i>
               </span> {{ ucwords ($cat->gdcat_nombre) }}</a> 
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i>
               <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
            </h4>
         </div>
         <div id="{{ $cat->gdcat_id.'colla' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
            <ul class="list-group">
            @foreach ($subcategorias as $sub)
               @if($cat->gdcat_id == $sub->gdcat_id)
               <li class="list-group-item">
                  <i class="fa fa-angle-double-right"></i>
                  <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id.'subcolla' }}" class="text-danger"> {{ $sub->gdsub_nombre }} </a>
                  <!-- <input id="{{$sub->gdsub_id}}b" type="checkbox" class="pull-right" onclick="checkbox_nodos({{$sub->gdsub_id}})" /> -->
                  
                  <div id="{{ $sub->gdsub_id.'subcolla' }}" class="panel-collapse collapse">
                  <ul class="list-unstyled">
                  @foreach ($documentos as $doc)
                     @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte">
                        <input type="radio" name="gddoc_id" class="gddoc_id" id="{{$doc->gdver_id}}" value="{{$doc->gdver_id}}" onclick="buscar_permisos(this.value)">
                        <label for="{{$doc->gddoc_id}}">{{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }}</label>
                     </li>
                     @endif
                  @endforeach   
                  </ul>
                  </div>

               </li>
               @endif
            @endforeach
            </ul>
         </div>
      </div>
      @endforeach
   </div>
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
      <h3 class="panel-title"><i class="fa fa-users"></i> Listado de usuarios</h3>
   </div>
   <div class="panel-body">
      <div class="input-group">
         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar" />
         <span class="input-group-addon" id="basic-addon2">@grupo-sig.com</span>
      </div>
   </div>
   
   <div class="table-responsive ocultar_250px">
      <table class="table table-hover table-condensed" id="dev-table">
      <thead>
         <tr class="active">
            <th>#</th>
            <th><strong>Nombres</strong></th>
            <th><strong>Apellido1</strong></th>
            <th><strong>Apellido2</strong></th>
            <th><strong>Cargo</strong></th>
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
            <td>{{$usuario->cargos->carg_nombre}}</td>
         </tr>
      @endforeach
      </tbody>
      </table>
   </div>
   <div class="panel-footer">
      <button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
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

$(function() {
   $("#rest").prop('disabled', true);
});


// function reestablecer(){
//    var usuario =  $('input:radio[name=usuario]:checked').val();
//    buscar_permisos(usuario);
// }


function buscar_permisos(docid){

   $.post("buscar_permiso_per_json",{docid:docid},function(data){

      // esta linea es para activar el boton Restablecer permisos
      $("#rest").prop('disabled', false);
      
      if(data.length == 0 ){
            $('.checkall').attr("checked", false);
      }else{
         $('.checkall').attr("checked", false);
         $.each(data,function(clave,valor) {
            //console.log('got');
            //console.log('permiso:'+valor.gdperdoc_permiso);
                           
               

               if(valor.gdperdoc_permiso==1){
                    
                   $('#'+valor.usu_id+'u').prop('checked' , true);
               }else{
                  if(valor.empresa != null)
                  {
                     if(valor.gdperdoc_permiso==0 && docid == valor.gdver_id)
                     {
                        $('#'+valor.usu_id+'u').prop('checked' , false);
                     }  
                  }
                  else{
                     $('#'+valor.usu_id+'u').prop('checked' , false);
                  }
               }               
                           
            
                   
         });

      }

   });

}


function validar(){
   if(!$('.gddoc_id').is(':checked')){
      alert("No ha seleccionado ningún documento");
      return false;
   }

   on_preload();
   return true;
}


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
