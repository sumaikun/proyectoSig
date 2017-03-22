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
	<h1><i class="fa fa-plus-circle"></i> Gesion de documentos  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Documentos</a></li>
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
         <h3 class="panel-title"><i class="fa fa-list"></i> Gestion de documentos de capacitaciones</h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
         <!--<a href="{{ url('admin/nuevousuario') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Agregar Usuario</a>-->
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr class=table_head>                     
                 <th>Título</th> 
                 <th>Documento</th>
                 <th>Fecha</th>                 
                 <th>Boton</th>                              
                </tr>  
            </thead>
             <tbody>
                @foreach($documentos as $documento)
              <tr>
                <td>  {{$documento->titulo}}  </td>                
                <td>  <a  onclick="return validate2('{{$documento->titulo}}')" href="downloaddocumento/{{$documento ->ruta}}/{{$documento ->id}}" >{{$documento ->ruta}}</a> </td>
                <td>  {{$documento ->created_at}}</td>                       
                <td>
                  <a onclick="return validate()" href="deletedoc/{{$documento->id}}"><button   class="btn btn-danger " >Borrar</button></a>         
                    <button  onclick="edit_doc('{{$documento ->id}}','{{$documento ->titulo}}')" class="btn btn-warning " >Editar</button>
                   <a onclick="search_data('{{$documento->id}}')"> <button   class="btn btn-success " >Detalles</button></a>
                  
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
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">editar</h4>
      </div>
      <div class="modal-body">
         <form action="editDocumento" onsubmit="return validar()" method="post" enctype="multipart/form-data">              
              <input type="hidden" name="id" id="id">
              <div class="form-group">              
                <label>*Titulo</label>
                <input type="text" name="titulo" id="titulo" class="form-control" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Documento</label>
                <input type="file" name="archivo" class="form-control">
                Si no selecciona ningun archivo se conservara el documento anteriormente subido a la plataforma 
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

<!-- Modal2 -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ultimas descargas</h4>
      </div>
      <div class="modal-body">
         <div id="ajax-content">
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>       
  $(document).ready(function() {
    $('#example').DataTable({
       "bSort": false
      });
  });

  function validate(){
      if(!confirm("Está seguro de borrar el archivo?"))
      {
        return false;
      }
      return true;
    }


  function validate2(title){
      if(!confirm("Está seguro de descargar el archivo "+title+"?"))
      {
        return false;
      }
      return true;
    }

   function edit_doc(id,title)
   {
      $('#myModal').modal('show');
      $('#id').val(id);
      $('#titulo').val(title); 
   }

   function search_data(id)
   {
      $("#ajax-content").empty();
      var ajax = $.get('detalles_doc/'+id, function(res, sta){$("#ajax-content").append(res);});
      ajax.done(function(res, sta){$('#myModal2').modal();   $('#example2').DataTable({
       "bSort": false
      });});
      
   } 
</script>


@stop
