@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-file-text-o"></i> Nuevo Documento <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Nuevo documento</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">




 

<div class="col-lg-6 col-xs-12">


<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-info-circle"></i> <strong>Información del documento</strong></h3>
   </div>
   <div class="panel-body">
  
   <form name="form_sub" id="form_sub" onsubmit="return validar_archivo()" method="post" enctype="multipart/form-data">
         
         <input type="hidden" id="gdcat_nombre" name="gdcat_nombre">
         <div class="col-lg-6"><strong>Indique la Categoría *</strong>
            <select name="gdcat_id" id="gdcat_id" class="form-control" onchange="buscar_subcate(this.value)" required="required">
               <option value="" selected="true" disabled="true">Seleccione</option>
               @foreach ($categorias as $cat)
                  <option value="{{$cat->gdcat_id}}">{{ $cat->gdcat_nombre }}</option>
               @endforeach
            </select>
         </div>
         
         <input type="hidden" id="gdsub_nombre" name="gdsub_nombre">
         <div class="col-lg-6"><strong>Indique la Sub Categoría *</strong>
            <select name="gdsub_id" id="gdsub_id" class="form-control" required="required" onchange="set_name_subcate();">
               <option value="" selected="true" disabled="true">Seleccione</option>
            </select>
         </div>

         <div class="col-lg-4"><strong>Identificacion *</strong>
            <input type="text" name="gddoc_identificacion" id="gddoc_identificacion" placeholder="GAD-FO-05" class="form-control text-center" required>
         </div>

         <div class="col-lg-3"><strong>Version *</strong>
            <div class="input-group">
               <span class="input-group-addon" id="basic-addon2">V</span>
               <input type="text" name="gdver_version" id="gdver_version" aria-describedby="basic-addon2" placeholder="4" class="form-control text-center" required>
            </div>
         </div>

         <div class="col-lg-5"><strong>Fecha de la version *</strong>
            <input type="date" name="gdver_fecha_version" id="gdver_fecha_version" class="form-control" required>
         </div>

         <div class="col-lg-12"><strong>Descripción *</strong>
            <input type="text" name="gdver_descripcion" id="gdver_descripcion" placeholder="Control Horario Laboral" class="form-control" required>
         </div>
         
         <div class="col-lg-12"><strong>Archivo *</strong>
            <input type="file"  name="gdver_ruta_archivo" id="gdver_ruta_archivo" class="filestyle" data-buttonText=" Seleccione" data-buttonName="btn-warning" required>
         </div>

         <div class="col-lg-12"><strong>Previsualización *</strong>
            <input type="file"  name="gdver_ruta_preview" id="gdver_ruta_preview" accept="image/x-png, image/gif, image/jpeg" class="filestyle" data-buttonText=" Seleccione" data-buttonName="btn-success" required>
         </div>
         
         <div class="col-lg-6">
            <div class="checkbox checkbox-success">
               <input type="checkbox" id="gddoc_req_consecutivo" name="gddoc_req_consecutivo" value="SI">
               <label for="gddoc_req_consecutivo"><b>Requiere Consecutivos </b></label>
            </div>
            <div class="checkbox checkbox-success">
               <input type="checkbox" id="gddoc_req_registro" name="gddoc_req_registro" value="SI">
               <label for="gddoc_req_registro"><b>Requiere Registro </b></label>
            </div>
         </div>

         <div class="col-lg-6"><strong>Consecutivo inicial</strong>
            <div class="input-group">
              <input type="text" name="gddoc_consecutivo_ini" id="gddoc_consecutivo_ini" class="form-control text-center" placeholder="0000" aria-describedby="basic-addon2" disabled="true">
              <span class="input-group-addon" id="basic-addon2">-{{ date("y") }}</span>
            </div>
         </div>

         <div class="col-lg-12"><br>
            <button type="submit" class="btn btn-success btn-md btn-block" onclick="javascript: form.action='registrar_doc';"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>

         <div class="col-lg-12"><small><strong>Nota: </strong>Los campos marcados con asteriscos (*) son obligatorios</small></div>
      </form>

   </div>
</div>

</div>





<di class="col-lg-6 col-xs-12">

<div class="ocultar">
<div class="panel-group" id="accordion">

   @foreach ($categorias as $cat)
	<div class="panel panel-default">
   	<div class="panel-heading">
      	<h4 class="panel-title">
         	<a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id }}">
               <i class="fa fa-folder-open-o text-primary"></i>
               <span class="text-muted"> <strong>{{ ucwords ($cat->gdcat_nombre) }}</strong> </span>
            </a>
            <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
            <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
         </h4>
      </div>
      <div id="{{ $cat->gdcat_id }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
      	<ul class="list-group">
         @foreach ($subcategorias as $sub)
            @if($cat->gdcat_id == $sub->gdcat_id)
				<li class="list-group-item">
               <i class="fa fa-angle-double-right"></i>
               <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id }}" class="text-danger"> {{$sub->gdsub_nombre}} </a>
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
               <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
               
               <div id="{{ $sub->gdsub_id }}" class="panel-collapse collapse">
               <ul class="list-unstyled">
               @foreach ($documentos as $doc)
                  @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte">
                        <i class="fa fa-caret-right"></i>
                           {{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }}
                        <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
                     </li>
                  @endif
               @endforeach   
               </ul>
               </div>

            </li>
            @endif
         @endforeach
			</ul>
      </div>
   </div>
   @endforeach
 
</div>
</div>

</di>




</section>
@stop



@section('script')
{{ HTML::script('admin/js/bootstrap-filestyle.js') }}

<script type="text/javascript">

$(function() {

$('#gddoc_req_consecutivo').click(function() {
   if($('#gddoc_req_consecutivo').is(':checked')){
      $("#gddoc_consecutivo_ini").prop('disabled', false);
   }else{
      $("#gddoc_consecutivo_ini").prop('disabled', true);
   }
});

});



function set_name_subcate(){
   var subcate_nombre = $("#gdsub_id :selected").text();
   $('#gdsub_nombre').val(subcate_nombre.toLowerCase());
}

function buscar_subcate(id_cate){

   var cat_nombre = $("#gdcat_id :selected").text();
   $('#gdcat_nombre').val(cat_nombre.toLowerCase());
   
   $.post("buscarsubcate_json",{id_cate:id_cate},function(data){
      console.log(data);

      $("option", gdsub_id).remove();
      $('#gdsub_id').append('<option value="" selected disabled>Seleccione</option>');
      $.each(data, function(i, value) {
-           $('#gdsub_id').append('<option value="'+value.gdsub_id+'">'+value.gdsub_nombre+'</option>');
      });
      // $('#gdsub_id').selectmenu("refresh", true);
   });
}


function validar_archivo(){

   if( isNaN($('#gdver_version').val()) ) {
      alert("el campo versión solo puede contener valores numéricos");
      $("#gdver_version").focus();
      return false;
   }else 
   if($('#gddoc_req_consecutivo').is(':checked') && $('#gddoc_consecutivo_ini').val()==''){
      alert("Por favor debe digitar el consecutivo inicial para este documento");
      $("#gddoc_consecutivo_ini").focus();
      return false;
   }


return true;
}

</script>
@stop
