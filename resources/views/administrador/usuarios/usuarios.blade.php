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
   	<li><a href="#"><i class="fa fa-users"></i> Gestión usuarios</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">



<div class="col-lg-2">
	<a href="{{ url('admin/nuevousuario') }}">
	<div class="thumbnail">
		{{ HTML::image('admin/images/usuarios/nuevo_usuario.png', 'categoria', array('class' => 'center-block')) }}
		<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Nuevo Usuario</span></button>
	</div>
	</a>
</div>
<div class="col-lg-2">
	<a href="{{ url('admin/listausuario') }}">
		<div class="thumbnail">
			{{ HTML::image('admin/images/usuarios/lista_usuario.png', 'categoria', array('class' => 'center-block')) }}
			<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Listado de usuarios</span></button>
		</div>
	</a>
</div>





@include('cosas_generales.boton_info', array('imagen'=>'usuario_admin'))
</section>
@stop