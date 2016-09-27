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
   return View::make('actividades.admin.actividades');
});

Route::get('actividades/create', function(){
	  
  $actividades = psig\models\ListActivities::lists('nombre','id');
  $empresas = psig\models\ListEnterprises::lists('nombre','id');
  return View::make('actividades.admin.nuevaactividad',array('actividades'=>$actividades,'empresas'=>$empresas));
   //return View::make('actividades.actividades');
});

Route::any('actividades/list', function(){

  if(strpos(URL::previous(),'list'))
  {
    $year = Input::get('year_list');
  }

  else
  {
    $year = date('Y');
  }    
  	$registros = psig\models\modActividad::orderBy('usuario')->orderBy('fecha','desc')->Where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$year.'%')->get();
    Session::put('usu_listy',$year);  
    $empresas = psig\models\ListEnterprises::lists('nombre','id');
    $usuarios = psig\models\Modusuarios::OrderBy('usu_nombres')->get();
    Session::put('usu_exportactividades',$registros);  
     return View::make('actividades.admin.listaactividades',array('registros'=> $registros,'empresas'=>$empresas,'usuarios'=>$usuarios));

});

Route::any('actividades/parameters', function(){
   $actividades = psig\models\ListActivities::orderBy('nombre')->get();
   $empresas = psig\models\ListEnterprises::OrderBy('nombre')->get();
   return View::make('actividades.admin.parametros', array('actividades' => $actividades,'empresas'=>$empresas));
});

Route::post('actividades/registrartpact', 'Conactividades@createAct');

Route::post('actividades/registrarempresa', 'Conactividades@createEmp');    

Route::get('actividades/editAct/{id}', 'Conactividades@showAct');

Route::get('actividades/editEmp/{id}', 'Conactividades@showEmp');

Route::post('actividades/updateAct','Conactividades@updateAct');

Route::post('actividades/updateEmp','Conactividades@updateEmp');

Route::get('actividades/destroyAct/{id}','Conactividades@destroyAct');

Route::get('actividades/destroyEmp/{id}','Conactividades@destroyEmp');

Route::post('actividades/registraractividad','Conactividades@store');

Route::get('actividades/edit/{id}', 'Conactividades@edit');

Route::post('actividades/updateactividad','Conactividades@update');

Route::get('actividades/excel', function(){
   $usuarios = psig\models\Modusuarios::OrderBy('usu_nombres')->get();
   return View::make('actividades.admin.excel',compact('usuarios'));
});

Route::post('actividades/subirexcel','Conactividades@excel');

Route::post('actividades/export_excel','Conactividades@exportar_actividades_admin');