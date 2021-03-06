<div class="table-responsive">
<style>
  .inactive {
     pointer-events: none;
     cursor: default;
  } 
</style>

<table id="ticketlist" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
      <th colspan="7" style="text-align: center;">Alquileres</th>
    </tr>
       <tr class="active">
          <th>#</th>          
          <th><strong>Fecha ingreso</strong></th>
          <th><strong>Fecha salida</strong></th>
          <th><strong>valor normal</strong></th>                                 
          <th><strong>valor receso</strong></th>
          <th><strong>cliente</strong></th>
          <th><strong>usuario</strong></th>
        </tr>
    </thead>
    <tbody>
      @foreach($Alquileres as $alquiler)
        <tr>
           <td> {{$alquiler->id}} </td>
           <td> {{$alquiler->fecha_ingreso}} </td>
           <td> {{$alquiler->fecha_salida}} </td>
           <td> {{$alquiler->valor}} </td>
           <td> {{$alquiler->valor2}} </td>
           <td> {{$alquiler->id_empresa}} </td>
           <td> {{$alquiler->usuarios->usu_nombres}} {{$alquiler->usuarios->usu_apellido1}} </td>                     
        </tr>
      @endforeach  
    </tbody>
 </table>

 <table id="ticketlist2" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
       <tr><th colspan="4" style="text-align:center;">Mantenimientos</th></tr> 
       <tr class="active">
          <th>#</th>          
          <th><strong>Fecha</strong></th>
          <th><strong>info extra</strong></th>
          <th><strong>Salida</strong></th>    
        </tr>
    </thead>
    <tbody>
      @foreach($Mantenimientos as $reparacion)
        <tr>
           <td> {{$reparacion->id}} </td>
           <td> {{$reparacion->fecha}} </td>
           <td> {{$reparacion->info_extra}} </td>
           <td> {{$reparacion->updated_at}} </td>                     
        </tr>
      @endforeach  
    </tbody>
 </table>
</div>


