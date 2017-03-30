<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
       <tr class="active">
          <th>#</th>
          <th><strong>Serial</strong></th>
          <th><strong>Status</strong></th>                                 
          <th><strong>Opciones</strong></th>
        </tr>
    </thead>
    <tbody>
      @foreach($seriales as $serial)
        <tr>
          <td> {{$serial->id}} </td>
          <td> {{$serial->valor}} <a href="#" data-toggle="modal" onclick="edit_name({{$serial->id}},'{{$serial->valor}}')" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></a></td>
          <td> {{$serial->nombre}} </td>
           <td><a href="#" data-toggle="modal" onclick="rentthis({{$serial->id}})" data-target="#myModal3" title="Alquilar" style="margin-left: 5px;"><i class="fa fa-briefcase" aria-hidden="true"></i></a><a href="#" title="Detalles" style="margin-left: 5px;"><i class="fa fa-calendar" aria-hidden="true"></i></a><a href="serialdelete/{{$serial->id}}" onclick="return confirm_action()" title="Borrar" style="margin-left: 5px;"><i class="fa fa-times" aria-hidden="true"></i></a>
           </td>            
        </tr>
      @endforeach  
    </tbody>
 </table>
 <button class="btn btn-primary"  onclick="new_serial({{$serial->id_elementos}})" title="crear nuevo"><span class="glyphicon glyphicon-plus"></span></button>






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