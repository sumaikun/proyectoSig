<style>
  .inactive {
     pointer-events: none;
     cursor: default;
  } 
</style>

<table id="ticketlist" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
       <tr class="active">
          <th>#</th>          
          <th><strong>Fecha ingreso</strong></th>
          <th><strong>Fecha salida</strong></th>
          <th><strong>valor normal</strong></th>                                 
          <th><strong>valor receso</strong></th>
          <th><strong>cliente</strong></th>
          <th><strong>usuario</strong></th>
        </tr>
    </thead>
    <tbody>
      @foreach($Alquileres as $alquiler)
        <tr>
           <td> {{$alquiler->id}} </td>
           <td> {{$alquiler->fecha_ingreso}} </td>
           <td> {{$alquiler->fecha_salida}} </td>
           <td> {{$alquiler->valor}} </td>
           <td> {{$alquiler->valor2}} </td>
           <td> {{$alquiler->id_empresa}} </td>
           <td> {{$alquiler->id_usuario}} </td>                     
        </tr>
      @endforeach  
    </tbody>
 </table>



