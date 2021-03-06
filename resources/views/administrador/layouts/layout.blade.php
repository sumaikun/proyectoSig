<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>System Integral group</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css') }}
        {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}
        {{ HTML::style('admin/css/AdminLTE.css') }}
        {{ HTML::style('admin/css/main.css') }}
        {{ HTML::style('general/css/preload.css') }}
        
        @yield('css')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
        {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}
        
        <!--<script src="//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"></script>-->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        

        <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print"/>
        <script src="http://momentjs.com/downloads/moment.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.js" type="text/javascript"></script>

        
   </head>

<body class="skin-black">

   <!-- header logo: estilo del logo-->
   <header class="header">
      <a href="#" class="logo">Administrador Sig</a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </a>
      <div class="navbar-right">
         <ul class="nav navbar-nav">

            <!-- Messages: estilo de para mensajes-->
            <!-- <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
            </li> -->

            <!-- Notificacion: estilo para las notificaciones -->
            <!-- <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
            </li> -->

            <!-- Tasks: otro estilo -->
            <!-- <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
            </li> -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="glyphicon glyphicon-user"></i>
                  <span>{{ucwords (Session::get('usu_nombres'))." ".ucwords (Session::get('usu_apellido1'))}}<i class="caret"></i></span>
               </a>
               <ul class="dropdown-menu">

                  <!-- User image -->
                  <li class="user-header bg-light-blue">
                     @if(Session::get('usu_foto'))
                        {{ HTML::image(Session::get('usu_foto'), 'foto', array('class' => 'img-circle')) }}
                     @else
                        {{ HTML::image('admin/img/avatar3.png', 'foto', array('class' => 'img-circle')) }}
                     @endif
                     <p>
                        {{ucwords (Session::get('usu_nombres'))." ".ucwords (Session::get('usu_apellido1'))." - ".ucwords (Session::get('rol_nombre'))}}
                        <small>{{date("Y-m-d H:i:s")}}</small>
                     </p>
                  </li>
                  
                  <!-- Menu Body -->
                  <!-- <li class="user-body">
                     <div class="col-xs-4 text-center">
                        <a href="#">Perfil</a>
                     </div>
                     <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                     </div>
                     <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                     </div>
                  </li> -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                     <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                     </div>
                     <div class="pull-right">
                        <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Terminar sesión</a>
                     </div>
                  </li>

               </ul>
            </li>
         </ul>
      </div>
      </nav>
   </header>

   <div class="wrapper row-offcanvas row-offcanvas-left">
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="left-side sidebar-offcanvas">
      <!-- sidebar: style can be found in sidebar.less -->
         <section class="sidebar">
         <!-- Sidebar user panel -->
            <div class="user-panel">
               <div class="pull-left image">
                  {{ HTML::image('admin/img/avatar3.png', 'a picture', array('class' => 'img-circle')) }}
                  <!-- <img src="img/avatar3.png" class="img-circle" alt="User Image" /> -->
               </div>
               <div class="pull-left info">
                  <p>Hola!, {{ucwords (Session::get('usu_nombres'))}}</p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
               </div>
            </div>
            <!-- search form -->
            <!-- <form action="#" method="get" class="sidebar-form">
               <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search..."/>
                  <span class="input-group-btn">
                     <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
               </div>
            </form> -->
            <!-- /.search form -->
            

            <!-- Menu lateral -->
            @yield('menu')

         </section>
         <!-- /.sidebar -->
      </aside>




      <!-- Aqui se despliegan todas las paginas -->
      <aside class="right-side">         
            @yield('contenido')
      </aside>



<div class="loader-wrapper" id="preload">
   <div id="loader"></div>
   <div class="lab_loader">
      <h3 class="espere"><strong>ESPERE</strong> <small>(PortalSIG)</small></h3>
   </div>
</div>


   </div><!-- ./wrapper -->



@yield('script')

{{ HTML::script('admin/js/main.js') }}
{{ HTML::script('general/js/main.js') }}

{{ HTML::script('admin/js/AdminLTE/app.js') }}
{{ HTML::script('admin/js/AdminLTE/demo.js') }}
{{ HTML::script('admin/js/AdminLTE/dashboard.js') }}




</body>
</html>