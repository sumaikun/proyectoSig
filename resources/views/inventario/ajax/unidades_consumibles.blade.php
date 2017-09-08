<div class="table-responsive ocultar_400px">
  <table id="example3" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <th>id</th>
      <th>Codigo</th>
      <th>Descripcion</th>
      <th>Cantidad</th>
      <th>serial general</th>
    </thead>
    <tbody>
      @foreach($consumibles as $consumible)
      <tr>
        <td> {{$consumible->id}} </td>
        <td> {{$consumible->codigo}} </td>
        <td> {{$consumible->descripcion}} </td>
        <td> {{$consumible->cantidad}} </td>
        <td> {{$consumible->serial_general}} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
$(document).ready(function() {
    

   
    $('#example3').DataTable({
       "bSort": false,
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            }
    });
  
  });
</script>