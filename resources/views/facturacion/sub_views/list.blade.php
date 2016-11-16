<div class="col-lg-12">
   <div class="panel panel-primary">
      <div class="panel-heading" style="min-height: 35px;">
         <div class="col-lg-10">
         <h3 class="panel-title"><i class="fa fa-list"></i> Facturas</h3>
         </div> 
          <div class="col-log-2">
             <form action='../actividades/list'  method="post">
              <select name="year_list"  class="form-control" onchange="javascript: this.form.submit();">
                   @for ($i = 2016; $i <= date('Y'); $i++)
                      <option value="{{$i}}" @if($i == Session::get('usu_listy')) {{'selected'}} @endif>{{{$i}}}</option>
                  @endfor
              </select>
           </form> 
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
                  <th><strong>Consecutivo</strong></th>
                  <th><strong>facturadora</strong></th>
                  <th><strong>cliente</strong></th>                  
                  <th style="text-align: center"><strong>valor factura</strong></th>
                  <th style="text-align: center"><strong>fecha de elaboracion</strong></th>
                  <th style="text-align: center"><strong>fecha de vencimiento</strong></th>
                  @if(Session::get('ver_pago')!=null)
                  <th style="text-align: center"><strong>status</strong></th>
                  @endif
                  <th style="text-align: center"><strong>informacion detallada</strong></th>
                  <th></th>
                  <th></th>
                  @if(Session::get('gene_factura')!=null)
                  <th></th>
                  <th></th>
                  @endif
               </tr>
            </thead>
            <tbody>
            
            @foreach($registros as $registro)
               <tr>
                  <td></td>
                  <td>{{ucwords($registro->consecutivo)}}</td>
                  <td>{{ucwords($registro->facturadoras->nombre)}}</td>
                  <td>{{ucwords ($registro->clientes->nombre)}}</td>              
                  <td style="text-align: center">${{$registro->total}}</td>
                  <td style="text-align: center">{{ucwords ($registro->fecha_elaboracion)}}</td>
                  <td style="text-align: center">{{ucwords ($registro->fecha_vencimiento)}}</td>
                   @if(Session::get('ver_pago')!=null)
                  <td style="text-align: center">
                    @if($registro->status==0)
                      {{ucwords("PENDIENTE")}}
                    @elseif($registro->status==1)
                      {{ucwords("PAGADA")}}
                    @else
                      {{ucwords("ANULADA")}}    
                    @endif                    
                  </td>
                  @endif
                  <td style="text-align: center"><button data-toggle="modal" data-target="#myModal" onclick="grab_data({{ $registro->id}})" id="detail_bill"><i class="fa fa-server" aria-hidden="true"></i></button></td>

                  @if(Session::get('rol_nombre')=='administrador'||Session::get('ver_pago')!=null)
                  <td>
                     <!--<a class='btn btn-danger btn-xs' href="{{ url('admin/facturacion/cancel/'.$registro->id) }}">-->
                      <button class='btn btn-danger btn-xs' id="anular" onclick="anular_pagar({{$registro->status}},{{$registro->id}},'anular')">  
                        <i class="fa fa-pencil-square-o"></i> ANULAR
                      </button>  
                     <!--</a>--> 
                  </td>
                  <td>
                     <!--<a class='btn btn-success btn-xs' href="{{ url('admin/facturacion/payed/'.$registro->id) }}">-->
                      <button class='btn btn-success btn-xs' id="pagar" onclick="anular_pagar({{$registro->status}},{{$registro->id}},'pagar')">   
                        <i class="fa fa-pencil-square-o"></i> Marcar Pagado
                      </button>  
                     <!--</a>--> 
                  </td>
                  @endif
                  @if(Session::get('gene_factura')!=null)
                  <td>
                     <a class="btn btn-warning btn-xs" href="descargar_factura/{{$registro->id}}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar</a> 
                  </td>
                  <td>
                     <button class="btn btn-primary btn-xs" onclick="anexar_soporte({{$registro->id}})"><i class="fa fa-file" aria-hidden="true"></i> Anex. Soporte</button> 
                  </td>
                  @endif
               </tr>
            
            @endforeach
            </tbody>
         </table>
         </div>
   </div>
</div>
