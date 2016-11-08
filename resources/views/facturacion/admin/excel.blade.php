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
	<h1><i class="fa fa-puzzle-piece"></i> Excel <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-puzzle-piece"></i> Actividades </a></li>
      <li class="active">Excel</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<div class="col-lg-10 col-lg-offset-1 custyle">
   <div class="panel panel-default">
 
      <div class="panel-heading">
         <strong><i class="fa fa-list"></i> Excel</strong>
      </div>      
      <div class="table-responsive ocultar_400px">
      <form action="subirexcel" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label>Facturadora</label>
            <select class="form-control" name="empresa" required>
              <option value="">Selecciona</option>
                @foreach($empresas as $empresa)
                  <option value="{{$empresa->nombre}}">{{$empresa->nombre}}</option>
                @endforeach   
            </select>
         </div>
         <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo" class="form-control" required>
         </div>         
         <div class="col-lg-6 col-lg-offset-6 col-xs-12">
            <button type="submit" class="btn btn-success pull-right" onclick="validar()"><i class="fa fa-floppy-o"></i> <b>Guardar</b></button> 
            <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>       
      </div>   
      </form>
       </div>
   </div> 
      <div class="panel panel-primary">  
       <div class="table-responsive ocultar_400px" style="max-height: 250px;">
         <table class="table table-hover table-condensed" id="dev-table">
            <thead>
                <tr class=table_head>
                  <th>empresa</th>
                  <th>Plantilla</th>
                 <th></th>                 
                </tr>  
            </thead>
             <tbody>
       
              
            @foreach($empresas as $empresa)
             <tr>
                <td>  {{$empresa->nombre}} </td>                
                <td>  <a href="downloadlayout/{{$empresa->nombre}}"><button ><img src="http://icons.iconarchive.com/icons/graphicloads/filetype/128/excel-xls-icon.png" style="width: 50%; height: 50%"/></button></a> </td>    
                <td> <a href="deletelayout/{{$empresa->nombre}}"><button class="btn btn-danger">Borrar</button></a> </td>            
             </tr>  
            @endforeach  
             </tbody>
          
          </table> 
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

</script>
@stop
