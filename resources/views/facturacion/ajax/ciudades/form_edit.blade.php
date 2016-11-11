 
<h3>Editar Ciudad</h3>
<br>
		
	 <input type="hidden" value="{{$id}}" name="id">
	
	  <div class="form-group">      
            <label>Departamento</label>
            <select class="form-control" name="departamento" required>
              <option value="">Selecciona</option>
              @foreach($departamentos as $key => $temp)
                <option value="{{$key}}" @if($key == $ciudad->departamento_id) {{'selected'}}  @endif>{{$temp}}</option>
              @endforeach
            </select>           
      </div>

      <div class="form-group">
        <label class="form-control">Nombre Ciudad-municipio</label>
        <input type="text" class="form-control" value="{{$ciudad->nombre}}" name="nombre"></input>
      </div>
          
      