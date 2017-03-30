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
                  <td> <a href="#" data-toggle="modal" onclick="edit_element({{$elemento->id}})" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i> <a href="elementdelete/{{$elemento->id}}" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a><a href="#" data-toggle="modal" title="Gestión" onclick="get_serials({{$elemento->id}})" data-target="#myModal4" style="margin-left: 5px;"><i class="fa fa-binoculars" aria-hidden="true"></i></a>
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

<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Nuevo Serial
            </h4>
         </div>
         <div class="modal-body">              
             <form action="addSerial" onsubmit="return validar()" method="post" enctype="multipart/form-data">   

                <input type="hidden" value="" id="newsid" name="newsid">

                 <div class="form-group">      
                    <label>Serial</label>
                    <input  class="form-control" name="serial"  id="codigo" type="text"  required/>            
                </div>
                

                 <div class="form-group">      
                    <label>Status</label>
                    <select class="form-control" name="status" id="status"  required>
                      <option value=''>Selecciona</button></option>
                      @foreach($estados as  $key=>$value)
                          <option value={{$key}}>{{$value}}</option>            
                      @endforeach          
                    </select>    
                </div>          

              
                  <button type="submit" onclick="clicked();" class="btn btn-success">
                        <i class="fa fa-floppy-o"></i> <b>Guardar</b>
                  </button>
                  <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
            </form>

         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Cambiar valor del Serial
            </h4>
         </div>
         <div class="modal-body">              
             <form action="editSerialname" onsubmit="return validar()" method="post" enctype="multipart/form-data">   

                <input type="hidden" value="" id="namesid" name="namesid">

                 <div class="form-group">      
                    <label>Serial</label>
                    <input  class="form-control" name="serial"  id="namese" type="text"  required/>            
                </div>
                
                  <button type="submit" onclick="clicked();" class="btn btn-success">
                        <i class="fa fa-floppy-o"></i> <b>Guardar</b>
                  </button>
                  <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
            </form>

         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alquilar</h4>
      </div>
      <div class="modal-body">
       <form action="alquilar" onsubmit="return validar()" method="post" id="rent_form" enctype="multipart/form-data">
        <input type="hidden" value="" id="objectid" name="objectid">
         <div class="form-group">      
            <label class="form-control">Selecciona el cliente</label>
            <select name="empresa" class="form-control">
              <option>Selecciona</option>
              @foreach($empresas as $key=>$value)
                <option value={{$key}}>{{$value}}</option>
              @endforeach 
            </select>            
        </div>

        <div class="form-group">      
            <label class="form-control">Fecha de alquiler</label>
            <input type="date" id="fecha1" name="fecha1" class="form-control">            
        </div>

        <div class="form-group">      
            <label class="form-control">Fecha estimada de regreso</label>
            <input type="date" id="fecha2" name="fecha2" class="form-control">            
        </div>

        <div class="form-group">      
            <label class="form-control">Valor diario</label>
            <input type="number" min="10000" name="valor" class="form-control">            
        </div>
        
        <button type="submit" onclick="clicked();" class="btn btn-success">
              <i class="fa fa-floppy-o"></i> <b>Guardar</b>
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

  function confirm_action(){
   return confirm('¿Esta seguro?');
 }

$(document).ready(function() {
$("#fecha1").change(event => {
    var min = `${event.target.value}`;
    var input = document.getElementById("fecha2");
    input.setAttribute("min", min);
  });

});
</script>

@stop
