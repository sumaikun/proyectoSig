<?php

//------------------------------------------------------------------------------------------------------
//  _   _  ____   _   _     _     ____   ___   ___   ____               _     ____   __  __  ___  _   _ 
// | | | |/ ___| | | | |   / \   |  _ \ |_ _| / _ \ / ___|             / \   |  _ \ |  \/  ||_ _|| \ | |
// | | | |\___ \ | | | |  / _ \  | |_) | | | | | | |\___ \   _____    / _ \  | | | || |\/| | | | |  \| |
// | |_| | ___) || |_| | / ___ \ |  _ <  | | | |_| | ___) | |_____|  / ___ \ | |_| || |  | | | | | |\  |
//  \___/ |____/  \___/ /_/   \_\|_| \_\|___| \___/ |____/          /_/   \_\|____/ |_|  |_||___||_| \_|
//------------------------------------------------------------------------------------------------------                                                                                                     

// ESTA RUTA CARGA LA VISTA PRINCIPAL DE LA GESTION DE USUARIOS EN EL ADMINISTRADOR
Route::any('usuarios', function(){
   return View::make('administrador.usuarios.usuarios');
});


// CARGA LA VISTA PARA AGREGAR UN NUEVO USUARIO
Route::any('nuevousuario', function(){
   $roles = Modroles::orderBy('rol_nombre')->get();
   $dependencias = Moddependencias::orderBy('depe_nombre')->get();
   $cargos = Modcargos::orderBy('carg_nombre')->get();
   return View::make('administrador.usuarios.nuevousuario', 
   	array('roles' => $roles, 'dependencias' => $dependencias, 'cargos' => $cargos));
});


// ESTA RUTA MUESTRA EL LISTADO DE USUARIOS PARA SU EDICION
Route::any('listausuario', function(){
   $usuarios = Modusuarios::orderBy('usu_nombres')->get();
   return View::make('administrador.usuarios.listausuario', array('usuarios' => $usuarios));
});

// MUESTRA LA INFORMACION DE UN USUARIO PARA EDITARLA
Route::get('showusuario/{id}', 'Conusuarios@show');


// CAPTURA LOS DATOS ENVIADOS Y REGISTRA EL NUEVO USUARIO
Route::post('registrarusuario', 'Conusuarios@create');


// TOMA LOS DATOS DEL USUARIO EDITADO Y LO ACTUALIZA
Route::post('actualizarusuario', 'Conusuarios@update');


//DEVUELVE TODOS LOS USUARIOS EN FORMATO JSON
Route::post('usuarios_json', 'Conusuarios@listado_json'); //todos los usuarios en formato json

//DEVUELVE TODOS LOS USUARIOS QUE NO SON ADMINISTRADORES
Route::post('usuarios_no_admin_json', 'Conusuarios@usuarios_no_admin_json');