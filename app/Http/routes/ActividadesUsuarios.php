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
	  
  $actividades = psig\models\ListActivities::lists('nombre','id');
  $empresas = psig\models\ListEnterprises::lists('nombre','id');
  return View::make('actividades.nuevaactividad',array('actividades'=>$actividades,'empresas'=>$empresas));
   //return View::make('actividades.actividades');
});

Route::get('actividades/list', function(){
	$registros = psig\models\modActividad::orderBy('fecha')->get();
   return View::make('actividades.listaactividades',array('registros'=> $registros));
});

Route::any('actividades/parameters', function(){
   $actividades = psig\models\ListActivities::orderBy('nombre')->get();
   $empresas = psig\models\ListEnterprises::OrderBy('nombre')->get();
   return View::make('actividades.parametros', array('actividades' => $actividades,'empresas'=>$empresas));
});

Route::post('actividades/registraractividad', 'Conactividades@createAct');

Route::post('actividades/registrarempresa', 'Conactividades@createEmp');    

Route::get('actividades/editAct/{id}', 'Conactividades@showAct');

Route::get('actividades/editEmp/{id}', 'Conactividades@showEmp');

Route::post('actividades/updateAct','conactividades@updateAct');

Route::post('actividades/updateEmp','conactividades@updateEmp');

Route::get('actividades/destroyAct/{id}','conactividades@destroyAct');

Route::get('actividades/destroyEmp/{id}','conactividades@destroyEmp');

Route::post('actividades/registraractividad','conactividades@store');

Route::get('actividades/edit/{id}', 'Conactividades@edit');

Route::post('actividades/updateactividad','conactividades@update');