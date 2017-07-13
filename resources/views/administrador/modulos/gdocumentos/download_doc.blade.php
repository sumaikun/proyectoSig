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
	<h1><i class="fa fa-cloud-download"></i> Descargar documentos <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/gdocumentos') }}"><i class="fa fa-book"></i> Gestión documental</a></li>
      <li class="active">Descargar documentos</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="col-lg-7">

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
                  <!-- <i class="fa fa-trash-o pull-right text-danger"></i>
                  <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
                  
                  <div id="{{ $sub->gdsub_id }}" class="panel-collapse collapse">
                  <ul class="list-unstyled">
                  @foreach ($documentos as $doc)
                     @if($sub->gdsub_id == $doc->gdsub_id)
                        <li class="correte">
                           <i class="fa fa-caret-right"></i>
                           <a href="#" onclick="buscar_info_doc({{$doc->gdver_id}})">{{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }}</a>
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

<style>
  .cons_empresas{
    display:none;
  }
  #cons_todas{
    display:none;
  }
</style>

<div class="col-lg-5">
   <div class="panel panel-default">
      <div class="panel-heading">
         <h3 class="panel-title"><i class="fa fa-file-text-o"></i> <strong>Información del documento</strong></h3>
      </div>
      <div class="panel-body">
         
         <strong>Nota: </strong>Seleccione un documento del árbol de documentos para ver sus detalles
         y descargarlo.

      <hr>
      
      <ul>
         <li><strong>Identificación: </strong><span id="identificacion"></span></li>
         <li><strong>Descripción: </strong><span id="desc"></span></li>
         <li><strong>Versión: </strong><span id="version"></span></li>
         <li><strong>Fecha de la versión: </strong><span id="fecha_version"></span></li>
         <li><strong>Requiere consecutivo: </strong><span id="req"></span></li>
         <li><strong>Consecutivo inicial: </strong><span id="conse_ini"></span></li>        
          <li id="cons_todas"><h4><small><strong>Ultimo Consecutivo: </strong></small><span id="ultimoconse" class="label label-success"></span></h4></li>
         @foreach($empresas as $empresa)
          <li class="cons_empresas"><strong>Ultimo Consecutivo {{$empresa->abbr}}: </strong><span id="cons_{{$empresa->abbr}}"></span></li>
        @endforeach
         <a href="" class="pull-right" data-toggle="modal" data-target="#hv">Ver HV Documento</a>
      </ul>

      

      

      </div>

      <div class="panel-footer">
            
            <!-- <div class="well" > -->
               <div class="row" id="noconse">
                  <div class="col-lg-6">
                     <button type="button" class="btn btn-lg btn-block btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> Previsualizar</button>
                  </div>
                  <div class="col-lg-6">
                     <form action="download_sin_consecutivo" name="form3" id="form3" method="post">
                        <input type="hidden" name="download" id="download">
                        <input type="hidden" name="iddoc_hidden" id="iddoc_hidden">
                        <button type="submit" class="btn btn-lg btn-block btn-success"><i class="fa fa-download text-success"></i> Descargar </button>
                        <!-- <a id="download" href="#" class="btn btn-lg btn-block btn-success" target="_blank"><i class="fa fa-download text-success"></i> Descargar archivo</a> -->
                     </form>
                  </div>
                  <div class="col-lg-12">
                     <small><strong>Nota: </strong>El botón previsualizar muestra una vista rapida del documento sin necesidad de generar un consecutivo o su descarga</small>
                  </div>
               </div>
            <!-- </div> -->

            <!-- <div id="siconse"> -->
               <div class="row" id="siconse">
                  <div class="col-lg-6">
                     <!-- <a href="#" id="preview" class="btn btn-lg btn-block btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> Previsualizar</a> -->
                     <button type="button" class="btn btn-lg btn-block btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-eye"></i> Previsualizar</button>
                  </div>

                  <div class="col-lg-6">
                     <button class="btn btn-lg btn-block btn-success" onclick="consecutivo()"><i class="fa fa-sort-numeric-asc"></i> Generar consec.</button>
                  </div>
                  <div class="col-lg-12">
                     <small><strong>Nota: </strong>El botón previsualizar muestra una vista rapida del documento sin necesidad de generar un consecutivo o su descarga</small>
                  </div>
               </div>
            <!-- </div> -->

      </div>
        <a href="{{ url('admin/download_doc') }}"><button class="btn btn-warning  form-control">Filtrar solo documentos con consecutivo</button></a>
   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sort-numeric-asc"></i> <strong>Consecutivo</strong></h4>
      </div>
      <div class="modal-body">
        
        <div class="well">

           <div class="row">
               <div class="col-lg-12" id="mencion"></div>
               <div class="col-lg-12 text-center">
                  <h1 id="info"></h1>
               </div>
               <div class="col-lg-12">
               <form action="descargar_doc_json" method="post" name="doc" id="doc">

                  <!-- cuando se genera el consecutivo se agrega a este campo para ser enviado en la descarga del documento -->
                  <input type="hidden" name="consecutivogenerado" id="consecutivogenerado">
                  <input type="hidden" name="id_doc" id="id_doc">
                  
                  <!-- <button type="submit" id="descargadoc" class="btn btn-success btn-block"><i class="fa fa-cloud-download"></i> Descargar Documento</button> -->
               </form>
                  
               </div>
           </div>

        </div>

      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-warning" name="copy" id="copy"><i class="fa fa-files-o"></i> Copiar</button> -->
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>




<!-- este modal es para la previsualizacion del documento -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4><strong id="titulo_doc"></strong></h4>
         </div>
         <div class="modal-body">
            <img src="" alt="" id="previsual" class="img-responsive center-block">
         </div>
      </div>
   </div>
</div>




<!-- Este modal es para ver la hv del documento -->
<div class="modal fade" id="hv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle"></i> HV Documento</h4>
      </div>
      <div class="modal-body nopadding">
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
         <li class="list-group-item"><strong>Tiempo de retención - Archivo de gestion: </strong><span id="retgest"></span></li>
         <li class="list-group-item"><strong>Tiempo de retención - Archivo Inactivo: </strong><span id="retinact"></span></li>
         <li class="list-group-item"><strong>Tiempo de retención - Archivo muerto: </strong><span id="retmuerto"></span></li>
      </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</section>
@stop



@section('script')
{{ HTML::script('admin/js/bootstrap-filestyle.js') }}



<script type="text/javascript">

$(function() {
   $('#noconse').hide();
   $('#siconse').hide();
});
 

function consecutivo(){

if (confirm("Está seguro de generar un consecutivo para este documento? ")) {
   var iddoc = $("#id_doc").val();
   $.post("generarconsecutivo_json",{iddoc:iddoc},function(data){
      //return alert(data);

      if(data==-1){
         $("#mencion").html("<i>Informe: </i>"); 
         $("#info").html("Usted tiene pendiente un registro para este documento");
         $('#descargadoc').hide();
          
      }else{
         $("#mencion").html("<i>Le correspondió el consecutivo: </i>"); 
         $("#info").html(data);
         $("#consecutivogenerado").val(data);
         
         $( "#doc" ).submit();
      }

      $('#myModal').modal('show');
      
   });
 

};

   
}


function buscar_info_doc(id){
   
   $.post("buscar_info_doc_json",{iddoc:id},function(data){

      //return alert(data);

      if(data.length==0){
         console.log(data);
      }else{
          //console.log("total empresas "+data.empresas[0].nombre);
         $("#identificacion").html(data.documentos.gddoc_identificacion); 
         $("#version").html("V"+data.documentos.gdver_version); 
         $("#desc").html(data.documentos.gdver_descripcion); 
         $("#fecha_version").html(data.documentos.gdver_fecha_version);          


         if(data.documentos.gddoc_req_consecutivo==1){
              $(".cons_empresas").show();
              $("#cons_todas").show();
            if(data.documentos.gddoc_is_multcons==1)
            {
              console.log('entra a mult cons');
              $(".cons_empresas").show();
              $("#cons_todas").hide();
              for(var i in data.consecutivo){
                  $("#cons_"+i).empty();
                  $("#cons_"+i).html(data.consecutivo[i]);                  
                }
              
            }
            else{
              //console.log('no es mult cons'+data.documentos.gddoc_req_consecutivo);
              $(".cons_empresas").hide();
              $("#cons_todas").show(); 
            }

            $("#req").html("SI");   
            $("#conse_ini").html(armar_sonsecutivo(data.documentos.gddoc_consecutivo_ini)+"-"+data.documentos.gddoc_anio);  
            
            $('#siconse').show();
            $('#noconse').hide();

            if(data.consecutivo!=null){

              if(data.documentos.gddoc_is_multcons==1)
              {
                //console.log('entré');

                 for (var i=0 ; i<data.empresas.length ; i++)
                 {
                    $("#cons_"+data.empresas[i].abbr).html(data.consecutivo[i]);
                    $("#cons_"+data.empresas[i].abbr).html();
                 }
              }
              else{                
               $("#ultimoconse").html(data.consecutivo.gdcon_consecutivo);
              }
            }else{
               $("#ultimoconse").html('');
            }
            
         }else{

            $(".cons_empresas").hide();
            $("#cons_todas").hide();

            $('#noconse').show();
            $('#siconse').hide();

            $("#download").val(data.documentos.gdver_ruta_archivo);
            $("#iddoc_hidden").val(data.documentos.gddoc_id);
            
            $("#req").html("NO");   
            $("#conse_ini").html('');
            $("#ultimoconse").html('');
         }         

         $("#previsual").attr("src", "../"+data.documentos.gdver_ruta_preview);
         // $("#ruta").html(data[0].gdver_ruta_archivo); 
         $("#id_doc").val(data.documentos.gdver_id);
         $("#titulo_doc").html(data.documentos.gddoc_identificacion+" "+data.documentos.gdver_descripcion); 


         if(data.hv != null){
           // hoja de vida del documento
           $("#origen").html(data.hv.gdhv_origen); 
           $("#rev").html(data.hv.gdhv_revisado_por); 
           $("#aprob").html(data.hv.gdhv_aprobado_por); 
           $("#cambio").html(data.hv.gdhv_detalle_cambio); 
           $("#disop").html(data.hv.gdhv_disp_obsoletos); 
           $("#custodia").html(data.hv.gdhv_custodia); 
           $("#medalmace").html(data.hv.gdhv_med_almacenamiento); 
           $("#mdpro").html(data.hv.gdhv_med_proteccion); 
           $("#ubreg").html(data.hv.gdhv_ubicacion_reg); 
           $("#retgest").html(data.hv.gdhv_ret_gestion); 
           $("#retinact").html(data.hv.gdhv_ret_inactivo); 
           $("#retmuerto").html(data.hv.gdhv_ret_muerto); 
         }else{
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
         }
         
      }

   });

}


</script>
@stop
