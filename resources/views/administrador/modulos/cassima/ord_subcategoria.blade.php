@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-sort-amount-desc"></i> Ordenar SubCategorías</h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Ordenar SubCategorías</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="row">
   <div class="col-lg-6">
      <div class="panel panel-default">
         <div class="panel-heading"><strong><i class="fa fa-list"></i> Lista de Categorías</strong></div>
         <div class="panel-body">
            <p>Organice las categorías pulsando sobre las flechas arriba abajo de cada una de estas </p>
         </div>
 
         <ul class="list-group">
         <?php $i=1; ?>
         @foreach($categorias as $cat)
            <li class="list-group-item">
               <strong>{{$i.". ".ucwords ($cat->gdcat_nombre)}}</strong>
               <a href="{{ url('admin/ordcatup/'.$cat->gdcat_id) }}"><i class="fa fa-arrow-up pull-right" style="margin-left:15px;"></i></a>
               <a href="{{ url('admin/ordcatdown/'.$cat->gdcat_id) }}"><i class="fa fa-arrow-down pull-right"></i></a>
            </li>
         <?php $i++; ?>
         @endforeach
         </ul>
      </div>
   </div>
</div>


</section>
@stop



@section('script')
<script type="text/javascript">



</script>
@stop
