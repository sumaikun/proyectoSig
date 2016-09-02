﻿<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>System Integral Group</title>
   <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css') }}
   {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}
   {{ HTML::style('http://getbootstrap.com/examples/dashboard/dashboard.css') }}
   {{ HTML::style('usuarios/css/style.css') }}
   @yield('css')
   {{ HTML::style('general/css/animate.css') }}
   {{ HTML::style('general/css/preload.css') }}
</head>
<body>

@yield('barra_usuario')
   
<div class="container-fluid">
<div class="row">
      
      <div class="col-lg-2 sidebar" id="menula">
         @yield('menu_lateral')
      </div>
      
      <div class="col-lg-10 col-lg-offset-2 main" id="conte">
         @yield('contenido')
      </div>

</div>
</div>




<div class="loader-wrapper" id="preload">
   <div id="loader"></div>
   <div class="lab_loader">
      <h3 class="espere"><strong>ESPERE</strong> <small>(PortalSIG)</small></h3>
   </div>
</div>


{{ HTML::script('http://code.jquery.com/jquery-1.11.0.min.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}
{{ HTML::script('usuarios/js/main.js') }}
{{ HTML::script('general/js/main.js') }}
@yield('script')
</body>
</html>