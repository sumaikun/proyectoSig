@if($check_use_data != null)
<div class="alert alert-warning">
  <strong>¡Aviso!</strong> Hay herramientas que no pueden alquilarse con la unidad por que no se encuentran en bodega.
</div>
<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <th>id</th>
    <th>Codigo</th>
    <th>Categoria</th>
    <th>Serial</th>
    <th>Opciones</th>
  </thead>
  <tbody>    
    @foreach($check_use_data as $serial)
    <tr> 
      <td> {{$serial->id}} </td>
      <td> {{$serial->elemento->codigo}}</td>
      <td> @if(isset($categorias[$serial->elemento->categoria])) {{$categorias[$serial->elemento->categoria]}} @endif</td>
      <td> {{$serial->valor}}</td>
      <?php $id = $serial->id; if($serial->id_status == 2){$tipo = 'mantenimiento';} else{$tipo = 'alquiler';} ?>
      <td><a href="{{'info/'.$id.'/'.$tipo}}" target="_blank"><button>Ingresar Detalles</button></a></td>
    </tr>
    @endforeach    
  </tbody>
</table>
    
@endif
<table class='table'>
  <tr>
    <th>Herramientas</th>

  </tr>
</table>