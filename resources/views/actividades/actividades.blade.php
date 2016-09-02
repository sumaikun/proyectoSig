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
	<h1><i class="fa fa-users"></i> Gestión usuarios <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-users"></i> Gestión de Actividades</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">



<div class="col-lg-2">
	<a href="{{ url('admin/actividades/create') }}">
	<div class="thumbnail">
		{{ HTML::image('admin/images/actividades/create.png', 'categoria', array('class' => 'center-block')) }}
		<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Registrar Actividad</span></button>
	</div>
	</a>
</div>
<div class="col-lg-2">
	<a href="{{ url('admin/actividades/list') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/actividades/list.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Resumen De Actividades</span></button>
		</div>
	</a>
</div>
<div class="col-lg-2">
	<a href="{{ url('admin/actividades/parameters') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/actividades/parameters.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Parametros De Actividades</span></button>
		</div>
	</a>
</div>





@include('cosas_generales.boton_info', array('imagen'=>'usuario_admin'))
</section>
@stop