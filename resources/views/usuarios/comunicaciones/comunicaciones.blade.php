@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>''))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'comunicaciones'))
@stop

@section('css')
   {{ HTML::style('general/css/mail.css') }}
   {{ HTML::style('general/css/summernote.css') }}
@stop


@section('contenido')
<h3 class="page-header"><i class="fa fa-envelope-o"></i> Comunicaciones PRE <small>PortalSIG</small></h3>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>


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
         	<a href="#compose" class="btn btn-danger btn-block navbar-btn" role="tab" data-toggle="tab"> <span class="glyphicon glyphicon-pencil"></span> Nuevo</a>
         </div>
         <ul class="nav navbar-nav">
         	<li><a href="#tab1" role="tab" data-toggle="tab">Historial</a></li>
            <li><a href="#tab2" role="tab" data-toggle="tab">Cotactos</a></li>
            <li><a href="#tab3" role="tab" data-toggle="tab">Centro de costo</a></li>
            <!-- <li><a href="#trash" role="tab" data-toggle="tab">opcion 2</a></li> -->
         </ul>
      </div>
        
   <!-- </div> -->
   
</nav>


<div class="tab-content">

<div class="tab-pane active" id="tab1">
	<div class="content-container clearfix">
   	<div class="col-md-12">
         <h4 class="content-title">CONSECUTIVOS COMUNICACIONES A PACIFIC RUBIALES ENERGY</h4>
         
         <form action="comunicaciones" name="form2" id="form2" method="post">
         
         <div class="row">
            <div class="col-lg-8">
               <div class="form-group">
                  <input type="search" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filtrar" class="form-control mail-search" autocomplete="off"/>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <select name="anio_cc_consecutivo" id="anio_cc_consecutivo" class="form-control" onchange="javascript: this.form.submit();">
                     @for ($i = 2015; $i <= date('Y'); $i++)
                         <option value="{{$i}}" @if($i == Session::get('anio_cc_consecutivo')) {{'selected'}} @endif>{{{$i}}}</option>
                     @endfor
                  </select>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form-group">
                  <a class="btn btn-success btn-block" href="{{ url('usuario/exportar_cc') }}"/>
                     <i class="fa fa-file-excel-o"></i> Exportar
                  </a>
               </div>
            </div>
         </div>

         </form>
         
         <div class="table-responsive">   
         <table class="table table-condensed table-hover table-bordered" id="dev-table">
         	<thead>
            	<tr class="active">
            		<th class="last">Fecha</th>
            		<th class="last">Consecutivo</th>
            		<th class="last">CC</th>
            		<th class="last">Servicio Prestado</th>
            		<th class="last">Dirigido A</th>
            		<th class="last">Asunto</th>
            		<th class="last">Utilizado Por</th>
            	</tr>
            </thead>
            <tbody>
            @foreach($consecutivos as $consecutivo)
               <tr>
                  <td class="last">{{$consecutivo->created_at->format('Y-m-d')}}</td>
                  <td class="last">{{$consecutivo->ccco_consecutivo}}</td>
                  <td class="last">{{$consecutivo->centrocosto->cccc_nombre}}</td>
                  <td class="last">{{$consecutivo->ccco_servicio_prestado}}</td>
                  <td class="last">{{$consecutivo->cccontacto->cccnt_nombres." ".$consecutivo->cccontacto->cccnt_apellido1}}</td>
                  <td class="last">{{$consecutivo->ccco_asunto}}</td>
                  <td class="last">{{ucwords ($consecutivo->usuairo->usu_nombres)." ".ucwords ($consecutivo->usuairo->usu_apellido1)}}</td>
               </tr>
            @endforeach
            </tbody>
         </table>

         <?php echo $consecutivos->links(); ?>
         
         </div>

      </div>
   </div>
</div>

<div class="tab-pane" id="compose">
   <div class="content-container clearfix">
      
      <div class="col-md-12">
   	
         <form name="form1" id="form1" action="guardar_consecutivo" method="post" onsubmit="return validar()">

         <fieldset>
            <legend>Consecutivo</legend>
      
            <div class="row">
         
               <div class="col-lg-3">
                  <div class="form-group">
                     <label for="created_at">Fecha</label>
                     <input type="date" name="created_at" id="created_at" class="form-control" value="{{date('Y-m-d')}}" required>
                  </div>
               </div>

               <div class="col-lg-2">
                  <div class="form-group">
                     <label for="cccc_id">Centro Costo</label>
                     <select name="cccc_id" id="cccc_id" class="form-control" required>
                        <option value="" disabled="true" selected="true">Seleccione..</option>
                        @foreach($centroc as $centro)
                           <option value="{{$centro->cccc_id}}">{{$centro->cccc_nombre}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>

               <div class="col-lg-5">
               	<div class="form-group">
               		<label for="cccnt_id">Dirigido A:</label>
                  	<select name="cccnt_id" id="cccnt_id" class="form-control" required>
                        <option value="" disabled="true" selected="true">Seleccione..</option>
                        @foreach($contactos as $contacto)
                           <option value="{{$contacto->cccnt_id}}">{{$contacto->cccnt_nombres." ".$contacto->cccnt_apellido1}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>

            </div>

            <div class="row">

               <div class="col-lg-5">
                  <div class="form-group">
                     <input type="text" name="ccco_asunto" id="ccco_asunto" class="form-control input-sm" placeholder="Asunto" required>
                  </div>
               </div>

               <div class="col-lg-5">
                  <div class="form-group">
                     <input type="text" name="ccco_servicio_prestado" id="ccco_servicio_prestado" class="form-control input-sm" placeholder="Servicio Prestado" required>
                  </div>
               </div>

               <div class="col-lg-2">
                  <div class="form-group">
                     <button type="submit" class="btn btn-success btn-block"/>
                        <i class="fa fa-floppy-o"></i> Guardar
                     </button>
                  </div>
               </div>

            </div>

         </fieldset>
               
         </form>

      </div>

   </div>
</div>

<div class="tab-pane" id="tab2">
   <div class="content-container clearfix">
      <div class="col-md-12">
         <h4 class="content-title">Gestionar Contactos</h4>
         
         <form action="cc_gest_contacto" method="post" name="form_gest_contac" id="form_gest_contac">

         <div class="row">

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="contacto_per">Contacto:</label>
                  <select name="contacto_per" id="contacto_per" class="form-control" onchange="gest_contacto(this.value)" required>
                     <option value="" disabled="true" selected="true">Seleccione..</option>
                     <optgroup label="Nuevo contacto">
                        <option value="nuevo">Nuevo Contacto</option>
                     </optgroup>
                     <optgroup label="Contactos">
                     @foreach($contactos as $contacto)
                        <option value="{{$contacto->cccnt_id}}">{{$contacto->cccnt_nombres." ".$contacto->cccnt_apellido1}}</option>
                     @endforeach
                     </optgroup>
                  </select>
               </div>
            </div>

            <div class="col-lg-2 col-lg-offset-6">
               <div class="btn-send">
                  <button type="submit" class="btn btn-primary btn-block">
                     <i class="fa fa-floppy-o"></i> Guardar
                  </button>
               </div>
            </div>

         </div>
         
         <div class="row">

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="cccnt_nombres">Nombres</label>
                  <input type="text" name="cccnt_nombres" id="cccnt_nombres" placeholder="Nombres" class="form-control" required/>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="cccnt_apellido1">1er Apellido</label>
                  <input type="text" name="cccnt_apellido1" id="cccnt_apellido1" placeholder="1er Apellido" class="form-control" required/>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="cccnt_apellido2">2do Apellido</label>
                  <input type="text" name="cccnt_apellido2" id="cccnt_apellido2" placeholder="2do Apellido" class="form-control" />
               </div>
            </div>

         </div>

         <div class="row">

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="cccnt_email_personal">Email Personal</label>
                  <input type="text" name="cccnt_email_personal" id="cccnt_email_personal" placeholder="Email Personal" class="form-control" />
               </div>
            </div>

            <div class="col-lg-4">
               <div class="form-group">
                  <label for="cccnt_email_trabajo">Email Trabajo</label>
                  <input type="text" name="cccnt_email_trabajo" id="cccnt_email_trabajo" placeholder="Email Trabajo" class="form-control" />
               </div>
            </div>

         </div>
         
         <div class="row">

            <div class="col-lg-3">
               <div class="form-group">
                  <label for="cccnt_celular_personal">Celular Personal</label>
                  <input type="tel" name="cccnt_celular_personal" id="cccnt_celular_personal" placeholder="Celular Personal" class="form-control" />
               </div>
            </div>

            <div class="col-lg-3">
               <div class="form-group">
                  <label for="cccnt_tel_personal">Telefono Personal</label>
                  <input type="tel" name="cccnt_tel_personal" id="cccnt_tel_personal" placeholder="Telefono Personal" class="form-control" />
               </div>
            </div>

            <div class="col-lg-3">
               <div class="form-group">
                  <label for="cccnt_celular_trabajo">Celular Trabajo</label>
                  <input type="tel" name="cccnt_celular_trabajo" id="cccnt_celular_trabajo" placeholder="Celular Trabajo" class="form-control" />
               </div>
            </div>

            <div class="col-lg-3">
               <div class="form-group">
                  <label for="cccnt_tel_trabajo">Telefono Trabajo</label>
                  <input type="tel" name="cccnt_tel_trabajo" id="cccnt_tel_trabajo" placeholder="Telefono Trabajo" class="form-control" />
               </div>
            </div>

         </div>

         <div class="row">
            <div class="col-lg-12">
               <label for="cccnt_notas">Nota</label>
               <textarea name="cccnt_notas" id="cccnt_notas" placeholder="Notas" class="form-control"></textarea>     
            </div>
         </div>

         </form>

      </div>
   </div>
</div>

<div class="tab-pane" id="tab3">
   <div class="content-container clearfix">
      <div class="col-md-12">
         <h4 class="content-title">Centro de costo</h4>
         
         <form action="cc_gest_centro_costo" method="post" name="form_centro_costo" id="form_centro_costo">

         <div class="row">

            <div class="col-lg-2">
               <div class="form-group">
                  <label for="centro_costo">Centro de costo:</label>
                  <select name="centro_costo" id="centro_costo" class="form-control" onchange="mover_cc(this.value)" required>
                     <option value="" disabled="true" selected="true">Seleccione..</option>
                     <optgroup label="Nuevo CC">
                        <option value="nuevo">Nuevo CC</option>
                     </optgroup>
                     <optgroup label="Centros de C">
                     @foreach($centroc as $centro)
                        <option value="{{$centro->cccc_id}}">{{$centro->cccc_nombre}}</option>
                     @endforeach
                     </optgroup>
                  </select>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="form-group">
                  <label for="centro_de_costo">Centro de costo</label>
                  <input type="text" name="centro_de_costo" id="centro_de_costo" placeholder="Ej. MPR" class="form-control" required/>
               </div>
            </div>

            <div class="col-lg-2">
               <div class="btn-send">
                  <button type="submit" class="btn btn-primary btn-block">
                     <i class="fa fa-floppy-o"></i> Guardar
                  </button>
               </div>
            </div>

         </div>

         </form>
         
      </div>
   </div>     
</div>

<div class="tab-pane" id="trash">
      
      <!-- <div class="container"> -->
           <div class="content-container clearfix">
               <div class="col-md-12">
                   <h1 class="content-title">Trash</h1>
                   
                   <input type="search" placeholder="Search Mail" class="form-control mail-search" />
                   
                   <ul class="mail-list">
                       
                       <li>
                           <a href="">
                               <span class="mail-sender">You Tube</span>
                               <span class="mail-subject">New subscribers!</span>
                               <span class="mail-message-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil eveniet ipsum nisi? Eaque odio quae debitis saepe explicabo alias sit tenetur animi...</span>
                           </a>
                       </li>
                   </ul>
               </div>
           </div>
       <!-- </div> -->
</div>

</div>



      
@stop




@section('script')
<script type="text/javascript">
!function(a,b){function g(b,c){this.$element=a(b),this.settings=a.extend({},f,c),this.init()}var e="floatlabel",f={slideInput:!0,labelStartTop:"20px",labelEndTop:"10px",paddingOffset:"10px",transitionDuration:.3,transitionEasing:"ease-in-out",labelClass:"",typeMatches:/text|password|email|number|search|url/};g.prototype={init:function(){var a=this,c=this.settings,d=c.transitionDuration,e=c.transitionEasing,f=this.$element,g={"-webkit-transition":"all "+d+"s "+e,"-moz-transition":"all "+d+"s "+e,"-o-transition":"all "+d+"s "+e,"-ms-transition":"all "+d+"s "+e,transition:"all "+d+"s "+e};if("INPUT"===f.prop("tagName").toUpperCase()&&c.typeMatches.test(f.attr("type"))){var h=f.attr("id");h||(h=Math.floor(100*Math.random())+1,f.attr("id",h));var i=f.attr("placeholder"),j=f.data("label"),k=f.data("class");k||(k=""),i&&""!==i||(i="You forgot to add placeholder attribute!"),j&&""!==j||(j=i),this.inputPaddingTop=parseFloat(f.css("padding-top"))+parseFloat(c.paddingOffset),f.wrap('<div class="floatlabel-wrapper" style="position:relative"></div>'),f.before('<label for="'+h+'" class="label-floatlabel '+c.labelClass+" "+k+'">'+j+"</label>"),this.$label=f.prev("label"),this.$label.css({position:"absolute",top:c.labelStartTop,left:f.css("padding-left"),display:"none","-moz-opacity":"0","-khtml-opacity":"0","-webkit-opacity":"0",opacity:"0"}),c.slideInput||f.css({"padding-top":this.inputPaddingTop}),f.on("keyup blur change",function(b){a.checkValue(b)}),b.setTimeout(function(){a.$label.css(g),a.$element.css(g)},100),this.checkValue()}},checkValue:function(a){if(a){var b=a.keyCode||a.which;if(9===b)return}var c=this.$element,d=c.data("flout");""!==c.val()&&c.data("flout","1"),""===c.val()&&c.data("flout","0"),"1"===c.data("flout")&&"1"!==d&&this.showLabel(),"0"===c.data("flout")&&"0"!==d&&this.hideLabel()},showLabel:function(){var a=this;a.$label.css({display:"block"}),b.setTimeout(function(){a.$label.css({top:a.settings.labelEndTop,"-moz-opacity":"1","-khtml-opacity":"1","-webkit-opacity":"1",opacity:"1"}),a.settings.slideInput&&a.$element.css({"padding-top":a.inputPaddingTop}),a.$element.addClass("active-floatlabel")},50)},hideLabel:function(){var a=this;a.$label.css({top:a.settings.labelStartTop,"-moz-opacity":"0","-khtml-opacity":"0","-webkit-opacity":"0",opacity:"0"}),a.settings.slideInput&&a.$element.css({"padding-top":parseFloat(a.inputPaddingTop)-parseFloat(this.settings.paddingOffset)}),a.$element.removeClass("active-floatlabel"),b.setTimeout(function(){a.$label.css({display:"none"})},1e3*a.settings.transitionDuration)}},a.fn[e]=function(b){return this.each(function(){a.data(this,"plugin_"+e)||a.data(this,"plugin_"+e,new g(this,b))})}}(jQuery,window,document);

function mover_cc(valor){

   if(valor=='nuevo'){
      $('#centro_de_costo').val('');
   }else{
      $('#centro_de_costo').val($( "#centro_costo option:selected" ).text());
   }

}



function gest_contacto(valor){
   
   on_preload();

   if(valor == 'nuevo'){
      $('#form_gest_contac input:not(.ignore)').val('');
   }else{
      $.post("cc_buscar_un_contacto",{cccnt_id:valor},function(data){
            
         $('#cccnt_nombres').val(data.cccnt_nombres);
         $('#cccnt_apellido1').val(data.cccnt_apellido1);
         $('#cccnt_apellido2').val(data.cccnt_apellido2);

         $('#cccnt_email_personal').val(data.cccnt_email_personal);
         $('#cccnt_email_trabajo').val(data.cccnt_email_trabajo);

         $('#cccnt_celular_personal').val(data.cccnt_celular_personal);
         $('#cccnt_celular_trabajo').val(data.cccnt_celular_trabajo);

         $('#cccnt_tel_personal').val(data.cccnt_tel_personal);
         $('#cccnt_tel_trabajo').val(data.cccnt_tel_trabajo);
            
         $('#cccnt_notas').val(data.cccnt_notas);
            
      });
   }
   off_preload();
}



$(document).ready(function(){
   $('.form-control').floatlabel({
      labelClass: 'float-label',
      labelEndTop: 5
   });
});


function validar(){
   on_preload();
   return true;
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

</script>
@stop