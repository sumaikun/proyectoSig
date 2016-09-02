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
      <i class="fa fa-check-square-o"></i> Asociar Documentos a Cargos 
   </h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Asociar Documentos a Cargos</li>
   </ol>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" >


<form action="reg_permisos_cargos" id="form1" name="form1" method="post">
   
   
<div class="col-lg-6">

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-check-circle-o"></i> Listado de Cargos</h3>
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
            <th>Cargos</th>
         </tr>
      </thead>
      <tbody>
      @foreach($cargos as $cargo)
         <tr>
            <td>
               <input type="radio" name="carg_id" id="{{$cargo->carg_id.'carg'}}" value="{{$cargo->carg_id}}" onclick="buscar_permisos_cargos(this.value)" required>
               <label for="{{$cargo->carg_id.'carg'}}">{{$cargo->carg_nombre}}</label>
            </td>
            
         </tr>
      @endforeach
      </tbody>
      </table>
   </div>
   <div class="panel-footer">
      <div class="row">
      <div class="col-lg-12">
         <button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      </div>
   </div>
</div>




</div>





<div class="col-lg-6">

<div class="well well-sm">
<div class="row">

<div class="col-lg-6">
   <div class="checkbox checkbox-circle checkbox-success">
      <input id="colocar" name="colocar" type="checkbox" onclick="gestcheckall(true)">
      <label for="colocar"><strong>Asignar todos</strong></label>
   </div>
</div>

<div class="col-lg-6">
   <div class="checkbox checkbox-circle checkbox-danger pull-right">
      <input id="quitar" name="quitar" type="checkbox" onclick="gestcheckall(false)">
      <label for="quitar"><strong>Quitar todos</strong></label>
   </div>
</div>

</div>
</div>

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
                  <input id="{{$sub->gdsub_id}}b" type="checkbox" class="pull-right" onclick="checkbox_nodos({{$sub->gdsub_id}})" />
                  
                  <div id="{{ $sub->gdsub_id.'subcolla' }}" class="panel-collapse collapse">
                  <ul class="list-unstyled">
                  @foreach ($documentos as $doc)
                     @if($sub->gdsub_id == $doc->gdsub_id)
                        <li class="correte">
                           <input type="checkbox" class="{{$sub->gdsub_id.'b'}} checkall" id="{{$doc->gddoc_id.'doc'}}" name="{{ $doc->gddoc_id.'doc' }}" />
                           <label for="{{$doc->gddoc_id.'doc'}}"> {{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }} </label>
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


</form>


</section>
@stop



@section('script')
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js') }}
{{ HTML::script('admin/js/main_angular.js') }}
<script type="text/javascript">

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


// esto es para la funcion padres hijos con los checkbox
function checkbox_nodos(id){
   $("#"+id+"b").click(function () {
      $("."+id+"b").prop('checked', $(this).is(':checked'));
   })
}

function buscar_permisos_cargos(carg_id){
   // alert(carg_id);

   $.post("buscar_permiso_carg_json",{carg_id:carg_id},function(data){ 
      
      if(data.length == 0 ){
            $('.checkall').attr("checked", false);
      }else{
         $.each(data,function(clave,valor) {
            if(valor.gdpercarg_permiso==1){
               $('#'+valor.gddoc_id+'doc').prop('checked' , true);
            }else{
               $('#'+valor.gddoc_id+'doc').prop('checked' , false);
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
