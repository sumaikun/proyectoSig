<ul class="sidebar-menu">
   <li @if($op=='inicio') {{'class="active"'}} @endif>
      <a href="{{ url('admin/inicio') }}">
         <i class="fa fa-home"></i> <span><b>Inicio</b></span>
      </a>
   </li>
   <li @if($op=='usuarios') {{'class="active"'}} @endif>
      <a href="{{ url('admin/usuarios') }}">
         <i class="fa fa-users"></i> <span><b>Usuarios</b></span>
      </a>
   </li>
   <li @if($op=='cargos') {{'class="active"'}} @endif>
      <a href="{{ url('admin/cargos') }}">
         <i class="fa fa-puzzle-piece"></i> <span><b>Cargos</b></span>
      </a>
   </li>
   <li @if($op=='dependencias') {{'class="active"'}} @endif>
      <a href="{{ url('admin/dependencias') }}">
         <i class="fa fa-sitemap"></i> <span><b>Dependencias</b></span>
      </a>
   </li>
   <li @if($op=='modulos') {{'class="active"'}} @endif>
      <a href="{{ url('admin/modulos') }}">
         <i class="fa fa-th-large"></i> <span><b>Modulos delegados</b></span>
      </a>
   </li>

   
               <!--<li class="treeview">
                  <a href="#">
                     <i class="fa fa-folder"></i> <span>Examples</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                     <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                     <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                     <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                     <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                     <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                     <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                  </ul>
               </li> -->
</ul>