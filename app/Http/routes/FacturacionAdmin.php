<?php

//-------------------------------------------------------------------------------------------    
  /*   _____               __                             .__               
_/ ____\____    _____/  |_ __ ______________    ____ |__| ____   ____  
\   __\\__  \ _/ ___\   __\  |  \_  __ \__  \ _/ ___\|  |/  _ \ /    \ 
 |  |   / __ \\  \___|  | |  |  /|  | \// __ \\  \___|  (  <_> )   |  \
 |__|  (____  /\___  >__| |____/ |__|  (____  /\___  >__|\____/|___|  /
            \/     \/                       \/     \/               \/  */
//-------------------------------------------------------------------------------------------    

Route::any('facturacion', function(){
   return View::make('facturacion.admin.modulo_facturacion');
});

Route::get('actividades/create', function(){
	  
  $actividades = psig\models\ListActivities::lists('nombre','id');
  $empresas = psig\models\ListEnterprises::lists('nombre','id');
  return View::make('actividades.admin.nuevaactividad',array('actividades'=>$actividades,'empresas'=>$empresas));
   //return View::make('actividades.actividades');
});

Route::any('facturacion/list', function(){

  return 'tomala bitch';
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

Route::any('facturacion/parameters', function(){
    
   $empresas = psig\models\ListEnterprises::Where('cliente','=',0)->OrderBy('nombre')->get();
   $clientes = psig\models\ListEnterprises::Where('cliente','=',1)->OrderBy('nombre')->get();
   return View::make('facturacion.admin.entidades', array('empresas'=>$empresas,'clientes'=>$clientes));
});

Route::post('facturacion/registrarcliente', 'Confactura@createCli');

Route::post('facturacion/registrarempresa', 'Confactura@createEmp');

Route::get('facturacion/editEmp/{id}', 'Confactura@showEmp');

Route::post('facturacion/updateEmp','Confactura@updateEmp');

Route::get('facturacion/destroyAct/{id}','Conactividades@destroyAct');

Route::get('facturacion/destroyEmp/{id}','Conactividades@destroyEmp');

Route::post('facturacion/registraractividad','Conactividades@store');

Route::get('facturacion/edit/{id}', 'Conactividades@edit');

Route::post('facturacion/updateactividad','Conactividades@update');

Route::get('facturacion/excel', function(){
   $usuarios = psig\models\Modusuarios::OrderBy('usu_nombres')->get();
   return View::make('facturacion.admin.excel',compact('usuarios'));
});


Route::any('facturacion/reports',function(){
  if(strpos(URL::previous(),'reports'))
  {
    $year = Input::get('year_list');
  }

  else
  {
    $year = date('Y');
  } 

  $empresas = psig\models\ListEnterprises::OrderBy('nombre')->get();
  $usuarios = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->get();
  
  return View::make('facturacion.admin.reports',compact('empresas','usuarios','year'));
});

Route::post('facturacion/subirexcel','Conactividades@excel');

Route::post('facturacion/export_excel','Conactividades@exportar_actividades_admin');