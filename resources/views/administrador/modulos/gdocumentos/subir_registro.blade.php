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
	<h1><i class="fa fa-cloud-upload"></i> Subir Registro <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/gdocumentos') }}"><i class="fa fa-book"></i> Gestión documental</a></li>
      <li class="active">Subir Registro</li>
    </ol>
    <!-- <hr> --> 
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="col-lg-10 col-lg-offset-1">

<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-cloud-upload"></i> <strong>Subir Registro</strong></h3>
   </div>
   <div class="panel-body">
      
      <form name="form1" id="form1" method="post" action="guardar_registro" enctype="multipart/form-data">

      <div class="col-lg-12"><strong>Consecutivo activo</strong>
         <div class="well well-sm">
            <div class="row">
               <div class="col-lg-12">

               <table class="table table-condensed">
               <tr>
                  <td></td>
                  <td><strong>Consecutivo</strong></td>
                  <td><strong>Identificación</strong></td>
                  <td><strong>Descripción</strong></td>
                  <td><strong>Apertura</strong></td>
               </tr>
               @foreach($consecutivos as $consecutivo)
                  <tr>
                     <td>
                        <input type="radio" name="gdcon_id" class="gdcon_id" id="{{$consecutivo->gdcon_id}}" value="{{$consecutivo->gdcon_id}}" onclick="buscar_doc(this.value)" required>
                     </td>
                     <td>{{ $consecutivo->gdcon_consecutivo }}</td>
                     <td>{{ $consecutivo->documentos->gddoc_identificacion }}</td>
                     <td>{{ $consecutivo->documentos->versiones()->where('gdver_estado', 'activo')->first()->gdver_descripcion }}</td>
                     <td>{{ $consecutivo->gdcon_creacion }}</td>
                  </tr>
               @endforeach
               </table>
              
               </div>
            </div>
         </div>
      </div>

      
         
      <div class="col-lg-10" style="border-right:2px solid;" id="reqc">

      
         <input type="hidden" id="gdreg_estado" name="gdreg_estado" value="true">
         
         
         <div class="col-lg-12"><strong>Archivo *</strong>
            <input type="file" name="archivo" id="archivo" class="filestyle" data-buttonText="Archivo" data-buttonName="btn-warning" required>
         </div>

         <div class="col-lg-12"><label for=""><strong>Descripcion *</strong></label>
            <input type="text" name="gdreg_descripcion" id="gdreg_descripcion" placeholder="Carta enviada a pasific" class="form-control" required>
         </div>

         <div class="col-lg-12"><label for=""><strong>Detalles</strong></label>
            <textarea name="gdreg_detalles" id="gdreg_detalles" rows="3" placeholder="Carta enviada a pasific para notificacion de personal" class="form-control"></textarea>
         </div>
         
         <div class="col-lg-9"><br>
            <small><strong>Nota: </strong>Los campos marcados con asteriscos (*) son obligatorios</small>
         </div>

         <div class="col-lg-3"><br>
            <button type="submit" class="btn btn-success btn-md pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>

      </div>
      
      </form>

      <div class="col-lg-2 text-center" id="anul">
         <button type="button" id="bntanular" class="btn btn-danger btn-circle btn-xl" onclick="anular()">
            <i class="fa fa-times"></i>
         </button>
         <h3>
            <strong id="infa">Anular</strong>
         </h3>
      </div>


      

   </div>
</div>


</div>





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         
         <form name="form2" id="form2" onsubmit="return validar()" method="post" action="guardar_registro">

         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-question-circle"></i> Informe</h4>
         </div>
         <div class="modal-body">
        
         <div class="well well-sm">
            <div class="row">
              <!--  <div class="col-lg-12">
                  Explique las razones de su informe
               </div> -->
               <div class="col-lg-12"><label for=""><strong>Informe</strong></label>
                  <textarea name="gdreg_descripcion_nulo" id="gdreg_descripcion_nulo" rows="3" placeholder="Carta enviada a pasific para notificacion de personal" class="form-control" required></textarea>
                  <input type="hidden" id="gdcon_id_nulo" name="gdcon_id_nulo">
               </div>
            </div>
         </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
      </div>
   
      </form>

    </div>
  </div>
</div>






</section>
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






function anular(){
   if( $('.gdcon_id').is(':checked') ){
      $('#myModal').modal('show');   
   }else{
      alert("Seleccione un consecutivo");
   }
   
}

function validar(){
   
   $("#form2 input[name=gdcon_id_nulo]").val($("#form1 input[name=gdcon_id]:checked").val());
   return true;
}

</script>
@stop
