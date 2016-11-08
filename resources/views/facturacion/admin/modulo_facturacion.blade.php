@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'usuarios'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-users"></i> Facturación <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-users"></i> Gestión de Facturación</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">



<div class="col-lg-2">
	<a href="{{ url('admin/facturacion/create') }}">
	<div class="thumbnail">
		{{ HTML::image('admin/images/facturacion/create.png', 'categoria', array('class' => 'center-block')) }}
		<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Crear Factura</span></button>
	</div>
	</a>
</div>
<div class="col-lg-2">
	<a href="{{ url('admin/facturacion/list') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/facturacion/list.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Facturas</span></button>
		</div>
	</a>
</div>
<div class="col-lg-2">
	<a href="{{ url('admin/facturacion/parameters') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/actividades/parameters.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Manejo de entidades</span></button>
		</div>
	</a>
</div>

<div class="col-lg-2">
	<a href="{{ url('admin/facturacion/excel') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/actividades/excel.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Plantillas</span></button>
		</div>
	</a>
</div>

<div class="col-lg-2">
	<a href="{{ url('admin/facturacion/permission') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/facturacion/permission.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Gestion de Permisos</span></button>
		</div>
	</a>
</div>




</section>
@stop