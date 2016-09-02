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
	<h1><i class="fa fa-pencil-square-o"></i> Actualizar Cargo <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/cargos') }}"><i class="fa fa-pencil-square-o"></i> Gestión de cargos</a></li>
      <li class="active">Actualizar Cargo</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<form name="form2" id="form2" onsubmit="return validar_update()" action="../updatecargo" method="post">
<div class="col-lg-6 col-lg-offset-2 custyle">
   <div class="panel panel-default">
      <div class="panel-heading"><strong><i class="fa fa-pencil-square-o"></i> Editar Cargo</strong></div>
      <div class="panel-body">
         
         <input type="hidden" name="carg_id" id="carg_id" value="{{{ isset($uncargo) ? $uncargo->carg_id : '' }}}">
         <div class="row">
            <div class="col-lg-12">
               <label for="carg_nombre">Nombre del Cargo</label>
               <input type="text" name="carg_nombre" id="carg_nombre" class="form-control" value="{{{ isset($uncargo) ? $uncargo->carg_nombre : 'Seleccione un cargo' }}}" required>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <label for="carg_perfil">Perfil del Cargo</label>
               <input type="file" disabled="true" name="carg_perfil" id="carg_perfil" class="form-control input-sm">
            </div>
         </div>

      </div>
      <div class="panel-footer">
         <div class="row">
            <div class="col-lg-6">
               <a href="{{ url('admin/cargos') }}" class="btn btn-warning btn-block"><i class="fa fa-reply"></i> Volver</a>
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
   if(!confirm("Está seguro de actualizar el cargo?")){
      return false;
   }
   return true;
}


</script>
@stop
