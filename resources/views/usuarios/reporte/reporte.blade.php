@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'reporte'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'reporte'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

 
@section('contenido')
<h3 class="page-header">
   <i class="fa fa-child"></i> Reporte de actividades<!-- <small>Bienvenid@</small> -->
</h3>

<div class="row">
   <div class="col-lg-9 well">
   <h3>Formulario de Reporte de actividades</h3>
   <hr>
	
	<form action="ra_send_reporte" name="form1" id="form1" method="post">	

		<div class="row">

			<div class="col-lg-3">
				<div class="form-group">
					<label for="rarepo_fecha">Fecha: </label>
					<input type="date" id="rarepo_fecha" name="rarepo_fecha" class="form-control text-center" value="<?php echo date('Y-m-d'); ?>" required="required">
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<label for="raemp_id">Empresa: </label>
					<select name="raemp_id" id="raemp_id" class="form-control" onchange="buscar_proyectos(this.value)" required="required">
						<option value="" disabled="">Seleccione...</option>
					@foreach($empresas as $empresa)
						<option value="{{$empresa->raemp_id}}">{{$empresa->raemp_empresa}}</option>
					@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-5">
				<div class="form-group">
					<label for="raproy_id">Proyecto: </label>
					<select name="raproy_id" id="raproy_id" class="form-control" required="required">
               	<option value="" selected="true" disabled="true">Seleccione</option>
            	</select>
				</div>
			</div>

		</div>

		<div class="row">
		
			<div class="col-lg-4">
				<div class="form-group">
					<label for="raact_id">Actividad: </label>
					<select name="raact_id" id="raact_id" class="form-control" required="required">
						<option value="" disabled="">Seleccione...</option>
					@foreach($actividades as $actividad)
						<option value="{{$actividad->raact_id}}">{{$actividad->racct_actividad}}</option>
					@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<label for="rarepo_lugar">Lugar: </label>
					<input type="text" id="rarepo_lugar" name="rarepo_lugar" class="form-control" required="required">
				</div>
			</div>

			<div class="col-lg-4">
				<div class="form-group">
					<label for="rarepo_sub_tema">Subconttratista/Tema: </label>
					<input type="text" id="rarepo_sub_tema" name="rarepo_sub_tema" class="form-control" required="required">
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-6 form-horizontal">
				<div class="form-group">
    				<label for="rarepo_horas" class="col-lg-5 control-label"><strong>Horas empleadas:</strong></label>
    				<div class="col-lg-3">
      				<input type="number" id="rarepo_horas" name="rarepo_horas" class="form-control text-center" required="required">
    				</div>
  				</div>
			</div>
		</div>

		<div class="row">
		<div class="col-sm-4 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">                
                    <form accept-charset="UTF-8" action="" method="POST">
                        <textarea name="rarepo_informe" id="rarepo_informe" class="form-control counted" placeholder="Detalle aqui su informe de actividades" rows="5" style="margin-bottom:10px;" required="required"></textarea>
                        <h6 class="pull-right" id="counter">0 characters remaining</h6>
                        <button class="btn btn-info" type="submit">Enviar reporte de actividades <i class="fa fa-paper-plane-o"></i></button>
                    </form>
                </div>
            </div>
        </div>
		</div>
		
	</form>
   </div>




   <div class="col-lg-3">
   	<strong>Nota </strong>
		<p class="text-justify">
			El reporte de actividades debe llenarse diariamente evitando olvido 
			de las actividades y retraso en el consolidado.
		</p>
   </div>
</div>    


@include('cosas_generales.boton_info', array('imagen'=>'gdocumental_usuario'))
@stop



@section('script')

<script type="text/javascript">



function buscar_proyectos(raemp_id){

	 $.post("ra_buscar_proyecto",{raemp_id:raemp_id},function(data){
      console.log(data);

      // if(data.length != 0){

	      $("option", raproy_id).remove();
	      $('#raproy_id').append('<option value="" selected disabled>Seleccione</option>');
	      $.each(data, function(i, value) {
	      	
	-           $('#raproy_id').append('<option value="'+data[i].raproy_id+'">'+data[i].raproy_proyecto+'</option>');
	      });
	      $('#raproy_id').selectmenu("refresh", true);
                  
      // }

   });

}




$(document).ready(function() {
$(".counted").each(function(){
	var longitud = $(this).val().length;
			$(this).parent().find('#counter').html('<b>'+longitud+'</b> caracteres');
			$(this).keyup(function(){ 
				var nueva_longitud = $(this).val().length;
				$(this).parent().find('#counter').html('<b>'+nueva_longitud+'</b> caracteres');
				if (nueva_longitud == "140") {
					$('#counter').css('color', '#ff0000');
				}
			});
		});
});

</script>
@stop


