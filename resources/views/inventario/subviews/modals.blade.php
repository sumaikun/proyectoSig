<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-warning">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar</h4>
      </div>
      <div class="modal-body">
        <div id="ajax-content2"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->


<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gestión</h4>
      </div>
      <div class="modal-body">
        <div id="ajax-content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Categorias
            </h4>
         </div>
         <div class="modal-body">              
            <div class="row">  
              <div class="col-lg-12">
                <div class="form-group">      
                  <label>INGRESE EL NOMBRE DE LA NUEVA CATEGORIA</label>
                  <input  class="form-control" name="new_category" id="new_category" type="text"  required/>            
                </div>
              </div>
            </div>      
         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="save_category"   class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Nuevo Serial
            </h4>
         </div>
         <div class="modal-body">              
             <form action="addSerial" onsubmit="return validar()" method="post" enctype="multipart/form-data">   

                <input type="hidden" value="" id="newsid" name="newsid">

                 <div class="form-group">      
                    <label>Serial</label>
                    <input  class="form-control" name="serial"  id="codigo" type="text"  required/>            
                </div>
                

                 <div class="form-group">      
                    <label>Status</label>
                    <select class="form-control" name="status" id="status"  required>
                      <option value=''>Selecciona</button></option>
                      @foreach($estados as  $key=>$value)
                          <option value={{$key}}>{{$value}}</option>            
                      @endforeach          
                    </select>    
                </div>          

              
                  <button type="submit" onclick="clicked();" class="btn btn-success">
                        <i class="fa fa-floppy-o"></i> <b>Guardar</b>
                  </button>
                  <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
            </form>

         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Cambiar valor del Serial
            </h4>
         </div>
         <div class="modal-body">              
             <form action="editSerialname" onsubmit="return validar()" method="post" enctype="multipart/form-data">   

                <input type="hidden" value="" id="namesid" name="namesid">

                 <div class="form-group">      
                    <label>Serial</label>
                    <input  class="form-control" name="serial"  id="namese" type="text"  required/>            
                </div>
                
                  <button type="submit" onclick="clicked();" class="btn btn-success">
                        <i class="fa fa-floppy-o"></i> <b>Guardar</b>
                  </button>
                  <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
            </form>

         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Componentes
            </h4>
         </div>
         <div class="modal-body">              
             <div id="ajax-content3"></div>
         </div>
         <div class="modal-footer">
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" action="newComponent">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">
               <i class="fa fa-plus-square-o"></i>Nuevo componente
            </h4>
         </div>
         <div class="modal-body">            
            <input type="hidden" value="" name="elementcomp">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre">                  
              </div>
              <div class="form-group">
                <label>Archivo</label>
                <input type="file" class="form-control" name="archivo">                  
              </div>         
         </div>
         <div class="modal-footer">
            <button class="btn btn-success">Guardar</button>
            <button type="button"  id="close_category" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
   </form>
</div>

<!-- Modal -->

<!-- Modal -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alquilar</h4>
      </div>
      <div class="modal-body">
       <form action="alquilar" onsubmit="return validar()" method="post" id="rent_form" enctype="multipart/form-data">
        <input type="hidden" value="" id="objectid" name="objectid">
         <div class="form-group">      
            <label class="form-control">Selecciona el cliente</label>
            <select name="empresa" class="form-control">
              <option>Selecciona</option>
              @foreach($empresas as $key=>$value)
                <option value={{$key}}>{{$value}}</option>
              @endforeach 
            </select>            
        </div>

        <div class="form-group">      
            <label class="form-control">Fecha de alquiler</label>
            <input type="date" id="fecha1" name="fecha1" class="form-control">            
        </div>

        <div class="form-group">      
            <label class="form-control">Fecha estimada de regreso</label>
            <input type="date" id="fecha2" name="fecha2" class="form-control">            
        </div>

        <div class="form-group">      
            <label class="form-control">Valor estandar</label>
            <input type="number" min="10000" name="valor" class="form-control">            
        </div>

        <div class="form-group">      
            <label class="form-control">Valor en receso</label>
            <input type="number" min="0" name="valor2" class="form-control">            
        </div>
        
        <button type="submit" onclick="clicked();" class="btn btn-success">
              <i class="fa fa-floppy-o"></i> <b>Guardar</b>
        </button>
        <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!--modal-->

<div id="myModalRep" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content panel-success">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reparación</h4>
      </div>
      <div class="modal-body">
        <form action="reparar" onsubmit="return validar()" method="post" id="fix_form" enctype="multipart/form-data">
          <input type="hidden" value="" id="objectidr" name="objectidr">
        
          <div class="form-group">      
              <label class="form-control">Fecha estimada de finalización de reparación</label>
              <input type="date" id="fechar" name="fechar" class="form-control" required>            
          </div>

          <div class="form-group">      
              <label class="form-control">Detalles de la operación</label>
              <textarea  class="form-control" name="detalles_oper" required></textarea>             
          </div>
          
          <button type="submit" onclick="clicked();" class="btn btn-success">
                <i class="fa fa-floppy-o"></i> <b>Guardar</b>
          </button>
          <button type="reset" class="btn btn-danger pull-right" style="margin-right:10px;"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>