<?php  

Route::any('ofertas', array('before' => 'sfun:ofertas', function(){

	if(Input::has('anio_ofertas')){
		Session::put('anio_ofertas', Input::get('anio_ofertas'));
	}else{
		Session::put('anio_ofertas', date("Y"));
	}

	$ofertas = psig\models\Modgeofertas::whereRaw ('YEAR( created_at ) = ?', array(Session::get('anio_ofertas')))->get();
	return View::make('usuarios.ofertas.ofertas', array('ofertas' => $ofertas));
}));


Route::post('buscar_una_oferta', array('before' => 'sfun:ofertas', 'uses' => 'Congeofertas@buscar_una_oferta'));

Route::post('save_oferta', array('before' => 'sfun:ofertas', 'uses' => 'Congeofertas@create'));

Route::any('exportar_ofertas', array('before' => 'sfun:ofertas', 'uses' => 'Congeofertas@exportar_ofertas'));

Route::post('update_oferta', array('before' => 'sfun:ofertas', 'uses' => 'Congeofertas@update'));

Route::post('buscar_consecutivos_anio', array('before' => 'sfun:ofertas', 'uses' => 'Congeofertas@buscar_consecutivos_anio'));


