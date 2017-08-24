<!DOCTYPE html>
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
  {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js') }}
  {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}

  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print"/>
  <script src="http://momentjs.com/downloads/moment.js" type="text/javascript"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.js" type="text/javascript"></script>

</head>


@yield('barra_usuario')
<body class="skin-black">

<div class="container-fluid">
  <div class="row">
        
        <div class="col-lg-2 sidebar" id="menula">
            <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
               <section class="sidebar">
               <!-- Sidebar user panel -->
                  <div class="user-panel">
                     <div class="pull-left image">
                        @if(Session::get('usu_foto'))
                              {{ HTML::image(Session::get('usu_foto'), 'foto', array('class' => 'img-responsive circle')) }}
                           @else
                              <img src="http://placehold.it/120x120" alt="Alternate Text" class="img-responsive" />
                           @endif
                        <!-- <img src="img/avatar3.png" class="img-circle" alt="User Image" /> -->
                     </div>
                     <br>
                     <div class="pull-left info">
                        <p>Hola!, {{ucwords (Session::get('usu_nombres'))}}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                     </div>
                  </div>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <div>
                    @yield('menu_lateral')
                  </div>
               </section>
           
            </aside> 
           
        </div>
        
        <div class="col-lg-10  main" id="conte">
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



{{ HTML::script('usuarios/js/main.js') }}
{{ HTML::script('general/js/main.js') }}
@yield('script')
</body>
</html>