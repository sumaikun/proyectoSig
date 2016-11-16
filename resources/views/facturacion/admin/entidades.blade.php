@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'cargos'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')

<style>

 .tb-enterprise{
   }

 .tb-data
  {
    visibility: hidden;
  } 

</style>
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-puzzle-piece"></i> Parametros <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/facturacion') }}"><i class="fa fa-puzzle-piece"></i> Facturación </a></li>
      <li class="active">parametros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<div class="col-lg-10 col-lg-offset-1 custyle">
   <div class="panel panel-default">
 
      <div class="panel-heading">
         <strong><i class="fa fa-list"></i>Entidades</strong>
      </div>

      
      <div class="panel-body">
         <a href="#"  class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal"><b>+</b> Agregar nuevo cliente</a>          
         <a href="#" style="margin-right:5px;" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal2"><b>+</b> Agregar nueva Facturadora</a>        
            
            <p><br></p>  
            <p><br></p>    

         <input type="text"  style="margin-bottom:10px;" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtro" />       

          <a href="#"  class="btn btn-success" onclick="hide_empresas()"><b>*</b> Clientes </a>          
         <a href="#" style="margin-right:5px;" class="btn btn-warning" onclick="hide_actividades()"><b>*</b> Empresas SIG</a>   

      </div>
         
         <div class="table-responsive" style="max-height:320px; ">
            <table class="table table-hover table-condensed" id="dev-table">
               <thead>
                  <tr class="active">                     
                     <th>ID</th>
                     <th style="text-align:center">Nombre</th>
                     <th style="text-align:center">Nit</th>
                     <th style="text-align:center">Telefono</th>
                     <th style="text-align:center">Dirección</th>
                     <th style="text-align:center">Ciudad</th>
                     <th style="text-align:center">Contacto</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody class="tb-activity ">         
                  @foreach ($clientes as $cliente)
                     <tr>                        
                        <td> {{$cliente->id}} </td>
                        <td> {{$cliente->nombre}} </td>
                        <td style="text-align:center"> {{$cliente->nit}} </td>
                        <td style="text-align:center"> {{$cliente->telefono}} </td>
                        <td style="text-align:center"> {{$cliente->direccion}} </td>
                        <td style="text-align:center"> {{$cliente->ciudades["nombre"]}} </td>
                        <td style="text-align:center"> {{$cliente->contacto}} </td>
                        <td align="right">
                           <a href="{{ url('admin/facturacion/editEmp/'.$cliente->id) }}" class="btn btn-warning btn-xs">
                              <i class="fa fa-pencil-square-o"></i> Editar
                           </a>
                           <!--<a href="{{ url('admin/facturacion/destroyEmp/'.$cliente->id) }}" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash-o"></i> Eliminar
                           </a>-->
                        </td>
                     </tr>
                  @endforeach
               </tbody> 
                       
               <tbody class="tb-enterprise tb-data">          
                  @foreach ($empresas as $empresa)
                     <tr>                     
                        <td> {{$empresa->id}} </td>
                        <td> {{$empresa->nombre}} </td>
                        <td style="text-align:center"> {{$empresa->nit}} </td>
                        <td style="text-align:center"> {{$empresa->telefono}} </td>
                        <td style="text-align:center"> {{$empresa->direccion}} </td>
                        <td style="text-align:center"> {{$empresa->ciudades["nombre"]}} </td>
                        <td style="text-align:center"> {{$empresa->contacto}} </td>
                        <td align="right" >
                           <a href="{{ url('admin/facturacion/editEmp/'.$empresa->id) }}" class="btn btn-warning btn-xs">
                              <i class="fa fa-pencil-square-o"></i> Editar
                           </a>
                           <!--<a href="{{ url('admin/facturacion/destroyEmp/'.$empresa->id) }}" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash-o"></i> Eliminar
                           </a>-->
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
       </div>
   </div>
</div>

 

<!-- Modal -->
<form name="form1" id="form1" action="registrarcliente" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Nuevo cliente
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">Nombre</label>
                  <input type="text" name="nombre"  class="form-control input-sm" placeholder="Nombre" autofocus required>
                  <label for="carg_nombre">Nit</label>
                  <input type="text" maxlength="11" minlength="10" name="nit" pattern="\d*[-,\/]?\d*" title="ejemplo:700569894-5" class="form-control input-sm" placeholder="Nit"  required>
                  <label for="carg_nombre">Teléfono</label>
                  <input type="text" name="telefono"  class="form-control input-sm" pattern="\d*[-,\/]?\d*" title="ejemplo:4568978 - 3005648974 es posible poner como minimo el fijo." maxlength="20" minlength="7" placeholder="Telefono"  required>
                  <label for="carg_nombre">Dirección</label>
                  <input type="text" name="direccion"  class="form-control input-sm" placeholder="Dirección" maxlength="100" minlength="10"  required>
                  <label for="carg_nombre">Departamento</label>
                  <select class="form-control" name="departamento" id="ajax_depar1" required>
                     <option value="">Selecciona</option>
                     @foreach($departamentos as $key => $temp)
                     <option value="{{$key}}">{{$temp}}</option>
                     @endforeach
                  </select>
                 <label for="carg_nombre">Ciudad</label>
                 <select class="form-control" name="ciudad" id="ajax_city1" required>
                     <option value="">Selecciona</option>
                     
                  </select>
                  <label for="carg_nombre">Contacto</label>
                  <input type="text" name="contacto" minlength="10" maxlength="50" class="form-control input-sm" placeholder="Contacto">
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
<form name="form1" id="form1" action="registrarempresa" method="post">
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
                  <input type="text" name="nombre"  class="form-control input-sm" placeholder="Nombre" autofocus required>
                  <label for="carg_nombre">Nit</label>
                  <input type="text" name="nit" pattern="\d*[-,\/]?\d*" title="ejemplo:700569894-5" class="form-control input-sm" placeholder="Nit" maxlength="11" minlength="10" required>
                  <label for="carg_nombre">Teléfono</label>
                  <input type="text" name="telefono"  class="form-control input-sm" pattern="\d*[-,\/]?\d*" title="ejemplo:4568978 - 3005648974 es posible poner como minimo el fijo." maxlength="20" minlength="7" placeholder="Telefono"  required>
                  <label for="carg_nombre">Dirección</label>
                  <input type="text" name="direccion"  class="form-control input-sm" placeholder="Dirección" maxlength="100" minlength="10"  required>                  
                  <label for="carg_nombre">Departamento</label>
                  <select class="form-control" name="departamento" id="ajax_depar2" required>
                     <option value="">Selecciona</option>
                     @foreach($departamentos as $key => $temp)
                     <option value="{{$key}}">{{$temp}}</option>
                     @endforeach
                  </select>
                  <label for="carg_nombre">Ciudad</label>
                  <select class="form-control" name="ciudad" id="ajax_city2" required>
                     <option value="">Selecciona</option>
                     
                  </select>     
                  <label for="carg_nombre">Contacto</label>
                  <input type="text" name="contacto" minlength="10" maxlength="50"  class="form-control input-sm" placeholder="Contacto">
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



      function hide_empresas(){
        document.getElementsByClassName("tb-enterprise")[0].style.display = "none";
        document.getElementsByClassName("tb-activity")[0].style.display = "";
        document.getElementsByClassName("tb-data")[0].style.visibility = "visible";
         event.preventDefault();
      }

      function hide_actividades(){
        document.getElementsByClassName("tb-activity")[0].style.display = "none";
        document.getElementsByClassName("tb-enterprise")[0].style.display = "";
        document.getElementsByClassName("tb-data")[0].style.visibility = "visible"; 
         event.preventDefault(); 
      }

$(document).ready(function() {
$("#ajax_depar1").change(event => {   
      
     if(event.target.value=="")
     {
      $("#ajax_city1").empty();
      $("#ajax_city1").append('<option> Selecciona <option>');      
     }
     else
     { 
      $.get(`ciudades/${event.target.value}`, function(res, sta){
         $("#ajax_city1").empty();
         $("#ajax_city1").append(`<option value="" selected> Selecciona </option>`);         
         res.forEach(element => {
            $("#ajax_city1").append(`<option value=${element.id}> ${element.nombre} </option>`);
         });
      });
   }
});

});

$(document).ready(function() {
$("#ajax_depar2").change(event => {   
      
     if(event.target.value=="")
     {
      $("#ajax_city2").empty();
      $("#ajax_city2").append('<option> Selecciona <option>');      
     }
     else
     { 
      $.get(`ciudades/${event.target.value}`, function(res, sta){
         $("#ajax_city2").empty();
         $("#ajax_city2").append(`<option value="" selected> Selecciona </option>`);         
         res.forEach(element => {
            $("#ajax_city2").append(`<option value=${element.id}> ${element.nombre} </option>`);
         });
      });
   }
});

});
</script>
@stop
