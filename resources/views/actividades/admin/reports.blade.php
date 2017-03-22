@extends('administrador.layouts.layout')

@section('menu')
    @include('administrador.layouts.menu', array('op'=>'cargos'))
@stop

@section('css')
   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')


<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-puzzle-piece"></i> Reportes <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-puzzle-piece"></i> Actividades </a></li>
      <li class="active">Reportes</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

<div class="row">

<div class="col-lg-12 ">
   <div class="panel panel-default">
 
      <div class="panel-heading">
         <strong><i class="fa fa-list"></i> Reportes</strong>
      </div>         
         <div class="table-responsive" style="max-width: 1100px !important; max-height: 500px;">
            <table class="table table-hover table-condensed" id="dev-table">
               <thead>
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
                  <tr class="active">
                     <th style="width:73.33px;">Usuario</th>
                     <th style="width:96.67px;">Empresa</th>
                     <th>Ene</th>   
                     <th>Feb</th>
                     <th>Mar</th>
                     <th>Abr</th>
                     <th>May</th>
                     <th>Jun</th>
                     <th>Jul</th>
                     <th>Ago</th>
                     <th>Sep</th>
                     <th>Oct</th>
                     <th>Nov</th>
                     <th>Dic</th>
                     <th>Total <br>General</th>
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
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-01')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-02')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-03')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-04')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-05')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-06')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-07')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-08')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-09')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-10')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-11')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_month($value->usuario,$empresa->tp_empresa,$year.'-12')}}</td>
                   <td> {{psig\Helpers\Metodos::cal_year($value->usuario,$empresa->tp_empresa,$year)}}</td>
                 </tr>                
                 @endforeach

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
