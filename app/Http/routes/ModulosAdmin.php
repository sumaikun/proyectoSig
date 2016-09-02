<?php 

//---------------------------------------------------------------------------------------------------                                                                                               
//  __  __   ___   ____   _   _  _       ___   ____               _     ____   __  __  ___  _   _ 
// |  \/  | / _ \ |  _ \ | | | || |     / _ \ / ___|             / \   |  _ \ |  \/  ||_ _|| \ | |
// | |\/| || | | || | | || | | || |    | | | |\___ \   _____    / _ \  | | | || |\/| | | | |  \| |
// | |  | || |_| || |_| || |_| || |___ | |_| | ___) | |_____|  / ___ \ | |_| || |  | | | | | |\  |
// |_|  |_| \___/ |____/  \___/ |_____| \___/ |____/          /_/   \_\|____/ |_|  |_||___||_| \_|
//---------------------------------------------------------------------------------------------------                                                                                               

Route::any('modulos', function(){
  $funciones = psig\models\Modfuncionalidades::all();
  return View::make('administrador.modulos.modulos', array('funciones' => $funciones));
});

// registrar funcionalidades
Route::post('reg_funcion', 'Confuncionalidades@create');

// eliminar funcionalidades
Route::get('eliminarfun/{id}', 'Confuncionalidades@destroy');

Route::any('permisos_modulos', function(){
   $funciones = psig\models\Modfuncionalidades::all();
   $usuarios = DB::table('usuarios')
      ->join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')
      ->where('roles.rol_nombre', '=', 'usuario')->get();
   return View::make('administrador.modulos.permisos_modulos', array('funciones' => $funciones, 'usuarios' => $usuarios));
});

// Asignar permiso a una funcionalidad
Route::post('reg_per_fun', 'Conpermisosfuncionalidaes@create');

// Busca los permisos de una funcionalidad
Route::post('buscar_permiso_fun_json', 'Conpermisosfuncionalidaes@store');