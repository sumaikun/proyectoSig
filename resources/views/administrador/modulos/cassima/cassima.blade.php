@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-google-wallet"></i> CASSIMA<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">

<div class="col-lg-2">
  <!-- <a href="{{ url('admin/cat_and_sub') }}"> -->
    <div class="thumbnail">
      {{ HTML::image('admin/images/modulos/categoria.png', 'categoria', array('class' => 'center-block')) }}
      <div class="btn-group btn-block">
         <button type="button" class="btn btn-block btn-link btn-xs" data-toggle="dropdown" aria-expanded="true">
            <span class="text-muted">
               <strong>Categorias/Subcategoria <span class="caret"></span></strong>
            </span>
         </button>
         <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('admin/cat_and_sub') }}"><i class="fa fa-plus-square"></i> Crear</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('admin/ord_edit_cat_and_sub') }}"><i class="fa fa-sort-amount-desc"></i> Ordenar y editar</a></li>
         </ul>
      </div>
      <!-- <button type="button" class="btn btn-block btn-link btn-xs">
         <span class="text-muted">
          <strong>Categorias/Subcategoria</strong>
         </span>
      </button> -->
    </div>
  <!-- </a> -->
</div> 


<div class="col-lg-2">
   <div class="thumbnail">
   {{ HTML::image('admin/images/modulos/documentos.png', 'categoria', array('class' => 'center-block')) }}
      <div class="btn-group btn-block">
         <button type="button" class="btn btn-block btn-link btn-xs" data-toggle="dropdown" aria-expanded="true">
            <span class="text-muted">
               <strong>Documentos <span class="caret"></span></strong>
            </span>
         </button>
         <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('admin/subir_doc') }}"><i class="fa fa-cloud-upload"></i> Nuevo Documento</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('admin/new_version') }}"><i class="fa fa-plus-square"></i> Nueva versión</a></li>
            <li><a href="{{ url('admin/update_ver') }}"><i class="fa fa-pencil-square-o"></i> Editar versión actual</a></li>
            <li><a href="{{ url('admin/hvdocumento') }}"><i class="fa fa-exclamation-circle"></i> HV documento</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('admin/disable_doc') }}"><span class="text-danger"><i class="fa fa-eye-slash"></i> Inactivar Documento</span></a></li>
         </ul>
      </div>
   </div>
</div>


<div class="col-lg-2">
   <div class="thumbnail">
      {{ HTML::image('admin/images/modulos/permisos.png', 'categoria', array('class' => 'center-block')) }}
      <div class="btn-group btn-block">
         <button type="button" class="btn btn-block btn-link btn-xs" data-toggle="dropdown" aria-expanded="true">
            <span class="text-muted">
               <strong>Permisos <span class="caret"></span></strong>
            </span>
         </button>
         <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('admin/permisos_per_doc') }}"><i class="fa fa-street-view"></i> Permisos usuario - doc</a></li>
            <li><a href="{{ url('admin/permisos_doc_per') }}"><i class="fa fa-file-text-o"></i> Permisos doc - usuario</a></li>
            <li><a href="{{ url('admin/permisos_por_cargo') }}"><i class="fa fa-check-circle-o"></i> Permisos por Cargo</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('admin/asociar_doc_carg') }}"><i class="fa fa-check-square-o"></i> <span class="text-success">Asociar Doc a Cargos</span></a></li>
         </ul>
      </div>
   </div>
</div>


</section>
@stop