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
<style type="text/css">  
  hr {
   display: block;
   position: relative;
   padding: 0;
   margin: 8px auto;
   height: 0;
   width: 100%;
   max-height: 0;
   font-size: 1px;
   line-height: 0;
   clear: both;
   border: none;
   border-top: 2px solid #aaaaaa;
   border-bottom: 2px solid #ffffff;
}
</style>
<!-- header de la pagina -->
<section class="content-header">
	<h1><i class="fa fa-plus-circle"></i>Factura<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/facturacion') }}"><i class="fa fa-child"></i> Facturación</a></li>
      <li class="active">Factura</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="max-width: 800px;" >

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><strong>Factura</strong></h3>
       </div>
       <div class="panel-body">
        <div class="ocultar" style="max-height: 420px !important">
        <form name="form1" id="form1" class='form_factura' action="registraractividad" onsubmit="return validar()" method="post" enctype="multipart/form-data">

        <div class="col-lg-9">
          
              <div class="form-group">      
                    <label>*Fecha Elaboración</label>
                    <input  class="form-control" name="fecha" type="date" required/>            
              </div>         

              <div class="form-group">
                    <label>*Empresa</label>
                    <select class="form-control" name="empresa" required>
                      <option value="">Selecciona</option>
                    @foreach($empresas as $key=>$value)
                      <option value={{$key}}>{{$value}}</option>
                    @endforeach   
                    </select>
              </div>       
              
              <div class="form-group">      
                  <label>*Descripción</label>
                  <br>
                    <a href="" onclick="add_item()" class="btn btn-success btn-md">
                      <span class="glyphicon glyphicon-print"></span> Agregar
                    </a>
                    <a href="" onclick="remove_item()" class="btn btn-danger btn-md">
                      <span class="glyphicon glyphicon-print"></span> eliminar
                    </a>
                    <hr>
                    <div id="container">
                    </div>
              </div>
              
              <input type="hidden" value="0" id="cont_items" name="cont">

               <div class="form-group">      
                  <label>*Valor del iva</label>
                  <input  class="form-control" name="fecha" type="text" required/>            
              </div>

              <div class="form-group">      
                  <label>*Fecha de vencimiento</label>
                  <input  class="form-control" name="fecha" type="date" required/>            
              </div>

              <div class="col-lg-6 col-lg-offset-6 col-xs-12">
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> <b>Guardar</b></button> 
                <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>      
              </div>  

        </div>

        
        <div class="divider"></div>

          
        </form>
        </div>
       </div>
       
       <div class="panel-footer">
        <strong>Nota:</strong> Todos los campos marcados con asteriscos (*) son obligatorios
       </div>
                
    </div>



</section>
@stop


@section('script')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js') }}
<script type="text/javascript">
var cont = 0;

function add_item()
{
  event.preventDefault();

  cont += 1;
 // console.log('contador '+cont);
  document.getElementById("cont_items").value = cont;
 
      var div = document.createElement("div");
      div.className = "form-group";
      div.id = "item"+cont;  
      var label = document.createElement("label");
      var text = document.createTextNode("Item"+cont);
      label.appendChild(text);
      label.style = 'color:#aaaaaa';
      div.appendChild(label);
      
      var input = document.createElement("input");
      input.type = "text";
      input.className = "form-control";
      input.name = "item";
      div.appendChild(input);
      var label = document.createElement("label");
      var text = document.createTextNode("Cantidad");
      label.appendChild(text);
      label.style = 'color:#aaaaaa';
      div.appendChild(label);
      
      var input = document.createElement("input");
      input.type = "text";
      input.className = "form-control";
      input.value = 1;
      input.name = "item";
      div.appendChild(input);
      var label = document.createElement("label");
      var text = document.createTextNode("Valor");
      label.appendChild(text);
      label.style = 'color:#aaaaaa';
      div.appendChild(label);
      
      var input = document.createElement("input");
      input.type = "text";
      input.className = "form-control";
      input.name = "item";
      div.appendChild(input);
      container.appendChild(div);
      var hr = document.createElement("hr");
      help = cont+100;
      hr.id = "item"+help;
      container.appendChild(hr);

      

}

function remove_item()
{
  event.preventDefault();

  //var pointer = document.getElementsById("cont_items").value;
  var pointer = document.getElementById("cont_items").value;
  
  if(pointer>0)
  {
    console.log('este es '+pointer);
    document.getElementById("item"+pointer).remove();
    pointer= 100+parseInt(pointer);
    //console.log(pointer);
    document.getElementById("item"+pointer).remove();
    cont -= 1;
    document.getElementById("cont_items").value = cont;

  }  
  
}

</script>
@stop
