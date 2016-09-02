<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Permiso denegado</title>
	{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css') }}
   {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
   <style>
      body{
        margin-top: 10%;
        margin-bottom: 10px; 
background:
linear-gradient(163deg, transparent 0px, transparent 1px, #222 1px, #222 14px, transparent 14px),
 linear-gradient(161deg, transparent 0px, #181818 1px, #222 2px, #222 15px, transparent 15px),
 linear-gradient(343deg, transparent 0px, transparent 1px, #222 1px, #222 14px, transparent 14px),
 linear-gradient(343deg, transparent 0px, transparent 1px, #222 1px, #222 14px, transparent 14px);
 background-color: #121212;
 background-position: 2px 1px, 23px 16px,48px 15px, 21px 30px;
 background-size: 48px 30px;

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
      
      
      <div class="col-lg-12 col-xs-12 text-center">
         <h1> <span class="text-danger">
            <i class="fa fa-exclamation-triangle text-warning"></i> {{$mensaje}}</span>
         </h1>
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