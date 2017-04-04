<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><strong>Actividad</strong></h3>
       </div>
       <div class="panel-body">
        <div class="ocultar" style="max-height: 460px !important">
     

        <div class="col-lg-9 col-md-9 col-xs-9">

          <form name="form1" id="form1" action="registraractividad" onsubmit="return validar()" method="post" enctype="multipart/form-data">

    
      
          <div class="form-group">      
                <label>Fecha</label>
                <input  class="form-control" name="fecha" type="date" required/>            
          </div>  

          <div class="form-group">
          <label>Actividad</label>
          <select class="form-control" name=actividad required>
            <option value="">Selecciona</option>
          @foreach($actividades as $actividad)
            <option value={{$actividad->id}}>{{$actividad->nombre}}</option>
          @endforeach 
          </select>
          </div>

          <div class="form-group">
          <label>Empresa</label>
          <select class="form-control" name="empresa" required>
            <option value="">Selecciona</option>
          @foreach($empresas as $empresa)
            <option value={{$empresa->id}}>{{$empresa->nombre}}</option>
          @endforeach   
          </select>
          </div>


          <div class="form-group">
          <label>Filial/Lugar</label>
          <input class="form-control" name="filial" type="text" maxlength="30" placeholder="Filial" required/>
          </div>          

          <div class="form-group">
          <label>Subcontratista/Tema</label>
          <input class="form-control" name="subcontratista" type="text" maxlength="100" placeholder="Subcontratista/tema" required/>
          </div>
      
      <div class="form-group">
          <label>Numero de horas</label>
           <input type="number" name="horas" min="0" max="24" class="form-control" placeholder="Numero de horas" required>
      </div>

      <div class="form-group">
          <label>Numero de minutos</label>
           <input type="number" name="minutos" min="1" max="59" class="form-control" placeholder="Numero de minutos" required>
      </div>

      <div class="form-group">
          <label>Descripción de actividad</label>
          <textarea class="form-control" placeholder="Descripción de habilidad" maxlength="500" name="descripcion" cols="50" row="10" style="height:100px"></textarea>
      </div>

              <div class="col-lg-6 col-lg-offset-6 col-xs-12">
                <button type="submit" onclick="clicked();" class="btn btn-success">
                      <i class="fa fa-floppy-o"></i> <b>Guardar</b>
                </button>
                <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>      
              </div>

          </form>
        </div>

        
        <div class="divider"></div>

          
       
        </div>
       </div>
       
       <div class="panel-footer">
        <strong>Nota:</strong> Todos los campos marcados con asteriscos (*) son obligatorios
       </div>
                
    </div>