 
<h3>Crear Ciudad</h3>
<br>
		
	
	
	  <div class="form-group">      
            <label>Departamento</label>
            <select class="form-control" name="departamento" required>
              <option value="">Selecciona</option>
              @foreach($departamentos as $key => $temp)
                <option value={{$key}}>{{$temp}}</option>
              @endforeach
            </select>           
      </div>

      <div class="form-group">
        <label class="form-control">Nombre Ciudad-municipio</label>
        <input type="text" class="form-control" name="nombre"></input>
      </div>
          
      