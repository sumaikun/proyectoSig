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
  <h1><i class="fa fa-puzzle-piece"></i> Cuentas Bancarias <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
    <li><a href="{{ url('usuario/facturacion') }}"><i class="fa fa-puzzle-piece"></i> Facturación </a></li>
      <li class="active">Cuentas Bancarias</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

  <div class="row">

    <div class="col-lg-3 col-lg-offset-1">
      <div class="panel panel-success">
        <div class="panel-heading">
          <strong>Bancos</strong>
          <button class='btn btn-success btn-xs pull-right' id="pagar" onclick="cuenta_bancaria(null,'crear_banco')">   
            <i class="fa fa-pencil-square-o"></i> Crear Entidad Bancaria
          </button>
        </div>
        <div class="panel-body">
           <div class="table-responsive ocultar_400px">
            <table class="table table-hover table-condensed" id="dev-table">
              <thead>
                 <tr class="active">
                  <th>Id</th>
                  <th>Nombre</th>                  
                  <th></th>                  
                 </tr>
              </thead>
                <tr>
                  @foreach($bancos as $banco)
                  <td>{{$banco->id}}</td>
                  <td>{{$banco->nombre}}</td>                  
                  <td style="text-align: center;"><button class="btn btn-danger"  onclick="cuenta_bancaria({{$banco->id}},'editar_banco')">Editar</button></td>                  
                  @endforeach
                </tr>
           </table>
           </div>
        </div>
        <div class="panel-footer"></div>
      </div>
    </div>
     <div class="col-lg-6 ">
      <div class="panel panel-info">
        <div class="panel-heading">
          <strong>Cuentas Bancarias</strong>
          <button class='btn btn-info btn-xs pull-right' id="pagar" onclick="cuenta_bancaria(null,'crear_cuenta')">   
            <i class="fa fa-pencil-square-o"></i> Crear Cuenta Bancaria
          </button>
        </div>
        <div class="panel-body">
           <div class="table-responsive ocultar_400px">
            <table class="table table-hover table-condensed" id="dev-table">
              <thead>
                 <tr class="active">
                  <th>Facturadora </th>
                  <th>Banco</th>
                  <th>Numero de cuenta</th>
                  <th>Tipo</th>
                  <th>estado</th>
                  <th></th>                  
                 </tr>
              </thead>
                @foreach($cuentas as $cuenta)
                <tr>
                  <td>{{$cuenta->empresas["nombre"]}}</td>
                  <td>{{$cuenta->bancos["nombre"]}}</td>
                  <td style="text-align: center;">{{$cuenta->numero}}</td>
                  <td>@if($cuenta->tipo==1) {{'Ahorros'}} @else {{"Corriente"}} @endif</td>                   
                  <td>@if($cuenta->estado==1) {{'Activa'}} @else {{"Inactiva"}} @endif</td>
                  <td><button class="btn btn-danger"  onclick="cuenta_bancaria({{$cuenta->id}},'editar_cuenta')">Editar</button></td> 
                </tr>
                @endforeach
           </table>
           </div>
        </div>
        <div class="panel-footer"></div>
      </div>
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
 function cuenta_bancaria(id,type)
{
  $("#ajax-content").empty();   

  if(type=='crear_banco'){

   var ajax = $.get('crear_banco', function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','crear_banco');});    

  }
  else if(type=='crear_cuenta'){

   var ajax = $.get('crear_cuenta', function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','crear_cuenta');});    

  }
  else if(type=='editar_banco'){

  var ajax = $.get('editar_banco/'+id, function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','editar_banco/0');});
  }
  else if(type=='editar_cuenta'){

  var ajax = $.get('editar_cuenta/'+id, function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','editar_cuenta/0');});
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

