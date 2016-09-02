<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   <!-- Brand and toggle get grouped for better mobile display -->
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><strong>SIG 1.0</strong></a>
   </div>

   <!-- Collect the nav links, forms, and other content for toggling -->
   <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
         <li @if($op=='inicio') {{'class="active"'}} @endif>
            <a href="{{ url('usuario/inicio') }}"><i class="fa fa-home"></i> <strong>Inicio</strong></a>
         </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
            Hola! <strong>{{ucwords (Session::get('usu_nombres'))." ".ucwords (Session::get('usu_apellido1'))}}</strong>
            <b class="caret"></b></a>
            <ul class="dropdown-menu">
               <li>
                  <div class="navbar-content">
                     <div class="row">
                        <div class="col-md-5">
                           @if(Session::get('usu_foto'))
                              {{ HTML::image(Session::get('usu_foto'), 'foto', array('class' => 'img-responsive')) }}
                           @else
                              <img src="http://placehold.it/120x120" alt="Alternate Text" class="img-responsive" />
                           @endif
                           <p class="text-center small"></p>
                        </div>
                        <div class="col-md-7">
                           <span>{{ucwords (Session::get('usu_nombres'))." ".ucwords (Session::get('usu_apellido1'))}}</span>
                           <p class="text-muted small">{{Session::get('usu_email')}}</p>
                           <div class="divider"></div>
                           <small>{{Session::get('carg_nombre')}}</small>
                        </div>
                     </div>
                  </div>
                  <div class="navbar-footer">
                     <div class="navbar-footer-content">
                        <div class="row">
                           <div class="col-md-6">
                              <a href="{{ url('usuario/cuenta') }}" class="btn btn-default btn-sm"><i class="fa fa-info-circle"></i> Información de acceso</a>
                           </div>
                           <div class="col-md-6">
                              <a href="{{ url('logout') }}" class="btn btn-danger btn-sm pull-right">Terminar sesión <i class="fa fa-sign-out"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </li>
      </ul>
   </div>
</nav>