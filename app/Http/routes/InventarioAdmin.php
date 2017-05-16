<?php

//-------------------------------------------------------------------------------------------    
/*.___                           __               .__        
|   | _______  __ ____   _____/  |______ _______|__| ____  
|   |/    \  \/ // __ \ /    \   __\__  \\_  __ \  |/  _ \ 
|   |   |  \   /\  ___/|   |  \  |  / __ \|  | \/  (  <_> )
|___|___|  /\_/  \___  >___|  /__| (____  /__|  |__|\____/ 
         \/          \/     \/          \/   */
//-------------------------------------------------------------------------------------------    

Route::any('inventario', function(){

   return View::make('inventario.admin.modulo_inventario');
});

Route::get('inventario/create', function(){

   $categorias = psig\models\InvCategorias::lists('nombre','id');
   $estados = psig\models\InvStatus::lists('nombre','id'); 
   return View::make('inventario.admin.create',compact("categorias","estados"));
});

Route::get('inventario/Gestion', function(){	
	$estados = psig\models\InvStatus::lists('nombre','id');
  $elementos = DB::select(DB::raw("select e.id,e.codigo,e.descripcion, (select count(id) from inventario_seriales where id_elementos=e.id and deleted_at is null) as cantidad ,c.nombre as categoria from inventario_elementos as e INNER JOIN inventario_categorias as c on e.categoria = c.id where e.deleted_at is null"));
  $empresas = psig\models\ListEnterprises::lists('nombre','id');             
	return View::make('inventario.admin.gestion',compact('elementos','estados','empresas'));
});

Route::get('inventario/insertar_categoria/{nombre}','Coninventario@createCat');

Route::get('inventario/insertar_status/{nombre}','Coninventario@createSta');

Route::post('inventario/addElemento','Coninventario@createEle');

Route::post('inventario/editElemento','Coninventario@editEle');

Route::get('inventario/get_seriales/{id}',function($id){
  $seriales = DB::SELECT(DB::RAW("select s.id_status,s.id,s.valor,e.nombre, s.id_elementos from inventario_seriales as s INNER JOIN inventario_status as e on s.id_status = e.id where s.deleted_at is null and s.id_elementos=".$id));  
  
  return View::make('inventario.ajax.seriallist',compact('seriales','id'));

});

Route::get('inventario/get_components/{id}',function($id){
  $components = DB::SELECT(DB::RAW("select * from inventario_componentes where id_elementos=".$id));
  return View::make('inventario.ajax.componentslist',compact('components','id'));
});

Route::get('inventario/edit_element/{id}',function($id){
   $element =  psig\models\InvElementos::where('id','=',$id)->first();
   $categorias = psig\models\InvCategorias::lists('nombre','id');
   //
  return View::make('inventario.ajax.edit_element',compact('element','categorias'));
});

Route::get('inventario/serialdelete/{id}','Coninventario@deleteSerial');

Route::get('inventario/elementdelete/{id}','Coninventario@deleteEle');

Route::post('inventario/addSerial','Coninventario@createSerial');

Route::post('inventario/editSerialname','Coninventario@editnameSerial');

Route::post('inventario/alquilar','Coninventario@alquilar');

Route::get('inventario/Detalles/{id}','Coninventario@details');

Route::get('inventario/Detalles/modify_rent_data/{id}/{fecha2}/{fecha1}/{valor}','Coninventario@edit_alquilar');

Route::post('inventario/newComponent','Coninventario@createcomp');

Route::post('inventario/reparar','Coninventario@reparar');