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
   return View::make('actividades.usuario.actividades');
});

Route::get('actividades/create', function(){
	  
  $actividades = psig\models\ListActivities::lists('nombre','id');
  $empresas = psig\models\ListEnterprises::lists('nombre','id');
  return View::make('actividades.usuario.nuevaactividad',array('actividades'=>$actividades,'empresas'=>$empresas));
   //return View::make('actividades.actividades');
});

Route::get('actividades/list', function(){
	$registros = psig\models\modActividad::orderBy('fecha')->get();
  $nombres = psig\models\Modusuarios::lists('usu_nombres','usu_id');
   return View::make('actividades.usuario.listaactividades',array('registros'=> $registros,'nombres'=>$nombres));
});


Route::post('actividades/registraractividad','conactividades@store');

Route::get('actividades/edit/{id}', 'Conactividades@edit');

Route::post('actividades/updateactividad','conactividades@update');