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
        <td>{{$seguimiento->seguimiento}}</td>
        <td>{{$seguimiento->usuario}}</td>
        <td> <button  title='guardar' onclick='save_register({{$seguimiento->id}})'><i class='fa fa-floppy-o' aria-hidden='true'></i> </button> <button title='eliminar' onclick='delete_register({{$seguimiento->id}})'><i class='fa fa-trash' aria-hidden='true'></i></button> </td>
       </tr>
      @endforeach 
      </tbody>
      </table>
    </div>
    </ol>
  </section>
 
<script>
    

 

function big_text_edit(elem){
  var id = $(elem).css("white-space","normal");   
}

function big_text_edit_over(elem){  
  var id = $(elem).css("white-space","nowrap");   
}

/*
function save_register(id){   
 var id = $('input[name='id']').val(); 
 var seguimiento = $('input[name='seguimiento']').val();
   
  token = $("input[name='_token']").val();
  
  $.post('update_Seguimiento/+id',{id:id,seguimiento:seguimiento} ,function(data){
      alert(data);
  });
    
}



function delete_register(id)
{  
  if(confirm("¿Desea reemplazar este registro  ?") ==  true)
  {
    $.get('delete_Seguimiento/+id',function(res){
      alert(res);      
    });  
  }   
}


  */
	
</script>
