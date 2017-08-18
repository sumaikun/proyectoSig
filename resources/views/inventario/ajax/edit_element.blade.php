 <form action="editElemento" onsubmit="return validar()" method="post" enctype="multipart/form-data">    

    <input type="hidden" value="{{$element->id}}" id="id" name="id">

     <div class="form-group">      
        <label>CODIGO</label>
        <input  class="form-control" name="codigo" value="{{$element->codigo}}" id="codigo" type="text"  required/>            
    </div>

    <div class="form-group">      
        <label>Descripción</label>
        <textarea class="form-control" name="descripcion" style="height: 100px;"   id="descripcion" required>{{$element->descripcion}}</textarea>  
    </div>

     <div class="form-group">      
        <label>Categoria</label>
        <select class="form-control" name="categoria" id="categoria"  required>
          <option value=''>Selecciona</button></option>
          @foreach($categorias as  $key=>$value)
            @if($key == $element->categoria)
            <option value={{$key}} selected>{{$value}}</option> 
            @else
            <option value={{$key}}>{{$value}}</option>
            @endif
          @endforeach
          <option value='new'>+ NUEVA CATEGORIA</button></option>
        </select>    
    </div> 

    <div class="form-group">         
      <label>Archivo</label>
      <input class="form-control" name="archivo" type="file">
    </div>         

          
      <button type="submit" onclick="clicked();" class="btn btn-success">
            <i class="fa fa-floppy-o"></i> <b>Guardar</b>
      </button>



</form>

<script>
  $('select[name=categoria]').change(function() {
    if ($(this).val() == 'new')
    {
        $('#myModal5').modal('show');
       
    }
});

$('#save_category').click(function(){
   $.get('insertar_categoria/'+$('#new_category').val(), function(res){
            
      
        var newValue = $('option', $('select[name=categoria]')).length;
        $('<option>')
            .text($('#new_category').val())
            .attr('value', res)
            .insertBefore($('option[value=new]', $('select[name=categoria]')));
        $(this).val(newValue);
        $('#myModal5').modal('hide');
        $('select[name=categoria]').val(res);
      });
});
</script>