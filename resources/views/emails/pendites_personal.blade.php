<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Notificación Documentos pendientes</title>
	{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css') }}
   {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
   <style>
      body{
        margin-top: 10px;
        margin-bottom: 10px; 
         background: rgba(226,226,226,1);
         background: -moz-linear-gradient(left, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 52%, rgba(219,219,219,1) 100%);
         background: -webkit-gradient(left top, right top, color-stop(0%, rgba(226,226,226,1)), color-stop(52%, rgba(254,254,254,1)), color-stop(100%, rgba(219,219,219,1)));
         background: -webkit-linear-gradient(left, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 52%, rgba(219,219,219,1) 100%);
         background: -o-linear-gradient(left, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 52%, rgba(219,219,219,1) 100%);
         background: -ms-linear-gradient(left, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 52%, rgba(219,219,219,1) 100%);
         background: linear-gradient(to right, rgba(226,226,226,1) 0%, rgba(254,254,254,1) 52%, rgba(219,219,219,1) 100%);
         filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#dbdbdb', GradientType=1 );
      }
      
      .container{
        background-color: white;
        border-radius: 5px 5px 0px 0px;
         -moz-border-radius: 5px 5px 0px 0px;
         -webkit-border-radius: 5px 5px 0px 0px;
         border: 0px none #949494;
      }

     .footer {
        padding-right: 15px;
        padding-left: 15px;
      }

      .footer {
        padding-top: 19px;
        color: #777;
        border-top: 1px solid #e5e5e5;
      }

      .letra{
        font-size: 40px;
      }

      /* Responsive: Portrait tablets and up */
      @media screen and (min-width: 768px) {
        /* Remove the padding we set earlier */
        .header,
        .marketing,
        .footer {
          padding-right: 0;
          padding-left: 0;
        }
        /* Space out the masthead */
        .header {
          margin-bottom: 30px;
        }
        /* Remove the bottom border on the jumbotron for visual effect */
        .jumbotron {
          border-bottom: 0;
        }
      }
   </style>
   
</head>
<body>
	
<div class="container">
   <div class="header" style="border-bottom: 1px solid #e5e5e5;">
      <!-- <nav>
         <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
         </ul>
      </nav> -->
      <h3 class="text-primary">System Integral Group</h3>
   </div>

   <div class="jumbotron">
      <div class="row">
      <div class="col-lg-3 col-xs-12">
         <h5><strong>Nombre:</strong> {{$nombre}}</h5>
         <h5><strong>Email:</strong> {{$email}}</h5>
      </div>
      <div class="col-lg-9 col-xs-12">
         <h2 class="letra">Sistema de documentación SIG</h2>
      </div>
      
      <div class="col-lg-12 col-xs-12">
         <p>A continuación se le detallara los consecutivos generados y que aun no se han completado sus registros.</p>
      </div>

      </div>
   </div>

   <div class="row">
      <div class="col-lg-12">

         <h4>Consecutivos</h4>
         <div class="panel panel-default">
            <div class="panel-body">

               <div class="table-responsive">
               <table class="table table-hover table-condensed">
                  <tr>
                     <td><strong>Consecutivo</strong></td>
                     <td><strong>Id documento</strong></td>
                     <td><strong>Descripción</strong></td>
                     <td><strong>Fecha Apertura</strong></td>
                  </tr>
						@foreach ($datos as $data)		
						<tr>
                     <td>{{$data['consecutivo']}}</td>
                     <td>{{$data['identificacon']}}</td>
                     <td>{{$data['descripcion']}}</td>
                     <td>{{$data['fecha']}}</td>
                  </tr>
                  @endforeach
               </table>
               </div>
               
               <div class="col-lg-12">
                  <p>
                     <a class="btn btn-success pull-right" href="http://portalsig.grupo-sig.com/usuario/registros_pendientes" role="button">
                        <i class="fa fa-cloud-upload"></i> Subir registros
                     </a>
                  </p>  
               </div>
            </div>
            <div class="panel-footer">
               <small><strong>Nota:</strong> Cualquier inquietud, duda, sugerencia, escribanos al correro soporteit@grupo-sig.com
               </small>
            </div>
         </div>

      </div>
   </div>

      <footer class="footer">
        <p>&copy; GrupoSig - Copyright © 2015</p>
      </footer>

    </div> <!-- /container -->

{{ HTML::script('http://code.jquery.com/jquery-1.11.0.min.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}
</body>
</html>