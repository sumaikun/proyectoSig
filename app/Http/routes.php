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
			return Redirect::guest('login');
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

Route::group(array('prefix' => 'admin', 'before' => 'admin'), function(){


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


});


 