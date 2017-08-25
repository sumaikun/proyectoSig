<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){

	if (Auth::check() && Session::get('rol_nombre')=='administrador'){
		return Redirect::guest('/admin/inicio');
	}else{
		if(Auth::check() && Session::get('rol_nombre')=='usuario'){
			return Redirect::guest('/usuario/inicio');
		}else{
			return Redirect::guest('/login');
		}
	}
	
});


Route::get('login', function(){
   
	return View::make('cosas_generales.login');	
});

Route::post('login', 'Conusuarios@login');
Route::get('logout', 'Conusuarios@logout');

//-->Funcion obsoleta
// Paginas no encontradas
/*App::missing(function($exception){
	// return Response::view('cosas_generales.404', array(), 404);
	return View::make('cosas_generales.page_error')->with('mensaje', 'Pagina no encontrada.');
});*/

Route::get('404', function(){
	// return Response::view('cosas_generales.404', array(), 404);
	return View::make('cosas_generales.page_error')->with('mensaje', 'Pagina no encontrada.');
});



//------------------------------------------------------------------------------------------------
//     _     ____   __  __  ___  _   _  ___  ____   _____  ____      _     ____    ___   ____  
//    / \   |  _ \ |  \/  ||_ _|| \ | ||_ _|/ ___| |_   _||  _ \    / \   |  _ \  / _ \ |  _ \ 
//   / _ \  | | | || |\/| | | | |  \| | | | \___ \   | |  | |_) |  / _ \  | | | || | | || |_) |
//  / ___ \ | |_| || |  | | | | | |\  | | |  ___) |  | |  |  _ <  / ___ \ | |_| || |_| ||  _ < 
// /_/   \_\|____/ |_|  |_||___||_| \_||___||____/   |_|  |_| \_\/_/   \_\|____/  \___/ |_| \_\
//------------------------------------------------------------------------------------------------

Route::group(array('prefix' => 'admin', 'before' => 'admin', 'middleware' => 'admin'), function(){


Route::any('inicio', function(){ return View::make('administrador.inicio'); });


//USUARIO----------------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/UsuariosAdmin.php');
//-----------------------------------------------------------------------------------------------------

//CARGOS-----------------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/CargosAdmin.php');
//-----------------------------------------------------------------------------------------------------

//DEPENDENCIAS-----------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/DependenciasAdmin.php');
//-----------------------------------------------------------------------------------------------------

//MODULOS----------------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/ModulosAdmin.php');
//-----------------------------------------------------------------------------------------------------

//A. GESTION DOCUMENTAL--------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/GdocumentalAdmin.php');
//-----------------------------------------------------------------------------------------------------

//B. CASSIMA-------------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/CassimaAdmin.php');
//-----------------------------------------------------------------------------------------------------

//OFERTAS SIG-------------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/OfertasAdmin.php');
//-----------------------------------------------------------------------------------------------------

//COMUNICACIONES PRE-----------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/ComuClienteAdmin.php');
//-----------------------------------------------------------------------------------------------------

//ACTIVIDADES-----------------------------------------------------------------------------------
										               require (__DIR__ . '/routes/ActividadesAdmin.php');
//-----------------------------------------------------------------------------------------------------

//FACTURACION-----------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/FacturacionAdmin.php');
//-----------------------------------------------------------------------------------------------------                

//INVENTARIO-----------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/InventarioAdmin.php');
//----------------------------------------------------------------------------------------------------- 

//CAPACITACION-----------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/CapacitacionAdmin.php');
//-----------------------------------------------------------------------------------------------------                             

});


 

//-----------------------------------------------------------                                                        
//  _   _  ____   _   _     _     ____   ___   ___   ____  
// | | | |/ ___| | | | |   / \   |  _ \ |_ _| / _ \ / ___| 
// | | | |\___ \ | | | |  / _ \  | |_) | | | | | | |\___ \ 
// | |_| | ___) || |_| | / ___ \ |  _ <  | | | |_| | ___) |
//  \___/ |____/  \___/ /_/   \_\|_| \_\|___| \___/ |____/ 
//-----------------------------------------------------------
                                                      


// Rutas de usuario
Route::group(array('prefix' => 'usuario', 'before' => 'usuario', 'middleware' => 'user'), function(){


Route::any('inicio', function(){	 return View::make('usuarios.inicio');  });

   
//GESTION DOCUMENTAL--------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/GdocumentalUsuarios.php');
//--------------------------------------------------------------------------------------------------

//CASSIMA-------------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/CassimaUsuarios.php');
//--------------------------------------------------------------------------------------------------

//CUENTA USUARIO------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/CuentasUsuarios.php');
//--------------------------------------------------------------------------------------------------


//REPORTE DE ACTIVIDADES----------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/ReporteUsuarios.php');
//--------------------------------------------------------------------------------------------------


//COMUNICACIONES------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/ComuClienteUsuarios.php');
//--------------------------------------------------------------------------------------------------

//OFERTAS------------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/OfertasUsuarios.php');
//--------------------------------------------------------------------------------------------------

//ACTIVIDADES-----------------------------------------------------------------------------------
											            require (__DIR__ . '/routes/ActividadesUsuario.php');
//-----------------------------------------------------------------------------------------------------
   
//FACTURACION-----------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/FacturacionUsuario.php');
//-----------------------------------------------------------------------------------------------------

//CAPACITACION-----------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/CapacitacionUsuario.php');
//-----------------------------------------------------------------------------------------------------

//INVENTARIO-----------------------------------------------------------------------------------
                                             require (__DIR__ . '/routes/InventarioUsuario.php');
//----------------------------------------------------------------------------------------------------- 

Route::any("all_registers",function(){
      
   $usuarios = DB::SELECT(DB::RAW("select DISTINCT(us.usu_id),us.* from usuarios as us inner join gd_registros as reg on reg.usu_id = us.usu_id ORDER BY us.usu_nombres"));
  
  if(strpos(URL::previous(),'all_registers'))
  {
   //return 'sd';
    $registros = psig\models\Modgdregistros::where('usu_id','=',Input::get('user_id'))->get();
    $usu = Input::get('user_id');
  }
  else{    
    $registros = psig\models\Modgdregistros::where('usu_id','=',Session::get('usu_id'))->get();;
    $usu = Session::get('usu_id');    
  }
  
  return view('usuarios.gdocumental.all_regs',compact('usuarios','registros','usu'));

   });                        

});





Route::get('registrar', function(){


   $depe = new Moddependencias();
   $depe->depe_id = 1;
   $depe->depe_nombre = 'Gestión IT';
   $depe->depe_sigla = 'IT';
   $depe->depe_responsable = 'Moises Forero Forero';
   $depe->save();

   $carg = new Modcargos();
   $carg->carg_id = 1;
   $carg->carg_nombre = 'Profesional IT';
   $carg->save();

   $rol = new Modroles();
   $rol->rol_id = 1;
   $rol->rol_nombre = 'administrador';
   $rol->save();

   $rol2 = new Modroles();
   $rol2->rol_id = 2;
   $rol2->rol_nombre = 'usuario';
   $rol2->save();

   $fun = new Modfuncionalidades();
   $fun->fun_nombre = 'cassima';
   $fun->save();

   $fun = new Modfuncionalidades();
   $fun->fun_nombre = 'gdocumental';
   $fun->save();

	$user = new Modusuarios;
   $user->usu_id = 1;
	$user->usu_nombres ="shamir";
	$user->usu_apellido1 ="torres";
	$user->usu_apellido2 ="villamil";
	$user->usu_email ="storres@grupo-sig.com";
	$user->usu_usuario ="storres";
	$user->password = Hash::make('shamirtv');
	$user->rol_id = 1;
	$user->carg_id = 1;
	$user->depe_id = 1;

	$user->save();
	return "El usuario fue agregado.";


});

Route::any('prueba', function(){
	return View::make('emails.nuevo_usuario');
});

Route::get('pdf/pdfviewer','Coninventario@pdf_viewer');