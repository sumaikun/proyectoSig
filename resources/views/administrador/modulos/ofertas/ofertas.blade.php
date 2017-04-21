@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'modulos'))
@stop

@section('css')
  {{ HTML::style('general/css/mail.css') }}
@stop
 
@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-search"></i> Ofertas SIG <small>Administrador Portalsig</small></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/ofertas_sig') }}"><i class="fa fa-book"></i> Ofertas SIG</a></li>
      <li class="active">Inicio</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">





<nav class="navbar navbar-default" role="navigation">
	<!-- <div class="container"> -->
   
   	<div class="navbar-header">
      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span>
 				<span class="icon-bar"></span>
 				<span class="icon-bar"></span>
 				<span class="icon-bar"></span>
			</button>
      </div>
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      	<div class="btn-compose pull-left">
         	<a href="#compose" class="btn btn-danger btn-block navbar-btn" role="tab" data-toggle="tab"> <i class="fa fa-plus"></i> Nueva Oferta</a>
         </div>
         <ul class="nav navbar-nav">
         	<li><a href="#tab1" role="tab" data-toggle="tab">Historial</a></li>
            <!-- <li><a href="#tab2" role="tab" data-toggle="tab">Cotactos</a></li> -->
            <!-- <li><a href="#tab3" role="tab" data-toggle="tab">Centro de costo</a></li> -->
            <!-- <li><a href="#trash" role="tab" data-toggle="tab">opcion 2</a></li> -->
         </ul>
      </div>
        
   <!-- </div> -->
   
</nav>


<div class="tab-content ocultar">

<div class="tab-pane active" id="tab1">
	<div class="content-container clearfix">
   	<div class="col-md-12">
         <h4 class="content-title">CONSECUTIVOS OFERTAS SIG</h4>
         
        	<form action="ofertas" name="form2" id="form2" method="post">
         
         <div class="row">
            <div class="col-lg-8">
               <div class="form-group">
                  <input type="search" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar" class="form-control mail-search" autocomplete="off"/>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <select name="anio_ofertas" id="anio_ofertas" class="form-control" onchange="javascript: this.form.submit();">
                     @for ($i = 2015; $i <= date('Y'); $i++)
                         <option value="{{$i}}" @if($i == Session::get('anio_ofertas')) {{'selected'}} @endif>{{{$i}}}</option>
                     @endfor
                  </select>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <a class="btn btn-success btn-block" href="{{ url('admin/exportar_ofertas') }}"/>
                     <i class="fa fa-file-excel-o"></i> Exportar
                  </a>
               </div>
            </div>
         </div>

         </form>

         <style>
           td {
                max-width: 250px;
                white-space: nowrap;
               text-overflow: ellipsis;
               overflow: hidden;    
              }
         </style>

         <div class="table-responsive">   
         <table class="table table-condensed table-hover table-bordered" id="dev-table">
         	<thead>
            	<tr class="active">
            		<th class="last"></th>
            		<th class="last">Fecha</th>
                  <th class="last">Ofertado por</th>
            		<th class="last">Consecutivo</th>
            		<th class="last">Cliente</th>
            		<th class="last">Concepto</th>
            		<th class="last">Orfeta Remplazo</th>
            		<th class="last">Valor Inicial</th>
            		<th class="last">Moneda</th>
            		<th class="last">Ultimo Vr Cotizado</th>
            		<th class="last">Resultado</th>
            		<th class="last">Factura SIG</th>
            		<th class="last">Valor Factura</th>
            		<th class="last">Archivo</th>
                  <th class="last"></th>
            	</tr>
            </thead>
            <tbody>
            @foreach ($ofertas as $oferta)
					<tr>
						<td class="last"><a href="#" onclick="editar_reg({{$oferta->geofer_id}})"><i class="fa fa-pencil-square-o"></i></a></td>
						<td class="last">{{$oferta->created_at->format('Y-m-d')}}</td>
                  <td> {{$oferta->facturadoras->nombre}} </td>
						<td class="last">{{$oferta->geofer_consecutivo}}</td>
						<td onclick="big_text_edit(this)" onblur="big_text_edit_over(this)">{{$oferta->geofer_cliente}}</td>
						<td onclick="big_text_edit(this)" onblur="big_text_edit_over(this)">{{$oferta->geofer_concepto}}</td>
						<td class="last">{{$oferta->geofer_reemplazo}}</td>
						<td class="last" align="right">@if($oferta->geofer_valor_inicial!=0){{psig\Helpers\Metodos::asDollars($oferta->geofer_valor_inicial)}}@endif</td>
						<td class="last">{{$oferta->geofer_moneda}}</td>
						<td class="last" align="right">@if($oferta->geofer_ult_valor_cot!=0){{psig\Helpers\Metodos::asDollars($oferta->geofer_ult_valor_cot)}}@endif</td>
						<td class="last">{{$oferta->geofer_resultado}}</td>
						<td class="last">{{$oferta->geofer_fact_sig}}</td>
						<td class="last" align="right">@if($oferta->geofer_val_factura!=0){{psig\Helpers\Metodos::asDollars($oferta->geofer_val_factura)}}@endif</td>
						<td class="last" align="right"><a href="download_file/{{$oferta->archivo}}"><button class="btn btn-sm btn-warning">Descargar</button></a></td>                  
                  <td class="last"><a href="#" onclick="editar_reg({{$oferta->geofer_id}})"><i class="fa fa-pencil-square-o"></i></a></td>
					</tr>
            @endforeach
            </tbody>
         </table>
         </div>

      </div>
   </div>
</div>

<div class="tab-pane" id="compose">
   <div class="content-container clearfix">
      <div class="col-md-12">
   	<h4 class="content-title">NUEVA OFERTA</h4>
   	<form action="save_oferta" enctype="multipart/form-data" name="form1" id="form1" method="post">
   		
   	
         <div class="row">
         	
         	<div class="col-lg-3">
               <div class="form-group">
               	<label for="created_at">Fecha:</label>
               	<input type="date" name="created_at" id="created_at" class="form-control input-sm text-center" value="{{date('Y-m-d')}}" placeholder="Asunto" required>
               </div>
            </div>

            <div class="col-lg-5">
               <div class="form-group">
               	<label for="usu_id">Usuario que simula la operación</label>
               	<select name="usu_id" id="usu_id" class="form-control" required>
               		<option value="" disabled selected>Seleccione...</option>
               		@foreach($usuarios as $usuario)
						<option value="{{{$usuario->usu_id}}}">{{{$usuario->usu_nombres." ".$usuario->usu_apellido1}}}</option>
               		@endforeach
               	</select>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
                  <label for="usu_id">Factura por</label>
                  <select name="facturadora_id" id="facturadora_id" class="form-control" required>
                     <option value="" selected>Seleccione...</option>
                     @foreach($facturadoras as $key=>$value)
                        <option value={{$key}}>{{$value}}</option>
                     @endforeach                      
                  </select>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
                  <label for="usu_id">archivo</label>
                  <input type="file" name="archivo"  class="form-control input-sm text-center" >
               </div>
            </div>

         </div>

         <div class="row">

            <div class="col-lg-4">
               <div class="form-group">
               	<label for="geofer_cliente">Cliente:</label>
               	<input type="text" name="geofer_cliente" id="geofer_cliente" class="form-control input-sm" placeholder="Cliente" required>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="form-group">
               	<label for="geofer_concepto">Concepto:</label>
               	<input type="text" name="geofer_concepto" id="geofer_concepto" class="form-control input-sm" placeholder="Concepto" required>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="form-group list-inline">

               	<label for="geofer_reemplazo">Oferta Remplazo:</label>
               	<!-- <input type="text" name="geofer_reemplazo" id="geofer_reemplazo" class="form-control input-sm" placeholder="Reemplazo"> -->
                  
                  <div class="row">
                     <div class="col-lg-5">
                        <select name="ani_consecutivos" id="ani_consecutivos" class="form-control" onchange="javascript: buscar_consecutivos('geofer_reemplazo', this.value);">
                              <option value="" disabled selected>Seleccione...</option>
                           @for ($i = 2015; $i <= date('Y'); $i++)
                              <option value="{{$i}}">{{{$i}}}</option>
                           @endfor
                        </select>
                     </div>
                     <div class="col-lg-7">
                        <select name="geofer_reemplazo" id="geofer_reemplazo" class="form-control pull-right">
                           <option value="" disabled="true" selected="true">Seleccione...</option>
                        </select>
                     </div>
                  </div>
                  
               </div>
            </div>

         </div>

         <div class="row">
         	
         	<div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_valor_inicial">Valor Inicial:</label>
               	<input type="number" name="geofer_valor_inicial" id="geofer_valor_inicial" class="form-control input-sm" placeholder="12019223">
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_moneda">Moneda:</label>
               	<select name="geofer_moneda" id="geofer_moneda"  class="form-control input-sm">
               		<option value="" disabled="true" selected="true">Seleccione...</option>
               		<option value="COP">COP</option>
               		<option value="USD">USD</option>
               	</select>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_ult_valor_cot">Ultimo Vr Cotizado:</label>
               	<input type="number" name="geofer_ult_valor_cot" id="geofer_ult_valor_cot" class="form-control input-sm" placeholder="12019223">
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_resultado">Resultado:</label>
               	<select name="geofer_resultado" id="geofer_resultado"  class="form-control input-sm">
               		<option value="" disabled="true" selected="true">Seleccione...</option>
               		<option value="SI">SI</option>
               		<option value="NO">NO</option>
               		<option value="REM">REM</option>
               	</select>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_fact_sig">Factura SIG:</label>
               	<input type="text" name="geofer_fact_sig" id="geofer_fact_sig" class="form-control input-sm" placeholder="12019223">
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_val_factura">Valor Factura:</label>
               	<input type="number" name="geofer_val_factura" id="geofer_val_factura" class="form-control input-sm" placeholder="12019223">
               </div>
            </div>

         </div>

         <div class="row">
         	<div class="col-lg-12">
         		<div class="form-group">
						<button type="submit" class="btn btn-success btn-block"><i class="fa fa-floppy-o"></i> Guardar</button>
         		</div>
         	</div>
         </div>

      </form>

      </div>
   </div>
</div>

<!-- <div class="tab-pane" id="tab2">
   <div class="content-container clearfix">
      <div class="col-md-12">
         <h4 class="content-title">Gestionar Contactos</h4>
         
         Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci quaerat aliquid voluptatum ipsa saepe, rerum, debitis fugit soluta ex, consequatur nesciunt obcaecati error doloribus reiciendis provident molestiae animi quia nobis.

      </div>
   </div>
</div>

<div class="tab-pane" id="tab3">
   <div class="content-container clearfix">
      <div class="col-md-12">
         <h4 class="content-title">Centro de costo</h4>
         
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste odit deserunt at perspiciatis cumque sint architecto commodi, facilis non pariatur ea quasi eligendi necessitatibus quia in voluptatum natus impedit asperiores!
         
      </div>
   </div>     
</div>

<div class="tab-pane" id="trash">
      
           <div class="content-container clearfix">
               <div class="col-md-12">
                   <h1 class="content-title">Trash</h1>
                   
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis aliquid quisquam illo odit laborum voluptate vel rem facere, libero. Veritatis natus vitae, rerum ex deleniti repudiandae. Soluta minima in atque.
               </div>
           </div>
</div> -->

</div>






<div class="modal fade bs-example-modal-lg" id="modalid" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		
		<form action="update_oferta" name="form3" enctype="multipart/form-data" id="form3" method="post">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Registro</h4>
      </div>
      <div class="modal-body">

      	<input type="hidden" name="geofer_id_upd" id="geofer_id_upd" value="">
        			
			<div class="row">
         	
         	<div class="col-lg-3">
               <div class="form-group">
               	<label for="created_at_upd">Fecha:</label>
               	<input type="date" name="created_at_upd" id="created_at_upd" class="form-control input-sm text-center" required>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="usu_id">Factura por</label>
                  <select name="facturadora_id" id="facturadora_id_upd" class="form-control" required>
                     <option value="" selected>Seleccione...</option>
                     @foreach($facturadoras as $key=>$value)
                        <option value={{$key}}>{{$value}}</option>
                     @endforeach                      
                  </select>
               </div>
            </div>

            <div class="col-lg-5">
               <div class="form-group">
                  <label for="usu_id">archivo</label>
                  <input type="file" name="archivo"  class="form-control input-sm text-center"  >
               </div>
            </div>

         </div>

         <div class="row">

            <div class="col-lg-5">
               <div class="form-group">
               	<label for="geofer_cliente_upd">Cliente:</label>
               	<input type="text" name="geofer_cliente_upd" id="geofer_cliente_upd" class="form-control input-sm" placeholder="Cliente" required>
               </div>
            </div>

            <div class="col-lg-5">
               <div class="form-group">
               	<label for="geofer_concepto_upd">Concepto:</label>
               	<input type="text" name="geofer_concepto_upd" id="geofer_concepto_upd" class="form-control input-sm" placeholder="Concepto" required>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group list-inline">
                  <label for="geofer_reemplazo_upd">Oferta Remplazo:</label>
                  <input type="text" name="geofer_reemplazo_upd" id="geofer_reemplazo_upd" class="form-control input-sm" placeholder="Reemplazo">
               </div>
            </div>

         </div>

         <div class="row">
         	
         	<div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_valor_inicial_upd">Valor Inicial:</label>
               	<input type="number" name="geofer_valor_inicial_upd" id="geofer_valor_inicial_upd" class="form-control input-sm" placeholder="12019223">
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_moneda_upd">Moneda:</label>
               	<select name="geofer_moneda_upd" id="geofer_moneda_upd"  class="form-control input-sm">
               		<option value="" disabled="true" selected="true">Seleccione...</option>
               		<option value="COP">COP</option>
               		<option value="USD">USD</option>
               	</select>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_ult_valor_cot_upd">Ult Vr Cot:</label>
               	<input type="number" name="geofer_ult_valor_cot_upd" id="geofer_ult_valor_cot_upd" class="form-control input-sm" placeholder="12019223">
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_resultado_upd">Resultado:</label>
               	<select name="geofer_resultado_upd" id="geofer_resultado_upd" class="form-control input-sm">
               		<option value="" disabled="true" selected="true">Seleccione...</option>
               		<option value="SI">SI</option>
               		<option value="NO">NO</option>
               		<option value="REM">REM</option>
               	</select>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_fact_sig_upd">Factura SIG:</label>
               	<input type="text" name="geofer_fact_sig_upd" id="geofer_fact_sig_upd" class="form-control input-sm" placeholder="12019223">
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
               	<label for="geofer_val_factura_upd">Valor Factura:</label>
               	<input type="number" name="geofer_val_factura_upd" id="geofer_val_factura_upd" class="form-control input-sm" placeholder="12019223">
               </div>
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




 

</section>
@stop



@section('script')

<script type="text/javascript">

$(function(){
var d = new Date();
var n = d.getFullYear();

$('#ani_consecutivos option[value='+n+']').attr('selected', 'selected');
buscar_consecutivos('geofer_reemplazo',n);

});



function buscar_consecutivos(idobject,anio){
   $.post("buscar_consecutivos_anio",{anio:anio},function(data){

      $("option", '#'+idobject).remove();
      $('#'+idobject).append('<option value="" selected disabled>Seleccione</option>');
      $.each(data, function(i, value) {
-           $('#'+idobject).append('<option value="'+value.geofer_consecutivo+'">'+value.geofer_consecutivo+'</option>');
      });
      //$('#'+idobject).selectmenu("refresh", true);

   });
}


function editar_reg(geofer_id){

	$.post("buscar_una_oferta",{geofer_id:geofer_id},function(data){
    	
    	console.log(data);
    	
    	
    	$('#geofer_id_upd').val(data.geofer_id);

    	var fecha = data.created_at.split(' ');
    	$('#created_at_upd').val(fecha[0]);
    	$('#geofer_cliente_upd').val(data.geofer_cliente);
    	$('#geofer_cliente_upd').val(data.geofer_cliente);
    	$('#geofer_concepto_upd').val(data.geofer_concepto);
    	$('#geofer_reemplazo_upd').val(data.geofer_reemplazo);
    	$('#geofer_valor_inicial_upd').val(data.geofer_valor_inicial);
    	$('#geofer_moneda_upd').val(data.geofer_moneda);
    	$('#geofer_ult_valor_cot_upd').val(data.geofer_ult_valor_cot);
    	$('#geofer_resultado_upd').val(data.geofer_resultado);
    	$('#geofer_fact_sig_upd').val(data.geofer_fact_sig);
    	$('#geofer_val_factura_upd').val(data.geofer_val_factura);
      $('#geofer_val_factura_upd').val(data.geofer_val_factura);
      $('#facturadora_id_upd').val(data.facturadora);

   });

	$('#modalid').modal('show');
}





// este codigo es para hacer filtros sobre la tabla
(function(){
    'use strict';
   var $ = jQuery;
   $.fn.extend({
      filterTable: function(){
         return this.each(function(){
            $(this).on('keyup', function(e){
               $('.filterTable_no_results').remove();
               var $this = $(this), search = $this.val().toLowerCase(), target = $this.attr('data-filters'), $target = $(target), $rows = $target.find('tbody tr');
               if(search == '') {
                  $rows.show(); 
               } else {
                  $rows.each(function(){
                     var $this = $(this);
                     $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                  })
                  if($target.find('tbody tr:visible').size() === 0) {
                     var col_count = $target.find('tr').first().find('td').size();
                     var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">Resultados 0</td></tr>')
                     $target.find('tbody').append(no_results);
                  }
               }
            });
         });
      }
   });
   $('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
   $('[data-action="filter"]').filterTable();
   
   $('.container').on('click', '.panel-heading span.filter', function(e){
      var $this = $(this), 
            $panel = $this.parents('.panel');
      
      $panel.find('.panel-body').slideToggle();
      if($this.css('display') != 'none') {
         $panel.find('.panel-body input').focus();
      }
   });
   $('[data-toggle="tooltip"]').tooltip();
})

function big_text_edit(elem){
   $("td").css("white-space","nowrap");
   $(elem).css("white-space","normal");
   
}

</script>
@stop
