@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-file-text-o"></i> Edición completa de Documento <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Editar documento</li>
    </ol>
    <!-- <hr> -->
</section>

<style>
   .mult_cons_v{
      visibility: hidden;
   }

   #Arch_emps{
      display: none;
   }


</style>
         
<!-- Cuerpo de la pagina -->
<section class="content">


<div class="col-lg-6 col-xs-12">


<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-info-circle"></i> <strong>Información del documento</strong></h3>
   </div>
   <div class="panel-body">
  
   <form name="form_sub" id="form_sub" action="updatealldocument" method="post" enctype="multipart/form-data">

         <input type="hidden" name="docid" value="{{$docid}}">
         
         <div id="Arch_original">
            <div class="col-lg-12"><strong>Archivo *</strong>
               <input type="file"  name="gdver_ruta_archivo" id="gdver_ruta_archivo" class="filestyle old_input" data-buttonText=" Seleccione" data-buttonName="btn-warning" required>
            </div>

            <div class="col-lg-12"><strong>Previsualización *</strong>
               <input type="file"  name="gdver_ruta_preview" id="gdver_ruta_preview" accept="image/x-png, image/gif, image/jpeg" class="filestyle old_input" data-buttonText=" Seleccione" data-buttonName="btn-success" required>
            </div>
         </div>

         <div id="Arch_emps">
            @foreach($empresas as $empresa)
            <div class="col-lg-12"><strong>Archivo {{$empresa->nombre}} *</strong>
               <input type="file"  name="arch{{$empresa->abbr}}" id="arch{{$empresa->abbr}}" class="filestyle emp_input" data-buttonText=" Seleccione" data-buttonName="btn-warning">
            </div>

            <div class="col-lg-12"><strong>Previsualización *</strong>
               <input type="file"  name="arch_prev{{$empresa->abbr}}" id="arch_prev{{$empresa->abbr}}"  accept="image/x-png, image/gif, image/jpeg" class="filestyle emp_input" data-buttonText=" Seleccione" data-buttonName="btn-success">
            </div>
            @endforeach
         </div>

         <div class="col-lg-6">
            <div class="checkbox checkbox-success">
               <input type="checkbox" id="gddoc_req_consecutivo" name="gddoc_req_consecutivo" value="SI">
               <label for="gddoc_req_consecutivo"><b>Requiere Consecutivos </b></label>
            </div>
            <div class="checkbox checkbox-success">
               <input type="checkbox" id="gddoc_req_registro" name="gddoc_req_registro" value="SI">
               <label for="gddoc_req_registro"><b>Requiere Registro </b></label>
            </div>
         </div>

      

         
         <div class="col-lg-12 mult_cons_v"><strong>¿Requiere diferentes consecutivos para cada empresa? *</strong></div>
          <div class="col-lg-6 mult_cons_v"><strong>Si</strong>
            <div class="input-group">
              <input type="Radio" name="mult_cons" value="1" />
            </div>
         </div>
          <div class="col-lg-6 mult_cons_v"><strong>No</strong>
            <div class="input-group">
              <input type="Radio" name="mult_cons" value="0" checked/>
            </div>
         </div>

         <div class="col-lg-12"><strong>¿Necesita diferentes archivos para cada empresa? *</strong></div>
          <div class="col-lg-6"><strong>Si</strong>
            <div class="input-group">
              <input type="Radio" onclick="transform_form(this)" name="mult_arch" value="1" />
            </div>
         </div>
          <div class="col-lg-6"><strong>No</strong>
            <div class="input-group">
              <input type="Radio" onclick="transform_form(this)" name="mult_arch" value="0" checked/>
            </div>
         </div>

               
         <div class="col-lg-12"><br>
            <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>

         <div class="col-lg-12"><small><strong>Nota: </strong>Los campos marcados con asteriscos (*) son obligatorios</small></div>
      </form>

   </div>
</div>

</div>


<script>
   function transform_form(input)
   {
      if(input.value==1)
      {
         $("#Arch_original").hide();
         $("#Arch_emps").show();
         $(".emp_input").prop('required',true);
         $(".old_input").prop('required',false);
      }
      if(input.value==0)
      {
         $("#Arch_original").show();
         $("#Arch_emps").hide();
         $(".emp_input").prop('required',false);
         $(".old_input").prop('required',true);
      }
   } 
</script>





</section>
@stop



@section('script')
{{ HTML::script('admin/js/bootstrap-filestyle.js') }}

<script type="text/javascript">

$(function() {

$('#gddoc_req_consecutivo').click(function() {
   if($('#gddoc_req_consecutivo').is(':checked')){
      $("#gddoc_consecutivo_ini").prop('disabled', false);
      $(".mult_cons_v").css("visibility", 'visible');

   }else{
      $("#gddoc_consecutivo_ini").prop('disabled', true);
      $(".mult_cons_v").css("visibility", "hidden");
   }
});

});








</script>
@stop
