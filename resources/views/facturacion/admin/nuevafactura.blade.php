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
        <form name="form1" id="form1" class='form_factura' action="registrarfactura" onsubmit="return validar()" method="post" enctype="multipart/form-data">

        <div class="col-lg-9">
          
              <div class="form-group">      
                    <label>*Fecha Elaboración</label>
                    <input  class="form-control" id="fecha_elaboracion" name="fecha_elaboracion" type="date" required/>            
              </div>         

              <div class="form-group">
                    <label>*Cliente</label>
                    <select class="form-control" id="customer" name="cliente" required>
                      <option value="">Selecciona</option>
                    @foreach($empresas as $key=>$value)
                      <option value={{$key}}>{{$value}}</option>
                    @endforeach   
                    </select>
              </div>

              <div class="form-group">
                    <label>*facturadora</label>
                    <select class="form-control" name="facturadora" required>
                      <option value="">Selecciona</option>
                    @foreach($facturadoras as $key=>$value)
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
                  <input  class="form-control" name="iva" type="number" step="any" required/>            
              </div>

              <div class="form-group">      
                  <label>*Fecha de vencimiento</label>
                  <input  class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" type="date" required/>            
              </div>

               <div class="form-group">      
                  <label>*Reembolso de gastos no generados por iva</label>
                  <input  class="form-control" name="reembolso" type="text" required/>            
              </div>              

              <div class="col-lg-6 col-lg-offset-6 col-xs-12">
                <a href="#" data-toggle="modal" data-target="#myModal" onclick="description()" class="btn btn-success pull-right">
                      <i class="fa fa-floppy-o"></i> <b>Factura</b>
                </a>
                <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>      
              </div>  

        </div>

        
        <div class="divider"></div>

          
       
        </div>
       </div>
       
       <div class="panel-footer">
        <strong>Nota:</strong> Todos los campos marcados con asteriscos (*) son obligatorios
       </div>
                
    </div>
</section>


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
                    <td rowspan="6" id="pre_desc" style="font-size: 85%; max-width: 550px;" colspan="2"></td>
                    <td id="pre_valor"></td>
                    <td id="pre_mult"></td>
                  </tr>  
                  <tr>                  
                    <td><b>Ingresos que generan iva</b></td>
                    <td></td>                
                  </tr>
                  <tr>                  
                    <td><b>Reembolsados de gastos no generadores de iva</b></td>
                    <td></td>                
                  </tr>
                  <tr>                  
                    <td><b>Subtotal</b></td>
                    <td></td>                
                  </tr>
                  <tr>                  
                    <td><b>Iva</b></td>
                    <td></td>                
                  </tr>
                  <tr>                  
                    <td><b>Total</b></td>
                    <td></td>                
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
      
         </div>
         <div class="modal-footer">
            <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>

 </form>

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
      input.name = "item"+cont;
      input.id = "meti"+cont;
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
      input.id = "cant"+cont;
      input.name = "cant"+cont;
      div.appendChild(input);
      var label = document.createElement("label");
      var text = document.createTextNode("Valor");
      label.appendChild(text);
      label.style = 'color:#aaaaaa';
      div.appendChild(label);
      
      var input = document.createElement("input");
      input.type = "text";
      input.className = "form-control";
      input.name = "valor"+cont;
      input.id = "valor"+cont;
      div.appendChild(input);

      var label = document.createElement("label");
      var text = document.createTextNode("¿Genera Iva?");
      label.appendChild(text);
      label.style = 'color:#aaaaaa';
      div.appendChild(label);
      
      var input = document.createElement("input");
      input.type = "checkbox";
      input.className = "form-control";
      input.name = "check"+cont;
      input.id = "check"+cont;
      input.checked = "checked"
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
    //console.log('este es '+pointer);
    document.getElementById("item"+pointer).remove();
    pointer= 100+parseInt(pointer);
    //console.log(pointer);
    document.getElementById("item"+pointer).remove();
    cont -= 1;
    document.getElementById("cont_items").value = cont;

  }  
  
}

function description()
{
  $("#pre_desc").empty();
  $("#pre_valor").empty();

  var content = '<ul>';
  var content2 = '<ul>';
  var content3 = '<ul>';
  //console.log('consigue el valor '+$("#meti1").val());
  if(cont!=0)
  {
    for(var i =0 ; i<cont ; i++ )
    {
      content = content+'<li>'+$("#meti"+(parseInt(i)+1)).val()+'</li>';
      content2 = content2+'<li>'+$("#valor"+(parseInt(i)+1)).val()+'</li>';
      content3 = content3+'<li>'+mult_items()+'</li>';
    }
  }

  content = content+'</ul>';  
  content2 = content2+'</ul>';
  content3 = content3+'</ul>';

  $("#pre_desc").append(content);
  $("#pre_valor").append(content2);
  $("#pre_mult").append(content3);
}

function mult_items(){
  return 'placeholder'; 
}

$(document).ready(function() {
$("#customer").change(event => {
  //console.log("Estoy llegando");      
     if(event.target.value=="")
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
  }
});

});


$(document).ready(function() {
$("#fecha_elaboracion").change(event => {
  //console.log("Estoy llegando"+`${event.target.value}`);
    var min = `${event.target.value}`;
    var input = document.getElementById("fecha_vencimiento");

    input.setAttribute("min", min);

    $('#pre_inicio').append(`${event.target.value}`);
  });

});

$(document).ready(function() {
$("#fecha_vencimiento").change(event => {
  //console.log("Estoy llegando"+`${event.target.value}`);      
    $('#pre_final').append(`${event.target.value}`);
  });

});
</script>
@stop
