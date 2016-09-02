@extends('administrador.layouts.layout')


@section('menu')
    @include('administrador.layouts.menu', array('op'=>''))
@stop



@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
   <h1><i class="fa fa-flag-o"></i> Resultado <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cogs"></i> Operaciones</a></li>
      <li class="active">Resultado</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">
@if($funcion==true)
<div class="jumbotron">
  <div class="container text-center">
    <h1><span class="text-success">Operación exitosa! </span> <i class="fa fa-check-circle"></i></h1>
    <p><strong>  {{$mensaje}}  </strong></p>
    <p><a href="{{ URL::previous() }}" class="btn btn-primary btn-lg" role="button"> <i class="fa fa-reply-all"></i> <strong>Volver</strong></a></p>
  </div>
</div>
@elseif($funcion==false)
<div class="jumbotron">
  <div class="container text-center">
    <h1><span class="text-danger">hoo! Error </span> <i class="fa fa-times"></i></h1>
    <p><strong>  {{$mensaje}}  </strong></p>
    <p><a href="{{ URL::previous() }}" class="btn btn-primary btn-lg" role="button"> <i class="fa fa-reply-all"></i> <strong>Volver</strong></a></p>
  </div>
</div>
@endif

</section>
@stop

