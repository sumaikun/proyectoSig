<div class="row">
<div>
  <table  class="table table-hover" cellspacing="0" style="margin-top: -15px;">
      <thead>
         <tr style="text-align:center;" class="active">
            <th>#</th>
            <th><strong>Tipo</strong></th>                                          
            <th><strong>Info</strong></th>
            <th><strong>Detalle</strong></th>
          </tr>
      </thead>
      <tbody>
        <?php static $i=1; ?>
        @foreach($alerts as $alert)          
          <tr>
            <td><?php echo $i ?></td>
            <td style="max-width:60px;""><?php echo $alert["tipo"] ?></td>          
            <td style="max-width:250px; margin-left: -80px"><?php echo $alert["comment"] ?></td>
            <?php $id = $alert["id"] ?>                        
            <td><a href="{{'inventario/info/'.$id.'/'.$alert['tipo']}}"><button>Ingresar Detalles</button></a></td>
          </tr>
          <?php $i++ ?>
        @endforeach  
      </tbody>
   </table>
 </div>
 
</div>