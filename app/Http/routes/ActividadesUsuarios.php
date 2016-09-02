<?php

//-------------------------------------------------------------------------------------------    
  /* _____          __  .__      .__    .___           .___             
  /  _  \   _____/  |_|__|__  _|__| __| _/____     __| _/____   ______
 /  /_\  \_/ ___\   __\  \  \/ /  |/ __ |\__  \   / __ |/ __ \ /  ___/
/    |    \  \___|  | |  |\   /|  / /_/ | / __ \_/ /_/ \  ___/ \___ \ 
\____|__  /\___  >__| |__| \_/ |__\____ |(____  /\____ |\___  >____  >
        \/     \/                      \/     \/      \/    \/     \/ */
//-------------------------------------------------------------------------------------------    

Route::any('actividades', function(){
   return View::make('actividades.actividades');
});

Route::get('actividades/create', function(){
	
   return View::make('actividades.nuevaactividad');
   //return View::make('actividades.actividades');
});

Route::get('actividades/list', function(){
	return "list";
   //return View::make('actividades.actividades');
});

Route::any('actividades/parameters', function(){
   $cargos = psig\models\Modcargos::orderBy('carg_nombre')->get();
   return View::make('actividades.parametros', array('cargos' => $cargos));
});

Route::post('registraractividad', 'Conactividad@create');    