 <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
      <tr class=table_head>                     
       <th>Usuario</th> 
       <th>fecha - hora</th>                                   
      </tr>  
  </thead>
   <tbody>
       @foreach($usuarios as $usuario)
       <tr>
        <td>{{$usuario->nombre}} {{$usuario->apellido}}</td>
        <td>{{$usuario->hora}}</td>
       </tr>
       @endforeach 
   </tbody>           
</table> 
