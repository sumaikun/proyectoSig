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
          <th><strong>Fecha</strong></th>
          <th><strong>Cliente</strong></th>
          <th><strong>Cantidad</strong></th>
          <th><strong>Precio total</strong></th>                                 
          <th><strong>Comentario</strong></th>
          <th><strong>Opciones</strong></th>
        </tr>
    </thead>
    <tbody>
      @foreach($tickets as $ticket)
        <tr>
           <td> {{$ticket->id}} </td>
           <td> {{$ticket->fecha}} </td>
           <td> @if($ticket->cliente == 0) {{'Otros'}} @else {{$empresas[$ticket->cliente]}} @endif </td>
           <td> {{$ticket->cantidad}} </td>
           <td> {{$ticket->precio}} </td>
           <td> {{$ticket->comentario}} </td>
           <td>  <a href="#"  onclick="edit_ticket({{$ticket->id}})" title="editar" ><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="consumible/ticketdelete/{{$ticket->id}}" onclick="return confirm_action()" title="Eliminar" style="margin-left: 5px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>  </td>           
        </tr>
      @endforeach  
    </tbody>
 </table>



