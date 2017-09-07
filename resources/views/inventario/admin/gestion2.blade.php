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
  a.disabled {
   pointer-events: none;
   cursor: default;
}
}
</style>
	<h1><i class="fa fa-plus-circle"></i> Gesion de Consumibles  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Consumibles</a></li>
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
         <h3 class="panel-title"><i class="fa fa-list"></i> Gestion de Consumibles</h3>
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
                  <th><strong>serial general</strong></th> 
                  <th><strong>Unidad</strong></th>                 
                  <th><strong>Opciones</strong></th>
               </tr>
            </thead>
            <tbody>
              @foreach($consumibles as $consumible)
                <tr>  
                  <td> {{$consumible->id}} </td>
                  <td style="width:110px;"> {{$consumible->codigo}} </td>
                  <td> {{$consumible->descripcion}}</td>             
                  <td style="text-align: center;"> {{$consumible->cantidad}}</td>                  
                  <td> {{$consumible->serial_general}}</td>                  
                  <td> @if($consumible->id_inventario_unidades == null) {{"BODEGA SIG"}} @else {{$unidades[$consumible->id_inventario_unidades]}} @endif </td> 
                  <td><a href="#" data-toggle="modal" onclick="edit_element({{$consumible->id}})" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i> <a href="consumibledelete/{{$consumible->id}}" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  <a href="#"  @if($consumible->id_inventario_unidades == null) onclick="modal_unidades('{{$consumible->id}}','{{$consumible->cantidad}}')" @endif><i class="fa fa-car" aria-hidden="true" title="Distribuir Unidades"></i></a></td>  
                </tr>  
              @endforeach
            </tbody>
         </table>
      </div>      
   </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar</h4>
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

<!-- Modal -->
<div id="modalUnidades" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Distribuir unidades</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="myForm" action="distribuir_unidades">
            <input name="id" type="hidden">
          @foreach($unidades as $key => $temp)            
            <label class="form-control">Unidad placa  {{$temp}} </label>
            <input type="number" min="0" max="1000" class="form-control" name='{{$temp}}'/>            
          @endforeach
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="distribuir_unidades()">Distribuir</button>      
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
  function confirm_action(){
   return confirm('¿Esta seguro?');
 }

 
  function edit_element(id)
  {
    $.get("consumible/edit_element/"+id, function(res, sta){
         $("#ajax-content").empty();
         $("#ajax-content").append(res);
      });
  }

  var unidad_id;
  var cantidad;

  function modal_unidades(id,cant)
  {
    unidad_id = id;
    cantidad = cant;
    $("#modalUnidades").modal('show');
  }

  function distribuir_unidades()
  {
    $("input[name='id']").val(unidad_id);
    var total = 0;
    @foreach($unidades as $key => $temp)
      total += parseInt($("input[name='{{$temp}}']").val());
      if(parseInt($("input[name='{{$temp}}']").val())<1 )
      {
        alert("cada unidad debe tener al menos una cantidad de 1");
        return false;
      }         
    @endforeach
    if(total > cantidad)
    {
      alert("Los valores no pueden superar combinados el total de "+cantidad);
      return false;
    }
    else{
      document.getElementById("myForm").submit();
    }
    
  }
 
</script>

@stop
