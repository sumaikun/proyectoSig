@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'gdocumental'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'gdocumental'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<h3 class="page-header"><i class="fa fa-bell-o"></i> Registros Pendientes<!-- <small>Bienvenid@</small> --></h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>


<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">
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







</div>
        









<!-- este boton muestra la informacion de la vista del documento -->
<div id="inbox">
   <div class="fab btn-group show-on-hover dropup">
      <div data-toggle="tooltip" data-placement="left" title="Información" style="margin-left: 42px;">
         <button type="button" class="btn btn-danger btn-io dropdown-toggle" data-toggle="modal" data-target="#info_doc">
            <span class="fa-stack fa-2x">
               <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
               <i class="fa fa-question fa-stack-1x fa-inverse fab-primary"></i>
               <i class="fa fa-info-circle fa-stack-1x fa-inverse fab-secondary"></i>
            </span>
         </button>
      </div>
      <ul class="dropdown-menu dropdown-menu-right" role="menu">
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="Manual"><i class="fa fa-book"></i></a></li> -->
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="LiveChat"><i class="fa fa-comments-o"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Reminders"><i class="fa fa-hand-o-up"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Invites"><i class="fa fa-ticket"></i></a></li> -->
      </ul>
   </div>
</div>      
   

@include('cosas_generales.boton_info', array('imagen'=>'upload_reg_usuario'))
@stop



@section('script')
{{ HTML::script('admin/js/bootstrap-filestyle.js') }}
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
