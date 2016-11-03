<table class="table table-bordered">
  <thead>
    <tr>
      <th>Fecha  del registro</th>
      <th>Detalles</th>
    </tr>
  </thead>
  <tbody>
      <td>{{$info->created_at}}</td>
      <td>{{$info->detalles}}</td>
  </tbody>
</table>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Fecha de pago</th>
      <th>Ret. fuente</th>
      <th>Ret. ica</th>
      <th>Ret. cree</th>
      <th>otras ret.</th>
    </tr>
  </thead>
  <tbody>
      <td>{{$info->fecha_pago}}</td>
      <td id="rete_fuente">${{$info->rete_fuente}}</td>
      <td id="rete_ica">${{$info->rete_ica}}</td>
      <td id="rete_cree">${{$info->rete_cree}}</td>
      <td id="rete_otras">${{$info->rete_otras}}</td>

  </tbody>
</table>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Pago neto</th>      
    </tr>
  </thead>
  <tbody>
      <td id="pago_neto" style="font-weight: bold; text-align:center"></td>
  </tbody>
</table>