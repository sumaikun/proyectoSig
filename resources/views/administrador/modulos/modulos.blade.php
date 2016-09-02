@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-cogs"></i> Modulos<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-cogs"></i> Modulos</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="height:500px;">



<div class="row">

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('admin/cassima') }}">
   {{ HTML::image('admin/images/modulos/cassima.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>CASSIMA</strong>
      </span>
   </button>
   </a>
</div>
</div>

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('admin/gdocumentos') }}">
   {{ HTML::image('admin/images/modulos/gdocumentos.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Gestión documental</strong>
      </span>
   </button>
   </a>
</div>
</div>

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('admin/comunicaciones') }}">
   {{ HTML::image('admin/images/modulos/comunicaciones.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Comunicaciones PRE</strong>
      </span>
   </button>
   </a>
</div>
</div>


<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('admin/ofertas') }}">
   {{ HTML::image('admin/images/modulos/ofertas.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Ofertas SIG</strong>
      </span>
   </button>
   </a>
</div>
</div>


</div>


<div class="divider" style="border-top: 2px solid gray; margin: 15px 0px;"></div>

<div class="row">
  <div class="col-lg-12">
    <h4>Administración de funciones</h4>
  </div>
</div>

<div class="row">

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('#') }}" data-toggle="modal" data-target="#myModal">
   {{ HTML::image('admin/images/funciones/funciones.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Funciones</strong>
      </span>
   </button>
   </a>
</div>
</div>

<div class="col-lg-2">
<div class="thumbnail">
   <a href="{{ url('admin/permisos_modulos') }}">
   {{ HTML::image('admin/images/funciones/permisos.png', 'upload', array('class' => 'img-responsive')) }}
   <button type="button" class="btn btn-block btn-link btn-xs">
      <span class="text-muted">
         <strong>Permisos</strong>
      </span>
   </button>
   </a>
</div>
</div>


</div>





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Listado de Funciones para los usuarios</h4>
      </div>
      <div class="modal-body">
        
			<form name="form1" id="form1" method="post" action="reg_funcion">
		    <table class="table table-striped custab">
		    	<thead>
		      	<tr>
		            <th>ID</th>
		            <th>Funcionalidad</th>
		            <th>Informacion</th>
		            <th>Creada desde</th>
		            <th class="text-center">Action</th>
		        	</tr>
		    	</thead>
					@foreach ($funciones as $key => $fun)
		       	<tr>
		         	<td>{{$key+1}}</td>
		            <td>{{ ucwords ($fun->fun_nombre) }}</td>
		            <td>{{ ucwords ($fun->fun_detalle) }}</td>
		            <td>{{ $fun->fun_creacion }}</td>
		            <td>
		            	<!-- Nota esto funciona y es para eliminar una funcionalidad por seguridad no esta activa ni para el usuario -->
		            	<a href="{{ url('admin/eliminarfun/'.$fun->fun_id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Eliminar</a></td>
		         </tr>
		         @endforeach
		         <tr>
		         	<td></td>
		            <td>
							<input type="text" name="fun_nombre" id="fun_nombre" class="form-control input-sm" required>
		            </td>
		            <td>
		            	<input type="text" name="fun_detalle" id="fun_detalle" class="form-control input-sm">
		            </td>
		            <td>
		               
		            </td>
		            <td>
							<button type="submit" class="btn btn-success btn-sm btn-block"><i class="fa fa-floppy-o"></i> <strong>Guardar</strong></button>
		            </td>
		         </tr>
		   </table>
		   </form>



      </div>
      <!-- 0<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


</section>
@stop