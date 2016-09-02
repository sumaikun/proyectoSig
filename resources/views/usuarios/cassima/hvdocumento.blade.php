@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'cassima'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'cassima'))
@stop



@section('contenido')
<h3 class="page-header"><i class="fa fa-pencil-square-o"></i> Actualizar HV Documentos <small>PortalSIG</small></h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>



   
<div class="col-lg-7">

<div class="ocultar_450px">
   <div class="panel-group" id="accordion">
      @foreach ($categorias as $cat)
      <div class="panel panel-default">
         <div class="panel-heading">
            <h4 class="panel-title">
               <a data-toggle="collapse" data-parent="#accordion" href="#{{ $cat->gdcat_id.'colla' }}"><i class="fa fa-folder-open-o"></i>
               </span> {{ ucwords ($cat->gdcat_nombre) }}</a> 
               <!-- <i class="fa fa-trash-o pull-right text-danger"></i>
               <i class="fa fa-pencil-square-o pull-right text-warning"></i> -->
            </h4>
         </div>
         <div id="{{ $cat->gdcat_id.'colla' }}" class="panel-collapse collapse"> <!-- aqui va el in para desplegar -->
            <ul class="list-group">
            @foreach ($subcategorias as $sub)
               @if($cat->gdcat_id == $sub->gdcat_id)
               <li class="list-group-item">
                  <i class="fa fa-angle-double-right"></i>
                  <a data-toggle="collapse" data-parent="#accordion1" href="#{{ $sub->gdsub_id.'subcolla' }}" class="text-danger"> {{ $sub->gdsub_nombre }} </a>
                  <!-- <input id="{{$sub->gdsub_id}}b" type="checkbox" class="pull-right" onclick="checkbox_nodos({{$sub->gdsub_id}})" /> -->
                  
                  <div id="{{ $sub->gdsub_id.'subcolla' }}" class="panel-collapse collapse">
                  <ul class="list-unstyled">
                  @foreach ($documentos as $doc)
                     @if($sub->gdsub_id == $doc->gdsub_id)
                     <li class="correte list-group-item">
                        <input type="radio" name="documento" class="documento" id="{{$doc->gddoc_id}}" value="{{$doc->gddoc_id}}" onclick="buscar_info_doc({{$doc->gddoc_id}})">
                        <label for="{{$doc->gddoc_id}}">{{$doc->gddoc_identificacion." ".$doc->gdver_descripcion }}</label>
                        <a href="#" onclick="editar_hv({{$doc->gddoc_id}})"><i class="fa fa-pencil-square-o pull-right" style="margin-right:15px;"></i></a>
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

</div>





<div class="col-lg-5">

<div class="panel panel-default">
   <div class="panel-heading"><i class="fa fa-info-circle"></i> Información del documento</div>
      <!-- <div class="panel-body">
         <p>...</p>
      </div> -->
 
      <ul class="list-group">
         <li class="list-group-item"><strong>Origen: </strong><span id="origen"></span></li>
         <li class="list-group-item"><strong>Revisado Por: </strong><span id="rev"></span></li>
         <li class="list-group-item"><strong>Aprobado Por: </strong><span id="aprob"></span></li>
         <li class="list-group-item"><strong>Cambio: </strong><span id="cambio"></span></li>
         <li class="list-group-item"><strong>Disposición de obsoletos: </strong><span id="disop"></span></li>
         <li class="list-group-item"><strong>Responsable de la custodia: </strong><span id="custodia"></span></li>
         <li class="list-group-item"><strong>Medio de almacenamiento: </strong><span id="medalmace"></span></li>
         <li class="list-group-item"><strong>Medio de proteccion del registro: </strong><span id="mdpro"></span></li>
         <li class="list-group-item"><strong>Ubicación del registro: </strong><span id="ubreg"></span></li>
         <li class="list-group-item"><strong>Tiempo de retención - Archivo de gestión: </strong><span id="retgest"></span></li>
         <li class="list-group-item"><strong>Tiempo de retención - Archivo Inactivo: </strong><span id="retinact"></span></li>
         <li class="list-group-item"><strong>Tiempo de retención - Archivo Muerto: </strong><span id="retmuerto"></span></li>
         
      </ul>
</div>

</div>








<div class="modal fade" tabindex="-1" id="editor" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-text-o"></i> HV Documento</h4>
         </div>

<form action="save_hv_doc" onsubmit="return validar()" method="post" name="save_hv" id="save_hv">

<input type="hidden" name="gddoc_id" id="gddoc_id">

<div class="modal-body">
            
<div class="row">
<div class="col-lg-3">
   <label for="gddoc_identificacion">Identificación</label>
   <input type="text" name="gddoc_identificacion" id="gddoc_identificacion" class="form-control input-sm ignore" readOnly="true">
</div>
<div class="col-lg-5">
   <label for="gdver_descripcion">Nombre</label>
   <input type="text" name="gdver_descripcion" id="gdver_descripcion" class="form-control input-sm ignore" readOnly="true">
</div>
<div class="col-lg-1">
   <label for="gdver_version">Version</label>
   <input type="text" name="gdver_version" id="gdver_version" class="form-control text-center ignore" readOnly="true">
</div>
<div class="col-lg-3">
   <label for="gdver_fecha_version">Fecha Version</label>
   <input type="date" name="gdver_fecha_version" id="gdver_fecha_version" class="form-control input-sm ignore" readOnly="true">
</div>
</div>

<div class="divider" style="border-top: 2px solid gray; margin: 5px 0px;"></div>

<div class="row">
<div class="col-lg-2">
   <label for="gdhv_origen">Origen</label>
   <select name="gdhv_origen" id="gdhv_origen" class="form-control input-sm" required="true">
      <option value="" selected disabled>Seleccione...</option>
      <option value="INTERNO">INTERNO</option>
      <option value="EXTERNO">EXTERNO</option>
   </select>
</div>
<div class="col-lg-5">
   <label for="gdhv_revisado_por">Revisado Por</label>
   <input type="text" name="gdhv_revisado_por" id="gdhv_revisado_por" class="form-control input-sm">
</div>
<div class="col-lg-5">
   <label for="gdhv_aprobado_por">Aprobado Por</label>
   <input type="text" name="gdhv_aprobado_por" id="gdhv_aprobado_por" class="form-control input-sm">
</div>
</div>
   
<div class="row">
   <div class="col-lg-12">
      <label for="gdhv_detalle_cambio">Descripcion del cambio</label>
      <textarea class="form-control input-sm" name="gdhv_detalle_cambio" id="gdhv_detalle_cambio" rows="3"></textarea>
   </div>
</div>

<div class="row">
<div class="col-lg-12">
   <label for="gdhv_disp_obsoletos">DISPOSICIÓN DE OBSOLETOS</label>
   <input type="text" name="gdhv_disp_obsoletos" id="gdhv_disp_obsoletos" class="form-control input-sm">
</div>
</div>

<div class="divider" style="border-top: 2px solid gray; margin: 5px 0px;"></div>

<h4><i class="fa fa-inbox"></i> RECUPERACIÓN DE REGISTROS (Esta sección solo aplica para formatos)</h4> <br>
<div class="row">
<div class="col-lg-3">
   <label for="gdhv_custodia">Responsable de la custodia</label>
   <input type="text" name="gdhv_custodia" id="gdhv_custodia" class="form-control input-sm">
</div>
<div class="col-lg-3">
   <label for="gdhv_med_almacenamiento">Medio de almacenamiento</label>
   <select name="gdhv_med_almacenamiento" id="gdhv_med_almacenamiento" class="form-control input-sm">
      <option value="" selected disabled>Seleccione...</option>
      <option value="FíSICO">FíSICO</option>
      <option value="DIGITAL">DIGITAL</option>
      <option value="FíSICO/DIGITAL">FíSICO/DIGITAL</option>
   </select>
</div>
<div class="col-lg-3">
   <label for="gdhv_med_proteccion">Medio de protec. registro</label>
   <select name="gdhv_med_proteccion" id="gdhv_med_proteccion" class="form-control input-sm">
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
<div class="col-lg-3">
   <label for="gdhv_ubicacion_reg">Ubicacion del registro</label>
   <input type="text" name="gdhv_ubicacion_reg" id="gdhv_ubicacion_reg" class="form-control input-sm">
</div>
</div>

<div class="row">
<div class="col-lg-4">
   <label for="gdhv_ret_gestion">T. Retención - Archivo de Gestión</label>
   <select name="gdhv_ret_gestion" id="gdhv_ret_gestion" class="form-control input-sm">
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
   <label for="gdhv_ret_inactivo">T. Retención - Archivo Inactivo</label>
   <select name="gdhv_ret_inactivo" id="gdhv_ret_inactivo" class="form-control input-sm">
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
   <label for="gdhv_ret_muerto">T. Retención - Archivo Muerto</label>
   <select name="gdhv_ret_muerto" id="gdhv_ret_muerto" class="form-control input-sm">
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

</div>
         
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
         </div>

</form>

      </div>
   </div>
</div>
    

@stop



@section('script')
<script type="text/javascript">

function validar(){
   on_preload();
   return true;
}

function editar_hv(gddoc_id){

   $.post("buscar_hv_doc",{gddoc_id:gddoc_id},function(data){
   

         if(data.hvdoc==null){
            $('#save_hv').each (function(){ this.reset(); });

            $("#gddoc_identificacion").val(data.doc.gddoc_identificacion); 
            $("#gdver_descripcion").val(data.version.gdver_descripcion); 
            $("#gdver_version").val(data.version.gdver_version);
            $("#gdver_fecha_version").val(data.version.gdver_fecha_version); 
            $("#gddoc_id").val(gddoc_id);

            $('#editor').modal('show');
         }else{

            $("#gddoc_identificacion").val(data.doc.gddoc_identificacion); 
            $("#gdver_descripcion").val(data.version.gdver_descripcion); 
            $("#gdver_version").val(data.version.gdver_version);
            $("#gdver_fecha_version").val(data.version.gdver_fecha_version); 
            $("#gddoc_id").val(gddoc_id);

            $("#gdhv_origen").val(data.hvdoc.gdhv_origen); 
            $("#gdhv_revisado_por").val(data.hvdoc.gdhv_revisado_por); 

            $("#gdhv_aprobado_por").val(data.hvdoc.gdhv_aprobado_por); 
            $("#gdhv_detalle_cambio").val(data.hvdoc.gdhv_detalle_cambio); 
            $("#gdhv_disp_obsoletos").val(data.hvdoc.gdhv_disp_obsoletos); 
            $("#gdhv_custodia").val(data.hvdoc.gdhv_custodia); 
            $("#gdhv_med_almacenamiento").val(data.hvdoc.gdhv_med_almacenamiento); 
            $("#gdhv_med_proteccion").val(data.hvdoc.gdhv_med_proteccion); 
            $("#gdhv_ubicacion_reg").val(data.hvdoc.gdhv_ubicacion_reg); 
            $("#gdhv_ret_gestion").val(data.hvdoc.gdhv_ret_gestion); 
            $("#gdhv_ret_inactivo").val(data.hvdoc.gdhv_ret_inactivo); 
            $("#gdhv_ret_muerto").val(data.hvdoc.gdhv_ret_muerto); 

            $('#editor').modal('show');
         }
   });

}

function buscar_info_doc(gddoc_id){
   
   $.post("buscar_hv_doc",{gddoc_id:gddoc_id},function(data){

      if(data.hvdoc==null){

         $("#origen").html(''); 
         $("#rev").html('');
         $("#aprob").html(''); 
         $("#cambio").html(''); 
         $("#disop").html(''); 
         $("#custodia").html(''); 
         $("#medalmace").html(''); 
         $("#mdpro").html(''); 
         $("#ubreg").html(''); 
         $("#retgest").html(''); 
         $("#retinact").html(''); 
         $("#retmuerto").html(''); 

      }else{
      
         $("#origen").html(data.hvdoc.gdhv_origen); 
         $("#rev").html(data.hvdoc.gdhv_revisado_por); 
         $("#aprob").html(data.hvdoc.gdhv_aprobado_por); 
         $("#cambio").html(data.hvdoc.gdhv_detalle_cambio); 
         $("#disop").html(data.hvdoc.gdhv_disp_obsoletos); 
         $("#custodia").html(data.hvdoc.gdhv_custodia); 
         $("#medalmace").html(data.hvdoc.gdhv_med_almacenamiento); 
         $("#mdpro").html(data.hvdoc.gdhv_med_proteccion); 
         $("#ubreg").html(data.hvdoc.gdhv_ubicacion_reg); 
         $("#retgest").html(data.hvdoc.gdhv_ret_gestion); 
         $("#retinact").html(data.hvdoc.gdhv_ret_inactivo); 
         $("#retmuerto").html(data.hvdoc.gdhv_ret_muerto); 

         
         
         
      }

   });

}

</script>
@stop
