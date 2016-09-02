@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'gdocumental'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'gdocumental'))
@stop


@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop



@section('contenido')
<h3 class="page-header"><i class="fa fa-search"></i> Consultar Registros<!-- <small>Bienvenid@</small> --></h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>


<div class="row">

<div class="col-lg-7">

<form name="form1" id="form1" action="timeline_registro" onsubmit="return validar()">

<div class="ocultar_450px">
   <div class="panel-group" id="accordion"><strong>Linea de tiempo por documento</strong>
      @foreach ($categorias as $cat)
      <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}">
               <i class="fa fa-folder-open-o text-warning"></i>
               <span class="text-muted"> <strong>{{ ucwords ($cat->gdcat_nombre) }}</strong> </span>
               <i class="fa fa-angle-double-down pull-right"></i>
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
                  <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id.'subcolla' }}" class="text-muted"> {{ucwords ($sub->gdsub_nombre)}} </a>
                  <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
                  <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
                  
                  <div id="{{ $sub->gdsub_id.'subcolla' }}" class="panel-collapse collapse">
                  <ul class="list-unstyled">
                  @foreach ($documentos as $doc)
                     @if($sub->gdsub_id == $doc->gdsub_id)
                        <li class="correte">
                           <input type="radio" name="gddoc_id" class="gddoc_id" id="{{$doc->gddoc_id}}" value="{{$doc->gddoc_id}}" onclick="buscar_informacion(this.value)">
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

<div class="col-lg-12 nopadding">
   <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-search"></i> Buscar</button>
</div>

</form>

</div>


<div class="col-lg-5"><br>

<div class="col-lg-12">
<div class="panel panel-default">
   <div class="panel-heading"><i class="fa fa-search"></i> <strong>Registro Individual</strong></div>
   <div class="panel-body">
      <form name="form2" id="form2" action="consulta_reg_individual" method="post">
         <div class="col-lg-5 col-xs-7">Identificación
           <input type="text" name="gddoc_identificacion" id="gddoc_identificacion" class="form-control" required>
         </div>
         <div class="col-lg-4 col-xs-7">Consecutivo
           <input type="text" name="gdcon_consecutivo" id="gdcon_consecutivo" class="form-control" required>
         </div>
         <div class="col-lg-2 col-xs-5"><br>
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
         </div>
         <div class="col-lg-12">
            @if(isset($mensaje))
               {{$mensaje}}
            @endif
         </div>
      </form>
   </div>
</div>   
</div>

</div>




</div>
        






<!-- este boton muestra la informacion de la vista del documento -->
<div id="inbox">
   <div class="fab btn-group show-on-hover dropup">
      <div data-toggle="tooltip" data-placement="left" title="Información" style="margin-left: 42px;">
         <button type="button" class="btn btn-danger btn-io dropdown-toggle" data-toggle="modal" data-target="#info_doc">
            <span class="fa-stack fa-2x">
               <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
               <i class="fa fa-question fa-stack-1x fa-inverse fab-primary"></i>
               <i class="fa fa-info-circle fa-stack-1x fa-inverse fab-secondary"></i>
            </span>
         </button>
      </div>
      <ul class="dropdown-menu dropdown-menu-right" role="menu">
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="Manual"><i class="fa fa-book"></i></a></li> -->
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="LiveChat"><i class="fa fa-comments-o"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Reminders"><i class="fa fa-hand-o-up"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Invites"><i class="fa fa-ticket"></i></a></li> -->
      </ul>
   </div>
</div>      


<!-- este include es para el boton informacion de la vista -->
@include('cosas_generales.boton_info', array('imagen'=>'buscar_usuario'))
@stop



@section('script')

<script type="text/javascript">

function validar(){
   if(!$('.gddoc_id').is(':checked')){
      alert("No ha seleccionado ningún documento");
      return false;
   }
   return true;
}

</script>
@stop
