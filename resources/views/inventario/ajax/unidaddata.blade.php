<?php $TOTAL = 0 ?>
@if($check_use_data != null)
<div class="alert alert-warning">
  <strong>¡Aviso!</strong> Hay herramientas que no pueden alquilarse con la unidad por que no se encuentran en bodega.
</div>
<table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <th>id</th>
    <th>Codigo</th>
    <th>Categoria</th>
    <th>Serial</th>
    <th>Opciones</th>
  </thead>
  <tbody>    
    @foreach($check_use_data as $serial)
    <tr> 
      <td> {{$serial->id}} </td>
      <td> {{$serial->elemento->codigo}}</td>
      <td> @if(isset($categorias[$serial->elemento->categoria])) {{$categorias[$serial->elemento->categoria]}} @endif</td>
      <td> {{$serial->valor}}</td>
      <?php $id = $serial->id; if($serial->id_status == 2){$tipo = 'mantenimiento';} else{$tipo = 'alquiler';} ?>
      <td><a href="{{'info/'.$id.'/'.$tipo}}" target="_blank"><button>Ingresar Detalles</button></a></td>
    </tr>
    @endforeach    
  </tbody>
</table>
    
@endif

<br>
<div class='col-lg-6 col-md-6'>
<table class='table'>
  <tr>
    <th>Herramientas Disponibles</th>      
  </tr>
  @foreach($seriales as $serial)
    <tr>    
      <td> @if(isset($categorias[$serial->elemento->categoria])) {{$categorias[$serial->elemento->categoria]}} @endif</td>
      <td> {{$serial->valor}}</td>
      <td> ${{$serial->elemento->precio}}</td>
      <?php $TOTAL +=  $serial->elemento->precio?>      
    </tr>
  @endforeach
</table>
</div>
<br>
<div class='col-lg-6 col-md-6'>
<table class='table'>
  <tr>
    <th>Consumibles Disponibles</th>      
  </tr>
   @foreach($consumibles as $consumible)
      <tr>    
        <td> {{$consumible->descripcion}}</td>
        <td> {{$consumible->cantidad}}</td>
        <td> precio individual: ${{$consumible->precio}}</td>
        <td> precio total: ${{($consumible->precio)*($consumible->cantidad)}}</td>
        <?php $TOTAL +=  ($consumible->precio)*($consumible->cantidad); $ticketprice = ($consumible->precio)*($consumible->cantidad);?>      
      </tr>
    @endforeach
</table>
</div>
<span>VALOR RECOMENDADO FINAL ${{$TOTAL}} </span>
<br>

<div class='col-lg-12 col-md-12'>
<form action='rent_all_data' method='post' onsubmit="return confirm_alldata()">
  <div class='form-group'>
    <input id="id-h" type="hidden" name="id">
    <input id="cliente-h" type="hidden" name="cliente">
    <input id="fecha1-h" type="hidden" name="fecha1">
     <input id="fecha2-h" type="hidden"  name="fecha2">
     <input name="ticketp" value="{{$ticketprice}}" type="hidden"> 
    <label class="form-control">Valor estandar</label>
    <input class="form-control" value="{{$TOTAL}}" min='100000' name='valor_estandar' required>
  </div>
  <div class='form-group'>
    <label class="form-control">Valor receso</label>
    <input class="form-control" min='100000' name='valor_receso' required>
  </div>
  <button class="form-control btn btn-success" type='submit'>Alquilar</button>  

</form>
</div>

<script>
  function confirm_alldata()
  {
    if(confirm('este proceso cambiara de estatus todas las herramientas asociadas al alquiler y generara un ticket por todos los consumibles asociados y estos no podran volver a utilizarse ¿Desea continuar?'))
    { return true;}
    else{ return false;}
  }

  execute();

  function execute()
  {
    $("#cliente-h").val($("#empresa").val());
    $("#fecha1-h").val($("#fecha1").val());
    $("#fecha2-h").val($("#fecha2").val());
    $("#id-h").val($("#id").val());
  }
</script>