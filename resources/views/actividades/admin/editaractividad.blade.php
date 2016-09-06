@extends('administrador.layouts.layout')
@section('menu')
    @include('administrador.layouts.menu', array('op'=>'actividades'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
   {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css') }}

   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Editar Registro<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-child"></i> Gestión de Actividades</a></li>
      <li class="active">Editar Registro</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

  @include('actividades.sub_views.edit')


@include('cosas_generales.boton_info', array('imagen'=>'nuevo_usuario_admin'))
</section>
@stop


@section('script')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js') }}
<script type="text/javascript">


</script>
@stop
