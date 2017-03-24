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
          <td> {{$serial->valor}}</td>
          <td> {{$serial->nombre}}</td>
           <td><abbr title="alquilar"><a href="#" data-toggle="modal" data-target="#myModal3" style="margin-left: 5px;"><i class="fa fa-briefcase" aria-hidden="true"></i></a></abbr><abbr title="detalles"><a href="#" style="margin-left: 5px;"><i class="fa fa-calendar" aria-hidden="true"></i></a></abbr>
           </td>            
        </tr>
      @endforeach  
    </tbody>
 </table>