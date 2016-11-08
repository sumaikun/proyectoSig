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
  <h1><i class="fa fa-users"></i> Facturación <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Gestión de Facturación</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">


@if(Session::get('gene_factura')!=null)
<div class="col-lg-2">
  <a href="{{ url('usuario/facturacion/create') }}">
  <div class="thumbnail">
    {{ HTML::image('admin/images/facturacion/create.png', 'categoria', array('class' => 'center-block')) }}
    <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Crear Factura</span></button>
  </div>
  </a>
</div>
@endif
@if(Session::get('obs_factura')!=null)
<div class="col-lg-2">
  <a href="{{ url('usuario/facturacion/list') }}">
    <div class="thumbnail">
      {{ HTML::image('admin/images/facturacion/list.png', 'categoria', array('class' => 'center-block')) }}
      <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Facturas</span></button>
    </div>
  </a>
</div>
@endif
@if(Session::get('ges_entidades')!=null)
<div class="col-lg-2">
  <a href="{{ url('usuario/facturacion/parameters') }}">
    <div class="thumbnail">
      {{ HTML::image('admin/images/actividades/parameters.png', 'categoria', array('class' => 'center-block')) }}
      <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Manejo de entidades</span></button>
    </div>
  </a>
</div>
@endif



@include('cosas_generales.boton_info', array('imagen'=>'inicio_usuario'))
@stop