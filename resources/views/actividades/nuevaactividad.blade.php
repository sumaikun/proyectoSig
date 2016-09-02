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
	<h1><i class="fa fa-plus-circle"></i>Nueva Actividad<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/usuarios') }}"><i class="fa fa-child"></i> Gestión de Actividades</a></li>
      <li class="active">Nueva Actividad</li>
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
 		
 		<form name="form1" id="form1" action="registrarusuario" onsubmit="return validar()" method="post" enctype="multipart/form-data">

 		<div class="col-lg-9">
			
  	    	<div class="form-group">			
          			<label>Fecha</label>
          			<input  class="form-control" name="fecha" type="date" required/>          	
    	    </div>	

    	    <div class="form-group">
					<label>Actividad</label>
					<select class="form-control" name=actividad required>
						<option value="">Selecciona</option>
					</select>
    	    </div>

    	    <div class="form-group">
					<label>Empresa</label>
					<select class="form-control" name="empresa" required>
						<option value="">Selecciona</option>
					</select>
    	    </div>


    	    <div class="form-group">
					<label>Filial</label>
					<input class="form-control" name="filial" type="text" maxlength="30" placeholder="Filial" required/>
    	    </div>    	    

    	    <div class="form-group">
					<label>Subcontratista/Tema</label>
					<input class="form-control" name="filial" type="text" maxlength="100" placeholder="Subcontratista/tema" required/>
    	    </div>
			
			<div class="form-group">
					<label>Numero de horas</label>
					 <input type="number" name="quantity" min="1" max="24" class="form-control" placeholder="Numero de horas" required>
			</div>

			<div class="form-group">
					<label>Descripción de actividad</label>
					<textarea class="form-control" placeholder="Descripción de habilidad" maxlength="500" name="descactividad" cols="50" row="10" style="height:100px"></textarea>
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
// funciones que se ejecutan al inicio de la carga de la pagina
// $(function() {
// 	alert("hola");
// });


function nombre_usuario(email){
	usuario = email.split('@');
	$("#usu_usuario").val(usuario[0]);
}







</script>
@stop
