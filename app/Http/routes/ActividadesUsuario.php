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
	  
  $actividades = psig\models\ListActivities::Select(DB::raw('id,nombre'))->orderBy('nombre')->get();
  $empresas = psig\models\ListEnterprises::Select(DB::raw('id,nombre'))->orderBy('nombre')->get();
  return View::make('actividades.usuario.nuevaactividad',array('actividades'=>$actividades,'empresas'=>$empresas));
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
    $permisos = psig\models\Modpermisosact::where('user_id','=',Session::get('usu_id'))->value('permisos');
    $array = explode(",",$permisos);
    if(in_array('ver_todos_usuarios', $array))
    {


      $registros = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->orderBy('usuario')->orderBy('fecha','desc')->Where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$year.'%')->get();
      Session::put('usu_listy',$year);  
      Session::put('usu_exportactividades',$registros);
    } 
    else{
      $registros = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->Where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$year.'%')->where('usuario','=',Session::get('usu_id'))->get();
    }    
    //return $registros;
     return View::make('actividades.usuario.listaactividades',array('registros'=> $registros));
});


Route::post('actividades/registraractividad','Conactividades@store');

Route::get('actividades/edit/{id}', 'Conactividades@edit');

Route::post('actividades/updateactividad','Conactividades@update');

Route::get('actividades/export_excel','Conactividades@exportar_actividades');

Route::any('actividades/reports',function(){

  $permisos = psig\models\Modpermisosact::where('user_id','=',Session::get('usu_id'))->value('permisos');
  $array = explode(",",$permisos);
    if(!in_array('revisar_reportes', $array))
    {
      return " ";
    }

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
  
  return View::make('actividades.usuario.reports',compact('empresas','usuarios','year','users'));
});

Route::any('actividades/informes',function(){
  $permisos = psig\models\Modpermisosact::where('user_id','=',Session::get('usu_id'))->value('permisos');
  $array = explode(",",$permisos);
    if(!in_array('revisar_reportes', $array))
    {
      return " ";
    }

  
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

    

  return View::make('actividades.usuario.reports2',compact('year','empresas')); 
});


Route::get('actividades/myactivities/{fecha}','Conactividades@myactivities');

Route::get('actividades/activity_calendar/{id}','Conactividades@calendar');

Route::get('actividades/detailinfo/{fecha}/{id}','Conactividades@detailinfo');