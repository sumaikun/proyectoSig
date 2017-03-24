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
                  <td> <abbr title="Editar"><a href="#" data-toggle="modal" onclick="edit_element({{$elemento->id}})" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i></abbr> <abbr title="Borrar"><a href="#" data-toggle="modal" data-target="#myModal2" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></abbr><abbr title="Gestión"><a href="#" data-toggle="modal" onclick="get_serials({{$elemento->id}})" data-target="#myModal4" style="margin-left: 5px;"><i class="fa fa-binoculars" aria-hidden="true"></i></a></abbr>
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
        <div id="ajax-content2"></div>
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
        <div id="ajax-content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Categorias
            </h4>
         </div>
         <div class="modal-body">              
            <div class="row">  
              <div class="col-lg-12">
                <div class="form-group">      
                  <label>INGRESE EL NOMBRE DE LA NUEVA CATEGORIA</label>
                  <input  class="form-control" name="new_category" id="new_category" type="text"  required/>            
                </div>
              </div>
            </div>      
         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="save_category"   class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
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

  function get_serials(id)
  {
   $.get("get_seriales/"+id, function(res, sta){
         $("#ajax-content").empty();
         $("#ajax-content").append(res);
      });
  }
  function edit_element(id)
  {
    $.get("edit_element/"+id, function(res, sta){
         $("#ajax-content2").empty();
         $("#ajax-content2").append(res);
      });
  }



</script>

@stop
