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
               <i class="fa fa-plus-square-o"></i>Factura
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
                    <td><b>Señores</b></td>
                    <td id="pre_nombre" style="text-align:center" colspan="3"></td>
                  <tr>
                  </tr>
                    <td><b>Nit</b></td>
                    <td id="pre_nit"></td>
                    <td><b>Teléfono</b></td>
                    <td id="pre_telefono"></td>
                  <tr>
                  </tr>
                    <td><b>Dirección</b></td>
                    <td id="pre_direccion"></td>
                    <td><b>Ciudad</b></td>
                    <td id="pre_ciudad"></td>
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
              </table>
              </div>
            </div>
      
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>


</section>
@stop


@section('script')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
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

  $.get('factura_info/'+id, function(res, sta){

        $("#pre_inicio").append(res.fecha_elaboracion);
        $("#pre_final").append(res.fecha_vencimiento);
        $("#pre_reembolso").append('$'+res.reembolso);
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

</script>

@stop
