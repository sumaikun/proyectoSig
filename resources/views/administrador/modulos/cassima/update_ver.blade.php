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
	<h1><i class="fa fa-pencil-square-o"></i> Editar Versión<!-- <small>subcategorias</small> --></h1>
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


<form action="updatedoc" name="form2" id="form2" method="post">
   <input type="hidden" value="0" id="doc_idtr" name="doc_idtr">
   <input type="hidden" value="0" id="doc_subc" name="doc_subc">    
</form>

<button class="btn btn-danger form-control" onclick="updatedocument()">Modificar como documento</button>

<script>
   function updatedocument()
   {
      if($("#doc_idtr").val() == 0){
         alert("Seleccione previamente un documento");
      }
      else{
          document.getElementById('form2').submit();
      }
   }
</script>

<br>
<br>

 <form name="form1" id="form1" action="updateversion" onsubmit="return validar_version()" method="post" enctype="multipart/form-data">

<div class="col-lg-6 col-xs-12">


<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-info-circle"></i> <strong>Información del documento</strong></h3>
   </div>
   <div class="panel-body">
         
         <div class="col-lg-12"><strong>Descripción</strong>
            <input type="text" name="gdver_descripcion" id="gdver_descripcion" placeholder="Control Horario Laboral" class="form-control">
         </div>
         
         <div class="col-lg-12"><strong>Archivo</strong>
            <input type="file"  name="gdver_ruta_archivo" id="gdver_ruta_archivo" class="filestyle" data-buttonText=" Seleccione" data-buttonName="btn-warning">
         </div>

         <div class="col-lg-12"><strong>Previsualización</strong>
            <input type="file"  name="gdver_ruta_preview" id="gdver_ruta_preview" accept="image/x-png, image/gif, image/jpeg" class="filestyle" data-buttonText=" Seleccione" data-buttonName="btn-success">
         </div>
         
         <div class="col-lg-6"><strong>Fecha de la version</strong>
            <div class="input-group">
              <input type="date" name="gdver_fecha_version" id="gdver_fecha_version" class="form-control text-center">
            </div>
         </div>

         <div class="col-lg-6"><strong>Consecutivo inicial</strong>
            <div class="input-group">
              <input type="text" name="gddoc_consecutivo_ini" id="gddoc_consecutivo_ini" class="form-control text-center" placeholder="0000" aria-describedby="basic-addon2" disabled="true">
              <span class="input-group-addon" id="basic-addon2">-{{ date("y") }}</span>
            </div>
         </div>

         <div class="col-lg-6"> <br>
            <div class="checkbox checkbox-success">
               <input type="checkbox" id="gddoc_req_consecutivo" name="gddoc_req_consecutivo" value="SI">
               <label for="gddoc_req_consecutivo"><b>Requiere Consecutivos </b></label>
            </div>
         </div>

         <div class="col-lg-6"> <br>
            <div class="checkbox checkbox-success">
               <input type="checkbox" id="gddoc_req_registro" name="gddoc_req_registro" value="SI">
               <label for="gddoc_req_registro"><b>Requiere Registro </b></label>
            </div>
         </div>

         <div class="col-lg-6"> <br>
            <div class="checkbox checkbox-success">
               <input type="checkbox" id="for_conse" name="for_conse" value="SI">
               <label for="for_conse"><b>Forzar consecutivo</b></label>
            </div>
         </div>

         <div class="col-lg-12"><br>
            <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>

         <div class="col-lg-12"><small><strong>Nota: </strong>Modifique solo los campos necesarios</small></div>

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
            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'collapse' }}">
               <i class="fa fa-folder-open-o text-primary"></i>
               <span class="text-muted"> <strong>{{ ucwords ($cat->gdcat_nombre) }}</strong> </span>
            </a>
            <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
            <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
         </h4>
      </div>
      <div id="{{ $cat->gdcat_id.'collapse' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
      	<ul class="list-group">
         @foreach ($subcategorias as $sub)
            @if($cat->gdcat_id == $sub->gdcat_id)
				<li class="list-group-item">
               <i class="fa fa-angle-double-right"></i>
               <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id.'subcalla' }}" class="text-danger"> {{ $sub->gdsub_nombre }} </a>
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
               <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
               
               <div id="{{ $sub->gdsub_id.'subcalla' }}" class="panel-collapse collapse">
               <ul class="list-unstyled">
               @foreach ($documentos as $doc)
                  @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte">
                        <input type="radio" name="gdver_id" class="gdver_id" id="{{$doc->gdver_id.'lab'}}" value="{{$doc->gdver_id}}" onclick="buscar_informacion({{$doc->gdver_id}})">
                        <label for="{{$doc->gdver_id.'lab'}}">{{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }}</label>
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

$('#gddoc_req_consecutivo').click(function() {
   if($('#gddoc_req_consecutivo').is(':checked')){
      $("#gddoc_consecutivo_ini").prop('disabled', false);
   }else{
      $("#gddoc_consecutivo_ini").prop('disabled', true);
   }
});

});


function buscar_informacion(id){
   
   $.post("buscar_info_doc_json",{iddoc:id},function(data){

      //return alert(data);

      if(data.length==0){
         console.log(data);
      }else{
         console.log(data);

         $('#doc_idtr').val(data.documentos.gddoc_id);


         $('#gdver_descripcion').val(data.documentos.gdver_descripcion);
         $("#gdver_fecha_version").val(data.documentos.gdver_fecha_version);         

         if(data.documentos.gddoc_req_registro==1){
            $('#gddoc_req_registro').prop("checked", true);
         }else{
            $('#gddoc_req_registro').prop("checked", false);
         }

         if(data.documentos.gddoc_req_consecutivo==1){
            $('#gddoc_req_consecutivo').prop("checked", true);
            $("#gddoc_consecutivo_ini").prop('disabled', false);
            $("#gddoc_consecutivo_ini").val(data.documentos.gddoc_consecutivo_ini);
         }else {
            $('#gddoc_req_consecutivo').prop("checked", false);
            $("#gddoc_consecutivo_ini").prop('disabled', true);
            $("#gddoc_consecutivo_ini").val('');
         }
      }
   });
}


function validar_version(){

   if($('.gdver_id').is(':checked')==false){
      alert("Por favor selecciona un documento del la estructura de documentos");
      return false;
   }else if(!confirm("Está seguro de actualizar?")){
      return false;
   }else if($('#gddoc_req_consecutivo').is(':checked')==true && $('#gddoc_consecutivo_ini').val()==''){
      alert("El campo Consecutivo inicial es requerido!!");
      $("#gddoc_consecutivo_ini").focus();
      return false;
   }else if( isNaN($('#gddoc_consecutivo_ini').val()) ) {
      alert("el campo Consecutivo inicial solo puede contener valores numéricos");
      $("#gddoc_consecutivo_ini").focus();
      return false;
   } 

   return true;
}

</script>
@stop
