@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-pencil-square-o"></i> Editar y ordenar, Categorias Y subcategorias</h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Editar y ordenar</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">




<di class="col-lg-9 col-lg-offset-1">

<div class="ocultar">
<div class="panel-group" id="accordion">
<h4>Estructura de documentos</h4>
   @foreach ($categorias as $cat)
   <div class="panel panel-default">
      <div class="panel-heading">
         <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}"><i class="fa fa-folder-open-o"></i>
            </span> {{ $cat->gdcat_nombre}}</a>
            <span style="margin-left:60px;"> Estado: {{ $cat->gdcat_estado }}</span>
            <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
            <a href="{{ url('admin/show_cate/'.$cat->gdcat_id) }}">
               <i class="fa fa-pencil-square-o pull-right text-warning"></i>
            </a>
            <a href="{{ url('admin/ordcatdown/'.$cat->gdcat_id) }}"><i class="fa fa-arrow-down pull-right text-success" style="margin-right:15px;"></i></a>
            <a href="{{ url('admin/ordcatup/'.$cat->gdcat_id) }}"><i class="fa fa-arrow-up pull-right text-success" style="margin-right:15px;"></i></a>
            <a href="{{ url('admin/chague_activation_cat/'.$cat->gdcat_id) }}" title="activar/inactivar" onclick="return confirm('¿Desea cambiar el estado de la categoria?')"><i class="fa fa-exchange pull-right" aria-hidden="true" style="margin-right:10px;"></i></a>
            
            
         </h4>
      </div>
      <div id="{{ $cat->gdcat_id.'colla' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
         <ul class="list-group">
         @foreach ($subcategorias as $sub)
            @if($cat->gdcat_id == $sub->gdcat_id)
            <li class="list-group-item">
               <i class="fa fa-angle-double-right"></i>
               <a href="#"> {{ $sub->gdsub_nombre }}</a>
               <span style="margin-left:60px;"> Estado: {{ $sub->gdsub_estado }}</span>
               <a href="{{ url('admin/show_subcate/'.$sub->gdsub_id) }}">
                  <i class="fa fa-pencil-square-o pull-right text-warning"></i>
               </a>
               <a href="{{ url('admin/ordsubcatdown/'.$cat->gdcat_id.'/'.$sub->gdsub_id) }}"><i class="fa fa-arrow-down pull-right" style="margin-right:10px;"></i></a>
               <a href="{{ url('admin/ordsubcatup/'.$cat->gdcat_id.'/'.$sub->gdsub_id) }}"><i class="fa fa-arrow-up pull-right" style="margin-right:10px;"></i></a>
               <a href="{{ url('admin/chague_activation_sub/'.$sub->gdsub_id) }}" title="activar/inactivar" onclick="return confirm('¿Desea cambiar el estado de la subcategoria?')"><i class="fa fa-exchange pull-right" aria-hidden="true" style="margin-right:10px;"></i></a>
            
            </li>
            @endif
         @endforeach
         </ul>
      </div>
   </div>
   @endforeach
</div>
</div>

</di>


</section>
@stop



@section('script')
<script type="text/javascript">

</script>
@stop