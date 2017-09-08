<div class="table-responsive ocultar_400px">
<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <th>id</th>
    <th>Codigo</th>
    <th>Categoria</th>
    <th>Serial</th>
  </thead>
  <tbody>    
    @foreach($seriales as $serial)
    <tr> 
      <td> {{$serial->id}} </td>
      <td> {{$serial->elemento->codigo}}</td>
      <td> @if(isset($categorias[$serial->elemento->categoria])) {{$categorias[$serial->elemento->categoria]}} @endif</td>
      <td> {{$serial->valor}}</td>
    </tr>
    @endforeach    
  </tbody>
</table>
</div> 

