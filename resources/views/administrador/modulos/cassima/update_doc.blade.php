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
	<h1><i class="fa fa-refresh"></i> Actualizar documento<!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Actualizar documento</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">




 <form name="form1" id="form1" action="update_archivo" onsubmit="return validar_version()" method="post" enctype="multipart/form-data">

<div class="col-lg-6 col-xs-12">

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-cloud-upload"></i> <strong>Información Nueva versión</strong></h3>
   </div>
   <div class="panel-body">
      
      <div class="col-lg-12"><strong>Archivo *</strong>
         <input type="file"  name="gdver_ruta_archivo" id="gdver_ruta_archivo" class="filestyle" data-buttonText=" Seleccione" data-buttonName="btn-warning" required>
      </div>

      <div class="col-lg-12"><strong>Previsualización *</strong>
         <input type="file"  name="gdver_ruta_preview" id="gdver_ruta_preview" class="filestyle" accept="image/x-png, image/gif, image/jpeg" data-buttonText=" Seleccione" data-buttonName="btn-success" required>
      </div>
      
      <div class="col-lg-12"><br>
         <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>

      

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
               <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id }}" class="text-danger"> {{ucwords ($sub->gdsub_nombre)}} </a>
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
               <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
               
               <div id="{{ $sub->gdsub_id }}" class="panel-collapse collapse">
               <ul class="list-unstyled">
               @foreach ($documentos as $doc)
                  @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte">
                        <input type="radio" name="gdver_id" class="gdver_id" id="{{$doc->gdver_id}}" value="{{$doc->gdver_id}}" onclick="buscar_informacion(this.value)">
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




function validar_version(){

   if($('.gdver_id').is(':checked')==false){
      alert("Por favor selecciona un documento del árbol de documentos");
      return false;
   }else
   if(!confirm("Está seguro de reemplazar el documento?")){
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
