@extends('usuarios.layouts.layout')


@section('barra_usuario')
  @include('usuarios.layouts.barra_usuario', array('op'=>'inicio'))
@stop


@section('menu_lateral')
  @include('usuarios.layouts.menu_lateral', array('op'=>'inicio'))
@stop


@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Nueva Actividad<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-child"></i> Gestión de Actividades</a></li>
      <li class="active">Nueva Actividad</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


	@include('actividades.sub_views.create')


@include('cosas_generales.boton_info', array('imagen'=>'nuevo_usuario_admin'))
</section>
@stop


@section('script')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js') }}
<script type="text/javascript">


</script>
@stop
