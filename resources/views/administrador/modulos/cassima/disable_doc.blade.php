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
	<h1><i class="fa fa-eye-slash"></i> Inactivar Documento<!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Inactivar Documento</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">




<form name="form1" id="form1" action="disabledoc" onsubmit="return validar()" method="post">

<div class="row">
<div class="col-lg-7 col-xs-12" style="border-right: gray 5px solid;">

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
               <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id }}" class="text-danger"> {{ $sub->gdsub_nombre }} </a>
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
               <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
               
               <div id="{{ $sub->gdsub_id }}" class="panel-collapse collapse">
               <ul class="list-unstyled">
               @foreach ($documentos as $doc)
                  @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte">
                        <input type="radio" name="geddoc_id" class="geddoc_id" id="{{$doc->gddoc_id.'doc'}}" value="{{$doc->gddoc_id}}" onclick="buscar_informacion({{$doc->gddoc_id}})">
                        <label for="{{$doc->gddoc_id.'doc'}}">{{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }}</label>
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


<div class="col-lg-5">
   <div class="panel panel-default">
      <div class="panel-heading">
         <h3 class="panel-title"><i class="fa fa-file-text-o"></i> <strong>Información del documento</strong></h3>
      </div>
      <div class="panel-body">
         
         <strong>Nota: </strong>Seleccione un documento del árbol de documentos para ver sus detalles
         y descargarlo.

      </div>
      
      
      <ul>
         <li><strong>Identificación: </strong><span id="identificacion"></span></li>
         <li><strong>Descripción: </strong><span id="desc"></span></li>
         <li><strong>Versión: </strong><span id="version"></span></li>
         <li><strong>Fecha de la versión: </strong><span id="fecha_version"></span></li>
         <li><strong>Requiere consecutivo: </strong><span id="req"></span></li>
         <li><strong>Consecutivo inicial: </strong><span id="conse_ini"></span></li>
         <!-- <li><strong>Ruta Archivo: </strong><span id="ruta"></span></li> -->
      </ul>

      <div class="panel-footer">
         <div class="well" id="noconse">
            <div class="row">
               <div class="col-lg-12">
                  <button type="submit" class="btn btn-lg btn-block btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg">
                     <i class="fa fa-thumbs-o-down"></i> Inactivar Documento
                  </button>
               </div>
            </div>
         </div>
      </div>

      </div>
   </div>
</div>

</div>
</form>


</section>
@stop



@section('script')
<script type="text/javascript">


function validar(){

   if($('.geddoc_id').is(':checked')==false){
      alert("Por favor selecciona un documento del la estructura de documentos");
      return false;
   }else if(!confirm("Está seguro de Inabilitar el documento?")){
      return false;
   }
}



function buscar_informacion(id){
   
   $.post("buscar_info_doc_json",{iddoc:id},function(data){

      if(data.length!=0){
         
         $("#identificacion").html(data.documentos.gddoc_identificacion); 
         $("#desc").html(data.documentos.gdver_descripcion); 
         $("#version").html("V"+data.documentos.gdver_version); 
         $("#fecha_version").html(data.documentos.gdver_fecha_version); 

         if(data.documentos.gddoc_req_consecutivo==1){
            $("#req").html("SI");   
            $("#conse_ini").html(armar_sonsecutivo(data.documentos.gddoc_consecutivo_ini)+"-"+data.documentos.gddoc_anio);  
         }else{
            $("#req").html("NO");   
            $("#conse_ini").html('');
         }
      }

   });
}



</script>
@stop
