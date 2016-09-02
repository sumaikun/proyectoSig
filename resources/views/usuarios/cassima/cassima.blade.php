@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>''))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'cassima'))
@stop



@section('contenido')
<h1 class="page-header"> <strong>CASSIMA</strong><!-- <small>Bienvenid@</small> --></h1>

<div class="row">

 

<!-- <div class="col-lg-2">
	<div class="thumbnail">
   	<a href="{{ url('usuario/hvdocumento') }}">
   		{{ HTML::image('usuarios/images/cassima/hvdocumento.png', 'upload', array('class' => 'img-responsive')) }}
   		<button type="button" class="btn btn-block btn-link btn-xs">
      		<span class="text-muted"><strong>HV Documentos</strong></span>
   		</button>
   	</a>
	</div>
</div> -->


<div class="col-lg-2">
   <div class="thumbnail">
   {{ HTML::image('usuarios/images/cassima/hvdocumento.png', 'upload', array('class' => 'img-responsive')) }}
      <div class="btn-group btn-block">
         <button type="button" class="btn btn-block btn-link btn-xs" data-toggle="dropdown" aria-expanded="true">
            <span class="text-muted">
               <strong>Documentos <span class="caret"></span></strong>
            </span>
         </button>
         <ul class="dropdown-menu" role="menu">
            <!-- <li><a href="{{ url('admin/subir_doc') }}"><i class="fa fa-cloud-upload"></i> Nuevo Documento</a></li> -->
            <!-- <li class="divider"></li> -->
            <!-- <li><a href="{{ url('admin/new_version') }}"><i class="fa fa-plus-square"></i> Nueva versión</a></li> -->
            <!-- <li><a href="{{ url('admin/update_ver') }}"><i class="fa fa-pencil-square-o"></i> Editar versión actual</a></li> -->
            <li><a href="{{ url('usuario/hvdocumento') }}"><i class="fa fa-exclamation-circle"></i> HV documento</a></li>
            <!-- <li class="divider"></li> -->
            <!-- <li><a href="{{ url('admin/disable_doc') }}"><span class="text-danger"><i class="fa fa-eye-slash"></i> Inactivar Documento</span></a></li> -->
         </ul>
      </div>
   </div>
</div>





</div>       
      
@stop



@section('script')
<script type="text/javascript">

// $(function() {
//    $('#noconse').hide();
//    $('#siconse').hide();
// });


</script>
@stop
