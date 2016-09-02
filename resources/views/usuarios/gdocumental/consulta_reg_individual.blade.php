
@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'gdocumental'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'gdocumental'))
@stop



@section('contenido')
<h3 class="page-header"><i class="fa fa-search"></i> Consultar Registros individuales<!-- <small>Bienvenid@</small> --></h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>


<div class="row">

<div class="col-lg-10 col-lg-offset-1">

<div class="well well-sm">
   <div class="row">
      <div class="col-xs-3 col-md-3 text-center">
         @if($registro->gdreg_estado=='usado')
         {{ HTML::image('usuarios/images/gdocumentos/download.png', 'categoria', array('class' => 'center-block img-responsive')) }}
         <br>
            <a href="../{{$registro->gdreg_ruta_archivo}}" class="btn btn-success btn-block">
               <i class="fa fa-cloud-download"></i> 
               Descargar Registro
            </a>
         @else
            {{ HTML::image('usuarios/images/gdocumentos/nulo.png', 'categoria', array('class' => 'center-block img-responsive')) }}
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
                  <strong>Usuario: </strong> {{ Metodos::obtener_usuario_de_un_registro($registro->gdreg_id); }}
                 

            </div>
         </div>
      </div>
   </div>
</div>
        

</div>

</div>
        
      
@stop



@section('script')

<script type="text/javascript">

</script>
@stop
