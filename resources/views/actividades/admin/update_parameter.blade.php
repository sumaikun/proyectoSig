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
	<h1><i class="fa fa-pencil-square-o"></i> Actualizar Parametro <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades/parameters') }}"><i class="fa fa-pencil-square-o"></i> Gestión de parametros</a></li>
      <li class="active">Actualizar Parametro</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<form name="form2" id="form2" onsubmit="return validar_update()" action=" {{isset($actividad) ? '../updateAct' : '../updateEmp' }} " method="post">
<div class="col-lg-6 col-lg-offset-2 custyle">
   <div class="panel panel-default">
      <div class="panel-heading"><strong><i class="fa fa-pencil-square-o"></i> Editar Parametro</strong></div>
      <div class="panel-body">
         
         <input type="hidden" name="id" id="id" value="{{isset($actividad) ? $actividad->id : $empresa->id}}">
         <div class="row">
            <div class="col-lg-12">
               <label for="carg_nombre">Nombre del Parametro</label>
               <input type="text" name="nombre" id="nombre" class="form-control" value="{{ isset($actividad) ? $actividad->nombre : $empresa->nombre }}" required>
            </div>
         </div>


      </div>

      <div class="panel-footer">
         <div class="row">
            <div class="col-lg-6">
               <a href="{{ URL::previous() }}" class="btn btn-warning btn-block"><i class="fa fa-reply"></i> Volver</a>
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




@include('cosas_generales.boton_info', array('imagen'=>'editar_cargo_admin'))
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


</script>
@stop
