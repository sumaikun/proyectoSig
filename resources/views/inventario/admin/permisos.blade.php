@extends('administrador.layouts.layout')
@section('menu')
    @include('administrador.layouts.menu', array('op'=>'actividades'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
   {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css') }}

   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')

<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Permisos<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/facturacion') }}"><i class="fa fa-child"></i> Inventario</a></li>
      <li class="active">Permisos</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="max-width: 800px;" >

  
  <form action="asignaPermisos" method="post"> 
    <div class="col-lg-8 col-sm-8 table-responsive" style="max-height: 580px;">
      <div class="panel-group" >
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Administración de elementos</strong></div>
          <div class="panel-body">
            <ul>
              <li>
                <label class="form-control">Crear elementos</label>
                <input class="form-control" name="permisos1" value="inventario_crear"  type="checkbox">
              </li>
              <br>
              <li>
                <label class="form-control">Editar elementos</label>
                <input class="form-control" name="permisos2" value="inventario_editar" type="checkbox">
              </li>
              <br>
              <li>
                <label class="form-control">Eliminar elementos</label>
                <input class="form-control" name="permisos3" value="inventario_eliminar" type="checkbox">
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Alquileres</strong></div>
          <div class="panel-body">
            <ul>
              <li>
                <label class="form-control">Observar Alquileres</label>
                <input class="form-control" name="permisos4" value="observar_alquileres" type="checkbox">
              </li>
              <br>
              <li>
                <label class="form-control">Cambiar Alquileres</label>
                <input class="form-control" name="permisos5" value="cambiar_alquileres" type="checkbox">
              </li>            
            </ul>
          </div>
        </div>
      </div>

      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Mantenimiento</strong></div>
          <div class="panel-body">
            <ul>
              <li>
                <label class="form-control">Observar Mantenimiento</label>
                <input class="form-control" name="permisos6" value="observar_mantenimiento" type="checkbox">
              </li>
              <br>
              <li>
                <label class="form-control">Cambiar Mantenimiento</label>
                <input class="form-control" name="permisos7" value="cambiar_mantenimiento" type="checkbox">
              </li>            
            </ul>
          </div>
        </div>
      </div>

      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Alertas</strong></div>
          <div class="panel-body">
            <ul>
              <li>
                <label class="form-control">Observar alertas</label>
                <input class="form-control" name="permisos8" value="ver_alertas" type="checkbox">
              </li>                        
            </ul>
          </div>
        </div>
      </div>

      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Consumibles</strong></div>
          <div class="panel-body">
            <ul>
              <li>
                <label class="form-control">Crear consumibles</label>
                <input class="form-control" name="permisos9" value="crear_consumibles" type="checkbox">
              </li>
              <li>
                <label class="form-control">Manipular consumibles</label>
                <input class="form-control" name="permisos10" value="man_consumibles" type="checkbox">
              </li>                        
            </ul>
          </div>
        </div>
      </div>
      
    </div>

    <div class="col-lg-4 col-sm-4">
      <label for="carg_nombre">Usuario</label>
        <select class="form-control" id="usuario" name="usuario" size="15" required>
          <option value="">Selecciona</option>
          @foreach($usuarios as $usuario)
          <option value={{$usuario->usu_id}}> {{$usuario->usu_nombres}} {{$usuario->usu_apellido1}}</option>
          @endforeach   
        </select>
      <button class="btn btn-success form-control">Guardar</button>  
    </div>

   </form> 

</section>




<!--
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Status
            </h4>
         </div>
         <div class="modal-body">              
            <div class="row">  
              <div class="col-lg-12">
                <div class="form-group">      
                  <label>INGRESE EL NOMBRE DEL NUEVO STATUS</label>
                  <input  class="form-control" name="new_status" id="new_status" type="text"  required/>            
                </div>
              </div>
            </div>      
         </div>
         <div class="modal-footer">
            <button type="button"  id="close_status" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="save_status"   class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>
-->
 

@section('script')
<script type="text/javascript">
function validar()
{
   on_preload();
   return true;
}

$(document).ready(function() {
  $("#usuario").change(event => {
      $('input:checkbox').removeAttr('checked');

      $.get(`permi_asoc/${event.target.value}`, function(res, sta){
        if(res!='inexistence')
        {
          array = res.split(',');
          console.log(array);
          for(i=0;i<array.length;i++){
            if(array[i]!=''){
              $( "input[value="+array[i]+"]").prop('checked', true);
              console.log('valor del array '+array[i]);
            }
          }
          //
        }
      });    
  });
});


</script>

@stop

@stop
