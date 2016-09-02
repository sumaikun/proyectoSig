@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'gdocumental'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'gdocumental'))
@stop



@section('contenido')
<h1 class="page-header"><h1><i class="fa fa-flag-o"></i> Resultado<!-- <small>Bienvenid@</small> --></h1>

<div class="row">



<div class="col-lg-12">

@if($funcion==true)
<div class="jumbotron">
  <div class="container text-center">
    <h1><span class="text-success">Operación exitosa! </span> <i class="fa fa-check-circle"></i></h1>
    <p><strong>  {{$mensaje}}  </strong></p>
    <p><a href="{{ url('usuario/hvdocumento') }}" class="btn btn-primary btn-lg" role="button"> <i class="fa fa-reply-all"></i> <strong>Volver</strong></a></p>
  </div>
</div>
@elseif($funcion==false)
<div class="jumbotron">
  <div class="container text-center">
    <h1><span class="text-danger">hoo! Error </span> <i class="fa fa-times"></i></h1>
    <p><strong>  {{$mensaje}}  </strong></p>
    <p><a href="{{ url('usuario/hvdocumento') }}" class="btn btn-primary btn-lg" role="button"> <i class="fa fa-reply-all"></i> <strong>Volver</strong></a></p>
  </div>
</div>
@endif


</div>







</div>
        
      
@stop



@section('script')
<script type="text/javascript">


// $(function() {
//    $("[name='my-checkbox']").bootstrapSwitch();
// });

function anular(){
   if( $('.gdcon_id').is(':checked') ){
      $('#myModal').modal('show');   
   }else{
      alert("Seleccione un consecutivo");
   }
   
}

function validar(){
   
   $("#form2 input[name=gdcon_id_nulo]").val($("#form1 input[name=gdcon_id]:checked").val());
   return true;
}


</script>
@stop
