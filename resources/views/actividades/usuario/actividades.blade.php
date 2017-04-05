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
  <h1><i class="fa fa-users"></i> Actividades <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-users"></i> Gestión de Actividades</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">



<div class="col-lg-2">
  <a href="{{ url('usuario/actividades/create') }}">
  <div class="thumbnail">
    {{ HTML::image('admin/images/actividades/create.png', 'categoria', array('class' => 'center-block')) }}
    <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Registrar Actividad</span></button>
  </div>
  </a>
</div>
<div class="col-lg-2">
  <a href="{{ url('usuario/actividades/list') }}">
    <div class="thumbnail">
      {{ HTML::image('admin/images/actividades/list.png', 'categoria', array('class' => 'center-block')) }}
      <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Resumen  Actividades</span></button>
    </div>
  </a>
</div>
<?php
  $permisos = psig\models\Modpermisosact::where('user_id','=',Session::get('usu_id'))->value('permisos');
  $array = explode(",",$permisos);
    $validate = False;
    if(in_array('revisar_reportes', $array))
    {
      $validate = True;
    }
?>
@if($validate == True)
<div class="col-lg-2">
  <a href="{{ url('usuario/actividades/reports') }}">
    <div class="thumbnail">
      {{ HTML::image('admin/images/actividades/reports.png', 'categoria', array('class' => 'center-block')) }}
      <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Reportes</span></button>
    </div>
  </a>
</div>
@endif


@include('cosas_generales.boton_info', array('imagen'=>'inicio_usuario'))
@stop