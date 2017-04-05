@extends('usuarios.layouts.layout')


@section('barra_usuario')
  @include('usuarios.layouts.barra_usuario', array('op'=>'inicio'))
@stop


@section('menu_lateral')
  @include('usuarios.layouts.menu_lateral', array('op'=>'inicio'))
@stop


@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop


@section('contenido')


<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-puzzle-piece"></i> Reportes <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('usuario/actividades') }}"><i class="fa fa-puzzle-piece"></i> Actividades </a></li>
      <li class="active">Reportes</li>
    </ol>
    <!-- <hr> -->
</section>

<style>
  .td_hr{
    display: none;
  }
</style>   
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<div class="col-lg-12 ">
   <div class="panel panel-default">
 
      <div class="panel-heading">
        <input type="hidden" value="0" id="con"> 
        <button onclick="change_data()"><i class="fa fa-exchange" aria-hidden="true"></i></button>
        <a href="informes"><button style="float:right;" class="btn btn-success">Reportes de empresas</button></a>
        <br>
         <strong><i class="fa fa-list"></i> Reportes</strong>
          <form action='../actividades/reports'  method="post">
            <select name="year_list"  class="form-control" onchange="javascript: this.form.submit();">
                   @for ($i = 2015; $i <= date('Y'); $i++)
                      <option onclick=" validar()" value="{{$i}}" @if($i == $year) {{'selected'}} @endif>{{{$i}}}</option>
                  @endfor
            </select>
            <label>Usuarios</label>
            <select name="userid"  class="form-control" onchange="javascript: this.form.submit();">
                <option  value="0">Selecciona</option>
                <option  value="0">Sin filtros</option> 
                  @foreach ($users as $user)
                  <option onclick=" validar()" value="{{$user->id}}">{{$user->nombres}} {{$user->apellido}}</option>
                  @endforeach
            </select>
          </form>
          <table>
            <thead>               
                  <tr class="active">
                     <th style="width:73.33px;">Usuario</th>
                     <th style="width:96.67px;">Empresa</th>
                     <th id="h2_Ene">Ene</th>   
                     <th id="h2_Feb">Feb</th>
                     <th id="h2_Mar">Mar</th>
                     <th id="h2_Abr">Abr</th>
                     <th id="h2_May">May</th>
                     <th id="h2_Jun">Jun</th>
                     <th id="h2_Jul">Jul</th>
                     <th id="h2_Ago">Ago</th>
                     <th id="h2_Sep">Sep</th>
                     <th id="h2_Oct">Oct</th>
                     <th id="h2_Nov">Nov</th>
                     <th id="h2_Dic">Dic</th>
                     <th id="h2_Total">Total</th>
                
                  </tr>
               </thead>             
            </table>      
      </div>         
         <div class="table-responsive" style="max-width: 1100px !important; max-height: 400px;">
            <table class="table table-hover table-condensed">
               <thead>               
                  <tr class="active">
                     <th style="width:73.33px;"></th>
                     <th style="width:96.67px;"></th>
                     <th id="h1_Ene"></th>   
                     <th id="h1_Feb"></th>
                     <th id="h1_Mar"></th>
                     <th id="h1_Abr"></th>
                     <th id="h1_May"></th>
                     <th id="h1_Jun"></th>
                     <th id="h1_Jul"></th>
                     <th id="h1_Ago"></th>
                     <th id="h1_Sep"></th>
                     <th id="h1_Oct"></th>
                     <th id="h1_Nov"></th>
                     <th id="h1_Dic"></th>
                     <th id="h1_Total"></th>
                   
                  </tr>
               </thead>
               <tbody class="tb-activity ">
                @foreach($usuarios as $key => $value) 
                 <tr>
                   <td rowspan="{{count(psig\Helpers\Metodos::ent_reports($value->usuario))+1}}">{{psig\Helpers\Metodos::user_name($value->usuario)}}</td>                   
                 </tr>

                 @foreach(psig\Helpers\Metodos::ent_reports($value->usuario) as $empresa)
                 <tr>                   
                   <td> {{psig\Helpers\Metodos::ent_names($empresa->tp_empresa)}} </td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-01')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-01')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-02')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-02')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-03')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-03')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-04')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-04')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-05')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-05')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-06')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-06')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-07')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-07')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-08')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-08')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-09')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-09')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-10')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-10')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-11')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-11')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-12')}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::hr_month($value->usuario,$empresa->tp_empresa,$year.'-12')}}h</span></td>
                   <td> <span class="td_per">{{psig\Helpers\Metodos::cal_year($value->usuario,$empresa->tp_empresa,$year)}}%</span><span class="td_hr">{{psig\Helpers\Metodos::hr_year($value->usuario,$empresa->tp_empresa,$year)}}h</span></td>
                  
                 </tr>                                 
                 @endforeach
                <tr style="border-width: 5px Important; border-style: solid; ">
                  <td></td>
                  <td>Total horas</td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-01',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-01')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-02',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-02')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-03',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-03')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-04',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-04')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-05',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-05')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-06',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-06')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-07',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-07')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-08',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-08')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-09',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-09')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-10',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-10')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-11',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-11')}}h</span></td>
                  <td><span class="td_per">{{psig\Helpers\Metodos::avr_hr_month($value->usuario,$year.'-12',$year)}}%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_month($value->usuario,$year.'-12')}}h</span></td>               
                  <td><span class="td_per">100%</span><span class="td_hr" >{{psig\Helpers\Metodos::total_hr_year($value->usuario,$year)}}h</span></td>  
                </tr>
               @endforeach

               </tbody> 
                       
              
            </table>
       </div>
   </div>
</div>






</section>
@stop


@section('script')
<script type="text/javascript">

function change_data(){
  if($("#con").val()==0)
  {
    $(".td_hr").show();
    $(".td_per").hide();
    $("#con").val(1);   
  }
  else{
    $(".td_hr").hide();
    $(".td_per").show();
    $("#con").val(0);
  }
  
}


$( document ).ready(function() {
    $("#h2_Ene").width($("#h1_Ene").width()+20);
    $("#h2_Feb").width($("#h1_Feb").width()+20);
    $("#h2_Mar").width($("#h1_Mar").width()+20);
    $("#h2_Abr").width($("#h1_Abr").width()+20);
    $("#h2_May").width($("#h1_May").width()+20);
    $("#h2_Jun").width($("#h1_Jun").width()+20);
    $("#h2_Jul").width($("#h1_Jul").width()+20);
    $("#h2_Ago").width($("#h1_Ago").width()+20);
    $("#h2_Sep").width($("#h1_Sep").width()+20);
    $("#h2_Oct").width($("#h1_Oct").width()+20);
    $("#h2_Nov").width($("#h1_Nov").width()+20);
    $("#h2_Dic").width($("#h1_Dic").width()+20);
    $("#h2_Total").width($("#h1_Total").width())+20;
     
});

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
})



      function hide_empresas(){
        document.getElementsByClassName("tb-enterprise")[0].style.display = "none";
        document.getElementsByClassName("tb-activity")[0].style.display = "";
        document.getElementsByClassName("tb-data")[0].style.visibility = "visible";
         event.preventDefault();
      }

      function hide_actividades(){
        document.getElementsByClassName("tb-activity")[0].style.display = "none";
        document.getElementsByClassName("tb-enterprise")[0].style.display = "";
        document.getElementsByClassName("tb-data")[0].style.visibility = "visible"; 
         event.preventDefault(); 
      }

</script>
@stop
