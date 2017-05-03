<div class="row">
  <div class="col-lg-8 col-md-8">
    <table id="example2" class="table  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
           <tr class="active">
              <th>#</th>
              <th><strong>Nombre</strong></th>                                          
              <th><strong>Opciones</strong></th>
            </tr>
        </thead>
        <tbody>
          @foreach($components as $component)
            <tr onmouseover="show_image({{$component->id}})" onmouseleave="hide_image()">
              <td> {{$component->id}} </td>
              <td> {{$component->nombre}} </td>          
              <td><a href="#" data-toggle="modal" onclick="edit_name({{$component->id}})"" title="editar" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>            
            </tr>
          @endforeach  
        </tbody>
     </table>
     <button class="btn btn-primary"  onclick="new_component({{$id}})" title="crear nuevo"><span class="glyphicon glyphicon-plus"></span></button>
   </div>
   <div class="col-lg-4 col-md-4">
      <div style="width:200px; height: 200px; border-style: solid; border-color: black;" id="image-space"></div>
   </div>  
</div>





 <script>

 <?php $elements = json_encode($components)?>  

 var array_objects =  <?php echo $elements ?> ;


 function new_component(id)
 { 
    $('#myModal9').modal('show');
    $('input[name="elementcomp"]').val(id);

 }

 function show_image(id)
 {
    $("#image-space").empty();
    //console.log('mostrar id '+id);
    //console.log(array_objects[id-1].imagen);
    $("#image-space").append('<img src="/inventarios_imagenes/'+array_objects[id-1].imagen+'" class="img-responsive" alt="Cinque Terre" width="304" height="236">');
 }

 function hide_image()
 {
    $("#image-space").empty();
 }
 
 </script>