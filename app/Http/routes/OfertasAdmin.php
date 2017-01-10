<?php 

Route::any('ofertas', function(){

	if(Input::has('anio_ofertas')){
		Session::put('anio_ofertas', Input::get('anio_ofertas'));
	}else{
		Session::put('anio_ofertas', date("Y"));
	}

	$usuarios = psig\models\Modusuarios::orderby('usu_nombres')->where('usu_estado','!=','inactivo')->get();
	$ofertas = psig\models\Modgeofertas::whereRaw ('YEAR( created_at ) = ?', array(Session::get('anio_ofertas')))->get();
	return View::make('administrador.modulos.ofertas.ofertas', array('ofertas' => $ofertas, 'usuarios' => $usuarios));
});

Route::post('buscar_consecutivos_anio', 'Congeofertas@buscar_consecutivos_anio');

Route::post('buscar_una_oferta', 'Congeofertas@buscar_una_oferta');

Route::post('save_oferta', 'Congeofertas@create');

Route::any('exportar_ofertas', 'Congeofertas@exportar_ofertas');

Route::post('update_oferta', 'Congeofertas@update');




