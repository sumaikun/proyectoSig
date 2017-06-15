<div class="panel panel-default">
	<div class="panel-heading">
   	<h3 class="panel-title"><strong>Actividad</strong></h3>
   </div>
   <div class="panel-body">
 		
 		<form name="form1" id="form1" action="" onsubmit="return validar()" method="post" enctype="multipart/form-data">

 		<div class="col-lg-9">
			
			<input type="hidden" value="{{$registro->id}}" name="id">
			{{ csrf_field() }}
	        <div class="form-group">
            	<label>Actividad *</label>
	            <select class="form-control" name=actividad required>
	              <option value="">Selecciona</option>
	            @foreach($actividades as $actividad)
	              <option value="{{$actividad->id}}">{{$actividad->nombre}}</option>
	            @endforeach 
	            </select>
          </div>
          <div class="form-group">
            	<label>Empresa *</label>
	            <select class="form-control" name="empresa" required>
	              <option value="">Selecciona</option>
	            @foreach($empresas as $empresa)
	              <option value={{$empresa->id}}>{{$empresa->nombre}}</option>
	            @endforeach   
	            </select>
          </div>

  	    	<div class="form-group">			
          			<label>Fecha *</label>
          			<input  class="form-control" name="fecha" type="date" max=<?php echo date('Y-m-d'); ?>  value="{{$registro->fecha}}" required/>          	
    	    </div>    	    

    	    <div class="form-group">
					<label>Filial</label>
					<input class="form-control" name="filial" type="text" maxlength="30" placeholder="Filial" value="{{$registro->filial}}" />
    	    </div>    	    

    	    <div class="form-group">
					<label>Subcontratista/Tema</label>
					<input class="form-control" name="subcontratista" type="text" maxlength="100" placeholder="Subcontratista/tema" value="{{$registro->subcontratista}}" />
    	    </div>

			<div class="form-group">
					<label>Descripción de actividad</label>
					<textarea class="form-control" placeholder="Descripción de habilidad" id="descripcion" maxlength="500" name="descripcion" cols="50" row="10" style="height:100px">{{$registro->descripcion}}</textarea>
			</div>

			<div class="form-group ">
            		<label>Hora inicial *</label>
            		<input class="form-control" id="hini" onblur="validate_date()" name="hini" type=time min="0:00" max="100:59" required="required" >
          	</div>

			<input name="usuario" type="hidden"/>

          	<div class="form-group ">
            		<label>Hora final *</label>
            		<input class="form-control" id="hfin" name="hfin" type=time min="0:00" max="100:59"  required="required" disabled> 
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

