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
	<h1><i class="fa fa-puzzle-piece"></i> Permisos <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-puzzle-piece"></i> Facturación </a></li>
      <li class="active">Permisos</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<div class="col-lg-10 col-lg-offset-1 custyle">
   <div class="panel panel-default">
 
      <div class="panel-heading">
         <strong><i class="fa fa-list"></i> Gestionar Permisos</strong>
      </div>      
        <div class="table-responsive ocultar_400px">
          <form action="registrarpermiso" method="post" enctype="multipart/form-data">

             <div class="row">
                   <div class="col-lg-12 content">
                      <label for="carg_nombre">Usuario</label>
                        <select class="form-control" id="usuario" name="usuario" >
                          <option value="">Selecciona</option>
                          @foreach($usuarios as $usuario)
                          <option value={{$usuario->usu_id}}> {{$usuario->usu_nombres}} {{$usuario->usu_apellido1}}</option>
                          @endforeach   
                        </select>               
                   </div>
                   <div class="col-lg-12 content">
                        <div class="form-group">
                          <label for="carg_nombre">generar facturas</label>
                          <input type="checkbox" name="permiso1"  value="gene_factura">
                          <label for="carg_nombre">Lista de facturas</label>
                          <input type="checkbox" name="permiso2"  value="obs_factura">
                          <label for="carg_nombre">ver información de pagos</label>
                          <input type="checkbox" name="permiso3"  value="ver_pago">
                          <label for="carg_nombre">gestion de entidades</label>
                          <input type="checkbox" name="permiso4"  value="ges_entidades">                         
                          <label for="carg_nombre">gestion de cuentas</label>
                          <input type="checkbox" name="permiso5"  value="ges_cuentas">
                          <label for="carg_nombre">manejo de ciudades</label>
                          <input type="checkbox" name="permiso6"  value="ges_ciudades">
                        </div>                     
                    </div>  
              </div>
            <br>
            <div class="row">
               <div class="col-lg-6 col-lg-offset-6 col-xs-12">
                  <button type="submit" class="btn btn-success pull-right" onclick="validar()"><i class="fa fa-floppy-o"></i> <b>Guardar</b></button> 
                  <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>       
              </div>   
            </form>
       </div>
   </div> 

  </div>
</div>

 







</section>
@stop


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
