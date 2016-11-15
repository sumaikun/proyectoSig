 
<h3>DATOS DEL PAGO</h3>
<br>
		
	<input type="hidden" value="{{$id}}" name="id">	
	
	  <div class="form-group">      
            <label>*Fecha pago</label>
            <input  class="form-control" id="fecha_elaboracion" name="fecha_pago" type="date" required/>            
      </div>

      <div class="form-group">
        <label class="form-control">Detalles</label>
        <textarea class="form-control" name="detalles"></textarea>
      </div>
          
      <div class="form-group">      
          <label>Retencion en la fuente</label>
          <input  class="form-control" max="9999000000" min="0" name="rete_fuente" value="0"  id="reembolso" type="number" required/>            
      </div>

      <div class="form-group">      
          <label>Retencion ica</label>
          <input  class="form-control" max="9999000000" min="0" name="rete_ica" value="0"  id="reembolso" type="number" required/>            
      </div>

      <div class="form-group">      
          <label>Retencion cree</label>
          <input  class="form-control" max="9999000000" min="0" name="rete_cree" value="0" id="reembolso" type="number" required/>            
      </div>

      <div class="form-group">      
          <label>otras retenciones</label>
          <input  class="form-control" max="9999000000" min="0" name="rete_otras" value="0" id="reembolso" type="number" required/>            
      </div>

      <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo" class="form-control" required>
     </div>     