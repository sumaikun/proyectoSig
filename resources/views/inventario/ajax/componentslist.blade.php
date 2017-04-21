<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
       <tr class="active">
          <th>#</th>
          <th><strong>Nombre</strong></th>
          <th><strong>imagen</strong></th>                                 
          <th><strong>Opciones</strong></th>
        </tr>
    </thead>
    <tbody>
      @foreach($components as $component)
        <tr>
          <td> {{$component->id}} </td>
          <td> {{$component->nombre}} <a href="#" data-toggle="modal" onclick="edit_name({{$component->id}})"" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></td>
          <td>  </td>
           <td>
           </td>            
        </tr>
      @endforeach  
    </tbody>
 </table>
 <button class="btn btn-primary"  onclick="new_serial()" title="crear nuevo"><span class="glyphicon glyphicon-plus"></span></button>






 <script>

 function new_serial(id)
 { 
    $('#myModal6').modal('show');
    $('#newsid').val(id);

 }

 function edit_name(id,name)
 {
    $('#myModal7').modal('show');
    $('#namesid').val(id);
    $('#namese').val(name);  
 }

 function rentthis(id)
 {
   $("#rent_form").trigger("reset");
   $("#objectid").val(id);
 }

 
 </script>