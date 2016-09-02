@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-pencil-square-o"></i> Editar SubCategoria</h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Editar SubCategoria</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">
	<div class="col-lg-8 col-lg-offset-1">
		<div class="panel panel-primary">
		  	<div class="panel-heading">
		    	<h3 class="panel-title"><i class="fa fa-pencil-square-o"></i> Edición de Subcategoría</h3>
		  	</div>
		  	<div class="panel-body">
		  	<form action="../update_subcat" method="post" name="form1" id="form1" onsubmit="return validar()">

		    	<div class="well">
		    	<div class="row">
		    		<div class="col-lg-9">
		    			<input type="text" name="gdsub_nombre" id="gdsub_nombre" class="form-control" placeholder="Categoría" value="{{$subcategoria->gdsub_nombre}}">
		    			<input type="hidden" name="gdsub_id" id="gdsub_id" value="{{$subcategoria->gdsub_id}}">
		    		</div>
					<div class="col-lg-3">
						<button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Guardar</button>
					</div>
				</div>
		    	</div>

		   </form>
		  	</div>
		  	<div class="panel-footer">
		  		<div class="row">
		  			<div class="col-lg-12">
		  				<a href="{{ url('admin/ord_edit_cat_and_sub') }}" class="btn btn-warning pull-right"><i class="fa fa-reply"></i> Volver</a>
		  			</div>
		  		</div>
		  	</div>
		</div>
	</div>
</div>



</section>
@stop



@section('script')
<script type="text/javascript">


function validar(){
	if(!confirm("Está seguro de editar el nombre de la Subcateogoría?")){
		return false;
	}

	return true;
}

</script>
@stop
