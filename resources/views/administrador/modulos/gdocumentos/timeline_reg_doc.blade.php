@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
   {{ HTML::style('general/css/timeline.css') }}
@stop
 
@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-clock-o"></i> Línea de Tiempo, {{$documet->gddoc_identificacion}} <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/gdocumentos') }}"><i class="fa fa-book"></i> Gestión documental</a></li>
      <li class="active">Línea de Tiempo</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="col-lg-12">




<div class="qa-message-list" id="wallmessages" style="overflow: auto;max-height: 500px;">

   @foreach($registros->reverse() as $registro)
   <!-- {{$registro->versiones}} -->

   <div class="message-item" id="m16">
      <div class="message-inner">
         <div class="message-head clearfix">
            <div class="avatar pull-left">
               <?php $excel = array(".xls", ".xlxs"); ?>
               <?php $word = array(".doc", ".docx"); ?>
               <?php $pdf = array(".pdf"); ?>
               <?php $ppt = array(".ppt",".pptx"); ?>
               @if(Metodos::buscar_palabras($registro->gdreg_ruta_archivo, $excel))<i class="fa fa-file-excel-o fa-3x"></i>@endif
               @if(Metodos::buscar_palabras($registro->gdreg_ruta_archivo, $word))<i class="fa fa-file-word-o fa-3x"></i>@endif
               @if(Metodos::buscar_palabras($registro->gdreg_ruta_archivo, $pdf))<i class="fa fa-file-pdf-o fa-3x"></i>@endif
               @if(Metodos::buscar_palabras($registro->gdreg_ruta_archivo, $ppt))<i class="fa fa-file-powerpoint-o fa-3x"></i>@endif
               @if($registro->gdreg_ruta_archivo=='')<i class="fa fa-file-o fa-3x"></i>@endif
            </div>
            <div class="user-detail">
               <strong>{{$registro->documentos->gddoc_identificacion}} </strong>{{$registro->versiones->gdver_descripcion}}
                  
                  <strong>Consecutivo: </strong>{{$registro->consecutivos->gdcon_consecutivo}}
                  <strong>Fecha creación: </strong> {{$registro->consecutivos->gdcon_creacion}}
                  <br>
                  <strong>Descripción: </strong>{{$registro->gdreg_descripcion}} <br>
                  
                  @if($registro->documentos->gddoc_req_registro)
                     <strong>Mas Información: </strong>{{$registro->gdreg_detalles}} <br>
                  @endif

                  <strong>Fecha registro: </strong> {{$registro->gdreg_creacion}} <br>

                  @if($registro->documentos->gddoc_req_registro)
                     <strong>Estado: </strong>{{$registro->gdreg_estado}} 
                  @endif

                  @if($registro->gdreg_estado=='usado' && $registro->documentos->gddoc_req_registro)
                     <a href="../{{$registro->gdreg_ruta_archivo}}">Descargar</a>
                  @endif

            </div>
         </div>
         <div class="qa-message-content"> 
            <strong>Usuario: </strong> {{ Metodos::obtener_usuario_de_un_registro($registro->gdreg_id); }}
         </div>
      </div>
   </div>

   @endforeach

</div>





</div>


</section>
@stop



@section('script')
<script type="text/javascript">

</script>
@stop
