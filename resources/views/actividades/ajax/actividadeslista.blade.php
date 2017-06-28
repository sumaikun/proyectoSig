<style>
  td {
       max-width: 200px;
       white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;    
     }
</style>
<table id="sample"  style="font-size: 85%;" class="table table-bordered table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>Fecha</th>
      <th>Actividad</th>
      <th>Cliente</th>
      <th>Empresa</th>
      <th>Filial</th>
      <th>Subcontratista</th>
      <th>Tiempo</th>
      <th>Hora inicial</th>
      <th>Hora final</th>
      <th>Descripción</th>
      <th>Opciones</th>      
    </tr>
  </thead>
  <tbody>   
    @foreach($actividades as $actividad) 
    <tr>
      <td> {{$actividad->fecha}}</td>
      <td> {{$actividad->actividades->nombre}}</td>
      <td> {{$actividad->empresas->nombre}}</td>
      <td> {{$actividad->propias->nombre}}</td>
      <td> {{$actividad->filial}}</td>
      <td> {{$actividad->subcontratista}}</td>
      <td> {{psig\Helpers\horas_minutos::calcular_tiempo_trasnc($actividad->hora_final,$actividad->hora_inicio)}} </td>
      <td> {{$actividad->hora_inicio}} </td>      
      <td> {{$actividad->hora_final}}</td>
      <td  onclick="big_text_edit(this)" onblur="big_text_edit_over(this)"> {{$actividad->descripcion}}</td>              
      <td> <button class="btn btn-warning" onclick="edit_register({{$actividad->id}})">Editar</button></td>
    </tr>    
    @endforeach
  </tbody>
</table>
