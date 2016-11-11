 
<h3>Editar Entidad Bancaria</h3>
<br>
    
    <input type="hidden" name="id" value="{{$id}}">
    <div class="form-group">      
        <label class="form-control">Facturadora</label>
        <select class="form-control" name="empresa" required>
          <option value="">Selecciona</option>
          @foreach($empresas as $key => $temp)
            <option value={{$key}} @if($key == $cuenta->fact_id) {{'selected'}}  @endif>{{$temp}}</option>
          @endforeach
        </select>           
      </div>
    
     <div class="form-group">      
        <label class="form-control">Entidad Bancaria</label>
        <select class="form-control" name="banco" required>
          <option value="">Selecciona</option>
          @foreach($bancos as $key => $temp)
            <option value={{$key}} @if($key == $cuenta->banco_id) {{'selected'}} @endif>{{$temp}}</option>
          @endforeach
        </select>           
      </div>

      <div class="form-group">
        <label class="form-control">No. Cuenta </label>
        <input type="number" class="form-control" value="{{$cuenta->numero}}" name="cuenta" required></input>
      </div>      

      <div class="form-group">
        <label class="form-control">Tipo de cuenta</label>
        <label class="form-control">Ahorros</label>
        <input type="radio" class="form-control" value=1 name="tipo" checked></input>
        <label class="form-control">Corriente</label>
        <input type="radio" class="form-control" value=2 name="tipo"></input>
      </div>

      <div class="form-group">
        <label class="form-control">Estado</label>
        <label class="form-control">Activa</label>
        <input type="radio" class="form-control" value=1 name="estado" checked></input>
        <label class="form-control">Inactiva</label>
        <input type="radio" class="form-control" value=0 name="estado"></input>
      </div>

          
      