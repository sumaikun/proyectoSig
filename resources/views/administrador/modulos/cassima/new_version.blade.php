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
	<h1><i class="fa fa-plus-square"></i> Nueva versión <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Nueva versión</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">




 <form name="form1" id="form1" action="registrar_version" onsubmit="return validar_version()" method="post" enctype="multipart/form-data">

<div class="col-lg-6 col-xs-12">

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-info-circle"></i> <strong>Información Nueva versión</strong></h3>
   </div>
   <div class="panel-body">
      
      <div class="col-lg-6">
         <label for="">Identificación</label>
         <input type="text" name="gddoc_identificacion" id="gddoc_identificacion" class="form-control text-center" disabled>
      </div>

      <div class="col-lg-6"><label for="">Versión Actual</label>
         <div class="input-group">
            <span class="input-group-addon" id="basic-addon2">V</span>
            <input type="text" name="version_actual" id="version_actual" aria-describedby="basic-addon2" class="form-control text-center" disabled="true">
         </div>
      </div>

      <div class="col-lg-12"><label for="gddoc_descripcion">Descripción *</label>
         <!-- <div class="input-group"> -->
            <!-- <span class="input-group-addon">
               <input type="checkbox" name="sides" id="sides" aria-label="..." onclick="check_descripcion()">
            </span> -->
            <input type="text" name="gddoc_descripcion" id="gddoc_descripcion" class="form-control" required>
         <!-- </div> -->
      </div>

      <div class="col-lg-6"><strong>Nueva versión</strong>
         <div class="input-group">
            <span class="input-group-addon" id="basic-addon2">V</span>
            <input type="text" name="version_nueva" id="version_nueva" aria-describedby="basic-addon2" class="form-control text-center" disabled="true">
         </div>
      </div>

      <div class="col-lg-6"><strong>Fecha de la versión *</strong>
         <input type="date" name="gdver_fecha_version" id="gdver_fecha_version" value="{{date('Y-m-d')}}" class="form-control" required>
      </div>

      <div class="col-lg-12"><strong>Archivo *</strong>
         <input type="file"  name="gdver_ruta_archivo" id="gdver_ruta_archivo" class="filestyle" data-buttonText=" Seleccione" data-buttonName="btn-warning" required>
      </div>

      <div class="col-lg-12"><strong>Previsualización *</strong>
         <input type="file"  name="gdver_ruta_preview" id="gdver_ruta_preview" class="filestyle" accept="image/x-png, image/gif, image/jpeg" data-buttonText=" Seleccione" data-buttonName="btn-success" required>
      </div>
      
      <div class="col-lg-12"><br>
         <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>

      <div class="col-lg-12"><small><strong>Nota: </strong>Los campos marcados con asteriscos (*) son obligatorios</small></div>

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
            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}">
               <i class="fa fa-folder-open-o text-primary"></i>
               <span class="text-muted"> <strong>{{ ucwords ($cat->gdcat_nombre) }}</strong> </span>
            </a>
            <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
            <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
         </h4>
      </div>
      <div id="{{ $cat->gdcat_id.'colla' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
      	<ul class="list-group">
         @foreach ($subcategorias as $sub)
            @if($cat->gdcat_id == $sub->gdcat_id)
				<li class="list-group-item">
               <i class="fa fa-angle-double-right"></i>
               <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id.'subcolla' }}" class="text-danger"> {{ucwords ($sub->gdsub_nombre)}} </a>
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
               <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
               
               <div id="{{ $sub->gdsub_id.'subcolla' }}" class="panel-collapse collapse">
               <ul class="list-unstyled">
               @foreach ($documentos as $doc)
                  @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte">
                        <input type="radio" name="gddoc_id" class="gddoc_id" id="{{$doc->gdver_id}}" value="{{$doc->gdver_id}}" onclick="buscar_informacion(this.value)">
                        <label for="{{$doc->gddoc_id}}">{{$doc->gddoc_identificacion." ".ucwords ($doc->gdver_descripcion) }}</label>
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

</div>



</form>


</section>
@stop



@section('script')
{{ HTML::script('admin/js/bootstrap-filestyle.js') }}

<script type="text/javascript">

$(function() {


});

// function check_descripcion(){
//    if($('#sides').is(':checked')){
//       $("#gddoc_descripcion").prop('disabled', false);
//    }else{
//       $("#gddoc_descripcion").prop('disabled', true);
//    }
// }


function buscar_informacion(iddoc){
   $.post("buscar_info_doc_json",{iddoc:iddoc},function(data){
      console.log(data);

      if(data.length != 0){
         $('#gddoc_identificacion').val(data.documentos.gddoc_identificacion);
         $('#gddoc_descripcion').val(data.documentos.gdver_descripcion);

         $('#version_actual').val(data.documentos.gdver_version);
         var new_version = parseInt(data.documentos.gdver_version)+1;
         $('#version_nueva').val(new_version);
         
      }

   });
}


function validar_version(){

   if($('.gddoc_id').is(':checked')==false){
      alert("por favor selecciona un documento del árbol de documentos");
      return false;
   }else
   if(!confirm("Está seguro de actualizar la version del documento?")){
      return false;
   }
   // if( isNaN($('#gdver_version').val()) ) {
   //    alert("el campo versión solo puede contener valores numéricos");
   //    $("#gdver_version").focus();
   //    return false;
   // }else 
   // if($('#gddoc_req_consecutivo').is(':checked') && $('#gddoc_consecutivo_ini').val()==''){
   //    alert("Por favor debe digitar el consecutivo inicial para este documento");
   //    $("#gddoc_consecutivo_ini").focus();
   //    return false;
   // }


return true;
}

</script>
@stop
