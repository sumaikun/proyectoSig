<!DOCTYPE html>
<html class="bg-black">
   <head>
      <meta charset="UTF-8">
      <title>Login</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      
      {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css') }}
      {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css') }}
      {{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') }}
      <!-- Theme style -->
      <link href="admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="bg-black">
   
      <div class="form-box" id="login-box">
         <div class="header bg-blue">
            {{ HTML::image('general/images/favicon.ico', 'info1', array('class' => 'user-image', 'height' => '30', 'style' => 'vertical-align:middle;',)) }}
            Iniciar sesión
         </div>

         <form name="form1" id="form1" method="POST">
            <div class="body bg-gray">

               <div class="text-center text-danger" style="display:@if(isset($error) or Session::get('msg')){{'inline'}}@else{{'none'}}@endif">
                  <h4>
                     <i class="fa fa-exclamation-triangle"></i>
                     {{ isset($error) ? $error : '' }} 
                     @if(Session::get('msg')) {{ Session::get('msg') }} @endif
                  </h4>
               </div>
                  
               <strong>Usuario</strong>
               <div style="margin-bottom: 15px" class="input-group col-lg-12">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" id="usu_usuario" name="usu_usuario" class="form-control text-center" placeholder="rflorez" autocomplete="off" required>                                        
                  <span class="input-group-addon" id="basic-addon2">@grupo-sig.com</span>
               </div>
                  
               <strong>Password</strong>
               <div style="margin-bottom: 15px" class="input-group col-lg-12">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" id="usu_password" name="usu_password" class="form-control" placeholder="***********" required>
               </div>

               <div class="form-group">
                  <input type="checkbox" name="remember_me" id="remember_me" /> Recuerdame
               </div>
               
            </div>
            
            <div class="footer">                                                               
               <button type="submit" class="btn bg-green btn-block" onclick="javascript: form.action='login';">Login <i class="fa fa-sign-in"></i></button>  
               Problemas? Escribe a <a href="mailto:soporteit@grupo-sig.com" class="text-danger"> soporteit@grupo-sig.com</a>
            </div>
            
         </form>

      </div>

{{ HTML::script('http://code.jquery.com/jquery-1.11.0.min.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}

   </body>
</html>