<div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Listado de actividades</h3>
         </div> 
          <div class="col-log-2">
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
                  <th><strong>Fecha</strong></th>
                  <th><strong>Usuario</strong></th>
                  <th><strong>Actividad</strong></th>                  
                  <th><strong>Empresa</strong></th>
                  <th><strong>Filial</strong></th>
                  <th><strong>Subcontratistas</strong></th>
                  <th><strong>Horas</strong></th>
                  <th><strong>Descripción</strong></th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
            
            @foreach($registros as $registro)
               <tr>
                  <td></td>
                  <td>{{ucwords($registro->fecha)}}</td>
                  <td>{{ucwords($registro->usuarios->usu_nombres)}} {{ucwords($registro->usuarios->usu_apellido1)}}</td>
                  <td>{{ucwords ($registro->actividades->nombre)}}</td>              
                  <td>{{$registro->empresas->nombre}}</td>
                  <td>{{ucwords ($registro->filial)}}</td>
                  <td>{{ucwords ($registro->subcontratista)}}</td>
                  <td>{{ucwords ($registro->horas)}}</td>
                  <td>{{$registro->descripcion}}</td>
                  @if(Session::get('rol_nombre')=='administrador')
                  <td>
                     <a class='btn btn-warning btn-xs' href="{{ url('admin/actividades/edit/'.$registro->id) }}">
                        <i class="fa fa-pencil-square-o"></i> Editar
                     </a> 
                  </td>
                  @else
                  <td>
                     <a class='btn btn-warning btn-xs' href="{{ url('usuario/actividades/edit/'.$registro->id) }}">
                        <i class="fa fa-pencil-square-o"></i> Editar
                     </a> 
                  </td>
                  @endif
               </tr>
            
            @endforeach
            </tbody>
         </table>
         </div>

   </div>
</div>
