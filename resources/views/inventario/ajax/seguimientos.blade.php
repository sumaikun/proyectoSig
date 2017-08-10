 <br>
  <?php //print_r($seguimientos[0]->id) ?>
    <section class="content-header">

    <h4> <i class="fa fa-list-ul"></i>Seguimiento	</h4>
    <ol class="breadcrumb">
    <div class="table-responsive">
     <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 12px;" width="100%">
      <thead>
      <tr class="table_head">
        <th>id</th>
        <th>Fecha</th>
        <th>seguimiento</th>
        <th>usuario</th>
        <th>Opciones</th>
      </tr>  
      </thead>
     <tbody>
     @foreach($seguimientos as $seguimiento)
      <tr>
        <td>{{$seguimiento->id}}</td>
        <td>{{$seguimiento->fecha}}</td>
        <td>{{$seguimiento->seguimiento}}&nbsp&nbsp&nbsp<button title="editar" onclick="modal_edit({{$seguimiento->id}})"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
        <td>{{$seguimiento->usuario}}</td>
        <td>  <button title='eliminar' onclick='delete_register({{$seguimiento->id}})'><i class='fa fa-trash' aria-hidden='true'></i></button> </td>
       </tr>
      @endforeach 
      </tbody>
      </table>
    </div>
    </ol>
  </section>
 
 <div id="myModal5" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modificar contenido de seguimiento</h4>
      </div>
      <input type="hidden" name="id_seg">
      <div class="modal-body">        
          <label class="form-control">Seguimiento</label>
          <textarea name="seguimiento_text" class="form-control"></textarea>
      </div>
      <input type="hidden" name="data_changue" value="">
      <div class="modal-footer">
        <button type="button" onclick="save_register()" class="btn btn-success" data-dismiss="modal">Cambiar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
    

 

function big_text_edit(elem){
  var id = $(elem).css("white-space","normal");   
}

function big_text_edit_over(elem){  
  var id = $(elem).css("white-space","nowrap");   
}

function modal_edit(id)
{
  $("#myModal5").modal('show');
  $('input[name="id_seg"]').val(id);    
}

function save_register(){   
 var id = $('input[name="id_seg"]').val(); 
 var seguimiento = $('textarea[name="seguimiento_text"]').val();  
  $.post('update_seguimiento/',{id:id,seguimiento:seguimiento} ,function(data){
      alert(data);
  });
    
}

function delete_register(id)
{  
  if(confirm("¿Desea Eliminar este registro  ?") ==  true)
  {
    $.get('delete_seguimiento/'+id,function(res){
      alert(res);
      $("#myModal4").modal('hide');      
    });  
  }   
}



	
</script>
