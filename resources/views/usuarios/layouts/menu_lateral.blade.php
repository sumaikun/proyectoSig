<br>
<br><br>
<ul class="nav nav-sidebar">

   <li @if($op=='inicio') {{'class="active"'}} @endif>
      <a href="{{ url('usuario/inicio') }}"><i class="fa fa-home"></i>Inicio <span class="sr-only">(current)</span></a>
   </li>


   @if(Session::get('gdocumental'))
   <li @if($op=='gdocumental') {{'class="active"'}} @endif>
      <a href="{{ url('usuario/gdocumental') }}">
         <i class="fa fa-file-text-o"></i> Gestión documental
      </a>
   </li>
   @endif 


   @if(Session::get('comunicaciones_cliente'))
   <li @if($op=='comunicaciones') {{'class="active"'}} @endif>
      <a href="{{ url('usuario/comunicaciones') }}">
         <i class="fa fa-envelope-o"></i> Comunicaciónes PRE
      </a>
   </li>
   @endif

   @if(Session::get('ofertas'))
   <li @if($op=='ofertas') {{'class="active"'}} @endif>
      <a href="{{ url('usuario/ofertas') }}">
         <i class="fa fa-cube"></i> Ofertas
      </a>
   </li>
   @endif
   
   @if(Session::get('cassima') or Session::get('admin reporte'))
   <hr><i class="fa fa-cogs"></i> Administración <hr>
   @endif   
</ul>

<ul class="nav nav-sidebar">
   
   @if(Session::get('cassima'))
   <li @if($op=='cassima') {{'class="active"'}} @endif>
      <a href="{{ url('usuario/cassima') }}">
         <i class="fa fa-google-wallet"></i> CASSIMA
      </a>
   </li>
   @endif

    @if(Session::get('admin_reporte'))
   <li @if($op=='admin_reporte') {{'class="active"'}} @endif>
      <a href="{{ url('usuario/admin_reporte') }}">
         <i class="fa fa-cog"></i> Reporte de Actividades
      </a>
   </li>
   @endif


   @if(psig\Helpers\Metodos::exist_fac_permission(Session::get('usu_id'))==true)
   <li>
      <a href="{{ url('usuario/facturacion') }}">
         <i class="fa fa-calculator"></i> Facturación
      </a>
   </li>
   @endif

   @if(Session::get('actividades'))
   <li @if($op=='actividades') {{'class="active"'}} @endif>
      <a href="{{ url('usuario/actividades') }}">
         <i class="fa fa-child"></i> Reporte de Actividades
      </a>
   </li>
   @endif

   @if(Session::get('capacitacion'))
      <li @if($op=='capacitacion') {{'class="active"'}} @endif>
         <a href="{{ url('usuario/capacitacion') }}">
            <i class="fa fa-bug"></i> Capacitaciones
         </a>
      </li>
   @endif
   
   
   @if(Session::get('todos los registros'))
      <li @if($op=='todos los registros') {{'class="active"'}} @endif>
         <a href="{{ url('usuario/all_registers') }}">
            <i class="fa fa-users"></i> Todos los registros
         </a>
      </li>
   @endif

   @if(psig\Helpers\Metodos::exist_inv_permission(Session::get('usu_id'))==true)
   <li>
      <a href="{{ url('usuario/inventario') }}">
         <i class="fa fa-envelope"></i> Inventario
      </a>
   </li>
   @endif
 
</ul>
      