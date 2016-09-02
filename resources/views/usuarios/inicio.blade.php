@extends('usuarios.layouts.layout')


@section('barra_usuario')
	@include('usuarios.layouts.barra_usuario', array('op'=>'inicio'))
@stop


@section('menu_lateral')
	@include('usuarios.layouts.menu_lateral', array('op'=>'inicio'))
@stop


@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop




@section('contenido')

<h3 class="page-header">Bienvenid@</h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>


<div class="row">
	<div class="col-lg-12">
<div class="jumbotron">
   <div class="container">
  	   <div class="row">
         <div class="col-lg-2">
            {{ HTML::image('usuarios/images/gdocumentos/usuario.png', 'upload', array('class' => 'img-responsive')) }}
  			</div>
  			<div class="col-lg-10">
            <div class="col-lg-12"><h1>Bienvenid@</h1></div>
  				<div class="col-lg-12"><p>Bienvenido al portal virtual de System Integral Group SAS.</p></div>
  			</div>
  		</div>    		
  	</div>
</div>
   </div>
</div>



<div id="inbox">
   <div class="fab btn-group show-on-hover dropup">
      <div data-toggle="tooltip" data-placement="left" title="Información" style="margin-left: 42px;">
         <button type="button" class="btn btn-danger btn-io dropdown-toggle" data-toggle="modal" data-target="#myModal">
            <span class="fa-stack fa-2x">
               <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
               <i class="fa fa-question fa-stack-1x fa-inverse fab-primary"></i>
               <i class="fa fa-info-circle fa-stack-1x fa-inverse fab-secondary"></i>
            </span>
         </button>
      </div>
      <ul class="dropdown-menu dropdown-menu-right" role="menu">
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="Manual"><i class="fa fa-book"></i></a></li> -->
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="LiveChat"><i class="fa fa-comments-o"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Reminders"><i class="fa fa-hand-o-up"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Invites"><i class="fa fa-ticket"></i></a></li> -->
      </ul>
   </div>
</div>      


@include('cosas_generales.boton_info', array('imagen'=>'inicio_usuario'))
@stop