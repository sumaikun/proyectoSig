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
	  
  $actividades = psig\models\ListActivities::Select(DB::raw('id,nombre'))->orderBy('nombre')->get();
  $empresas = psig\models\ListEnterprises::Select(DB::raw('id,nombre'))->orderBy('nombre')->get();
  //return $empresas;
  //return $actividades;
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
    //$year = "2016";    
  	$registros = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->orderBy('usuario')->orderBy('fecha','desc')->Where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$year.'%')->get();
    Session::put('usu_listy',$year);  
    $actividades = psig\models\ListActivities::Select(DB::raw('id,nombre'))->orderBy('nombre')->get();
    $empresas = psig\models\ListEnterprises::Select(DB::raw('id,nombre'))->orderBy('nombre')->get();
    $usuarios = psig\models\Modusuarios::OrderBy('usu_nombres')->get();
    Session::put('usu_exportactividades',$registros);  
     return View::make('actividades.admin.listactividades',array('registros'=> $registros,'empresas'=>$empresas,'usuarios'=>$usuarios,'actividades'=>$actividades));
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

Route::post('actividades/updateactividad','Conactividades@update');

Route::get('actividades/excel', function(){
   $usuarios = psig\models\Modusuarios::OrderBy('usu_nombres')->get();
   return View::make('actividades.admin.excel',compact('usuarios'));
});


Route::any('actividades/reports',function(){
  if(strpos(URL::previous(),'reports'))
  {

    $year = Input::get('year_list');
    $userid = Input::get('userid');
    
    if($userid==0)
    {
      $usuarios = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->where('fecha','like','%'.$year.'%')->get();
    }
    else{
      $usuarios = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->where('fecha','like','%'.$year.'%')->where('usuario','=',$userid)->get();
    }
    
  }

  else
  {
    $year = date('Y');
    $usuarios = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->where('fecha','like','%'.$year.'%')->get();
  } 

  $empresas = psig\models\ListEnterprises::OrderBy('nombre')->get();  
  $users = DB::SELECT(DB::raw("select DISTINCT usuario as id, u.usu_nombres as nombres , u.usu_apellido1 as apellido from reg_actividades as reg inner JOIN usuarios as u on reg.usuario = u.usu_id  where fecha like '%".$year."%'"));
  //return $users;
  
  return View::make('actividades.admin.reports',compact('empresas','usuarios','year','users'));
});

Route::post('actividades/subirexcel','Conactividades@excel');

Route::post('actividades/export_excel','Conactividades@exportar_actividades_admin');

Route::any('actividades/informes',function(){

   if(strpos(URL::previous(),'informes'))
  {
    $year = Input::get('year_list');
    $ent = Input::get('ent_list');
    if($ent!=0)
    {
      $cond = " fecha like '%".$year."%' and tp_empresa =".$ent." ";
    }
    else{
      $cond = " fecha like '%".$year."%' ";
    }
  }
  else{
    $year = date('Y');
    $cond = " fecha like '%".$year."%' ";    
  
  } 

  $empresas = DB::SELECT(DB::RAW("select DISTINCT tp_empresa, e.nombre from reg_actividades as reg inner join lista_empresas as e on reg.tp_empresa = e.id where ".$cond." ORDER BY nombre"));    

  return View::make('actividades.admin.reports2',compact('year','empresas')); 
});


Route::get('actividades/myactivities/{fecha}','Conactividades@myactivities');

Route::get('actividades/activity_calendar/{id}','Conactividades@calendar');

Route::get('actividades/activity_list/{id}/{year}','Conactividades@lista');

Route::get('actividades/detailinfo/{fecha}/{id}','Conactividades@detailinfo');

Route::any('actividades/permission',function(){
   $usuarios = psig\models\Modusuarios::OrderBy('usu_nombres')->where('rol_id','!=','1')->get();
  return View::make('actividades.admin.permission',compact('usuarios'));
});

Route::post('actividades/registrarpermiso','Conactividades@assign_permission');

Route::get('actividades/permi_asoc/{id}','Conactividades@check_permission');

Route::get('actividades/reg_edit/{id}','Conactividades@edit');
