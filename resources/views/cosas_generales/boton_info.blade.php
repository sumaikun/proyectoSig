<!-- este boton muestra la informacion de la vista del documento -->
<div id="inbox">
   <div class="fab btn-group show-on-hover dropup">
      <div data-toggle="tooltip" data-placement="left" title="Información" style="margin-left: 42px;">
         <button type="button" class="btn btn-danger btn-io dropdown-toggle" data-toggle="modal" data-target="#info_view">
            <span class="fa-stack fa-2x">
               <i class="fa fa-circle fa-stack-2x fab-backdrop"></i>
               <i class="fa fa-question fa-stack-1x fa-inverse fab-primary"></i>
               <i class="fa fa-info-circle fa-stack-1x fa-inverse fab-secondary"></i>
            </span>
         </button>
      </div>
      <ul class="dropdown-menu dropdown-menu-right" role="menu">
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="Manual"><i class="fa fa-book"></i></a></li> -->
         <!-- <li><a href="#" data-toggle="tooltip" data-placement="left" title="LiveChat"><i class="fa fa-comments-o"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Reminders"><i class="fa fa-hand-o-up"></i></a></li>
         <li><a href="#" data-toggle="tooltip" data-placement="left" title="Invites"><i class="fa fa-ticket"></i></a></li> -->
      </ul>
   </div>
</div>      

<!-- Modal -->
<div class="modal fade" id="info_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Información de la vista</h4>
      </div>
      <div class="modal-body">
         {{ HTML::image('general/images/explicacion/'.$imagen.'.png', 'upload', array('class' => 'img-responsive')) }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> 