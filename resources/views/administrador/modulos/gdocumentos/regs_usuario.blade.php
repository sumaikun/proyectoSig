@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
   {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap2/bootstrap-switch.css') }}
@stop 

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-cloud-upload"></i> Registros por usuario <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/gdocumentos') }}"><i class="fa fa-book"></i> Gestión documental</a></li>
      <li class="active">Registros por usuario</li>
    </ol>
    <!-- <hr> --> 
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="col-lg-10 col-lg-offset-1">
   <div class="panel panel-primary">
      <div class="panel-heading">
         <h3 class="panel-title"><i class="fa fa-cloud-upload"></i> <strong>Registros por usuario</strong></h3>
      </div>
      <div class="panel-body">
         
         <form name="form1" id="form1" method="post" action="registros_usuario" enctype="multipart/form-data">
            <select class="form-control" name="user_id" onchange="document.getElementById('form1').submit();">
               <option>Selecciona</option>
               @foreach($usuarios as $usuario)                  
               <option value="{{$usuario->usu_id}}" @if($usu == $usuario->usu_id) {{'selected'}} @endif>{{$usuario->usu_nombres}} {{$usuario->usu_apellido1}}</option>                  
               @endforeach
            </select>
         </form>   
         <div class="col-lg-12"><strong>Registros</strong>
            <div class="well well-sm">
               <div class="row">
                  <div class="col-lg-12">

                  <table id="example" class="table table-condensed">
                     <thead>
                        <th></th>
                        <th><strong>Documento</strong></th>
                        <th><strong>Descripción</strong></th>
                        <th><strong>Fecha registro</strong></th>
                        <th><strong>Estado</strong></th>
                        <th><strong>Descargar</strong></th>
                     </thead>
                     <tbody>
                        @foreach($registros->reverse() as $registro)
                        <tr>   
                           <td></td>
                           <td><strong>{{$registro->documentos->gddoc_identificacion}} </strong>{{$registro->versiones->gdver_descripcion}}<strong>Consecutivo: </strong>{{$registro->consecutivos->gdcon_consecutivo}}
                           <strong>Fecha creación: </strong> {{$registro->consecutivos->gdcon_creacion}}</td>
                           <td>{{$registro->gdreg_descripcion}}</td>
                           <td>{{$registro->gdreg_creacion}} </td>
                           <td>{{$registro->gdreg_estado}}</td>
                           <td><a href="../{{$registro->gdreg_ruta_archivo}}">Descargar</a></td>
                        </tr>
                        @endforeach                        
                     </tbody>
                  </table>                 
                  </div>
               </div>
            </div>
         </div>        

      </div>
   </div>
</div>












</section>
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
   <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function() {
    
    $('#example').DataTable({
       "bSort": false,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
        }
    });
  });
</script>
@stop



@section('script')
{{ HTML::script('admin/js/bootstrap-filestyle.js') }}
{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.js') }}


<script type="text/javascript">

// $(function() {
//    $("[name='my-checkbox']").bootstrapSwitch();
// });


function buscar_doc(gdcon_id){
   
   $.post("buscar_doc_conse",{gdcon_id:gdcon_id},function(data){
      console.log(data);

      if(data.gddoc_req_registro == 0 && data.gddoc_req_consecutivo == 1){
         $( "#reqc" ).addClass( "hide" );
         $( "#anul" ).addClass( "col-lg-offset-5" );
         $( "#infa" ).html( "Informe" );
         
         $( "#bntanular" ).removeClass( "btn-danger" ).addClass( "btn-success" );
         $( ".fa-times" ).removeClass( "fa-times" ).addClass( "fa-info" );
         
      }else{

         $( "#reqc" ).removeClass( "hide" );
         $( "#anul" ).removeClass( "col-lg-offset-5" );
         $( "#infa" ).html( "Anular" );
         
         $( "#bntanular" ).removeClass( "btn-success" ).addClass( "btn-danger" );
         $( ".fa-times" ).removeClass( "fa-info" ).addClass( "fa-times" );

      }

   });

}








</script>
@stop
