 <form action="updateConsumible" onsubmit="return validar()" method="post" enctype="multipart/form-data">    

    <input type="hidden" value="{{$consumible->id}}" id="id" name="id">

     <div class="form-group">      
        <label>CODIGO</label>
        <input  class="form-control" name="codigo" value="{{$consumible->codigo}}" id="codigo" type="text"  required/>            
    </div>

    <div class="form-group">      
        <label>Descripción</label>
        <textarea class="form-control" name="descripcion" style="height: 100px;"   id="descripcion" required>{{$consumible->descripcion}}</textarea>  
    </div>

    <div class="form-group">      
        <label>cantidad</label>
        <input class="form-control" name="cantidad"   type="number" value="{{$consumible->cantidad}}"  id="cantidad" required>  
    </div>

    <div class="form-group">      
        <label>Serial general</label>
        <input class="form-control" name="serial"   type="text" value="{{$consumible->serial_general}}"  id="serial" required>  
    </div>
          
      <button type="submit" onclick="clicked();" class="btn btn-success">
            <i class="fa fa-floppy-o"></i> <b>Guardar</b>
      </button>



</form>
