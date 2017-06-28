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
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-puzzle-piece"></i> Actividades </a></li>
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
         <strong><i class="fa fa-list"></i> Actividades-Empresas</strong>
      </div>

      
      <div class="panel-body">
         <a href="#"  class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal"><b>+</b> Agregar nueva actividad</a>          
         <a href="#" style="margin-right:5px;" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal2"><b>+</b> Agregar nueva Empresa</a>        
            
            <p><br></p>  
            <p><br></p>    

         <input type="text"  style="margin-bottom:10px;" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtro" />       

          <a href="#"  class="btn btn-success" onclick="hide_empresas()"><b>*</b> Actividades </a>          
         <a href="#" style="margin-right:5px;" class="btn btn-warning" onclick="hide_actividades()"><b>*</b> Empresas </a>   

      </div>
         
         <div class="table-responsive ocultar_400px">
            <table class="table table-hover table-condensed" id="dev-table">
               <thead>
                  <tr class="active">
                     <th style="width:73.33px;">#</th>
                     <th style="width:96.67px;">ID</th>
                     <th style="width:294.44px;"> Nombre</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody class="tb-activity ">         
                  @foreach ($actividades as $actividad)
                     <tr>
                        <td style="width:73.33px !important;"></td>
                        <td style="width:96.67px !important;"> {{$actividad->id}} </td>
                        <td style="width:294.44px !important;">{{$actividad->nombre}} </td>
                        <td align="right" style="width:568.89px;">
                           <a href="{{ url('admin/actividades/editAct/'.$actividad->id) }}" class="btn btn-warning btn-xs">
                              <i class="fa fa-pencil-square-o"></i> Editar
                           </a>
                           <button onclick="delete_actividad({{$actividad->id}})" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash-o"></i> Eliminar
                           </button>
                        </td>
                     </tr>
                  @endforeach
               </tbody> 
                       
               <tbody class="tb-enterprise tb-data">          
                  @foreach ($empresas as $empresa)
                     <tr>
                        <td style="width:73.33px !important;"></td>
                        <td style="width:96.67px !important;"> {{$empresa->id}} </td>
                        <td style="width:294.44px !important;">{{$empresa->nombre}} </td>
                        <td align="right" style="width:568.89px;">
                           <a href="{{ url('admin/actividades/editEmp/'.$empresa->id) }}" class="btn btn-warning btn-xs">
                              <i class="fa fa-pencil-square-o"></i> Editar
                           </a>
                           <button onclick="delete_empresa({{$empresa->id}})"  class="btn btn-danger btn-xs">
                              <i class="fa fa-trash-o"></i> Eliminar
                           </button>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
       </div>
   </div>
</div>

 

<!-- Modal -->
<form name="form1" id="form1" action="registrartpact" method="post">
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
                  <input type="text" name="act_nombre" id="act_nombre" class="form-control input-sm" placeholder="Actividad" autofocus required>
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
                  <input type="text" name="emp_nombre" id="emp_nombre" class="form-control input-sm" placeholder="Empresa" autofocus required>
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

<!-- Modal3 -->
<form name="form2" id="form2" action="replace_empresa" method="post">
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Empresa a reemplazar
            </h4>
         </div>
         <div class="modal-body">
            <input type="hidden" name="emp_torplc" id="emp_torplc">
            <div class="row">
               <div class="col-lg-12 form-group">
                  <label class="form-control">Empresa</label>
                  <select name="replace_emp" class="form-control" id="replace_emp" required>
                     <option value=""> Selecciona </option>
                     @foreach ($empresas as $empresa)
                        <option value="{{$empresa->id}}"> {{$empresa->nombre}} </option>
                     @endforeach
                  </select>
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

<!-- Modal4 -->
<form name="form3" id="form3" action="replace_actividad" method="post">
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Actividad a reemplazar
            </h4>
         </div>
         <div class="modal-body">
         <input type="hidden" name="act_torplc" id="emp_torplc">
            <div class="row">
               <div class="col-lg-12 form-group">
                  <label class="form-control">Actividad</label>
                  <select name="replace_act" class="form-control"  id="replace_emp" required>
                     <option value=""> Selecciona </option>
                     @foreach ($actividades as $actividad)
                        <option value="{{$actividad->id}}"> {{$actividad->nombre}} </option>
                     @endforeach
                  </select>
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


function delete_empresa(id)
{
   if(confirm("¿Desea reemplazar esta empresa con otra antes de eliminarla ?") ==  true)
  {
    $("input[name='emp_torplc']").val(id);
    $("#myModal3").modal("show");  
  }
  else
  {
    window.location.href = 'destroyEmp/'+id;
  }
}

function delete_actividad(id)
{
   if(confirm("¿Desea reemplazar esta actividad con otra antes de eliminarla ?") ==  true)
  {
    $("input[name='act_torplc']").val(id);
    $("#myModal4").modal("show");  
  }
  else
  {
    window.location.href = 'destroyAct/'+id;
  }
}


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
