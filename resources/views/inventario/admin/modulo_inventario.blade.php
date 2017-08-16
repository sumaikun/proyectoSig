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
	<h1><i class="fa fa-users"></i> Inventario <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-users"></i> Gestión de Inventario</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">



<div class="col-lg-2">
	<a href="{{ url('admin/inventario/create') }}">
	<div class="thumbnail">
		{{ HTML::image('admin/images/inventarios/create.png', 'categoria', array('class' => 'center-block')) }}
		<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Ingresar Elemento</span></button>
	</div>
	</a>
</div>

<div class="col-lg-2">
	<a href="{{ url('admin/inventario/Gestion') }}">
	<div class="thumbnail">
		{{ HTML::image('admin/images/inventarios/list.png', 'categoria', array('class' => 'center-block')) }}
		<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Gestion de Inventario</span></button>
	</div>
	</a>
</div>


</section>


<script>
$( document ).ready(function() {
    console.log( "ready!" );
});
</script>

@stop


