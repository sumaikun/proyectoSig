@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
  
@stop
 
@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-search"></i> Consultar registro <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/gdocumentos') }}"><i class="fa fa-book"></i> Gestión documental</a></li>
      <li class="active">Consultar registro</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="col-lg-7" style="border-right: gray 5px solid;">

<form name="form1" id="form1" action="timeline_registro" onsubmit="return validar()">

<div class="ocultar_450px">
   <div class="panel-group" id="accordion"><strong>Linea de tiempo por documento</strong>
      @foreach ($categorias as $cat)
      <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}">
               <i class="fa fa-folder-open-o text-warning"></i>
               <span class="text-muted"> <strong>{{ ucwords ($cat->gdcat_nombre) }}</strong> </span>
               <i class="fa fa-angle-double-down pull-right"></i>
            </a>
            <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
            <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
         </h4>
         </div>
         <div id="{{ $cat->gdcat_id.'colla' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
            <ul class="list-group">
            @foreach ($subcategorias as $sub)
               @if($cat->gdcat_id == $sub->gdcat_id)
               <li class="list-group-item">
                  <i class="fa fa-angle-double-right"></i>
                  <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id.'subcolla' }}" class="text-muted"> {{ucwords ($sub->gdsub_nombre)}} </a>
                  <!-- <i class="fa fa-trash-o pull-right text-danger"></i> -->
                  <!-- <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
                  
                  <div id="{{ $sub->gdsub_id.'subcolla' }}" class="panel-collapse collapse">
                  <ul class="list-unstyled">
                  @foreach ($documentos as $doc)
                     @if($sub->gdsub_id == $doc->gdsub_id)
                        <li class="correte">
                           <input type="radio" name="gddoc_id" class="gddoc_id" id="{{$doc->gddoc_id.'d'}}" value="{{$doc->gddoc_id}}" onclick="buscar_informacion(this.value)">
                           <label for="{{$doc->gddoc_id.'d'}}">{{$doc->gddoc_identificacion." ".ucwords ($doc->gdver_descripcion) }}</label>
                        </li>
                     @endif
                  @endforeach   
                  </ul>
                  </div>

               </li>
               @endif
            @endforeach
            </ul>
         </div>
      </div>
      @endforeach
   </div>
</div>

<div class="col-lg-12 nopadding">
   <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-search"></i> Buscar</button>
</div>

</form>

</div>


<div class="col-lg-5"><br>

<div class="col-lg-12">
<div class="panel panel-default">
   <div class="panel-heading"><i class="fa fa-search"></i> <strong>Registro Individual</strong></div>
   <div class="panel-body">
      <form name="form2" id="form2" action="consulta_reg_individual" method="post">
         <div class="col-lg-5 col-xs-7">Identificación
           <input type="text" name="gddoc_identificacion" id="gddoc_identificacion" class="form-control" required>
         </div>
         <div class="col-lg-4 col-xs-7">Consecutivo
           <input type="text" name="gdcon_consecutivo" id="gdcon_consecutivo" class="form-control" required>
         </div>
         <div class="col-lg-2 col-xs-5"><br>
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>
         </div>
         <div class="col-lg-12">
            @if(isset($mensaje))
               {{$mensaje}}
            @endif
         </div>
      </form>
   </div>
</div>   
</div>
</div>

<div class="col-lg-5">
<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-users"></i> Habilitar visualización completa</h3>
   </div>
   <div class="panel-body">
      <div class="input-group">
         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar" />
         <span class="input-group-addon" id="basic-addon2">@grupo-sig.com</span>
      </div>
   </div>
   
   <div class="table-responsive ocultar_250px">

   <form action="reg_visu_per" onsubmit="return validar()" id="form1" name="form1" method="post">
      <table class="table table-hover table-condensed" id="dev-table">
      <thead>
         <tr class="active">
            <th>#</th>
            <th><strong>Nombres</strong></th>
            <th><strong>Apellido1</strong></th>
            <th><strong>Apellido2</strong></th>
            <th><strong>Cargo</strong></th>
            <!-- <th><strong>Usuario</strong></th> -->
         </tr>
      </thead>
      <tbody>
      @foreach($usuarios as $usuario)
         <tr>
            <td>
               <input type="checkbox" name="{{$usuario->usu_id.'u'}}" id="{{$usuario->usu_id.'u'}}" class="checkall" value="{{$usuario->usu_id}}" >
            </td>
            <td>{{$usuario->usu_nombres}}</td>
            <td>{{$usuario->usu_apellido1}}</td>
            <td>{{$usuario->usu_apellido2}}</td>
            <td>{{$usuario->cargos->carg_nombre}}</td>
         </tr>
      @endforeach
      </tbody>
      </table>
   </div>
   <div class="panel-footer">
      <button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
   </div>
 </div>
 </form>
</div>

</section>
@stop



@section('script')

<script type="text/javascript">

function validar(){
   if(!$('.gddoc_id').is(':checked')){
      alert("No ha seleccionado ningún documento");
      return false;
   }
   return true;
}

function buscar_informacion(docid){

   $.post("buscar_usu_rela",{docid:docid},function(data){

      // esta linea es para activar el boton Restablecer permisos
      /*$("#rest").prop('disabled', false);
      
      if(data.length == 0 ){
            $('.checkall').attr("checked", false);
      }else{
         $.each(data,function(clave,valor) {
            if(valor.gdperdoc_permiso==1){
               $('#'+valor.usu_id+'u').prop('checked' , true);
            }else{
               $('#'+valor.usu_id+'u').prop('checked' , false);
            }       
         });

      }*/

   });

}

</script>
@stop
