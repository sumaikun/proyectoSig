@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'ninguno'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'admin_reporte'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

 
@section('contenido')
<h3 class="page-header">
   <i class="fa fa-child"></i> Administracion reporte de actividades<!-- <small>Bienvenid@</small> -->
</h3>


<div class="panel panel-default">
  <div class="panel-body">
    	

    	<div class="table-responsive">
		  <table class="table table-bordered table-condensed">
		    <thead>
		    	<tr>
		    		<td colspan="2">Empleado</td>
		    		<td colspan="12">Meses</td>
		    	</tr>
		    	<tr>
		    		<td>Empleado</td>
		    		<td>Empresa</td>
		    		<td>Enero</td>
		    		<td>Febrero</td>
		    		<td>Marzo</td>
		    		<td>Abril</td>
		    		<td>Mayo</td>
		    		<td>Junio</td>
		    		<td>Julio</td>
		    		<td>Agosto</td>
		    		<td>Septiembre</td>
		    		<td>Octubre</td>
		    		<td>Noviembre</td>
		    		<td>Diciembre</td>
		    	</tr>
		    </thead>
		  </table>
		</div>


  </div>
</div>

   


@include('cosas_generales.boton_info', array('imagen'=>'gdocumental_usuario'))
@stop



@section('script')
<script type="text/javascript">

</script>
@stop


