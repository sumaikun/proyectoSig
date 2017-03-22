@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'usuarios'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')

<!-- header de la pagina -->
<section class="content-header">
<style type="text/css">
 .ui-datepicker-calendar {
    display: none;
    }​
}
</style>
	<h1><i class="fa fa-plus-circle"></i> Gesion de Inventario  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Inventario</a></li>
      <li class="active">registros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

  <div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Gestion Inventario</h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
          
         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Codigo</strong></th>
                  <th><strong>Descripción</strong></th>                                 
                  <th><strong>Cantidad</strong></th>
                  <th><strong>Categoria</strong></th>                  
                  <th><strong>Opciones</strong></th>
               </tr>
            </thead>
            <tbody>
              @foreach($elementos as $elemento)
                <tr>  
                  <td> {{$elemento->id}} </td>
                  <td style="width:110px;"> {{$elemento->codigo}} </td>
                  <td> {{$elemento->descripcion}}</td>             
                  <td style="text-align: center;"> {{$elemento->cantidad}}</td>                  
                  <td> {{$elemento->categoria}}</td>                  
                  <td> <abbr title="Editar"><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i></abbr> <abbr title="Borrar"><a href="#" data-toggle="modal" data-target="#myModal2" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></abbr><abbr title="Gestión"><a href="#" data-toggle="modal" data-target="#myModal4" style="margin-left: 5px;"><i class="fa fa-binoculars" aria-hidden="true"></i></a></abbr>
                  </td>  
                </tr>  
              @endforeach
            </tbody>
         </table>
      </div>      
   </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-warning">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar</h4>
      </div>
      <div class="modal-body">
         <form action="addElemento" onsubmit="return validar()" method="post" enctype="multipart/form-data">    

              <input type="hidden" value="0" id="cont_items" name="cont">

               <div class="form-group">      
                  <label>CODIGO</label>
                  <input  class="form-control" name="codigo" id="codigo" type="text"  required/>            
              </div>

              <div class="form-group">      
                  <label>Descripción</label>
                  <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>  
              </div>

              <div class="form-group">      
                  <label>Cantidad</label>
                  <input  class="form-control" name="cantidad" id="cantidad" onblur="generate_serials()" type="number"  required/>
                  <div id="container">
                  </div>  
              </div>

              <div class="form-group">      
                  <label>Status</label>
                  <select class="form-control" name="status" id="status"  required>
                    <option value=''>Selecciona</button></option>
                    @foreach($estados as  $key=>$value)
                      <option value={{$key}}>{{$value}}</option>
                    @endforeach
                    <option value='new'>+ NUEVO STATUS</button></option>
                  </select> 
              </div>

               <div class="form-group">      
                  <label>Categoria</label>
                  <select class="form-control" name="categoria" id="categoria"  required>
                    <option value=''>Selecciona</button></option>
                    @foreach($categorias as  $key=>$value)
                      <option value={{$key}}>{{$value}}</option>
                    @endforeach
                    <option value='new'>+ NUEVA CATEGORIA</button></option>
                  </select>    
              </div>          

            
                <button type="submit" onclick="clicked();" class="btn btn-success">
                      <i class="fa fa-floppy-o"></i> <b>Insertar</b>
                </button>
                <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
          

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-danger">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Eliminar</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alquilar</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gestión</h4>
      </div>
      <div class="modal-body">
        <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Serial</strong></th>
                  <th><strong>Status</strong></th>                                 
                  <th><strong>Opciones</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                   <td><abbr title="alquilar"><a href="#" data-toggle="modal" data-target="#myModal3" style="margin-left: 5px;"><i class="fa fa-briefcase" aria-hidden="true"></i></a></abbr><abbr title="detalles"><a href="#" style="margin-left: 5px;"><i class="fa fa-calendar" aria-hidden="true"></i></a></abbr>
                   </td> 
                </tr>
            </tbody>
         </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
       "bSort": false
      });
  });

</script>

@stop
