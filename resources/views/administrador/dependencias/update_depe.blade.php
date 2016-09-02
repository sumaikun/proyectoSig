@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'dependencias'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-pencil-square-o"></i> Actualizar Dependencia <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/dependencias') }}"><i class="fa fa-pencil-square-o"></i>Gestión de Dependencias</a></li>
      <li class="active">Actualizar Dependencia</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">



<div class="row">

<form name="form2" id="form2" onsubmit="return validar_update()" action="../updatedepe" method="post">
<div class="col-lg-6 col-lg-offset-2 custyle">
   <div class="panel panel-default">
      <div class="panel-heading"><strong><i class="fa fa-pencil-square-o"></i> Editar Dependencia</strong></div>
      <div class="panel-body">
         
         <input type="hidden" name="depe_id" id="depe_id" value="{{{ isset($dependencia) ? $dependencia->depe_id : '' }}}">
         <div class="row">
            <div class="col-lg-12">
               <label for="depe_nombre">Nombre del la Dependencia</label>
               <input type="text" name="depe_nombre" id="depe_nombre" class="form-control" value="{{{ isset($dependencia) ? $dependencia->depe_nombre : '' }}}" required>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <label for="depe_sigla">Siglas</label>
               <input type="text" name="depe_sigla" id="depe_sigla" class="form-control" value="{{{ isset($dependencia) ? $dependencia->depe_sigla : '' }}}" required>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <label for="depe_responsable">Responsable</label>
               <input type="text" name="depe_responsable" id="depe_responsable" class="form-control" value="{{{ isset($dependencia) ? $dependencia->depe_responsable : '' }}}">
            </div>
         </div>

      </div>
      <div class="panel-footer">
         <div class="row">
            <div class="col-lg-6">
               <a href="{{ url('admin/dependencias') }}" class="btn btn-warning btn-block"><i class="fa fa-reply"></i> Volver</a>
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




@include('cosas_generales.boton_info', array('imagen'=>'editar_depe_admin'))
</section>
@stop


@section('script')
<script type="text/javascript">
function validar_update(){
   if(!confirm("Está seguro de actualizar la Dependencia?")){
      return false;
   }
   return true;
}
</script>
@stop