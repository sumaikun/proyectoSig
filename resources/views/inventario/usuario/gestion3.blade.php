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
<style type="text/css">
 .ui-datepicker-calendar {
    display: none;
    }​
}
</style>
	<h1><i class="fa fa-plus-circle"></i> Gesion de unidades  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Inventario</a></li>
      <li class="active">Gestion de unidades</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

  <div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Gestion de unidades</h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive ocultar_400px">
         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Placa</strong></th>
                  <th><strong>Descripción</strong></th>
                  <th><strong>Opciones</strong></th>           
               </tr>
            </thead>
            <tbody>
              @foreach($unidades as $unidad)
              <tr>
                <td>{{$unidad->id}}</td>
                <td>{{$unidad->placa}}</td>
                <td>{{$unidad->descripcion}}</td>
                <td>

                <?php if(Session::get('man_unidades')!=null){ ?>
                <a href="#" onclick="edit_unidad({{$unidad->id}})" title="editar"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                <a href="delete_unidad/{{$unidad->id}}" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                <a href="#"><i onclick="datos_unidad({{$unidad->id}})"  title="herramientas y consumibles asociados" class="fa fa-arrow-down" aria-hidden="true"></i></a>
                <?php } ?>
                
                <?php if(Session::get('alq_unidades')!=null){ ?>
                @if($unidad->status == 0)
                <a href="#"  onclick="rentthis({{$unidad->id}})"  title="Alquilar" style="margin-left: 5px;"  ><i class="fa fa-briefcase" aria-hidden="true"></i></a>
                @else
                <a href="DetallesUnidad/{{$unidad->id}}" title="Detalles" style="margin-left: 5px;"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                @endif
                @if($unidad->status == 1)
                <a href="unidadback/{{$unidad->id}}" onclick="return confirm_action()"><i title="Regresar a bodega" class="fa fa-backward" aria-hidden="true"></i></a>
                @endif
                <?php } ?>
                </td>
              </tr>
              @endforeach
            </tbody>
         </table>
         </div>
          <?php if(Session::get('crear_unidades')!=null){ ?>
         <button onclick="nueva_unidad()">Crear nueva unidad</button>
         <?php } ?>
      </div>      
   </div>
</div>

  <div class="col-lg-6">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Herramientas de la unidad</h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
        <div id="ajax-content"></div>        
      </div>      
   </div>
</div>

  <div class="col-lg-6">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Consumibles de la unidad</h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
        <div id="ajax-content2"></div>        
      </div>      
   </div>
</div>

</section>


<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="crear_unidad" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de la unidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label class="form-control">Placa</label>
        <input type="text" maxlength="6" class="form-control" name="placa" required> 
        <label class="form-control">Descripcion</label>
        <textarea  class="form-control" name="descripcion"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="input" class="btn btn-primary">Crear</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="update_unidad" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de la unidad a editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id">
        <label class="form-control">Placa</label>
        <input type="text" maxlength="6" class="form-control" name="placa_edit" required> 
        <label class="form-control">Descripcion</label>
        <textarea  class="form-control" name="descripcion_edit">
        </textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="input" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="Modalrent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos para el alquiler</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <input type='hidden' id='id'>
         <div class="form-group">      
            <label class="form-control">Selecciona el cliente</label>
            <select id="empresa" name="empresa" class="form-control">
              <option value=''>Selecciona</option>
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
        <button class='btn btn-warning form-control' onclick='search_all_data()'>Siguiente</button>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>      
    </div>
  </div>
</div>


<div class="modal fade" id="Modalrent2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos para el alquiler</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive" style='max-height: 500px !important;'>
        <div id='ajax-rent'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>      
    </div>
  </div>
</div>

<script type="text/javascript">



  $(document).ready(function() {
    

    $('#example').DataTable({
       "bSort": false,
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            }
    });
    
  });

  function nueva_unidad()
  {    
    $("#myModal").modal("show");
  }

  function confirm_action(){
   return confirm('¿Esta seguro?');
 }

  function edit_unidad(id)
  {
    $("textarea[name='descripcion_edit']").empty();
    $.get("editar_unidad/"+id,function(res,sta){
      $("input[name='id']").val(res.id);
      $("input[name='placa_edit']").val(res.placa);
      $("textarea[name='descripcion_edit']").append(res.descripcion);
      $("#myModal2").modal("show");

    })
  }

  function datos_unidad(id)
  {
     $.get("datos_unidad_seriales/"+id,function(res,sta){      
        $("#ajax-content").empty();
        $("#ajax-content").append(res);
        $('#example2').DataTable({
          "bSort": false,
          "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            }
        });
      });

     $.get("datos_unidad_consumibles/"+id,function(res,sta){      
        $("#ajax-content2").empty();
        $("#ajax-content2").append(res);
        $('#example3').DataTable({
          "bSort": false,
          "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            }
        });
      });
  }

  var unidadid;

  function rentthis(id)
  {
    unidadid = id;    
    $(".form-control").val('');
    $('#Modalrent').modal('show');
  }

  function search_all_data()
  {
    $('#id').val(unidadid);

    if($("#empresa").val()==''){
      return  alert('Seleccione una empresa');
    }
    if($("#fecha1").val()==''){
      return alert('Seleccione la fecha de alquiler');
    }
    if($("#fecha2").val()==''){
      return alert('Seleccione la fecha estimada de regreso');
    }
    var d2 = new Date($("#fecha2").val());
    var d1 = new Date($("#fecha1").val());
    

    if(d2.getTime() < d1.getTime()){
      return alert('La fecha estimada de retorno no debe ser menor');
    }

    if(d2.getTime() == d1.getTime()){
      return alert('Las fechas no pueden ser iguales');
    }

    $.get("unidad_all_data/"+unidadid,function(res,sta){
        $("#Modalrent").modal('hide');
        $("#ajax-rent").empty();
        $("#ajax-rent").append(res);
        $("#Modalrent2").modal('show');
    })
  }

</script>

@stop
