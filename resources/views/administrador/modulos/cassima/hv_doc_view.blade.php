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
	<h1><i class="fa fa-exclamation-circle"></i> Hoja de vida documento <!-- <small>subcategorias</small> --></h1>
   <ol class="breadcrumb">
   	<li>
         <a href="{{ url('admin/modulos') }}">
            <i class="fa fa-th-large"></i> Modulos
         </a>
      </li>
      <li><a href="{{ url('admin/cassima') }}">CASSIMA</a></li>
      <li class="active">Hoja de vida documento</li>
   </ol>
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" >


<form role="form" name="form1" id="form1" action="../reg_hv_documento" method="post">
<input type="hidden" name="gddoc_id" id="gddoc_id" value="{{$documento->gddoc_id}}">

<div class="col-lg-10">

<div class="row">
<div class="col-lg-3">
   <label for="gddoc_identificacion">Identificación</label>
   <input type="text" name="gddoc_identificacion" id="gddoc_identificacion" class="form-control" value="{{$documento->gddoc_identificacion}}" readOnly="true">
</div>
<div class="col-lg-5">
   <label for="gdver_descripcion">Nombre</label>
   <input type="text" name="gdver_descripcion" id="gdver_descripcion" class="form-control" value="{{$version[0]->gdver_descripcion}}" readOnly="true">
</div>
<div class="col-lg-1">
   <label for="gdver_version">Version</label>
   <input type="text" name="gdver_version" id="gdver_version" class="form-control text-center" value="{{$version[0]->gdver_version}}" readOnly="true">
</div>
<div class="col-lg-3">
   <label for="gdver_fecha_version">Fecha Version</label>
   <input type="date" name="gdver_fecha_version" id="gdver_fecha_version" class="form-control" value="{{$version[0]->gdver_fecha_version}}" disabled>
</div>
</div>

<div class="divider" style="border-top: 2px solid gray; margin: 15px 0px;"></div>

<div class="row">
<div class="col-lg-2">
   <label for="gdhv_origen">Origen</label>
   <select name="gdhv_origen" id="gdhv_origen" class="form-control" required="true">
      <option value="" selected disabled>Seleccione...</option>
      <option value="INTERNO">INTERNO</option>
      <option value="EXTERNO">EXTERNO</option>
   </select>
</div>
<div class="col-lg-5">
   <label for="gdhv_revisado_por">Revisado Por</label>
   <input type="text" name="gdhv_revisado_por" id="gdhv_revisado_por" class="form-control" value="{{{ isset($hv) ? $hv->gdhv_revisado_por : '' }}}">
</div>
<div class="col-lg-5">
   <label for="gdhv_aprobado_por">Aprobado Por</label>
   <input type="text" name="gdhv_aprobado_por" id="gdhv_aprobado_por" class="form-control" value="{{{ isset($hv) ? $hv->gdhv_aprobado_por : '' }}}">
</div>
</div>
   
<div class="row">
   <div class="col-lg-12">
      <label for="gdhv_detalle_cambio">Descripcion del cambio</label>
      <textarea class="form-control" name="gdhv_detalle_cambio" id="gdhv_detalle_cambio" rows="3">{{{ isset($hv) ? $hv->gdhv_detalle_cambio : '' }}}</textarea>
   </div>
</div>

<div class="row">
<div class="col-lg-12">
   <label for="gdhv_disp_obsoletos">DISPOSICIÓN DE OBSOLETOS</label>
   <input type="text" name="gdhv_disp_obsoletos" id="gdhv_disp_obsoletos" class="form-control" value="{{{ isset($hv) ? $hv->gdhv_disp_obsoletos : '' }}}">
</div>
</div>

<div class="divider" style="border-top: 2px solid gray; margin: 15px 0px;"></div>

<h4><i class="fa fa-inbox"></i> RECUPERACIÓN DE REGISTROS (Esta sección solo aplica para formatos)</h4> <br>
<div class="row">
<div class="col-lg-6">
   <label for="gdhv_custodia">Responsable de la custodia</label>
   <input type="text" name="gdhv_custodia" id="gdhv_custodia" class="form-control" value="{{{ isset($hv) ? $hv->gdhv_custodia : '' }}}">
</div>
<div class="col-lg-6">
   <label for="gdhv_med_almacenamiento">Medio de almacenamiento</label>
   <select name="gdhv_med_almacenamiento" id="gdhv_med_almacenamiento" class="form-control">
      <option value="" selected disabled>Seleccione...</option>
      <option value="FíSICO">FíSICO</option>
      <option value="DIGITAL">DIGITAL</option>
      <option value="FíSICO/DIGITAL">FíSICO/DIGITAL</option>
   </select>
</div>
</div>

<div class="row">
<div class="col-lg-6">
   <label for="gdhv_med_proteccion">Medio de proteccion del registro</label>
   <select name="gdhv_med_proteccion" id="gdhv_med_proteccion" class="form-control">
      <option value="" selected disabled>Seleccione...</option>
      <option value="Medio Digital: Carpeta informatica">Medio Digital: Carpeta informatica</option>
      <option value="Medio Digital: Carpeta con clave de usuario">Medio Digital: Carpeta con clave de usuario</option>
      <option value="Medio Digital: Backup">Medio Digital: Backup</option>
      <option value="Medio Físico: Carpetas">Medio Físico: Carpetas</option>
      <option value="Medio Físico: Folder">Medio Físico: Folder</option>
      <option value="Medio Físico: Legajadorez AZ">Medio Físico: Legajadorez AZ</option>
      <option value="Medio Físico: Libros Foliados">Medio Físico: Libros Foliados</option>

      <option value="Medio Físico: Carpetas; Medio Informatico:Carpeta Informatica">Medio Físico: Carpetas; Medio Informatico:Carpeta Informatica</option>
      <option value="Medio Físico: Legajadores AZ; Medio Digital: Carpeta Informatica">Medio Físico: Legajadores AZ; Medio Digital: Carpeta Informatica</option>
      <option value="Medio Físico: Carpetas; Medio Digital: Backup">Medio Físico: Carpetas; Medio Digital: Backup</option>
      <option value="Medio Físico: Fólder; Medio Digital: Backup">Medio Físico: Fólder; Medio Digital: Backup</option>
      <option value="Medio Físico: Legajadores AZ; Medio Digital: Backup">Medio Físico: Legajadores AZ; Medio Digital: Backup</option>
   </select>

</div>
<div class="col-lg-6">
   <label for="gdhv_ubicacion_reg">Ubicacion del registro</label>
   <input type="text" name="gdhv_ubicacion_reg" id="gdhv_ubicacion_reg" class="form-control" value="{{{ isset($hv) ? $hv->gdhv_ubicacion_reg : '' }}}">
</div>
</div>

<div class="row">
<div class="col-lg-4">
   <label for="gdhv_ret_gestion">T. RETENCIÓN - ARCHIVO DE GESTIÓN</label>
   <select name="gdhv_ret_gestion" id="gdhv_ret_gestion" class="form-control">
      <option value="" selected disabled>Seleccione...</option>
      <option value="Duración del proyecto">Duración del proyecto</option>
      <option value="Permanente: Tiempo indefinido">Permanente: Tiempo indefinido</option>
      <option value="Temporal: un (1) anio">Temporal: un (1) Año</option>
      <option value="Temporal: un (2) anios">Temporal: un (2) Años</option>
      <option value="Temporal: un (3) anios">Temporal: un (3) Años</option>
      <option value="Temporal: un (4) anios">Temporal: un (4) Años</option>
      <option value="N/A">N/A</option>
   </select>
</div>
<div class="col-lg-4">
   <label for="gdhv_ret_inactivo">T. RETENCIÓN - ARCHIVO INACTIVO</label>
   <select name="gdhv_ret_inactivo" id="gdhv_ret_inactivo" class="form-control">
      <option value="" selected disabled>Seleccione...</option>
      <option value="N/A">N/A</option>
      <option value="Destrucción">Destrucción</option>
      <option value="Permanente: Tiempo Indefinido">Permanente: Tiempo Indefinido</option>
      <option value="Un (1) anio">Un (1) año</option>
      <option value="Dos (2) anios">Dos (2) años</option>
      <option value="Tres (3) anios">Tres (3) años</option>
      <option value="Cuatro (4) anios">Cuatro (4) años</option>
      <option value="Cinco (5) anios">Cinco (5) años</option>
      <option value="Diez (10) anios">Diez (10) años</option>
      <option value="Veinte (20) anios">Veinte (20) años</option>
   </select>
</div>
<div class="col-lg-4">
   <label for="gdhv_ret_muerto">T. RETENCIÓN - ARCHIVO MUERTO</label>
   <select name="gdhv_ret_muerto" id="gdhv_ret_muerto" class="form-control">
      <option value="" selected disabled>Seleccione...</option>
      <option value="N/A">N/A</option>
      <option value="Destrucción">Destrucción</option>
      <option value="Permanente: Tiempo Indefinido">Permanente: Tiempo Indefinido</option>
      <option value="Un (1) anio">Un (1) año</option>
      <option value="Dos (2) anios">Dos (2) años</option>
      <option value="Tres (3) anios">Tres (3) años</option>
      <option value="Cuatro (4) anios">Cuatro (4) años</option>
      <option value="Cinco (5) anios">Cinco (5) años</option>
      <option value="Diez (10) anios">Diez (10) años</option>
      <option value="Veinte (20) anios">Veinte (20) años</option>
   </select>
   
</div>
</div>

</div><!-- div10 -->

<div class="col-lg-2"> <br>
   <a href="{{ url('admin/hv_doc') }}" class="btn btn-primary btn-block">
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


</section>
@stop



@section('script')
<script type="text/javascript">

$(function() {
   $("#gdhv_origen option[value='{{{ isset($hv) ? $hv->gdhv_origen : '' }}}']").attr("selected",true);

   $("#gdhv_med_almacenamiento option[value='{{{ isset($hv) ? $hv->gdhv_med_almacenamiento : '' }}}']").attr("selected",true);

   $("#gdhv_med_proteccion option[value='{{{ isset($hv) ? $hv->gdhv_med_proteccion : '' }}}']").attr("selected",true);

   $("#gdhv_ret_gestion option[value='{{{ isset($hv) ? $hv->gdhv_ret_gestion : '' }}}']").attr("selected",true);

   $("#gdhv_ret_inactivo option[value='{{{ isset($hv) ? $hv->gdhv_ret_inactivo : '' }}}']").attr("selected",true);

   $("#gdhv_ret_muerto option[value='{{{ isset($hv) ? $hv->gdhv_ret_muerto : '' }}}']").attr("selected",true);


   
});

</script>
@stop
