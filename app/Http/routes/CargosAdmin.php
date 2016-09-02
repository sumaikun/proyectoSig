<?php

//-------------------------------------------------------------------------------------------                                                                                         
//   ____     _     ____    ____   ___   ____               _     ____   __  __  ___  _   _ 
//  / ___|   / \   |  _ \  / ___| / _ \ / ___|             / \   |  _ \ |  \/  ||_ _|| \ | |
// | |      / _ \  | |_) || |  _ | | | |\___ \   _____    / _ \  | | | || |\/| | | | |  \| |
// | |___  / ___ \ |  _ < | |_| || |_| | ___) | |_____|  / ___ \ | |_| || |  | | | | | |\  |
//  \____|/_/   \_\|_| \_\ \____| \___/ |____/          /_/   \_\|____/ |_|  |_||___||_| \_|
//-------------------------------------------------------------------------------------------

// CARGA LA VISTA PRINCIPAL DE LA SECCION CARGOS
Route::any('cargos', function(){
   $cargos = psig\models\Modcargos::orderBy('carg_nombre')->get();
   return View::make('administrador.cargos.cargos', array('cargos' => $cargos));
});
    
// TOMAS LOS DATOS ENVIADOS DEL FORMULARIO Y REGISTRA EL NUEVO CARGO
Route::post('registrarcargo', 'Concargos@create');

//ESTA RUTA MUESTRA EL CARGO PARA SER ACTUALIZADO
Route::get('showcargo/{id}', 'Concargos@show');

//ESTA RUTA ACTUALIZA UN CARGO
Route::post('updatecargo', 'Concargos@update');
   
//ELIMINA UN CARGO SELECCIONADO
Route::get('eliminarcargo/{id}', 'Concargos@destroy');