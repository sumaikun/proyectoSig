@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-pencil-square-o"></i> Editar Categoría</h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Editar Categoría</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="row">
   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet aperiam aliquid modi culpa molestias, ullam deleniti fugit ducimus. Voluptas repellat fugit nam magnam nesciunt veritatis molestias repudiandae necessitatibus distinctio, ad!
</div>


</section>
@stop



@section('script')
<script type="text/javascript">



</script>
@stop
