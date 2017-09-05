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
                <td>{{$unidad->id}}</td>
                <td>{{$unidad->placa}}</td>
                <td>{{$unidad->descripcion}}</td>
                <td><a href="#" onclick="edit_unidad({{$unidad->id}})" title="editar"><i class="fa fa-pencil" aria-hidden="true"></a></i> <a href="delete_unidad/{{$unidad->id}}" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
              @endforeach
            </tbody>
         </table>
         <button onclick="nueva_unidad()">Crear nueva unidad</button>
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
        <textarea  class="form-control" name="descripcion">
        </textarea>
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
        <button type="input" class="btn btn-primary">Editar</button>
      </div>
      </form>
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
    $.get("editar_unidad/"+id,function(res,sta){
      $("input[name='id']").val(res.id);
      $("input[name='placa_edit']").val(res.placa);
      $("textarea[name='descripcion_edit']").append(res.descripcion);
      $("#myModal2").modal("show");

    })
  }

</script>

@stop
