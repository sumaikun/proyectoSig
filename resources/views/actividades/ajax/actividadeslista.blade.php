
<table id="sample"  style="font-size: 75%;" class="table table-bordered table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>Fecha</th>
      <th>Actividad</th>
      <th>Empresa</th>
      <th>Filial</th>
      <th>Subcontratista</th>
      <th>Tiempo</th>
      <th>Hora inicial</th>
      <th>Hora final</th>
      <th>Descripción</th>      
    </tr>
  </thead>
  <tbody>   
    @foreach($actividades as $actividad) 
    <tr>
      <td> {{$actividad->fecha}}</td>
      <td> {{$actividad->actividades->nombre}}</td>
      <td> {{$actividad->empresas->nombre}}</td>
      <td> {{$actividad->filial}}</td>
      <td> {{$actividad->subcontratista}}</td>
      <td> {{psig\Helpers\horas_minutos::calcular_tiempo_trasnc($actividad->hora_final,$actividad->hora_inicio)}} </td>
      <td> {{$actividad->hora_inicio}} </td>      
      <td> {{$actividad->hora_final}}</td>
      <td> {{$actividad->descripcion}}</td>              
    </tr>    
    @endforeach
  </tbody>
</table>
