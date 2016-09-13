@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'gdocumental'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'gdocumental'))
@stop

@section('css')
   {{ HTML::style('general/css/timeline.css') }}
@stop



@section('contenido')
<h3 class="page-header"><i class="fa fa-server fa-flip-horizontal"></i> Registros guardados, {{$documet->gddoc_identificacion}}<!-- <small>Bienvenid@</small> --></h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>





<div class="row">

<div class="col-lg-12">


<div class="qa-message-list" id="wallmessages">

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
            <strong>Usuario: </strong> {{ Metodos::obtener_usuario_de_un_registro($registro->gdreg_id) }}
         </div>
      </div>
   </div>

   @endforeach

</div>





</div>


</div>
        
      
@stop



@section('script')

<script type="text/javascript">

</script>
@stop
