@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'cargos'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')

<style>

 .tb-enterprise{
   }

 .tb-data
  {
    visibility: hidden;
  } 

</style>
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-puzzle-piece"></i> Ciudades <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-puzzle-piece"></i> Facturación </a></li>
      <li class="active">Ciudades</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

  <div class="row">

    <div class="col-lg-10 col-lg-offset-1">
      <div class="panel panel-success">
        <div class="panel-heading">
          <button class='btn btn-success btn-xs' id="pagar" onclick="ciudades(null,'crear')">   
            <i class="fa fa-pencil-square-o"></i> Crear ciudad
          </button>
        </div>
        <div class="panel-body">
           <div class="table-responsive ocultar_400px">
            <table class="table table-hover table-condensed" id="dev-table">
              <thead>
                 <tr class="active">
                  <th>Departamento</th>
                  <th>Ciudad</th>
                  <th></th>                  
                 </tr>
              </thead>
                @foreach($ciudades as $ciudad)
                <tr>             
                  <td>{{$ciudad->departamento->nombre}}</td>
                  <td>{{$ciudad->nombre}}</td>
                  <td><button class="btn btn-danger"  onclick="ciudades({{$ciudad->id}},'editar')">Editar</button></td>             
                </tr>
                @endforeach
           </table>
           </div>
        </div>
        <div class="panel-footer"></div>
      </div>
    </div>


</section>

 <form name="form1" id="form1" class='form_factura' action="" onsubmit="return validar()" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-md">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">
                 <i class="fa fa-plus-square-o"></i>
              </h4>
           </div>
           <div class="modal-body">
           
              <div class="row">  
                <div class="col-lg-12">
                  <div id="ajax-content"></div>
                </div>
              </div>
        
           </div>
           <div class="modal-footer">
              <button type="submit" class="btn btn-success">Guardar</button>
              <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
           </div>
        </div>     
     </div>
  </div>
 </form>  


@stop


@section('script')
<script type="text/javascript">
function validar()
{
   on_preload();
   return true;
}
 function ciudades(id,type)
{
  $("#ajax-content").empty();   

  if(type=='crear'){

   var ajax = $.get('crear_ciudad', function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','crear_ciudad');});    

  }
  else if(type=='editar'){

  var ajax = $.get('editar_ciudad/'+id, function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','editar_ciudad/0');});
  }
}

function validar(){
   if(!confirm("¿Esta seguro/a?")){
      return false;
   }
   return true;
}


</script>
@stop
