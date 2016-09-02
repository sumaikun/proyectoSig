@extends('usuarios.layouts.layout')


@section('barra_usuario')
   @include('usuarios.layouts.barra_usuario', array('op'=>'usuario'))
@stop


@section('menu_lateral')
   @include('usuarios.layouts.menu_lateral', array('op'=>'usuario'))
@stop



@section('contenido')
<h1 class="page-header"><i class="fa fa-info"></i> Información de usuario<!-- <small>Bienvenid@</small> --></h1>

<!-- esta linea es para maximizar y minimizar el area de informacion -->
<div class="maxi row" data-toggle="tooltip" data-placement="left" title="Maximizar / Minimizar">
   <i id="mximin" class="fa fa-expand fa-2x"></i>
</div>



<div class="row">
      

<div class="col-lg-12">

<!-- <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
   <a href="edit.html" >Edit Profile</a>
   <a href="edit.html" >Logout</a>
   <br>
   <p class=" text-info">May 05,2014,03:00 pm </p>
</div> -->
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-1 toppad" >
   <div class="panel panel-info">
      <div class="panel-heading">
         <h3 class="panel-title">
            {{ucwords($usuario->usu_nombres)." ".ucwords($usuario->usu_apellido1)." ".ucwords($usuario->usu_apellido2)}}
         </h3>
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="col-md-3 col-lg-3 " align="center"> 
               <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> 
            </div>
            <div class=" col-md-9 col-lg-9 "> 
               <table class="table table-user-information">
               <tbody>
                  <tr>
                     <td><strong>Nombre:</strong></td>
                     <td>{{ucwords($usuario->usu_nombres)." ".ucwords($usuario->usu_apellido1)." ".ucwords($usuario->usu_apellido2)}}</td>
                  </tr>
                  <tr>
                     <td><strong>Email:</strong></td>
                     <td>{{$usuario->usu_email}}</td>
                  </tr>
                  <tr>
                     <td><strong>Cargo:</strong></td>
                     <td>{{ucwords($usuario->cargos->carg_nombre)}}</td>
                  </tr>
                  <tr>
                     <td><strong>Dependencia:</strong></td>
                     <td>{{ucwords($usuario->dependencias->depe_nombre)}}</td>
                  </tr>
                  <tr>
                     <td><strong>Usuario desde:</strong></td>
                     <td>{{$usuario->usu_creacion}}</td>
                  </tr>
               </tbody>
               </table>
            
            </div>

            <div class="col-lg-12">
               <h4 class="text-warning">Cambiar contraseña</h4>
               <div class="well">
                  <strong>Usuario:</strong>{{$usuario->usu_usuario}}
                  <form action="updatepassusu" onsubmit="return validar()" name="form1" id="form1" method="post">
                  <div class="row">
                     <div class="col-lg-5">Nueva Contraseña
                        <input type="password" name="password" id="password" class="form-control" required>
                     </div>
                     <div class="col-lg-5">Repita la nueva contraseña
                        <input type="password" name="password2" id="password2" class="form-control" required>
                     </div>
                     <div class="col-lg-2"><br>
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar</button>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
            

         </div>
      </div>
      <div class="panel-footer">
         <strong>Nota: </strong> si presenta algún inconveniente comuníquese con soporteit@grupo-sig.com
      </div>
            
   </div>
</div>





   

</div>


@if(isset($mensaje))
<div class="col-lg-12">
   <div class="well well-sm">
      <div class="row">
         <div class="col-lg-12 text-center">
            <h3>{{ $mensaje }}</h3>
         </div>
      </div>
   </div>
</div>
@endif


</div>
         
      
@stop




@section('script')
<script type="text/javascript">

function validar() {

   var pass1 = document.getElementById("password").value;
   var pass2 = document.getElementById("password2").value; 
   if (pass1 != pass2) {
      // Si no se cumple la condicion...
      alert('[ERROR] Las contraseñas no coinciden...');
      return false;
   }else if (!confirm("Está seguro de actualizar contraseñas") {
      return false;
   }

   return true;
}




</script>
@stop