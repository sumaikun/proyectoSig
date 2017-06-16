<?php 

//----------------------------------------------------------------------------------------------------                                                                                               
//   ____     _     ____   ____   ___  __  __     _                 _     ____   __  __  ___  _   _ 
//  / ___|   / \   / ___| / ___| |_ _||  \/  |   / \               / \   |  _ \ |  \/  ||_ _|| \ | |
// | |      / _ \  \___ \ \___ \  | | | |\/| |  / _ \    _____    / _ \  | | | || |\/| | | | |  \| |
// | |___  / ___ \  ___) | ___) | | | | |  | | / ___ \  |_____|  / ___ \ | |_| || |  | | | | | |\  |
//  \____|/_/   \_\|____/ |____/ |___||_|  |_|/_/   \_\         /_/   \_\|____/ |_|  |_||___||_| \_|
//-----------------------------------------------------------------------------------------------------
                                                                                                 
Route::any('cassima', function(){
  return View::make('administrador.modulos.cassima.cassima');
});



/*********************************** CATEGORIA Y SUBCATEGORIA **********************************************/


// categoria y subcategoria
Route::any('cat_and_sub', function(){
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->where('gdcat_estado','=','activo')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id')->orderBy('gdsub_guia', 'asc')->where('gdsub_estado','=','activo')->get();
   return View::make('administrador.modulos.cassima.cat_and_sub', array('categorias' => $categorias, 'subcategorias' => $subcategorias));
});

// registrando una categoria
Route::post('registrar_cat', 'Congdcategorias@create');

// registrando una sub-categoria
Route::post('registrar_sub', 'Congdsubcategorias@create');


// esta ruta es para editar y ordenar las categorias y las subcategorias
Route::any('ord_edit_cat_and_sub', function(){
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->where('gdcat_estado','=','activo')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id')->orderBy('gdsub_guia', 'asc')->where('gdsub_estado','=','activo')->get();
   return View::make('administrador.modulos.cassima.ord_edit_cat_and_sub', array('categorias' => $categorias, 'subcategorias' => $subcategorias));
});

// ordenando una categoria hacia arriba
Route::get('ordcatup/{id}', 'Congdcategorias@ordcatup');

// ordenando una categoria hacia arriba
Route::get('ordcatdown/{id}', 'Congdcategorias@ordcatdown');

// mostrando el nombre de una categoria para editar
Route::get('show_cate/{id}', 'Congdcategorias@show');

// editando la categoria seleccionada
Route::post('update_cat', 'Congdcategorias@update');

// mostrando el nombre de una subcategorias
Route::get('show_subcate/{id}', 'Congdsubcategorias@show');

// editando la subcategoria seleccionada
Route::post('update_subcat', 'Congdsubcategorias@update');
   
// ordenando una subcategoria hacia abajo
Route::get('ordsubcatdown/{idcat}/{idsub}', 'Congdsubcategorias@ordsubdown');

// ordenando una subcategoria hacia arriba
Route::get('ordsubcatup/{idcat}/{idsub}', 'Congdsubcategorias@ordsubup');
   
/******************************************************************************************************/




/******************************************** PERMISOS ************************************************/

// asignar permisos por persona
Route::any('permisos_per_doc', function(){
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->get();
         
   $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')
      ->orderBy('gddoc_identificacion', 'asc')   
      ->get();

    $usuarios = psig\models\Modusuarios::join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')
   ->where('roles.rol_nombre', '=', 'usuario')->where('usu_estado','=','activo')->get();   
         
   return View::make('administrador.modulos.cassima.permisos_per_doc', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos, 'usuarios' => $usuarios));   
});

// es para buscar los permisos que tiene un usuario espesifico sobre varios documentos
Route::post('buscar_permiso_doc_json', 'Congdpermisosdocumentos@show_doc_json');

// es para buscar los permisos que tiene un documento espesifico sobre varios usuarios
Route::post('buscar_permiso_per_json', 'Congdpermisosdocumentos@show_per_json');

// esta ruta registra o actualiza los permisos otorgados a un usuario
Route::post('reg_permisos', 'Congdpermisosdocumentos@create_per_doc');


// asignar permisos por documento
Route::any('permisos_doc_per', function(){
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->get();
         
   $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')
      ->orderBy('gddoc_identificacion', 'asc')   
      ->get();

   $usuarios = psig\models\Modusuarios::join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')
   ->where('roles.rol_nombre', '=', 'usuario')->where('usu_estado','=','activo')->get();

         
   return View::make('administrador.modulos.cassima.permisos_doc_per', 
   array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos, 'usuarios' => $usuarios));   
});

// esta ruta registra o actualiza los permisos otorgados a un usuario
Route::post('reg_permisos_doc_per', 'Congdpermisosdocumentos@create_doc_per');

// vista principal para asociar permisos a los documentos por cargo
Route::any('asociar_doc_carg', function(){
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->get();     
   $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')
      ->orderBy('gddoc_identificacion', 'asc')   
      ->get();
   $cargos = psig\models\Modcargos::all();

   return View::make('administrador.modulos.cassima.asociar_doc_carg', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos, 'cargos' => $cargos));
});

Route::post('reg_permisos_cargos', 'Congdpermisoscargos@create');

Route::post('buscar_permiso_carg_json', 'Congdpermisoscargos@show');



Route::any('permisos_por_cargo', function(){
   $usuarios = psig\models\Modusuarios::where('usu_estado', '=', 'activo')->get();
   return View::make('administrador.modulos.cassima.permisos_por_cargo', array('usuarios' => $usuarios));
});

Route::post('reg_permisos_por_cargo', 'Congdpermisoscargos@asignar_por_cargo');

/*********************************************************************************************************/





/******************************************** SUBIR DOCUMENTOS ************************************************/
Route::any('subir_doc', function(){
   // Modgdcategorias::all()->orderBy('gdcat_guia');
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->get();     
   $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')
      ->orderBy('gddoc_identificacion', 'asc')   
      ->get();
      
   return View::make('administrador.modulos.cassima.subir_doc', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos));
});
 
Route::post('registrar_doc', 'Congddocumentos@create');

Route::any('new_version', function(){
	// Modgdcategorias::all()->orderBy('gdcat_guia');
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->get();     
   $documentos = DB::table('gd_documentos')
    	->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
    	->where('gd_versiones.gdver_estado', '=', 'activo')
    	->where('gd_documentos.gddoc_estado', '=', 'activo')
    	->orderBy('gddoc_identificacion', 'asc')->get();
      
   return View::make('administrador.modulos.cassima.new_version', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos));
});


Route::post('registrar_version', 'Congdversiones@create');


Route::any('update_ver', function(){
	// Modgdcategorias::all()->orderBy('gdcat_guia');
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->get();     
   $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')
      ->orderBy('gddoc_identificacion', 'asc')->get();
      
      return View::make('administrador.modulos.cassima.update_ver', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos));
});
   
// esta ruta es para actualizar campos de la version actual del documento
Route::post('updateversion', 'Congdversiones@edit');  

// busca las subcategorias de una categoria y las devuelve en formato json
Route::post('buscarsubcate_json', 'Congdsubcategorias@store_json');
   
   
// pagina principal para inabilitar un documento
Route::any('disable_doc', function(){
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->get();     
   $documentos = DB::table('gd_documentos')
    ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
    ->where('gd_versiones.gdver_estado', '=', 'activo')
    ->where('gd_documentos.gddoc_estado', '=', 'activo')
    ->orderBy('gddoc_identificacion', 'asc')->get();
      
   return View::make('administrador.modulos.cassima.disable_doc', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos));
});

   
Route::post('disabledoc', 'Congddocumentos@disable_doc');






/***************************************** ACTUALIZACION HV ***********************************/

//carga la vista principal de la actualizacion de la hoja de vida
Route::any('hvdocumento', 'Congdhvdocumentos@index');

// busca la informacion de la hoja de vida de un documento 
Route::post('buscar_hv_doc', 'Congdhvdocumentos@show');

// esta ruta es para registrar o actualizar la hv de un documento
Route::post('save_hv_doc', 'Congdhvdocumentos@create');

/***********************************************************************************************/