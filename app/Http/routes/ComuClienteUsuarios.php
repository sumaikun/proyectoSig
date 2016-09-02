<?php 


Route::any('comunicaciones', array('before' => 'sfun:comunicaciones_cliente', function(){

	if(Input::has('anio_cc_consecutivo')){
		Session::put('anio_cc_consecutivo', Input::get('anio_cc_consecutivo'));
	}else{
		Session::put('anio_cc_consecutivo', date("Y"));
	}

	$contactos = Modcccontactos::orderby('cccnt_nombres')->get();
	$centroc = Modcccentrocosto::all();
	$consecutivos = Modccconsecutivos::whereRaw ('YEAR( created_at ) = ?', array(Session::get('anio_cc_consecutivo')))->paginate(8);

	return View::make('usuarios.comunicaciones.comunicaciones', 
		array('consecutivos' => $consecutivos, 'centroc' => $centroc, 'contactos' => $contactos));
}));


Route::post('guardar_consecutivo', array('before' => 'sfun:comunicaciones_cliente', 'uses' => 'Conccconsecutivos@guardar_consecutivo'));

Route::post('cc_gest_contacto', array('before' => 'sfun:comunicaciones_cliente', 'uses' => 'Concccontactos@cc_gest_contacto'));

Route::post('cc_gest_centro_costo', array('before' => 'sfun:comunicaciones_cliente', 'uses' => 'Concccentrocosto@cc_gest_centro_costo'));

Route::post('cc_buscar_un_contacto', array('before' => 'sfun:comunicaciones_cliente', 'uses' => 'Concccontactos@cc_buscar_un_contacto'));

Route::any('exportar_cc', array('before' => 'sfun:comunicaciones_cliente', 'uses' => 'Conccconsecutivos@exportar_cc'));