<?php 


Route::any('comunicaciones', function(){	
	

	if(Input::has('anio_cc_consecutivo')){
		Session::put('anio_cc_consecutivo', Input::get('anio_cc_consecutivo'));
		//return Input::get('anio_cc_consecutivo');
	}
	elseif (strpos(URL::previous(),'comunicaciones')) {
		//Do Nothing
	}
	else{
		Session::put('anio_cc_consecutivo', date("Y"));
 

	$usuarios = psig\models\Modusuarios::orderby('usu_nombres')->get();
	$contactos = psig\models\Modcccontactos::orderby('cccnt_nombres')->get();
	$centroc = psig\models\Modcccentrocosto::all();
	$consecutivos = psig\models\Modccconsecutivos::whereRaw ('YEAR( created_at ) = ?', array(Session::get('anio_cc_consecutivo')))->paginate(8);

	return View::make('administrador.modulos.comunicaciones.comunicaciones', 
		array('consecutivos' => $consecutivos, 'centroc' => $centroc, 'contactos' => $contactos, 'usuarios' => $usuarios));

});
 
Route::post('guardar_consecutivo', 'Conccconsecutivos@guardar_consecutivo');

Route::post('cc_gest_contacto', 'Concccontactos@cc_gest_contacto');

Route::post('cc_gest_centro_costo', 'Concccentrocosto@cc_gest_centro_costo');

Route::post('cc_buscar_un_contacto', 'Concccontactos@cc_buscar_un_contacto');

Route::any('exportar_cc', 'Conccconsecutivos@exportar_cc');