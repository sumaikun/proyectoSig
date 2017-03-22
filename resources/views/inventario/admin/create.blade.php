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
	<h1><i class="fa fa-plus-circle"></i>Elemento<!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/facturacion') }}"><i class="fa fa-child"></i> Inventario</a></li>
      <li class="active">Elemento</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content" style="max-width: 800px;" >

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><strong>Registro de nuevo Elemento</strong></h3>
       </div>
       <div class="panel-body">
        <div class="ocultar" style="max-height: 420px !important">
     

        <div class="col-lg-9">
          <form action="addElemento" onsubmit="return validar()" method="post" enctype="multipart/form-data">    

              <input type="hidden" value="0" id="cont_items" name="cont">

               <div class="form-group">      
                  <label>CODIGO</label>
                  <input  class="form-control" name="codigo" id="codigo" type="text"  required/>            
              </div>

              <div class="form-group">      
                  <label>Descripción</label>
                  <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>  
              </div>

              <div class="form-group">      
                  <label>Cantidad</label>
                  <input  class="form-control" name="cantidad" id="cantidad" onblur="generate_serials()" type="number"  required/>
                  <div id="container">
                  </div>  
              </div>

              <div class="form-group">      
                  <label>Status</label>
                  <select class="form-control" name="status" id="status"  required>
                    <option value=''>Selecciona</button></option>
                    @foreach($estados as  $key=>$value)
                      <option value={{$key}}>{{$value}}</option>
                    @endforeach
                    <option value='new'>+ NUEVO STATUS</button></option>
                  </select> 
              </div>

               <div class="form-group">      
                  <label>Categoria</label>
                  <select class="form-control" name="categoria" id="categoria"  required>
                    <option value=''>Selecciona</button></option>
                    @foreach($categorias as  $key=>$value)
                      <option value={{$key}}>{{$value}}</option>
                    @endforeach
                    <option value='new'>+ NUEVA CATEGORIA</button></option>
                  </select>    
              </div>          

              <div class="col-lg-6 col-lg-offset-6 col-xs-12">
                <button type="submit" onclick="clicked();" class="btn btn-success">
                      <i class="fa fa-floppy-o"></i> <b>Insertar</b>
                </button>
                <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>      
              </div>

          </form>
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
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Categorias
            </h4>
         </div>
         <div class="modal-body">              
            <div class="row">  
              <div class="col-lg-12">
                <div class="form-group">      
                  <label>INGRESE EL NOMBRE DE LA NUEVA CATEGORIA</label>
                  <input  class="form-control" name="new_category" id="new_category" type="text"  required/>            
                </div>
              </div>
            </div>      
         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="save_category"   class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Status
            </h4>
         </div>
         <div class="modal-body">              
            <div class="row">  
              <div class="col-lg-12">
                <div class="form-group">      
                  <label>INGRESE EL NOMBRE DEL NUEVO STATUS</label>
                  <input  class="form-control" name="new_status" id="new_status" type="text"  required/>            
                </div>
              </div>
            </div>      
         </div>
         <div class="modal-footer">
            <button type="button"  id="close_status" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="save_status"   class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>

 

@section('script')
<script type="text/javascript">

$('select[name=categoria]').change(function() {
    if ($(this).val() == 'new')
    {
        $('#myModal').modal('show');
       
    }
});

$('select[name=status]').change(function() {
    if ($(this).val() == 'new')
    {
        $('#myModal2').modal('show');
       
    }
});

$('#save_category').click(function(){
   $.get('insertar_categoria/'+$('#new_category').val(), function(res){
            
      
        var newValue = $('option', $('select[name=categoria]')).length;
        $('<option>')
            .text($('#new_category').val())
            .attr('value', res)
            .insertBefore($('option[value=new]', $('select[name=categoria]')));
        $(this).val(newValue);
        $('#myModal').modal('hide');
        $('select[name=categoria]').val(res);
      });
});
$('#save_status').click(function(){
   $.get('insertar_status/'+$('#new_status').val(), function(res){
            
      
        var newValue = $('option', $('select[name=status]')).length;
        $('<option>')
            .text($('#new_status').val())
            .attr('value', res)
            .insertBefore($('option[value=new]', $('select[name=status]')));
        
        $('#myModal').modal('hide');
        $('select[name=status]').val(res);
      });
});
$('#close_category').click(function(){$('select[name=categoria]').val('');});
$('#close_status').click(function(){$('select[name=categoria]').val('');});

function generate_serials(){

    $("#container").empty();

      for(var i = 0 ; i<$("#cantidad").val(); i++){
        var div = document.createElement("div");
        div.className = "form-group";
        div.id = "item";  
        var label = document.createElement("label");
        var text = document.createTextNode("serial "+(i+1));
        label.appendChild(text);
        label.style = 'color:#aaaaaa';
        div.appendChild(label);
        
        var input = document.createElement("input");
        input.type = "text";
        input.className = "form-control";
        input.name = "item"+(i+1);
        input.id = "meti";
        input.required = "required"
        div.appendChild(input);
        container.appendChild(div);  
      }
      
}

 function clicked() {
   if (confirm('¿Desea continuar?'))
    {
           return true;
    } else {
           return false;
       }
  }

</script>
@stop

@stop
