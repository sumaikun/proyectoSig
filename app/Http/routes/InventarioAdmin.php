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
	$elementos = DB::statement(DB::raw("SET @serial=0;"));
	$elementos = DB::select(DB::raw("Select  @serial := @serial+1 AS cod ,e.id as id, e.codigo as codigo , e.descripcion as descripcion , s.valor as serial , c.nombre as categoria , st.nombre as `status` from inventario_elementos as e inner join inventario_seriales as s on s.id_elementos = e.id INNER JOIN inventario_categorias as c on e.categoria = c.id INNER JOIN inventario_status as st on st.id = e.`status` order By cod")); 

    //return $elementos;
   $categorias = psig\models\InvCategorias::lists('nombre','id');
   $estados = psig\models\InvStatus::lists('nombre','id');         
	return View::make('inventario.admin.gestion',compact('elementos','categorias','estados'));
});

Route::get('inventario/insertar_categoria/{nombre}','Coninventario@createCat');

Route::get('inventario/insertar_status/{nombre}','Coninventario@createSta');

Route::post('inventario/addElemento','Coninventario@createEle');