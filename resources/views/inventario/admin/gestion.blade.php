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
	<h1><i class="fa fa-plus-circle"></i> Gesion de Inventario  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="{{ url('admin/actividades') }}""><i class="fa fa-users"></i> Inventario</a></li>
      <li class="active">registros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

  <div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Gestion Inventario</h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
          
         <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Codigo</strong></th>
                  <th><strong>Descripción</strong></th>                                 
                  <th><strong>Cantidad</strong></th>
                  <th><strong>Categoria</strong></th>
                  <th><strong>Precio</strong></th>                  
                  <th><strong>Opciones</strong></th>
               </tr>
            </thead>
            <tbody>
              @foreach($elementos as $elemento)
                <tr>  
                  <td> {{$elemento->id}} </td>
                  <td style="width:110px;"> {{$elemento->codigo}} </td>
                  <td> {{$elemento->descripcion}}</td>             
                  <td style="text-align: center;"> {{$elemento->cantidad}}</td>                  
                  <td> {{$elemento->categoria}}</td>
                  <td> {{$elemento->precio}}</td>                  
                  <td> <a href="#" data-toggle="modal" onclick="edit_element({{$elemento->id}})" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></i> <a href="elementdelete/{{$elemento->id}}" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a><a href="#" data-toggle="modal" title="Gestión" onclick="get_serials({{$elemento->id}})" data-target="#myModal4" style="margin-left: 5px;"><i class="fa fa-binoculars" aria-hidden="true"></i></a><a  href="#" title="Componentes" style="margin-left: 5px;" data-target="#myModal8" data-toggle="modal" onclick="get_components({{$elemento->id}})"><i class="fa fa-list-ul" aria-hidden="true"></i></a> <a @if($elemento->archivo == null) {{'onclick=no_file()'}} @else{{"href=downloadpdf/".$elemento->id}} target="_blank" @endif ><i class="fa fa-arrow-down" title="pdf" aria-hidden="true"></i></a>
                  </td>  
                </tr>  
              @endforeach
            </tbody>
         </table>
      </div>      
   </div>
</div>

@include("inventario.subviews.modals")
<!-- Modal -->




<script type="text/javascript">



  $(document).ready(function() {
    
    /*var spanish = $.getJSON("//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json", function(data) {
      return data;  
    });    
    
    console.log(spanish);*/
    $('#example').DataTable({
       "bSort": false,
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            }
    });
  });

  function get_serials(id)
  {
    $("#ajax-content").empty();
   $.get("get_seriales/"+id, function(res, sta){         
         $("#ajax-content").append(res);
      });
  }

  function get_components(id)
  {
    $("#ajax-content3").empty();
    $.get("get_components/"+id, function(res, sta){         
         $("#ajax-content3").append(res);
      }); 
  }

  function edit_element(id)
  {
    $.get("edit_element/"+id, function(res, sta){
         $("#ajax-content2").empty();
         $("#ajax-content2").append(res);
      });
  }

  function confirm_action(){
   return confirm('¿Esta seguro?');
 }

 function no_file()
 {
    alert("No hay archivo registrado");
 }

$(document).ready(function() {
$("#fecha1").change(event => {
    var min = `${event.target.value}`;
    var input = document.getElementById("fecha2");
    input.setAttribute("min", min);
  });

});
</script>

@stop
