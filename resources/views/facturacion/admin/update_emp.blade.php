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
	<h1><i class="fa fa-pencil-square-o"></i> Actualizar Parametros <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades/parameters') }}"><i class="fa fa-pencil-square-o"></i> Gestión de parametros</a></li>
      <li class="active">Actualizar Parametros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<form name="form2" id="form2" onsubmit="return validar_update()" action="../updateEmp" method="post">
<div class="col-lg-6 col-lg-offset-2 custyle">
   <div class="panel panel-default">
      <div class="panel-heading"><strong><i class="fa fa-pencil-square-o"></i> Editar Parametros</strong></div>
      <div class="panel-body">
         
         <input type="hidden" name="id" id="id" value="{{$empresa->id}}">
         <div class="row">
            <div class="col-lg-12">
               <label for="carg_nombre">Nombre</label>
               <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{$empresa->nombre}}">
               <label for="carg_nombre">Nit</label>
               <input type="text" name="nit"  class="form-control input-sm" value="{{$empresa->nit}}" maxlength="11" minlength="10" placeholder="Nit" pattern="\d*[-,\/]?\d*" title="ejemplo:700569894-5" required>
               <label for="carg_nombre">Teléfono</label>
               <input type="text" name="telefono"  class="form-control input-sm" value="{{$empresa->telefono}}" placeholder="Telefono"  pattern="\d*[-,\/]?\d*" title="ejemplo:4568978 - 3005648974 es posible poner como minimo el fijo." maxlength="20" minlength="7" required>
               <label for="carg_nombre">Dirección</label>
               <input type="text" name="direccion"  class="form-control input-sm" value="{{$empresa->direccion}}" placeholder="Dirección" maxlength="100" minlength="10" required>

               <label for="carg_nombre">Departamento</label>
                  <select class="form-control" name="departamento" id="ajax_depar1">
                     <option value="">Selecciona</option>
                     @foreach($departamentos as $key => $temp)
                     <option value="{{$key}}">{{$temp}}</option>
                     @endforeach
                  </select>
              <label for="carg_nombre">Ciudad</label>
                 <select class="form-control" name="ciudad" id="ajax_city1" required>
                     <option value="">Selecciona</option>
                     <option value="{{$empresa->ciudad}}" selected>{{$empresa->ciudades["nombre"]}}</option>
                  </select>
               <label for="carg_nombre">Contacto</label>
               <input type="text" name="contacto"  class="form-control input-sm" value="{{$empresa->contacto}}" minlength="10" maxlength="50" placeholder="Contacto">
               <label for="carg_nombre">Tipo de Entidad</label>
               <label>Empresa SIG</label>
               <input type="radio" name="tp_emp" value="0" checked>
               <label>Cliente</label>
               <input type="radio" name="tp_emp" value="1">
            </div>
         </div>


      </div>

      <div class="panel-footer">
         <div class="row">
            <div class="col-lg-6">
               <a href="{{url('admin/facturacion/parameters')}}" class="btn btn-warning btn-block"><i class="fa fa-reply"></i> Volver</a>
            </div>
            <div class="col-lg-6">
               <button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
            </div>
         </div>
      </div>

   </div>
</div>
</form>

</div>





</section>
@stop


@section('script')
<script type="text/javascript">


function validar_update(){
   if(!confirm("Está seguro de actualizar el parametro?")){
      return false;
   }
   return true;
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
      $.get(`../ciudades/${event.target.value}`, function(res, sta){
         $("#ajax_city1").empty();
         $("#ajax_city1").append(`<option value="" selected> Selecciona </option>`);         
         res.forEach(element => {
            $("#ajax_city1").append(`<option value=${element.id}> ${element.nombre} </option>`);
         });
      });
   }
});

});
</script>
@stop
