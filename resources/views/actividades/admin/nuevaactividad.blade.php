@extends('administrador.layouts.layout')
@section('menu')
    @include('administrador.layouts.menu', array('op'=>'actividades'))
@stop

@section('css')
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/bower_components/Font-Awesome/css/font-awesome.css') }}
   {{ HTML::style('http://awesome-bootstrap-checkbox.okendoken.com/demo/build.css') }}
   {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css') }}

   {{ HTML::style('general/css/icono_info.css') }}
@stop

@section('contenido')
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Nueva Actividad<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}"><i class="fa fa-child"></i> Gestión de Actividades</a></li>
      <li class="active">Nueva Actividad</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->


<section class="content" style="max-width: 800px;" >
	@include('actividades.sub_views.create')
  <div class="col-lg-11 col-md-11 col-xs-11">      
    <div id="ajax_content" style="max-height: 300px;"></div>
  </div>
</section>


@stop


@section('script')

<script>

  $("input[name=fecha]").change(event => {

      if(event.target.value!="")
      {       
        update_table();
      }
  });

  function update_table()
  {
    $("#ajax_content").empty();

    $.get("myactivities/"+$("input[name=fecha]").val(), function(res, sta){
            console.log(res);
             $("#ajax_content").append(res);        
            
        });
  }

  function validate_date()
  {
    console.log('validacion');
    $("#hfin").prop( "disabled", false );
    $("#hfin").prop( "min", $("#hini").val());
  }

  $(document).on("submit","#form1",function(e){

      $("#myModal").modal('hide');
      e.preventDefault();        
      
       if($('input[name=fecha]').val()!="")
       {
         $('input[name=fechaactividad]').val($('input[name=fecha]').val());      
         var route = "registraractividad";
         var token = $("#token").val();
         var datastring = $("#form1").serialize();        
           $.ajax({
              url: route,  
              headers: {'X-CSRF-TOKEN': token},
              type: 'POST',
              dataType: 'html',     
              data: datastring,          
              success: function(data)
              {
                $("#form1").trigger('reset');
                update_table();                
              },
              error: function(data)
              {
                alert("ha ocurrido un error") ;
              }       
          });
       }
       else{
         alert('debe agregar una fecha para ingresar la actividad'); 
       }
  });

</script>    
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js') }}
@stop
