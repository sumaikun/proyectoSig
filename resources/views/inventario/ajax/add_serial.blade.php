 <form action="addSerial" onsubmit="return validar()" method="post" enctype="multipart/form-data">    

    <input type="hidden" value="{{$element->id}}" id="id" name="id">

     <div class="form-group">      
        <label>Serial</label>
        <input  class="form-control" name="codigo"  id="codigo" type="text"  required/>            
    </div>

    

     <div class="form-group">      
        <label>Status</label>
        <select class="form-control" name="categoria" id="categoria"  required>
          <option value=''>Selecciona</button></option>
          @foreach($status as  $key=>$value)
              <option value={{$key}}>{{$value}}</option>            
          @endforeach          
        </select>    
    </div>          

  
      <button type="submit" onclick="clicked();" class="btn btn-success">
            <i class="fa fa-floppy-o"></i> <b>Guardar</b>
      </button>
      <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>


</form>

