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
	<h1><i class="fa fa-plus-circle"></i> Documentos de capacitación  <!-- <small>Nuevo usuario</small> --></h1>
   <ol class="breadcrumb">
   	<li><a href="#"><i class="fa fa-users"></i> Capacitación</a></li>
      <li class="active">registros</li>
    </ol>
    <!-- <hr> -->
</section>
         
<!-- Cuerpo de la pagina -->
<section class="content">

 <section class="content">

  <div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Gestion de documentos de capacitaciones</h3>
         </div> 
          <div class="col-log-2">            
         </div>
      </div>
      <div class="panel-body">
         <!--<a href="{{ url('admin/nuevousuario') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Agregar Usuario</a>-->
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr class=table_head>                     
                 <th>Título</th> 
                 <th>Documento</th>
                 <th>Fecha</th>                                              
                </tr>  
            </thead>
             <tbody>
                @foreach($documentos as $documento)
              <tr>
                <td>  {{$documento->titulo}}  </td>                
                <td>  <a  onclick="return validate2('{{$documento->titulo}}')" href="downloaddocumento/{{$documento ->ruta}}/{{$documento ->id}}" >{{$documento ->ruta}}</a> </td>
                <td>  {{$documento ->created_at}}</td>                            
              </tr>  
            @endforeach  
            
             </tbody>           
          </table> 
      </div>
         
         
   </div>
</div>



</section>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
       "bSort": false
      });
  });

    function validate2(title){
      if(!confirm("Está seguro de descargar el archivo "+title+"?"))
      {
        return false;
      }
      return true;
    }

</script>
@stop