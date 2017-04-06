<table class="table table-bordered table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>Hora inicio</th>
      <th>Tiempo trabajado</th>
      <th>Hora final</th>
      <th>actividad</th>
      <th>empresa</th>      
    </tr>
  </thead>
  <tbody ng-repeat="skill in skills">   
    @foreach($actividades as $actividad) 
    <tr>
      <td> {{$actividad->hora_inicio}} </td>
      <td> {{psig\Helpers\horas_minutos::calcular_tiempo_trasnc($actividad->hora_final,$actividad->hora_inicio)}} </td>
      <td> {{$actividad->hora_final}}</td>
      <td> {{$actividad->actividad}}</td>
      <td> {{$actividad->empresa}}</td>        
    </tr>
    <tr>
      <td><span style="font-weight: bold;">filial</span></td>
      <td>{{$actividad->filial}}</td>
      <td><span style="font-weight: bold;">Subcontratista</span></td>
      <td>{{$actividad->subcontratista}}</td>
      <td><span style="font-weight: bold;">Desc: </span>{{$actividad->descripcion}}</td>    
    </tr>
    @endforeach
  </tbody>
</table>