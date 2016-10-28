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
         <a href="#" style="margin-right:5px;" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal2"><b>+</b> Agregar nueva Empresa</a>        
            
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
                     <th>Nombre</th>
                     <th>Nit</th>
                     <th>Telefono</th>
                     <th>Dirección</th>
                     <th>Ciudad</th>
                     <th>Contacto</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody class="tb-activity ">         
                  @foreach ($clientes as $cliente)
                     <tr>                        
                        <td> {{$cliente->id}} </td>
                        <td> {{$cliente->nombre}} </td>
                        <td> {{$cliente->nit}} </td>
                        <td> {{$cliente->telefono}} </td>
                        <td> {{$cliente->direccion}} </td>
                        <td> {{$cliente->ciudad}} </td>
                        <td> {{$cliente->contacto}} </td>
                        <td align="right">
                           <a href="{{ url('admin/facturacion/editEmp/'.$cliente->id) }}" class="btn btn-warning btn-xs">
                              <i class="fa fa-pencil-square-o"></i> Editar
                           </a>
                           <a href="{{ url('admin/facturacion/destroyEmp/'.$cliente->id) }}" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash-o"></i> Eliminar
                           </a>
                        </td>
                     </tr>
                  @endforeach
               </tbody> 
                       
               <tbody class="tb-enterprise tb-data">          
                  @foreach ($empresas as $empresa)
                     <tr>                     
                        <td> {{$empresa->id}} </td>
                        <td> {{$empresa->nombre}} </td>
                        <td> {{$empresa->nit}} </td>
                        <td> {{$empresa->telefono}} </td>
                        <td> {{$empresa->direccion}} </td>
                        <td> {{$empresa->ciudad}} </td>
                        <td> {{$empresa->contacto}} </td>
                        <td align="right" >
                           <a href="{{ url('admin/facturacion/editEmp/'.$empresa->id) }}" class="btn btn-warning btn-xs">
                              <i class="fa fa-pencil-square-o"></i> Editar
                           </a>
                           <a href="{{ url('admin/facturacion/destroyEmp/'.$empresa->id) }}" class="btn btn-danger btn-xs">
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

 

<!-- Modal -->
<form name="form1" id="form1" action="registrarcliente" method="post">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Nueva cliente
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">
               <div class="col-lg-12">
                  <label for="carg_nombre">Nombre</label>
                  <input type="text" name="nombre"  class="form-control input-sm" placeholder="Actividad" autofocus required>
                  <label for="carg_nombre">Nit</label>
                  <input type="text" name="nit"  class="form-control input-sm" placeholder="Nit"  required>
                  <label for="carg_nombre">Teléfono</label>
                  <input type="text" name="telefono"  class="form-control input-sm" placeholder="Telefono"  required>
                  <label for="carg_nombre">Dirección</label>
                  <input type="text" name="direccion"  class="form-control input-sm" placeholder="Dirección"  required>
                 <label for="carg_nombre">Ciudad</label>
                  <select name="ciudad"  class="form-control input-sm" required>
                     <option value="">Seleccion</option>
                     <option value="amazonas">Amazonas</option>
                     <option value="antioquia">Antioquia</option>
                     <option value="arauca">Arauca</option>
                     <option value="atlantico">Atl&aacute;ntico</option>
                     <option value="bolivar">Bolivar</option>
                     <option value="boyaca">Boyac&aacute;</option>
                     <option value="caldas">Caldas</option>
                     <option value="caqueta">Caquet&aacute;</option>
                     <option value="casanare">Casanare</option>
                     <option value="cauca">Cauca</option>
                     <option value="cesar">Cesar</option>
                     <option value="choco">Choc&oacute;</option>
                     <option value="cordoba">C&oacute;rdoba</option>
                     <option value="cundinamarca">Cundinamarca</option>
                     <option value="guainia">Guain&iacute;ia</option>
                     <option value="guaviare">Guaviare</option>
                     <option value="huila">Huila</option>
                     <option value="guajira">La Guajira</option>
                     <option value="magadelan">Magdalena</option>
                     <option value="meta">Meta</option>
                     <option value="narino">Nari&ntilde;o</option>
                     <option value="norte_santander">Norte de Santander</option>
                     <option value="putumayo">Putumayo</option>
                     <option value="quindio">Quind&iacute;io</option>
                     <option value="risaralda">Risaralda</option>
                     <option value="san_andres">San Andr&eacute;s y Providencia</option>
                     <option value="santander">Santander</option>
                     <option value="sucre">Sucre</option>
                     <option value="tolima">Tolima</option>
                     <option value="valle">Valle Del Cauca</option>
                     <option value="vaupes">Vaup&eacute;s</option>
                     <option value="vichada">Vichada</option>
                  </select>
                  <label for="carg_nombre">Contacto</label>
                  <input type="text" name="contacto"  class="form-control input-sm" placeholder="Contacto">
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
                  <input type="text" name="nombre"  class="form-control input-sm" placeholder="Actividad" autofocus required>
                  <label for="carg_nombre">Nit</label>
                  <input type="text" name="nit"  class="form-control input-sm" placeholder="Nit"  required>
                  <label for="carg_nombre">Teléfono</label>
                  <input type="text" name="telefono"  class="form-control input-sm" placeholder="Telefono"  required>
                  <label for="carg_nombre">Dirección</label>
                  <input type="text" name="direccion"  class="form-control input-sm" placeholder="Dirección"  required>
                  <label for="carg_nombre">Ciudad</label>
                  <select name="ciudad"  class="form-control input-sm" required>
                     <option value="">Seleccion</option>
                     <option value="amazonas">Amazonas</option>
                     <option value="antioquia">Antioquia</option>
                     <option value="arauca">Arauca</option>
                     <option value="atlantico">Atl&aacute;ntico</option>
                     <option value="bolivar">Bolivar</option>
                     <option value="boyaca">Boyac&aacute;</option>
                     <option value="caldas">Caldas</option>
                     <option value="caqueta">Caquet&aacute;</option>
                     <option value="casanare">Casanare</option>
                     <option value="cauca">Cauca</option>
                     <option value="cesar">Cesar</option>
                     <option value="choco">Choc&oacute;</option>
                     <option value="cordoba">C&oacute;rdoba</option>
                     <option value="cundinamarca">Cundinamarca</option>
                     <option value="guainia">Guain&iacute;ia</option>
                     <option value="guaviare">Guaviare</option>
                     <option value="huila">Huila</option>
                     <option value="guajira">La Guajira</option>
                     <option value="magadelan">Magdalena</option>
                     <option value="meta">Meta</option>
                     <option value="narino">Nari&ntilde;o</option>
                     <option value="norte_santander">Norte de Santander</option>
                     <option value="putumayo">Putumayo</option>
                     <option value="quindio">Quind&iacute;io</option>
                     <option value="risaralda">Risaralda</option>
                     <option value="san_andres">San Andr&eacute;s y Providencia</option>
                     <option value="santander">Santander</option>
                     <option value="sucre">Sucre</option>
                     <option value="tolima">Tolima</option>
                     <option value="valle">Valle Del Cauca</option>
                     <option value="vaupes">Vaup&eacute;s</option>
                     <option value="vichada">Vichada</option>
                  </select>
                  <label for="carg_nombre">Contacto</label>
                  <input type="text" name="contacto"  class="form-control input-sm" placeholder="Contacto">
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

</script>
@stop
