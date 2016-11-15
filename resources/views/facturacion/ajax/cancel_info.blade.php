<button class='btn btn-success btn-xs' id="pagar" onclick="editar_informacion({{$info->id}},'anulado')">Editar</button>
<a href="soporte_anulacion/{{$info->archivo}}">Soporte</a>   
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Detalles</th>
    </tr>
  </thead>
  <tbody>
      <td>{{$info->created_at}}</td>
      <td>{{$info->detalles}}</td>
  </tbody>
</table>