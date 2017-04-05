<div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Listado de actividades</h3>
         </div> 
          <div class="col-log-2">
      
          
         <form action='../actividades/list'  method="post">
            <select name="year_list"  class="form-control" onchange="javascript: this.form.submit();">
                   @for ($i = 2016; $i <= date('Y'); $i++)
                      <option value="{{$i}}" @if($i == Session::get('usu_listy')) {{'selected'}} @endif>{{{$i}}}</option>
                  @endfor
            </select>
         </form>   
          @if(Session::get('rol_nombre')=='administrador')
            <a class="btn btn-success "  data-toggle="modal" data-target="#myModal" href="">
                <i class="fa fa-file-excel-o"></i> Exportar
            </a>
          @else
            <a class="btn btn-success " href="{{url('usuario/actividades/export_excel')}}">
                <i class="fa fa-file-excel-o"></i> Exportar
            </a>
          @endif  
         </div>
      </div>
      <div class="panel-body">
         <!--<a href="{{ url('admin/nuevousuario') }}" class="btn btn-primary btn-xs pull-right"><b>+</b> Agregar Usuario</a>-->
         <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="buscador" />
      </div>
         
         <div class="table-responsive ocultar_400px">
         <table class="table table-hover table-condensed" id="dev-table">
            <thead>
               <tr class="active">
                  <th>#</th>
                  <th><strong>Usuario</strong></th>
                  <th><strong>Calendario</strong></th>        
               </tr>
            </thead>
            <tbody>
              @foreach($registros as $registro)
                <tr>
                  <td>{{$registro->usuario}}</td>
                  <td>{{ucwords($registro->usuarios->usu_nombres)}} {{ucwords($registro->usuarios->usu_apellido1)}}</td>
                  <td><button class="btn btn-warning" onclick="look_for_calendar({{$registro->usuario}})">Observar historial de actividades</button></td>
                </tr>
              @endforeach
            </tbody>
         </table>
         </div>

   </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calendario</h4>
      </div>
      <div class="modal-body">
        
        <div class="calendarbody">

          <div id='calendar'></div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Información detallada</h4>
      </div>
      <div class="modal-body">        
        <div id="ajax_content" style="max-height: 300px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

