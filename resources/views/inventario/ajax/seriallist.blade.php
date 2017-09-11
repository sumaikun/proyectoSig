<style>
  .inactive {
     pointer-events: none;
     cursor: default;
  } 
</style>

<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
       <tr class="active">
          <th>#</th>
          <th><strong>Serial</strong></th>
          <th><strong>Unidades</strong></th>
          <th><strong>Estatus</strong></th>                                 
          <th><strong>Opciones</strong></th>
        </tr>
    </thead>
    <tbody>
      @foreach($seriales as $serial)
        <tr>
          <td> {{$serial->id}} </td>
          <td> {{$serial->valor}} @if(Session::get('rol_nombre')=='administrador' or Session::get('inventario_editar')!=null)<a href="#" data-toggle="modal" onclick="edit_name({{$serial->id}},'{{$serial->valor}}')" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a>@endif</td>
          <td> @if($serial->id_inventario_unidades!=null){{$unidades[$serial->id_inventario_unidades]}} @else  {{"BODEGA SIG"}} @endif</td>
          <td> {{$serial->nombre}} </td>
           <td>
           @if(Session::get('rol_nombre')=='administrador' or Session::get('inventario_crear')!=null)
           <a href="#" data-toggle="modal" onclick="rentthis({{$serial->id}})" data-target="#myModal3" title="Alquilar" style="margin-left: 5px;"  @if($serial->id_status != 1) class="inactive" @endif><i class="fa fa-briefcase" aria-hidden="true"></i></a>
           @endif
           <a href="Detalles/{{$serial->id}}" title="Detalles" style="margin-left: 5px;" @if($serial->id_status == 1) class="inactive" @endif><i class="fa fa-calendar" aria-hidden="true"></i></a>
           @if(Session::get('rol_nombre')=='administrador' or Session::get('inventario_crear')!=null)
           <a href="#" data-target="#myModalRep"   data-toggle="modal" onclick="fixthis({{$serial->id}})" title="Reparación" style="margin-left: 5px;" @if($serial->id_status != 1) class="inactive" @endif><i class="fa fa-life-ring" aria-hidden="true"></i></a>
           @endif
           @if(Session::get('rol_nombre')=='administrador' or Session::get('inventario_eliminar')!=null)
           <a href="serialdelete/{{$serial->id}}" onclick="return confirm_action()" title="Borrar" style="margin-left: 5px;"><i class="fa fa-times" aria-hidden="true"></i></a>
           @endif
           <a href="#" onclick="modal_unidades('{{$serial->id}}')"><i class="fa fa-car" aria-hidden="true" title="Unidades"></i></a>
           <a href="serialback/{{$serial->id}}" onclick="return confirm_action()"><i title="Regresar a bodega" class="fa fa-backward" aria-hidden="true"></i></a>
           </td>            
        </tr>
      @endforeach  
    </tbody>
 </table>
 <button class="btn btn-primary"  onclick="new_serial({{$id}})" title="crear nuevo"><span class="glyphicon glyphicon-plus"></span></button>


<!-- Modal -->
<div id="modalUnidades" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unidad perteneciente</h4>
      </div>
      <div class="modal-body">
        <label class="form-control">Unidad asignada</label>
        <select class="form-control" name='asignunidad'>
          <option value="0">Sin unidad</option>
          @foreach($unidades as $key => $temp)
            <option value=" {{$key}} ">{{$temp}}</option>
          @endforeach
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="asignar_unidad()">Asignar</button>      
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



 <script>

 function new_serial(id)
 { 
    $('#myModal6').modal('show');
    $('#newsid').val(id);

 }

 function edit_name(id,name)
 {
    $('#myModal7').modal('show');
    $('#namesid').val(id);
    $('#namese').val(name);  
 }

 function rentthis(id)
 {
   $("#rent_form").trigger("reset");
   $("#objectid").val(id);
 }

 function fixthis(id)
 {
    $("#fix_form").trigger("reset");
    $("#objectidr").val(id);
 }

 var id_unidad;

 function modal_unidades(id)
 {
    id_unidad = id;
    $("#modalUnidades").modal('show');
 }

 function asignar_unidad()
 {
    $.get('asignar_unidad/'+id_unidad+"/"+$("select[name='asignunidad']").val(),function(){
      $("#modalUnidades").modal('hide');
      $("#myModal4").modal('hide');    
    })
 }
 
 </script>