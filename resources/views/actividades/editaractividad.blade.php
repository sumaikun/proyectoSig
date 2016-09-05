@extends('administrador.layouts.layout')
@section('menu')
    @include('administrador.layouts.menu', array('op'=>'actividades'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
   {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css') }}

   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Editar Registro<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-child"></i> Gestión de Actividades</a></li>
      <li class="active">Editar Registro</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">



<div class="panel panel-default">
	<div class="panel-heading">
   	<h3 class="panel-title"><strong>Actividad</strong></h3>
   </div>
   <div class="panel-body">
 		
 		<form name="form1" id="form1" action="../updateactividad" onsubmit="return validar()" method="post" enctype="multipart/form-data">

 		<div class="col-lg-9">
			
			<input type="hidden" value="{{$registro->id}}" name="id">

  	    	<div class="form-group">			
          			<label>Fecha</label>
          			<input  class="form-control" name="fecha" type="date" value="{{$registro->fecha}}" required/>          	
    	    </div>	
			
    	    <div class="form-group">
					<label>Actividad</label>
					<select class="form-control" name=actividad required>					
					@foreach($actividades as $key=>$value)

						@if($key==$registro->tp_actividad)
						<option value={{$key}} selected>{{$value}}</option>
						@else
						<option value={{$key}}>{{$value}}</option>
						@endif
					@endforeach	
					</select>
    	    </div>

    	    <div class="form-group">
					<label>Empresa</label>
					<select class="form-control" name="empresa" required>					
					@foreach($empresas as $key=>$value)
						@if($key==$registro->tp_empresa)
						<option value={{$key}} selected>{{$value}}</option>
						@else
						<option value={{$key}}>{{$value}}</option>
						@endif
					@endforeach		
					</select>
    	    </div>


    	    <div class="form-group">
					<label>Filial</label>
					<input class="form-control" name="filial" type="text" maxlength="30" placeholder="Filial" value="{{$registro->filial}}" required/>
    	    </div>    	    

    	    <div class="form-group">
					<label>Subcontratista/Tema</label>
					<input class="form-control" name="subcontratista" type="text" maxlength="100" placeholder="Subcontratista/tema" value="{{$registro->subcontratista}}" required/>
    	    </div>
			
			<div class="form-group">
					<label>Numero de horas</label>
					 <input type="number" name="horas" min="1" max="24" class="form-control" placeholder="Numero de horas" value="{{$registro->horas}}" required>
			</div>

			<div class="form-group">
					<label>Descripción de actividad</label>
					<textarea class="form-control" placeholder="Descripción de habilidad" maxlength="500" name="descripcion" cols="50" row="10" style="height:100px"></textarea>
			</div>						
			<!-- <div class="col-lg-6 col-xs-12">
				<div class="checkbox checkbox-warning">
		         <input type="checkbox" name="notificacion" id="notificacion" value="1">
		         <label for="notificacion"><b>Enviar notificación por email</b></label>
		      </div>
			</div> -->	
			<div class="col-lg-6 col-lg-offset-6 col-xs-12">
				<button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> <b>Guardar</b></button> 
				<button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>			
			</div>	

		</div>

		
		<div class="divider"></div>

			
		</form>

   </div>
   
   <div class="panel-footer">
   	<strong>Nota:</strong> Todos los campos marcados con asteriscos (*) son obligatorios
   </div>
            
</div>




@include('cosas_generales.boton_info', array('imagen'=>'nuevo_usuario_admin'))
</section>
@stop


@section('script')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js') }}
<script type="text/javascript">


</script>
@stop
