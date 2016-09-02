@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'usuarios'))
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
	<h1><i class="fa fa-plus-circle"></i> Nuevo usuario <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/usuarios') }}"><i class="fa fa-users"></i> Gestión usuarios</a></li>
      <li class="active">Nuevo usuario</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">



<div class="panel panel-default">
	<div class="panel-heading">
   	<h3 class="panel-title"><strong>Datos de usuario</strong></h3>
   </div>
   <div class="panel-body">
 		
 		<form name="form1" id="form1" action="registrarusuario" onsubmit="return validar()" method="post" enctype="multipart/form-data">

 		<div class="col-lg-9">
			

			<div class="form-group col-lg-12">
				<label>Nombres *</label>
				<input type="text" name="usu_nombres" id="usu_nombres" class="form-control" placeholder="pepito andres" required>
			</div>
					
			<div class="form-group col-lg-6">
				<label>1er Apellido *</label>
				<input type="text" name="usu_apellido1" id="usu_apellido1" class="form-control" placeholder="perez" required>
			</div>
						
			<div class="form-group col-lg-6">
				<label>2do Apellido</label>
				<input type="text" name="usu_apellido2" id="usu_apellido2" class="form-control" placeholder="perez">
			</div>

			<div class="form-group col-lg-6">
				<label>Email *</label>
				<input type="email" name="usu_email" id="usu_email" class="form-control" placeholder="pperez@grupo-sig.com" required onblur="nombre_usuario(this.value)">
			</div>
						
			<div class="form-group col-lg-6">
				<label>Usuario *</label>
				<input type="text" name="usu_usuario" id="usu_usuario" class="form-control" placeholder="pperez" readonly="true">
			</div>
			
			<div class="form-group col-lg-5">
				<label>Contraseña *</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="*********" required>
			</div>

			<div class="form-group col-lg-5">
				<label>Confirmar *</label>
				<input type="password" name="password2" id="password2" class="form-control" placeholder="*********" required>
			</div>

			<div class="form-group col-lg-2">
				<label for="">Generador</label>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Generador</button>
			</div>
						
			<div class="form-group col-lg-4">
				<label>Rol *</label>
				<select name="rol_id" id="rol_id" class="form-control" required>
				@foreach ($roles as $rol)
					<option value="{{ $rol->rol_id }}" @if($rol->rol_nombre =='usuario') {{'selected'}} @endif>{{ $rol->rol_nombre }}</option>
				@endforeach
				</select>
			</div>
										
			<div class="form-group col-lg-4">
				<label>Cargo *</label>
				<select name="carg_id" id="carg_id" class="form-control" required>
					<option value="" disabled="" selected="">Seleccione...</option>
					@foreach ($cargos as $cargo)
						<option value="{{ $cargo->carg_id }}">{{ $cargo->carg_nombre }}</option>
					@endforeach
				</select>
			</div>
						
			<div class="form-group col-lg-4">
				<label>Dependencia *</label>
				<select name="depe_id" id="depe_id" class="form-control" required>
					<option value="" disabled="" selected="">Seleccione...</option>
					@foreach ($dependencias as $dependencia)
						<option value="{{ $dependencia->depe_id }}">{{ $dependencia->depe_nombre }}</option>
					@endforeach
				</select>
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

		<div class="col-lg-3">

			<div class="fileinput fileinput-new" data-provides="fileinput">
			  	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
			    	<img alt="" src="http://placehold.it/100x140">
			  	</div>
			  	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
			  	<div>
			    	<span class="btn btn-success btn-file">
			    		<span class="fileinput-new"><i class="fa fa-picture-o"></i> Seleccionar Foto</span>
			    		<span class="fileinput-exists">Cambiar</span>
			    		<input type="file"  name="usu_foto" id="usu_foto">
			    	</span>
			    	<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Quitar</a>
			  	</div>
			</div>

		</div>
		
		<div class="divider"></div>

		<div class="col-lg-3 col-xs-12">
				<div class="checkbox checkbox-warning">
		         <input type="checkbox" name="documentos" id="documentos" value="1">
		         <label for="documentos"><b>Asignar documentos del cargo</b></label>
		      </div>
			</div>	
			
		</form>

   </div>
   
   <div class="panel-footer">
   	<strong>Nota:</strong> Todos los campos marcados con asteriscos (*) son obligatorios
   </div>
            
</div>






<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Generador de Contraseña</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-lg-8">
        		<div class="well text-center">
					<h2 id="pass"></h2>
        		</div>
        	</div>
        	<div class="col-lg-4">
        		<button type="button" class="btn btn-primary btn-block" onclick="password(6)">Generar</button>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="usarpass()">Usar Contraseña</button>
      </div>
    </div>
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


function validar() {

   var pass1 = document.getElementById("password").value;
   var pass2 = document.getElementById("password2").value; 
  	if (pass1 != pass2) {
    	// Si no se cumple la condicion...
    	alert('[ERROR] Las contraseñas no coinciden...');
    	return false;
  	}else if (!confirm("Está seguro de registrar al usuario "+$("#usu_nombres").val()+" ?")) {
   	return false;
  	}

	return true;
}



function usarpass(){
	var pass = $('#pass').html();
	$('#password').val(pass);
	$('#password2').val(pass);
	$('#myModal').modal('hide');
}


function password(length, special) {
  var iteration = 0;
  var password = "";
  var randomNumber;
  if(special == undefined){
      var special = false;
  }
  while(iteration < length){
    randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
    if(!special){
      if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
      if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
      if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
      if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
    }
    iteration++;
    password += String.fromCharCode(randomNumber);
  }

  $('#pass').html(password);
  // return password;
}


</script>
@stop
