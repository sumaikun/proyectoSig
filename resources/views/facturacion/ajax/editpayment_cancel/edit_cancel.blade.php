 
<h3>ANULAR FACTURA-EDITAR</h3>
<br>
		<input type="hidden" value="{{$id}}" name="id">
    <div class="form-group">
	    <label class="form-control">Detalles</label>
	    <textarea class="form-control" name="detalles">{{$info->detalles}}</textarea>
	</div>  
	<div class="form-group">
        <label class="form-control">Archivo</label>
        <input type="file" name="archivo" class="form-control">
    </div>  