@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'cassima'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'cassima'))
@stop



@section('contenido')
<h1 class="page-header"> <strong>HV Documento</strong><!-- <small>Bienvenid@</small> --></h1>

<form role="form" name="form1" id="form1" action="reg_hv_documento" method="post">
<input type="hidden" name="gddoc_id" id="gddoc_id" value="{{$documento->gddoc_id}}">

<div class="col-lg-10">

<div class="row">
<div class="col-lg-3">
   <label for="gddoc_identificacion">Codigo</label>
   <input type="text" name="gddoc_identificacion" id="gddoc_identificacion" class="form-control" value="{{$documento->gddoc_identificacion}}" readOnly="true">
</div>
<div class="col-lg-5">
   <label for="gdver_descripcion">Nombre</label>
   <input type="text" name="gdver_descripcion" id="gdver_descripcion" class="form-control" value="{{$documento->gdver_descripcion}}" readOnly="true">
</div>
<div class="col-lg-1">
   <label for="gdver_version">Version</label>
   <input type="text" name="gdver_version" id="gdver_version" class="form-control text-center" value="{{$documento->gdver_version}}" readOnly="true">
</div>
<div class="col-lg-3">
   <label for="gdver_fecha_version">Fecha Version</label>
   <input type="date" name="gdver_fecha_version" id="gdver_fecha_version" class="form-control" value="{{$documento->gdver_fecha_version}}" disabled>
</div>
</div>

<div class="divider" style="border-top: 2px solid gray; margin: 15px 0px;"></div>

<div class="row">
<div class="col-lg-3">
   <label for="gdhv_origen">Origen</label>
   <select name="gdhv_origen" id="gdhv_origen" class="form-control">
      <option value="" selected disabled>Seleccione...</option>
      <option value="INTERNO">INTERNO</option>
      <option value="EXTERNO">EXTERNO</option>
   </select>
</div>
</div>

<div class="row">
<div class="col-lg-6">
   <label for="gdhv_revisado_por">Revisado Por</label>
   <input type="text" name="gdhv_revisado_por" id="gdhv_revisado_por" class="form-control" value="{{$hv->gdhv_revisado_por}}">
</div>
<div class="col-lg-6">
   <label for="gdhv_aprobado_por">Aprobado Por</label>
   <input type="text" name="gdhv_aprobado_por" id="gdhv_aprobado_por" class="form-control" value="{{$hv->gdhv_aprobado_por}}">
</div>
</div>
   
<div class="row">
   <div class="col-lg-12">
      <label for="gdhv_detalle_cambio">Descripcion del cambio</label>
      <textarea class="form-control" name="gdhv_detalle_cambio" id="gdhv_detalle_cambio" rows="3"></textarea>
   </div>
</div>

<div class="row">
<div class="col-lg-12">
   <label for="gdhv_disp_obsoletos">DISPOSICIÓN DE OBSOLETOS</label>
   <input type="text" name="gdhv_disp_obsoletos" id="gdhv_disp_obsoletos" class="form-control">
</div>
</div>

<div class="divider" style="border-top: 2px solid gray; margin: 15px 0px;"></div>

<h4><i class="fa fa-inbox"></i> RECUPERACIÓN DE REGISTROS (Esta sección solo aplica para formatos)</h4> <br>
<div class="row">
<div class="col-lg-6">
   <label for="gdhv_custodia">Responsable de la custodia</label>
   <input type="text" name="gdhv_custodia" id="gdhv_custodia" class="form-control">
</div>
<div class="col-lg-6">
   <label for="gdhv_med_almacenamiento">Medio de almacenamiento</label>
   <input type="text" name="gdhv_med_almacenamiento" id="gdhv_med_almacenamiento" class="form-control">
</div>
</div>


<div class="row">
<div class="col-lg-6">
   <label for="gdhv_med_proteccion">Medio de proteccion del registro</label>
   <input type="text" name="gdhv_med_proteccion" id="gdhv_med_proteccion" class="form-control">
</div>
<div class="col-lg-6">
   <label for="gdhv_ubicacion_reg">Ubicacion del registro</label>
   <input type="text" name="gdhv_ubicacion_reg" id="gdhv_ubicacion_reg" class="form-control">
</div>
</div>

<div class="row">
<div class="col-lg-4">
   <label for="gdhv_ret_gestion">TIEMPO DE RETENCIÓN - ARCHIVO DE GESTIÓN</label>
   <input type="text" name="gdhv_ret_gestion" id="gdhv_ret_gestion" class="form-control">
</div>
<div class="col-lg-4">
   <label for="gdhv_ret_inactivo">TIEMPO DE RETENCIÓN - ARCHIVO INACTIVO</label>
   <input type="text" name="gdhv_ret_inactivo" id="gdhv_ret_inactivo" class="form-control">
</div>
<div class="col-lg-4">
   <label for="gdhv_ret_muerto">TIEMPO DE RETENCIÓN - ARCHIVO MUERTO</label>
   <input type="text" name="gdhv_ret_muerto" id="gdhv_ret_muerto" class="form-control">
</div>
</div>

<div class="col-lg-12 nopadding"> <br>
   <button type="submit" class="btn btn-success btn-block">
      <i class="fa fa-save"></i> 
      <strong>Guardar</strong>
   </a>
</div>

</div>

<div class="col-lg-2"> <br>
   <a href="{{ URL::previous() }}" class="btn btn-primary btn-block">
      <i class="fa fa-reply-all"></i> 
      <strong>Volver</strong>
   </a>
</div>

<div class="col-lg-2"> <br>
   <button type="submit" class="btn btn-success btn-block">
      <i class="fa fa-save"></i> 
      <strong>Guardar</strong>
   </a>
</div>

</form>
@stop



@section('script')
<script type="text/javascript">

// $(function() {
//    $('#noconse').hide();
//    $('#siconse').hide();
// });


function validar(){
   if(!$('.gddoc_id').is(':checked')){
      alert("No ha seleccionado ningún documento");
      return false;
   }
   return true;
}


</script>
@stop
