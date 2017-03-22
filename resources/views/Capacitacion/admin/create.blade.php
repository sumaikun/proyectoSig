@extends('administrador.layouts.layout')
@section('menu')
    @include('administrador.layouts.menu', array('op'=>'actividades'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
   {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css') }}

   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')

<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Documento<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/facturacion') }}"><i class="fa fa-child"></i> Capacitaciones</a></li>
      <li class="active">Nuevo documento</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="max-width: 800px;" >

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><strong>Registro de nuevo Documento</strong></h3>
       </div>
       <div class="panel-body">
        <div class="ocultar" style="max-height: 420px !important">
     

        <div class="col-lg-9">
          <form action="addDocumento" onsubmit="return validar()" method="post" enctype="multipart/form-data">    
              
              <div class="form-group">
                <label>*Titulo</label>
                <input type="text" name="titulo" class="form-control" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>*Documento</label>
                <input type="file" name="archivo" class="form-control" required>
              </div>
              <div class="col-lg-6 col-lg-offset-6 col-xs-12">
                <button type="submit" onclick="clicked();" class="btn btn-success">
                      <i class="fa fa-floppy-o"></i> <b>Insertar</b>
                </button>
                <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>      
              </div>

          </form>
        </div>

        
        <div class="divider"></div>

          
       
        </div>
       </div>
       
       <div class="panel-footer">
        <strong>Nota:</strong> Todos los campos marcados con asteriscos (*) son obligatorios
       </div>
                
    </div>
</section>




 



@stop
