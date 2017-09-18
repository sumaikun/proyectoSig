<form method="post" id="myForm3" action="actualizar_ticket">
    <input  name="id" value=" {{$ticket->id}} " type="hidden">
    <label class="form-control">Cliente</label>
    <div class="form-group">
      <select name="cliente" id="ticket_cliente" class="form-control" required>
        <option value="">Selecciona</option>
        @foreach($empresas as $key=>$temp)
          <option  value="{{$key}}" @if($key==$ticket->cliente) {{'selected'}} @endif> {{$temp}} </option>
        @endforeach
        <option value=0>Otro</option>
      </select>
    </div>
    <div class="form-group">
      <label class="form-control">fecha</label>
      <input type='date' name='date' id='ticket_fecha' value="{{$ticket->fecha}}" class='form-control' max=<?php echo date('Y-m-d'); ?>>
    </div> 
    <div class="form-group">
      <label class="form-control">Cantidad</label>
      <input name="cantidad" min='1' id="ticket_cantidad" value="{{$ticket->cantidad}}"  class="form-control">
    </div>
    <div class="form-group">
      <label class="form-control">Precio</label>
      <input name="precio" min='0' id="ticket_precio" value="{{$ticket->precio}}" class="form-control">
    </div>
    <div class="form-group">
      <label class="form-control">Comentario</label>
      <textarea name="comentario" class="form-control">{{$ticket->comentario}}</textarea>
    </div>
    <button type="submit" class="btn btn-warning form-control">Actualizar</button>      
</form>