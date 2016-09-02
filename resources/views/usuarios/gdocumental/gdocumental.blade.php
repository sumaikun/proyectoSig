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
<h3 class="page-header"><i class="fa fa-book"></i> Gestión Documental CASSIMA<!-- <small>Bienvenid@</small> --></h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>


<div class="row">
      
<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('usuario/download_doc') }}">
   {{ HTML::image('usuarios/images/gdocumentos/download_doc.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Descargar Documentos</strong>
      </span>
   </button>
   </a>
</div>
</div>

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('usuario/registros_pendientes') }}">
   {{ HTML::image('usuarios/images/gdocumentos/registro.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Registros Pendientes</strong>
      </span>
   </button>
   </a>
</div>
</div>

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('usuario/consultar_registros') }}">
   {{ HTML::image('usuarios/images/gdocumentos/consultar_registro.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Consultar Registros</strong>
      </span>
   </button>
   </a>
</div>
</div>


@if(isset($mensaje))
<div class="col-lg-12">
   <div class="well well-sm">
      <div class="row">
         <div class="col-lg-12 text-center">
            <h3>{{ $mensaje }}</h3>
         </div>
      </div>
   </div>
</div>
@endif


</div>
         




<div id="inbox">
   <div class="fab btn-group show-on-hover dropup">
      <div data-toggle="tooltip" data-placement="left" title="Información" style="margin-left: 42px;">
         <button type="button" class="btn btn-danger btn-io dropdown-toggle" data-toggle="modal" data-target="#myModal">
            <span class="fa-stack fa-2x">
               <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
               <i class="fa fa-question fa-stack-1x fa-inverse fab-primary"></i>
               <i class="fa fa-info-circle fa-stack-1x fa-inverse fab-secondary"></i>
            </span>
         </button>
      </div>
      <!-- <ul class="dropdown-menu dropdown-menu-right" role="menu">
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Manual"><i class="fa fa-book"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="LiveChat"><i class="fa fa-comments-o"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Reminders"><i class="fa fa-hand-o-up"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Invites"><i class="fa fa-ticket"></i></a></li>
      </ul> -->
   </div>
</div>      


@include('cosas_generales.boton_info', array('imagen'=>'gdocumental_usuario'))
@stop