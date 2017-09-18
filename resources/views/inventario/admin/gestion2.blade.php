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
                  <th width='10px;'><strong>Cantidad disponible</strong></th>
                  <th><strong>serial general</strong></th> 
                  <th><strong>Unidad</strong></th>
                  <th><strong>Precio</strong></th>                  
                  <th><strong>Opciones</strong></th>
               </tr>
            </thead>
            <tbody>
              @foreach($consumibles as $consumible)
                <tr>  
                  <td> {{$consumible->id}} </td>
                  <td style="width:110px;"> {{$consumible->codigo}} </td>
                  <td> {{$consumible->descripcion}}</td>             
                  <td width='10px;' style="text-align: center;"> {{$consumible->cantidad}}</td>                  
                  <td> {{$consumible->serial_general}}</td>                                    
                  <td> @if($consumible->id_inventario_unidades == null) {{"BODEGA SIG"}} @else {{$unidades[$consumible->id_inventario_unidades]}} @endif </td>
                  <td> {{$consumible->precio}}</td> 
                  <td>@if($consumible->id_inventario_unidades == null) <a href="#" data-toggle="modal" onclick="edit_element({{$consumible->id}})" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a> @endif <a href="consumibledelete/{{$consumible->id}}" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  <a href="#"  @if($consumible->id_inventario_unidades == null) onclick="modal_unidades('{{$consumible->id}}','{{$consumible->cantidad}}')" > <i class="fa fa-car" aria-hidden="true" title="Distribuir Unidades"></i> @else  onclick="modal_regresar('{{$consumible->id}}','{{$consumible->cantidad}}')"> <i class="fa fa-sort-desc" title="regresar consumibles a bodega" aria-hidden="true"></i> @endif</a>
                  @if($consumible->id_inventario_unidades == null) <a href="#" onclick="entregar_consumible('{{$consumible->id}}','{{$consumible->precio}}','{{$consumible->cantidad}}')" title="entregar consumibles"><i class="fa fa-users" aria-hidden="true"></i></a>  @endif
                  <a href="#" onclick="informacion_tickets({{$consumible->id}})" title="informacion de tickets"><i class="fa fa-ticket" aria-hidden="true"></i></a>
                  </td>  
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

<!-- Modal -->
<div id="modalRegresar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Regresar unidades a bodega</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="myForm2" action="regresar_unidades">
            <input id="idregresar" name="id" type="hidden">
            <input type="number" name="total" id="regresar_total" class="form-control"/>  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="regresar_unidades()">Regresar</button>      
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="modalEntregar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Entregar consumible</h4>
      </div>
      <div class="modal-body">        
        <form method="post" id="myForm3" action="entregar_consumible">
            <input id="entregarid" name="id" type="hidden">
            <label class="form-control">Cliente</label>
            <div class="form-group">
              <select name="cliente" id="entregar_cliente" class="form-control" required>
                <option value="">Selecciona</option>
                @foreach($empresas as $key=>$temp)
                  <option value="{{$key}}"> {{$temp}} </option>
                @endforeach
                <option value=0>Otro</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-control">fecha</label>
              <input type='date' name='date' id='entregar_fecha' class='form-control' max=<?php echo date('Y-m-d'); ?>>
            </div> 
            <div class="form-group">
              <label class="form-control">Cantidad</label>
              <input name="cantidad" min='1' id="entregar_cantidad" onblur="generate_entregar_precio()" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-control">Precio</label>
              <input name="precio" min='0' id="entregar_precio" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-control">Comentario</label>
              <textarea name="comentario" class="form-control"></textarea>
            </div>  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="entregar_consumible_ok()">Entregar</button>      
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="Ajaxmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span id="ajax-title"></span></h4>
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

<div id="Ajaxmodal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span id="ajax-title2"></span></h4>
      </div>
      <div class="modal-body">        
        <div id="ajax-content3"></div>
      </div>
      <div class="modal-footer">              
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    
    /*var spanish = $.getJSON("//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json", function(data) {
      return data;  
    });    
    
    console.log(spanish);*/
    $('#example').DataTable({
       "bSort": false,
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            }
    });
  });



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

  var regresar_id;
  var cantidadr;

  function modal_regresar(id,cant)
  {
    regresar_id = id;
    cantidadr = cant;
    $("#idregresar").val(regresar_id);
    $("#regresar_total").val(cant);
    $("#regresar_total").attr({"max" : cant});       
    $("#modalRegresar").modal('show');
  }  

  function distribuir_unidades()
  {
    $("input[name='id']").val(unidad_id);
    var total = 0;
    @foreach($unidades as $key => $temp)      
      if(parseInt($("input[name='{{$temp}}']").val())<1 )
      {
        alert("cada unidad debe tener al menos una cantidad de 1");
        return false;
      }
      if($("input[name='{{$temp}}']").val()=="")
        {total += parseInt(0);}
      else{total += parseInt($("input[name='{{$temp}}']").val());}         
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

  function regresar_unidades()
  {
    if($("#regresar_total").val()>0 && $("#regresar_total").val()<=cantidadr)
    {document.getElementById("myForm2").submit();}
    else{
      alert("la cantidad debe ser mayor a 0 y menor o igual a "+cantidadr);
    }
  }

  var entregarcantidad;

  var entregarprecio;

  function entregar_consumible(id,precio,cantidad)
  {
    $("#entregarid").val(id);
    $("#modalEntregar").modal('show');
    entregarcantidad = cantidad;
    entregarprecio = precio;
  }

  function generate_entregar_precio()
  {
       console.log($("#entregar_cantidad").val()+" "+entregarcantidad);

      if(parseInt($("#entregar_cantidad").val())>entregarcantidad)
      {
        alert('la cantidad definida debe ser mayor a 0 y menor a la cantidad de consumibles disponibles');
        $("#entregar_cantidad").val(1);
        $("#entregar_cantidad").focus();
        return '';
      }
      if(parseInt($("#entregar_cantidad").val())<1)
      {
        alert('la cantidad definida debe ser mayor a 0 y menor a la cantidad de consumibles disponibles');
        $("#entregar_cantidad").val(1);
        $("#entregar_cantidad").focus();
        return '';
      }
      var generateprecio = entregarcantidad*entregarprecio;
      $("#entregar_precio").val(generateprecio);
  }

  function entregar_consumible_ok()
  {

    if(parseInt($("#entregar_cantidad").val())>entregarcantidad || parseInt($("#entregar_cantidad").val())<1)
    {
        alert('la cantidad definida debe ser mayor a 0 y menor a la cantidad de consumibles disponibles');
        $("#entregar_cantidad").val(1);
        $("#entregar_cantidad").focus();
        return '';
    }

    if($("#entregar_precio").val()<0)
    {
      alert('el valor minimo para entregar consumible es de $0 pesos');
      return '';
    }

    if($("#entregar_cliente").val()=="")
    {
      alert('Seleccione un cliente valido');
      return '';
    }

    if($("#entregar_fecha").val()=="")
    {
      alert('Seleccione una fecha');
      return '';
    }

      document.getElementById("myForm3").submit();

  }

  function informacion_tickets(id)
  {
    $.get("consumible/tickets_table/"+id, function(res, sta){
         $('#ajax-title').empty();
         $('#ajax-title').append('Lista de tickets');
         $('#ajax-content2').empty();
         $('#ajax-content2').append(res);
         $("#Ajaxmodal").modal('show');
      }); 
  }

  function edit_ticket(id)
  {
    $.get("consumible/edit_ticket/"+id, function(res, sta){
         $("#Ajaxmodal").modal('hide');
         $('#ajax-title2').empty();
         $('#ajax-title2').append('Editar tickets');
         $('#ajax-content3').empty();
         $('#ajax-content3').append(res);
         $("#Ajaxmodal2").modal('show');
      }); 
  }
 
</script>

@stop
