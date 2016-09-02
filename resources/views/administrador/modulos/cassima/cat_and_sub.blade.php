@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-align-left"></i> Categorias Y subcategorias</h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Categorias / subcategorias</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">







<di class="col-lg-6">

<div class="col-lg-12">
<form name="form_cat" id="form_cat" onsubmit="return validar_cat()" method="post">

<div class="panel panel-primary">
   <div class="panel-heading"><i class="fa fa-plus-circle"></i> <strong>Nueva Categoría</strong></div>
   <div class="panel-body">
      <div class="col-lg-12 col-xs-12">
         <input type="text" name="gdcat_nombre" id="gdcat_nombre" class="form-control" autocomplete="off" required>
      </div>
   </div>
   <div class="panel-footer">
      <div class="row">
         <div class="col-lg-12 col-xs-12">
            <button type="submit" class="btn btn-success pull-right" onclick="javascript: form.action='registrar_cat';"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>  

</form>
</div>

<div class="col-lg-12">
<form name="form_sub" id="form_sub" onsubmit="return validar_sub()" method="post">

<div class="panel panel-primary">
   <div class="panel-heading"><i class="fa fa-plus-circle"></i> <strong>Nueva Sub - Categoría</strong></div>
   <div class="panel-body">
   
      <div class="row">
         <div class="col-lg-12"><strong>Indique la Categoría </strong>
            <select name="gdcat_id" id="gdcat_id_sub" class="form-control" required="required">
               <option value="" selected="true" disabled="true">Seleccione</option>
               @foreach ($categorias as $cat)
                  <option value="{{$cat->gdcat_id}}">{{ $cat->gdcat_nombre }}</option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12"><strong>Sub - Categoría</strong>
           <input type="text" name="gdsub_nombre" id="gdsub_nombre" class="form-control" required>
         </div>
      </div>

   </div>
   <div class="panel-footer">
      <div class="row">
         <div class="col-lg-12">
            <button type="submit" class="btn btn-success pull-right" onclick="javascript: form.action='registrar_sub';"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>   

</form>
</div>


</di>








<di class="col-lg-6">

<div class="ocultar">
<div class="panel-group" id="accordion">
<h4>Estructura de documentos</h4>
   @foreach ($categorias as $cat)
   <div class="panel panel-default">
      <div class="panel-heading">
         <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}"><i class="fa fa-folder-open-o"></i>
            </span> {{ $cat->gdcat_nombre}}</a>
            <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
            <!-- <a href="{{ url('admin/show_cate/'.$cat->gdcat_id) }}">
               <i class="fa fa-pencil-square-o pull-right text-warning"></i>
            </a>
            <a href="{{ url('admin/ordcatdown/'.$cat->gdcat_id) }}"><i class="fa fa-arrow-down pull-right" style="margin-right:15px;"></i></a>
            <a href="{{ url('admin/ordcatup/'.$cat->gdcat_id) }}"><i class="fa fa-arrow-up pull-right" style="margin-right:15px;"></i></a> -->
            
         </h4>
      </div>
      <div id="{{ $cat->gdcat_id.'colla' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
         <ul class="list-group">
         @foreach ($subcategorias as $sub)
            @if($cat->gdcat_id == $sub->gdcat_id)
            <li class="list-group-item">
               <i class="fa fa-angle-double-right"></i>
               <a href="#"> {{ $sub->gdsub_nombre }}</a>
               <!-- <a href="{{ url('admin/show_subcate/'.$sub->gdsub_id) }}">
                  <i class="fa fa-pencil-square-o pull-right text-warning"></i>
               </a> -->
               <!-- <a href="{{ url('admin/ordsubcatdown/'.$cat->gdcat_id.'/'.$sub->gdsub_id) }}"><i class="fa fa-arrow-down pull-right" style="margin-right:15px;"></i></a> -->
            <!-- <a href="{{ url('admin/ordcatup/'.$cat->gdcat_id) }}"><i class="fa fa-arrow-up pull-right" style="margin-right:15px;"></i></a> -->
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
               <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
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

function validar_sub(){
   var subc = document.getElementById("gdsub_nombre").value;
   var cate = $("#gdcat_id_sub option:selected").text();

   if (confirm('Está seguro de registrar la Sub categoría '+subc+ ' a la categoría '+cate+ ' ?')==true) {
      return true;
   }else{
      return false;
   }
}

function validar_cat(){
   var cat = $("#gdcat_nombre").val();

   if (confirm('Está seguro de registrar la Categoría '+cat+' ?')) {
      return true;
   }else{
      return false;
   }
}

</script>
@stop