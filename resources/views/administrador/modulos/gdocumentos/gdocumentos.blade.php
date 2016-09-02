@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-book"></i> Gestión documental <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-book"></i> Gestión documental</a></li>
      <li class="active">Inicio</li>
    </ol>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">

<div class="col-lg-2">
	<a href="{{ url('admin/download_doc') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/gdocumentos/consecutivos.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-block btn-link btn-xs">
			   <span class="text-muted">
			   	<strong>Descargar Documentos</strong>
			   </span>
			</button>
			<!-- <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Descarga de Documentos</span></button> -->
		</div>
	</a>
</div>

<div class="col-lg-2">
	<a href="{{ url('admin/subir_registro') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/gdocumentos/registro.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-block btn-link btn-xs">
			   <span class="text-muted">
			   	<strong>Subir registro</strong>
			   </span>
			</button>
		</div>
	</a>
</div>

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('admin/consultar_registros') }}">
   {{ HTML::image('admin/images/gdocumentos/consultar_registro.png', 'upload', array('class' => 'img-responsive')) }}
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

</section>
@stop