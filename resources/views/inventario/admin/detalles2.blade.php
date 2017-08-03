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

  <h1><i class="fa fa-plus-circle"></i> Detalles de Mantenimiento  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
    <li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Inventario</a></li>
      <li class="active">Mantenimiento</li>
    </ol>
    <!-- <hr> -->
</section>

<div class="container">
<br>
   <div class="col-lg-11">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Información del mantenimiento </h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
        <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>id</th>
            <th width="30%">Fecha estimada de devolución</th>
            <th>Comentario</th>
            <th>Quedan</th>
            <th>Cancelar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> {{ $registro->id }} </td>
            <td> {{ $registro->fecha }} <a href="#" data-toggle="modal"  title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i></td>
            <td> {{ $registro->info_extra }} <a href="#" data-toggle="modal"  title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i></td>
            <td> <strong style="color:red;">{{ psig\Helpers\horas_minutos::taking_away_days($registro->fecha,date("Ymd"))}} días</strong> </td>
            <td><a href="" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
          </tr>
        </tbody>
      </table>    
      </div>
   </div>
   </div>
   <div class="col-lg-11"> 
    <button class="btn btn-warning">Crear Seguimiento</button>
    <button class="btn btn-success">Ver Seguimiento</button>
   </div> 
 
</div>
@stop

