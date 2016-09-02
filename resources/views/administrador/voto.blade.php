@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'voto'))
@stop




@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-flag-o"></i> Elecciones <!-- <small>Panel de control</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-flag-o"></i> Elecciones</a></li>
      <li class="active">Inicio</li>
    </ol>
    <hr>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">




<div class="row"> 
<div class="col-lg-12">                  
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="@if(count($total) != 0){{($adrian*100)/count($total)}}@else{{0}}@endif" aria-valuemin="0" aria-valuemax="100" style="width:@if(count($total) != 0){{($adrian*100)/count($total)}}@else{{0}}@endif%;">
                <span class="sr-only">60% Complete</span>
            </div>
            <span class="progress-type">YOHAN ADRIAN PRIETO RUIZ / {{$adrian}}</span>
            <span class="progress-completed">@if(count($total) != 0) {{($adrian*100)/count($total)}} @else {{0}} @endif %</span>
        </div>

        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="@if(count($total) != 0){{($gloria*100)/count($total)}}@else{{0}}@endif" aria-valuemin="0" aria-valuemax="100" style="width:@if(count($total) != 0){{($gloria*100)/count($total)}}@else{{0}}@endif%;">
                <span class="sr-only">40% Complete (success)</span>
            </div>
            <span class="progress-type">GLORIA INELDA RIAÑO GARZON / {{$gloria}}</span>
            <span class="progress-completed">@if(count($total) != 0) {{($gloria*100)/count($total)}} @else {{0}} @endif %</span>
        </div>

        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="@if(count($total) != 0){{($jhony*100)/count($total)}}@else{{0}}@endif" aria-valuemin="0" aria-valuemax="100" style="width:@if(count($total) != 0){{($jhony*100)/count($total)}}@else{{0}}@endif%;">
                <span class="sr-only">40% Complete (success)</span>
            </div>
            <span class="progress-type">JHONNY J. SANCHEZ GONZALEZ / {{$jhony}}</span>
            <span class="progress-completed">@if(count($total) != 0) {{($jhony*100)/count($total)}} @else {{0}} @endif %</span>
        </div>
       
 </div>
</div>



<div class="col-lg-6">

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-users"></i> Listado de sufragantes</h3>
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
            <th>#</th>
            <th><strong>Nombres</strong></th>
            <th><strong>Apellido1</strong></th>
            <th><strong>Apellido2</strong></th>
            
            
         </tr>
      </thead>
      <tbody>
      @foreach($total as $usuario)
         <tr>
            <td>
               <!-- <input type="checkbox" name="{{$usuario->usu_id.'u'}}" id="{{$usuario->usu_id.'u'}}" class="checkall" value="{{$usuario->usu_id}}"> -->
               <input type="radio" name="usuario" id="{{$usuario->usu_id.'u'}}" value="{{$usuario->usu_id}}" onclick="buscar_permisos(this.value)" required>
            </td>
            <td>{{$usuario->usuarios->usu_nombres}}</td>
            <td>{{$usuario->usuarios->usu_apellido1}}</td>
            <td>{{$usuario->usuarios->usu_apellido2}}</td>
         </tr>
      @endforeach
      </tbody>
      </table>
   </div>
   <div class="panel-footer">
      <!-- <div class="row">
      <div class="col-lg-6">
         <button type="button" onclick="reestablecer()" id="rest" class="btn btn-warning btn-block"><i class="fa fa-floppy-o"></i> Restablecer permisos</button>
      </div>
      <div class="col-lg-6">
         <button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
      </div> -->
   </div>
</div>

</div>



<div class="col-lg-6">

<div class="panel panel-success">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-info-circle"></i> Información Elecciones</h3>
   </div>
     
   <table class="table table-condensed">
      <tr>
         <td>Total de votos:</td><td>{{count($total)}}</td>
      </tr>
      <tr>
         <td>YOHAN ADRIAN PRIETO RUIZ: </td><td>{{$adrian}}</td>
      </tr>
      <tr>
         <td>GLORIA INELDA RIAÑO GARZON: </td><td>{{$gloria}}</td>
      </tr>
      <tr>
         <td>JHONNY J. SANCHEZ GONZALEZ: </td><td>{{$jhony}}</td>
      </tr>
   </table>


</div>




</div>




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
