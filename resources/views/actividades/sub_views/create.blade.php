<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><strong>Actividad</strong></h3>
       </div>
       <div class="panel-body">
        <div class="ocultar" style="max-height: 460px !important">
     

        <div class="col-lg-10 col-md-10 col-xs-10">         
      
          <div class="form-group">      
                <label>*Fecha</label>
                <input  class="form-control" max=<?php echo date('Y-m-d'); ?>  name="fecha" type="date" />           
          </div>
       

          <button class="btn btn-primary form-button" data-toggle="modal" data-target="#myModal" title="nueva actividad" ><span class="glyphicon glyphicon-plus"></span> Nueva Actividad</button>
        </div>
        
        
        
        <div class="divider"></div>

          
       
        </div>
       </div>
       
       <div class="panel-footer">
        <strong>Nota:</strong> Todos los campos marcados con asteriscos (*) son obligatorios
       </div>
                
    </div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresar Actividad</h4>
      </div>
      <div class="modal-body">
        <form name="form1" id="form1" action="registraractividad"  method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="fechaactividad" required>
          <div class="form-group">
            <label>*Actividad</label>
            <select class="form-control" name=actividad required>
              <option value="">Selecciona</option>
            @foreach($actividades as $actividad)
              <option value="{{$actividad->id}}">{{$actividad->nombre}}</option>
            @endforeach 
            </select>
          </div>
          <div class="form-group">
            <label>*Cliente</label>
            <select class="form-control" name="empresa" required>
              <option value="">Selecciona</option>
            @foreach($empresas as $empresa)
              <option value={{$empresa->id}}>{{$empresa->nombre}}</option>
            @endforeach   
            </select>
          </div>
          <div class="form-group">
            <label>*Empresa</label>
            <select class="form-control" name="propia" required>
              <option value="">Selecciona</option>
            @foreach($propias as $propia)
              <option value={{$propia->id}}>{{$propia->nombre}}</option>
            @endforeach   
            </select>
          </div>
          <div class="form-group">
              <label>Filial/Lugar</label>
              <input class="form-control" name="filial" type="text" maxlength="30" placeholder="Filial" />
          </div>
          <div class="form-group">
              <label>Subcontratista/Tema</label>
              <input class="form-control" name="subcontratista" type="text" maxlength="100" placeholder="Subcontratista/tema" />
          </div>
          <div class="form-group">
              <label>Descripción de actividad</label>
              <textarea class="form-control" placeholder="Descripción de la actividad" maxlength="500" name="descripcion" cols="50" row="5" style="height:100px"></textarea>
          </div>
          <div class="form-group ">
            <label>*Hora inicial</label>
            <input class="form-control" id="hini" onblur="validate_date()" name="hini" type=time min="0:00" max="100:59" required="required" >
          </div>

          <div class="form-group ">
            <label>*Hora final</label>
            <input class="form-control" id="hfin" name="hfin" type=time min="0:00" max="100:59"  required="required" disabled>  
          </div>   
          <button type="submit"  class="btn btn-success">
              <i class="fa fa-floppy-o"></i> <b>Guardar</b>
          </button>
        </form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

