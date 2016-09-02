@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'inicio'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop




@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-cogs"></i> Bienvenid@ <!-- <small>Panel de control</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active">Bienvenida</li>
    </ol>
    <hr>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">
{{ HTML::image('admin/images/admin.png', 'a picture', array('class' => 'img-responsive center-block')) }}






@include('cosas_generales.boton_info', array('imagen'=>'inicio_admin'))

</section>
@stop