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

<div class="col-lg-2">
	<a href="{{ url('admin/inventario/Permisos') }}">
	<div class="thumbnail">
		{{ HTML::image('admin/images/inventarios/permission.png', 'categoria', array('class' => 'center-block')) }}
		<button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Permisos de Inventario</span></button>
	</div>
	</a>
</div>

<div class="col-lg-2">
  <a href="{{ url('admin/inventario/create2') }}">
  <div class="thumbnail">
    {{ HTML::image('admin/images/inventarios/generate.jpg', 'categoria', array('class' => 'center-block')) }}
    <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Crear consumibles</span></button>
  </div>
  </a>
</div>

<div class="col-lg-2">
  <a href="{{ url('admin/inventario/Gestion2') }}">
  <div class="thumbnail">
    {{ HTML::image('admin/images/inventarios/list2.png', 'categoria', array('class' => 'center-block')) }}
    <button type="button" class="btn btn-default btn-block btn-xs"><span class="text-success">Gestion de consumibles</span></button>
  </div>
  </a>
</div>


</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Alertas
            </h4>
         </div>
         <div class="modal-body">              
            <div class="row">  
              <div class="col-lg-12">
                <div id="ajax-content">
              </div>
            </div>      
         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button onclick="quit_alerts()" type="submit" id="save_category"   class="btn btn-success" data-dismiss="modal"><i class="fa fa-floppy-o"></i>Entendido no me las muestres mas</button>
         </div>
      </div>
   </div>
</div>

<script>

@if(session::get('no_show_alerts')==null)

$( document ).ready(function() {
    $.get("inventario/check_alerts", function(res, sta){
         $("#ajax-content").append(res);
         $("#myModal").modal('show');
      });
});

@endif

function quit_alerts()
{
	if(confirm("Quitar las alertas hará que no se muestren hasta su proximo inicio de sesión ¿Esta de acuerdo?"))
	{
		window.location.href= "inventario/quit_alerts";		
	}

}
</script>

@stop


