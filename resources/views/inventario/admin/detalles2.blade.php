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

  <h1><i class="fa fa-plus-circle"></i> Detalles de Mantenimiento  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
    <li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Inventario</a></li>
      <li class="active">Mantenimiento</li>
    </ol>
    <!-- <hr> -->
</section>

<div class="container">
<br>
   <div class="col-lg-11">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Información del mantenimiento </h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
        <table class="table table-hover table-bordered" style="font-size: 12px;">
        <thead>
          <tr>
            <th>id</th>
            <th width="30%">Fecha estimada de devolución</th>
            <th>Comentario</th>
            <th>Quedan</th>
            <th>Cancelar</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> {{ $registro->id }} </td>
            <td>  <span class="date{{ $registro->id }}">{{ $registro->fecha }}</span> <a href="#" onclick="assign_id({{ $registro->id }})" data-toggle="modal"  title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i></td>
            <td> <span class="comment{{ $registro->id }}">{{ $registro->info_extra }}</span> <a href="#" onclick="assign_id({{ $registro->id }})" data-toggle="modal"  title="editar" data-target="#myModal2"><i class="fa fa-pencil" aria-hidden="true"></a></i></td>
            <td> <strong style="color:red;"><span class="days{{$registro->id}}">{{ psig\Helpers\horas_minutos::taking_away_days($registro->fecha,date("Ymd"))}}</span> días</strong> </td>
            <td><a href="#" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
          </tr>
        </tbody>
      </table>    
      </div>
   </div>
   </div>
   <div class="col-lg-11"> 
    <button class="btn btn-warning" data-toggle="modal"  data-target="#myModal3">Crear Seguimiento</button>
    <button class="btn btn-success" onclick="modal_seguimiento()">Ver Seguimiento</button>
   </div> 
 
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modificar fecha estimada de devolución</h4>
      </div>
      <div class="modal-body">        
          <label class="form-control">Fecha</label>
          <input type="date" min="<?php echo date('Y-m-d'); ?>" name="fecha" class="form-control">
      </div>
      <input type="hidden" name="data_changue" value="">
      <div class="modal-footer">
        <button type="button" onclick="changue_date()" class="btn btn-success" data-dismiss="modal">Cambiar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modificar comentario</h4>
      </div>
      <div class="modal-body">        
        <label class="form-control">Comentario</label>
        <textarea class="form-control" name="comentario"></textarea> 
      </div>
      <input type="hidden" id="tempdate" value="">
      <div class="modal-footer">
        <button type="button"  onclick="changue_comment()"  class="btn btn-success" data-dismiss="modal">Cambiar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
    <div class="modal-dialog">    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">  Nuevo Seguimiento   </h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id" value =" {{$registro->id}} ">    
         <div class='form-group'>
          <label class='form-control'>seguimiento</label>
          <textarea class='form-control' id='seguimiento' required='required' name='seguimiento'></textarea>  
        </div>                        
        </div>
        <div class="modal-footer">
           <input type="submit" class="btn btn-primary" onclick="new_seguimiento()" value="guardar">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>        
    </div>
</div>

<div id="myModal4" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">  Seguimientos   </h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id" value =" {{$registro->id}} ">    
         <div class='form-group'>
            <div id="ajax-content"></div>
          </div>                        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>        
    </div>
</div>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
   <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

@stop

<script>
  function confirm_action()
  {
    if(confirm("¿Desea eliminar el registro de mantenimiento?"))
    {
       $.get("deletereparacion/"+{{$registro->id}}, function(res, sta){
          alert(res);
       })
      
    }
    else{
      
    }
  }

  function changue_date()
  {
    //$("input[name='fecha']").val();
    id = $("input[name='data_changue']").val();
    $(".date"+id).empty();
    //console.log($("input[name='fecha']").val());
    $(".date"+id).text($("input[name='fecha']").val());
     $.post('addrepairdate',{fecha:$("input[name='fecha']").val(),id:id} ,function(data)
     {      
        alert(data);
        var date1 = new Date($("input[name='fecha']").val());
        var today = new Date();
        var timeDiff = Math.abs(today.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        $(".days"+id).empty();
        $(".days"+id).text(diffDays);
     });  
          
  }

  function assign_id(id)
  {
    $("input[name='data_changue']").val(id);
  }

  function changue_comment()
  {    
    id = $("input[name='data_changue']").val();
    $(".comment"+id).empty();
    console.log($("input[name='comentario']").val());
    $(".comment"+id).text($("textarea[name='comentario']").val());
    $.post('addrepaircomment',{comentario:$("textarea[name='comentario']").val(),id:id} ,function(data)
     {      
       alert(data);
     });
  }

  function new_seguimiento()
  {
   
   var id = $('input[name="id"]').val();
   var seguimiento = $('textarea[name="seguimiento"]').val();
   console.log(seguimiento);
   $.post('create_seguimiento', {id:id,seguimiento:seguimiento} ,function(data){      
        alert(data);
        $("#myModal3").modal('hide');
        $('textarea[name="seguimiento"]').val("");
      });  
  }

  function modal_seguimiento()
  {
    $("#ajax-content").empty();    
    $.get("table_seguimiento/{{$registro->id}}", function(res, sta){
          $("#ajax-content").append(res);
            $('#example').DataTable({
             "bSort": false,
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
                }
            });
          $("#myModal4").modal('show');
       })
  }
</script>