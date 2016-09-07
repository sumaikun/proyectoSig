<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		return Redirect::guest('/');
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


Route::filter('admin', function(){

	if (Auth::check()){
		$usuario = Modusuarios::find(Session::get('usu_id'));
		$rol = $usuario->roles;
		if ($rol->rol_nombre != 'administrador') {
			return View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.');
		}
	}else{
		return Redirect::guest('login')->with('msg', 'Debes identificarte primero.');
	}

});





Route::filter('usuario', function(){

	if (Auth::check()){
		$usuario = Modusuarios::find(Session::get('usu_id'));
		$rol = $usuario->roles;
		if ($rol->rol_nombre != 'usuario') {
			return View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.');
		}
	}else{
		return Redirect::guest('login')->with('msg', 'Debes identificarte primero.');
	}

});


// este filtro es para no permitir ir atras
Route::filter('no-cache',function($route, $request, $response){

    $response->header("Cache-Control","no-cache,no-store, must-revalidate");
    $response->header("Pragma", "no-cache"); //HTTP 1.0
    $response->header("Expires"," Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

});



Route::filter('sfun', function($route, $request, $funcion){
    
	$fun = Modfuncionalidades::where('fun_nombre', '=', $funcion)->first();
	$esta = Modpermisosfuncionalidades::whereRaw('usu_id = ? and fun_id = ? and perfun_permiso = ?', array(Session::get('usu_id'), $fun->fun_id, 1))->exists();
	if(!$esta){
		return View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.');
	}
	

});