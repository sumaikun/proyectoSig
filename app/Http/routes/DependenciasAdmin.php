<?php 

// CARGA LA VISTA PRINCIPAL DE DEPENDENCIAS
Route::any('dependencias', function(){
   $dependencias = Moddependencias::orderBy('depe_nombre')->get();
   return View::make('administrador.dependencias.dependencias', array('dependencias' => $dependencias));
});

// esta ruta registra una dependencia
Route::post('registrardepe', 'Condependencias@create');

//esta ruta muestra la dependencia para ser actualizado
Route::get('showdepe/{id}', 'Condependencias@show');

//esta ruta actualiza un dependencias
Route::post('updatedepe', 'Condependencias@update');
   
//esta ruta elimina una dependencia
Route::get('eliminardepe/{id}', 'Condependencias@destroy');  