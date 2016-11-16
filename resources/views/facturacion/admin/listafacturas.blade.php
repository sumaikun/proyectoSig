@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'usuarios'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')

<!-- header de la pagina -->
<section class="content-header">
<style type="text/css">
 .ui-datepicker-calendar {
    display: none;
    }​
}
</style>
	<h1><i class="fa fa-plus-circle"></i> Facturas Registradas  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Facturas</a></li>
      <li class="active">registros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

   @include('facturacion.sub_views.list')


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Factura <span id="pre_cons" class="pull-right" style="font-weight: bold; color:red;"></span>
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">  
              <div class="col-lg-12">
               <table class="table table-bordered">
                <thead>
                 
                </thead>
                <tbody>
                  <tr>
                    <td><b>fecha</b></td>
                    <td id="pre_inicio"></td>
                    <td><b>vence</b></td>
                    <td id="pre_final"></td>
                  </tr>
                   <tr>
                    <td><b>Señores</b></td>
                    <td id="pre_nombre" style="text-align:center" colspan="3"></td>                 
                  </tr>
                    <td><b>Nit</b></td>
                    <td id="pre_nit"></td>
                    <td><b>Teléfono</b></td>
                    <td id="pre_telefono"></td>
                  <tr>
                    <td><b>Dirección</b></td>
                    <td id="pre_direccion"></td>
                    <td><b>Ciudad</b></td>
                    <td id="pre_ciudad"></td>
                  </tr>                    
                  <tr>
                    <td colspan="2" style="text-align:center;"><b>Descripción</b></td>
                    <td><b>Valor Unitario</b></td>
                    <td><b>Valor Total</b></td>
                  </tr>
                  <tr>
                    <td rowspan="7" id="pre_desc" style="font-size: 85%; max-width: 550px;" colspan="2"></td>
                    <td id="pre_valor"></td>
                    <td id="pre_mult"></td>
                  </tr>  
                  <tr>                  
                    <td><b>Ingresos que generan iva</b></td>
                    <td id="pre_iva"></td>                
                  </tr>
                  <tr>                  
                    <td><b>Ingresos que no generan iva</b></td>
                    <td id="pre_noiva"></td>                
                  </tr>
                  <tr>                  
                    <td><b>Reembolsados de gastos no generadores de iva</b></td>
                    <td id="pre_reembolso"></td>                
                  </tr>
                  <tr>                  
                    <td><b>Subtotal</b></td>
                    <td id="pre_subtotal">$</td>                
                  </tr>
                  <tr>                  
                    <td><b>Iva</b></td>
                    <td id="pre_valoriva"></td>                
                  </tr>
                  <tr>                  
                    <td><b>Total</b></td>
                    <td id="pre_total"></td>                
                  </tr>
                </tbody>
                <strong>Cuenta a pagar:</strong>
                <div id="pre_pagar"></div>
              </table>
              </div>
            </div>
            <span id="title_status" style="font-weight: bold; color:red;"></span>
              <div id="detail_status"></div>        
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal2 -->
 <form name="form1" id="form1" class='form_factura' action="" onsubmit="return validar()" method="post" enctype="multipart/form-data">
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">  
              <div class="col-lg-12">
                <div id="ajax-content"></div>
              </div>
            </div>
      
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>     
   </div>
</div>
</form>

<!-- Modal3 -->
 <form name="form1" id="form2" class='form_factura' action="" onsubmit="return validar()" method="post" enctype="multipart/form-data">
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>
            </h4>
         </div>
         <div class="modal-body">
         
            <div class="row">  
              <div class="col-lg-12">
                <div id="ajax-content-2"></div>
              </div>
            </div>
      
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>     
   </div>
</div>
</form>
</section>
@stop


@section('script')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">


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
                     var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
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
});



function grab_data(id){
 // console.log('estes es el id '+id);
        $("#pre_nit").empty();
        $("#pre_nombre").empty();
        $("#pre_direccion").empty();
        $("#pre_telefono").empty();
        $("#pre_ciudad").empty();
        $("#pre_inicio").empty();
        $("#pre_final").empty();
        $("#pre_reembolso").empty();
        $("#pre_iva").empty();
        $("#pre_noiva").empty();
        $("#pre_subtotal").empty();
        $("#pre_valoriva").empty();
        $("#pre_total").empty();
        $("#pre_desc").empty();
        $("#pre_cons").empty();
        $("#pre_valor").empty();
        $("#pre_mult").empty();
        $("#pre_pagar").empty();
        $("#title_status").empty();
        $("#detail_status").empty();

  $.get('factura_info/'+id, function(res, sta){

        min_string = "  CONSECUTIVO "+res.consecutivo;
        $("#pre_cons").append(min_string);
        $("#pre_inicio").append(res.fecha_elaboracion);
        $("#pre_final").append(res.fecha_vencimiento);
        $("#pre_reembolso").append('$'+res.reembolso);
        $("#pre_pagar").append(res.banco.nombre+" "+res.cuenta.tipo+" "+res.cuenta.numero);
        if(res.soporte!=""){$("#pre_pagar").append(' '+'<a href="descargar_soporte/'+res.soporte+'" >Soporte</a>');}  
        
        //console.log('Descripción :'+res.descripcion);
        list_products(res.descripcion);

        if(res.status==1){
          $("#title_status").append('FACTURADA PAGADA'+'<BR>');
             $.get('pagada_info/'+res.id, function(res, sta){ $("#detail_status").append(res);neto();});
        }

        if(res.status==2){
          $("#title_status").append('FACTURA ANULADA'+'<BR>');
            $.get('anulada_info/'+res.id, function(res, sta){ $("#detail_status").append(res);});
        }
        //$("#pre_desc").append(content);
        //$("#pre_valor").append(content2);
        //$("#pre_mult").append(content3);
        $("#pre_iva").append('$'+res.con_iva);
        $("#pre_noiva").append('$'+res.sin_iva);
        subtotal = parseInt(res.con_iva)+parseInt(res.sin_iva)+parseInt(res.reembolso);
        $("#pre_subtotal").append('$'+subtotal);
        $("#pre_valoriva").append('$'+res.valor_iva);
        $("#pre_total").append('$'+res.total);

      $.get('cliente/'+res.cliente, function(res, sta){

        $("#pre_nit").append(res.nit);
        $("#pre_nombre").append(res.nombre);
        $("#pre_direccion").append(res.direccion);
        $("#pre_telefono").append(res.telefono);
        $("#pre_ciudad").append(res.ciudad);

      });

    });
}

function neto(){
  //console.log('rete fuente: '+($("#rete_fuente").html()).slice(1));
  retenciones = parseInt(($("#rete_fuente").html()).slice(1))+parseInt(($("#rete_ica").html()).slice(1))+parseInt(($("#rete_cree").html()).slice(1))+parseInt(($("#rete_otras").html()).slice(1));
  //console.log('retenciones '+retenciones);
  total = parseInt(($("#pre_total").html()).slice(1)) - retenciones;
  $("#pago_neto").append('$'+total);
}
 
function list_products(products){
  products_array = products.split("|");
  //console.log('tamaño '+products_array.length);
  size = (products_array.length-1);
  html = '<ul>';
  html2 = '<ul>';
  html3 = '<ul>';
  for(var i = 0 ; i<size ; i++)
  {
    
    product_array = products_array[i].split(",");
    html = html+'<li>'+product_array[0]+'</li>';
    html2 = html2+'<li>$'+product_array[2]+'</li>';
    html3 = html3+'<li>$'+(product_array[1]*product_array[2])+'</li>';

  }
  html = html + '</ul>';
  html2 = html2 + '</ul>';
  html3 = html3 + '</ul>';
  $("#pre_desc").append(html);
  $("#pre_valor").append(html2);
  $("#pre_mult").append(html3);
  //console.log('elementos :'+products_array[0]);
}
/*$(document).ready(function() {
$("#detail_bill").click(function(){
  //console.log("Estoy llegando");      
     /*if(event.target.value=="")
     {
      
     }
     else
     { 
      $.get(`cliente/${event.target.value}`, function(res, sta){
       // console.log(res);
        $("#pre_nit").append(res.nit);
        $("#pre_nombre").append(res.nombre);
        $("#pre_direccion").append(res.direccion);
        $("#pre_telefono").append(res.telefono);
        $("#pre_ciudad").append(res.ciudad);       
    });
  }*/
/*});

});*/ 
 function anular_pagar(status,id,type)
{
  $("#ajax-content").empty();

  if(status != 0)
  {
    return alert('No se puede modificar el estado de esta factura');
  }  

  if(type=='anular'){

   var ajax = $.get('anular_factura/'+id, function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','anular_factura/0');});
    

  }
  else if(type=='pagar'){

  var ajax = $.get('pagar_factura/'+id, function(res, sta){$("#ajax-content").append(res);});
   ajax.done(function(res, sta){$('#myModal2').modal(); $("#form1").attr('action','pagar_factura/0');});
  }
}

function editar_informacion(id,type)
{
  
  $('#myModal').hide();
  $("#ajax-content-2").empty();
  if(type=='pago')
  {var ajax = $.get('editar_pago/'+id, function(res, sta){$("#ajax-content-2").append(res);});
   ajax.done(function(res, sta){$('#myModal3').modal(); $("#form2").attr('action','editar_pago/0');});
  }
  else if(type=='anulado')
  {
    var ajax = $.get('editar_cancel/'+id, function(res, sta){$("#ajax-content-2").append(res);});
   ajax.done(function(res, sta){$('#myModal3').modal(); $("#form2").attr('action','editar_cancel/0');});
  }  
  
  //$('#myModal').modal();
}

function anexar_soporte(id)
{  
  $("#ajax-content-2").empty();
  var ajax = $.get('anexar_soporte/'+id, function(res, sta){$("#ajax-content-2").append(res);});
   ajax.done(function(res, sta){$('#myModal3').modal(); $("#form2").attr('action','anexar_soporte/0');});  
  
}

function validar(){
   if(!confirm("¿Esta seguro/a?")){
      return false;
   }
   return true;
}

</script>

@stop
