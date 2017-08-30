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

<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Consumible<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/facturacion') }}"><i class="fa fa-child"></i> Inventario</a></li>
      <li class="active">Consumible</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="max-width: 800px;" >

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><strong>Registro de nuevo Consumible</strong></h3>
       </div>
       <div class="panel-body">
        <div class="ocultar" style="max-height: 420px !important">
     

        <div class="col-lg-9">
          <form action="addConsumible" onsubmit="return validar()" method="post" enctype="multipart/form-data">    

              
               <div class="form-group">      
                  <label>*CODIGO</label>
                  <input  class="form-control" name="codigo" id="codigo" type="text"  required/>            
              </div>

              <div class="form-group">      
                  <label>*Descripción</label>
                  <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>  
              </div>

              <div class="form-group">      
                  <label>*Cantidad</label>
                  <input  class="form-control" max="10000" min="1" name="cantidad" id="cantidad"  type="number"  required/>
                  <div id="container">
                  </div>  
              </div>

              <div class="form-group">      
                  <label>*SERIAL GENERAL</label>
                  <input  class="form-control" name="serial" id="serial" type="text"  required/>            
              </div>      


              <div class="col-lg-6 col-lg-offset-6 col-xs-12">
                <button type="submit" onclick="clicked();" class="btn btn-success">
                      <i class="fa fa-floppy-o"></i> <b>Crear &nbsp&nbsp</b>
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




@section('script')

@stop

@stop
