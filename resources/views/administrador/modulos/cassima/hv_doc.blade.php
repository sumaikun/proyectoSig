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
	<h1><i class="fa fa-exclamation-circle"></i> Hoja de vida documento <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Hoja de vida documento</li>
   </ol>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" >


<form action="../buscar_hv" onsubmit="return validar()" id="form1" name="form1" method="post">
   
<div class="col-lg-7">

<div class="ocultar_450px">
   <div class="panel-group" id="accordion">
      @foreach ($categorias as $cat)
      <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
               <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}"><i class="fa fa-folder-open-o"></i>
               </span> {{ ucwords ($cat->gdcat_nombre) }}</a> 
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i>
               <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
            </h4>
         </div>
         <div id="{{ $cat->gdcat_id.'colla' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
            <ul class="list-group">
            @foreach ($subcategorias as $sub)
               @if($cat->gdcat_id == $sub->gdcat_id)
               <li class="list-group-item">
                  <i class="fa fa-angle-double-right"></i>
                  <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id.'subcolla' }}" class="text-danger"> {{ $sub->gdsub_nombre }} </a>
                  <!-- <input id="{{$sub->gdsub_id}}b" type="checkbox" class="pull-right" onclick="checkbox_nodos({{$sub->gdsub_id}})" /> -->
                  
                  <div id="{{ $sub->gdsub_id.'subcolla' }}" class="panel-collapse collapse">
                  <ul class="list-unstyled">
                  @foreach ($documentos as $doc)
                     @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte list-group-item">
                        <input type="radio" name="gddoc_id" class="gddoc_id" id="{{$doc->gddoc_id}}" value="{{$doc->gddoc_id}}" onclick="buscar_info_doc({{$doc->gddoc_id}})">
                        <label for="{{$doc->gddoc_id}}">{{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }}</label>
                        <a href="{{ url('admin/buscar_hv/'.$doc->gddoc_id) }}"><i class="fa fa-pencil-square-o pull-right" style="margin-right:15px;"></i></a>
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

<!-- <div class="col-lg-12 nopadding">
   <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-search"></i> Buscar</button>
</div> -->

</div>

</form>



<div class="col-lg-5">

<div class="panel panel-default">
   <div class="panel-heading"><i class="fa fa-info-circle"></i> Información del documento</div>
      <!-- <div class="panel-body">
         <p>...</p>
      </div> -->
 
      <ul class="list-group">
         <li class="list-group-item"><strong>Origen: </strong><span id="origen"></span></li>
         <li class="list-group-item"><strong>Revisado Por: </strong><span id="rev"></span></li>
         <li class="list-group-item"><strong>Aprobado Por: </strong><span id="aprob"></span></li>
         <li class="list-group-item"><strong>Cambio: </strong><span id="cambio"></span></li>
         <li class="list-group-item"><strong>Disposición de obsoletos: </strong><span id="disop"></span></li>
         <li class="list-group-item"><strong>Responsable de la custodia: </strong><span id="custodia"></span></li>
         <li class="list-group-item"><strong>Medio de almacenamiento: </strong><span id="medalmace"></span></li>
         <li class="list-group-item"><strong>Medio de proteccion del registro: </strong><span id="mdpro"></span></li>
         <li class="list-group-item"><strong>Ubicación del registro: </strong><span id="ubreg"></span></li>
         <li class="list-group-item"><strong>TIEMPO DE RETENCIÓN - ARCHIVO DE GESTIÓN: </strong><span id="retgest"></span></li>
         <li class="list-group-item"><strong>TIEMPO DE RETENCIÓN - ARCHIVO INACTIVO: </strong><span id="retinact"></span></li>
         <li class="list-group-item"><strong>TIEMPO DE RETENCIÓN - ARCHIVO MUERTO: </strong><span id="retmuerto"></span></li>
         
      </ul>
</div>

</div>


</section>
@stop



@section('script')
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js') }}
{{ HTML::script('admin/js/main_angular.js') }}
<script type="text/javascript">


function validar(){
   if(!$('.gddoc_id').is(':checked')){
      alert("No ha seleccionado ningún documento");
      return false;
   }
   return true;
}



function buscar_info_doc(gddoc_id){
   
   $.post("buscar_hv_doc",{gddoc_id:gddoc_id},function(data){

      if(data.length==0){

         $("#origen").html(''); 
         $("#rev").html('');
         $("#aprob").html(''); 
         $("#cambio").html(''); 
         $("#disop").html(''); 
         $("#custodia").html(''); 
         $("#medalmace").html(''); 
         $("#mdpro").html(''); 
         $("#ubreg").html(''); 
         $("#retgest").html(''); 
         $("#retinact").html(''); 
         $("#retmuerto").html(''); 

      }else{
      
         $("#origen").html(data.gdhv_origen); 
         $("#rev").html(data.gdhv_revisado_por); 
         $("#aprob").html(data.gdhv_aprobado_por); 
         $("#cambio").html(data.gdhv_detalle_cambio); 
         $("#disop").html(data.gdhv_disp_obsoletos); 
         $("#custodia").html(data.gdhv_custodia); 
         $("#medalmace").html(data.gdhv_med_almacenamiento); 
         $("#mdpro").html(data.gdhv_med_proteccion); 
         $("#ubreg").html(data.gdhv_ubicacion_reg); 
         $("#retgest").html(data.gdhv_ret_gestion); 
         $("#retinact").html(data.gdhv_ret_inactivo); 
         $("#retmuerto").html(data.gdhv_ret_muerto); 

         
         
         
      }

   });

}

</script>
@stop
