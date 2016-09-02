@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
  
@stop
 
@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-search"></i> Consultar registro individual<!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/gdocumentos') }}"><i class="fa fa-book"></i> Gestión documental</a></li>
      <li class="active">Consultar registro</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="col-lg-10 col-lg-offset-1">

<div class="well well-sm">
   <div class="row">
      <div class="col-xs-3 col-md-3 text-center">
         @if($registro->gdreg_estado=='usado')
         {{ HTML::image('admin/images/gdocumentos/download.png', 'categoria', array('class' => 'center-block img-responsive')) }}
         <br>
            <a href="../{{$registro->gdreg_ruta_archivo}}" class="btn btn-success btn-block">
               <i class="fa fa-cloud-download"></i> 
               Descargar Registro
            </a>
         @else
            {{ HTML::image('admin/images/gdocumentos/nulo.png', 'categoria', array('class' => 'center-block img-responsive')) }}
         @endif
      </div>
      <div class="col-xs-9 col-md-9 section-box">
         <h2>
            {{$registro->documentos->gddoc_identificacion}} <br> <small>{{ ucfirst($registro->gdreg_descripcion) }}</small>
         </h2>
         <hr />
         <div class="row rating-desc">
            <div class="col-md-12">
               
                  <strong>Consecutivo: </strong>{{$registro->consecutivos->gdcon_consecutivo}}
                  <strong>Fecha creación: </strong> {{$registro->consecutivos->gdcon_creacion}}
                  <br>
                  <strong>Descripción: </strong>{{$registro->gdreg_descripcion}} <br>
                  @if($registro->documentos->gddoc_req_registro)
                     <strong>Mas Información: </strong>{{$registro->gdreg_detalles}}<br>
                  @endif

                  <strong>Fecha registro: </strong> {{$registro->gdreg_creacion}} <br>

                  @if($registro->documentos->gddoc_req_registro)
                     <strong>Estado: </strong>{{$registro->gdreg_estado}} 
                  @endif
                  <hr>
                  <strong>Usuario: </strong>{{$registro->usuarios->usu_nombres." ".$registro->usuarios->usu_apellido1}}  
                 

            </div>
         </div>
      </div>
   </div>
</div>
        

</div>

 

</section>
@stop



@section('script')

<script type="text/javascript">

</script>
@stop
