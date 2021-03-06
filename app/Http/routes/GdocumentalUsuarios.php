<?php 

//----------------------------------------------------------------------------------------
//   ____       _                                                     _             _               _   _   ____    _   _ 
//  / ___|   __| |   ___     ___   _   _   _ __ ___     ___   _ __   | |_    __ _  | |             | | | | / ___|  | | | |
// | |  _   / _` |  / _ \   / __| | | | | | '_ ` _ \   / _ \ | '_ \  | __|  / _` | | |    _____    | | | | \___ \  | | | |
// | |_| | | (_| | | (_) | | (__  | |_| | | | | | | | |  __/ | | | | | |_  | (_| | | |   |_____|   | |_| |  ___) | | |_| |
//  \____|  \__,_|  \___/   \___|  \__,_| |_| |_| |_|  \___| |_| |_|  \__|  \__,_| |_|              \___/  |____/   \___/                                                                                                                         
//----------------------------------------------------------------------------------------
                                                                                    
Route::any('gdocumental', function(){	
   return View::make('usuarios.gdocumental.gdocumental');
});

// CARGA LA VISTA PRINCIPAL DE LA DESCARGA DE DOCUMENTOS
Route::any('download_doc', function(){
   
   //	
   if(strpos(URL::previous(),'download_doc'))
   {
      $categorias = DB::SELECT(DB::RAW("select DISTINCT(cat.gdcat_id),cat.*   from gd_categorias as cat INNER JOIN gd_subcategorias as sub on cat.gdcat_id = sub.gdcat_id inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id INNER JOIN gd_permisos_documentos as per on doc.gddoc_id = per.gddoc_id where  cat.gdcat_estado = 'activo' and doc.gddoc_req_consecutivo = 1 and per.usu_id = ".Session::get('usu_id')));
      $subcategorias = DB::SELECT(DB::RAW("select DISTINCT(sub.gdsub_id),sub.*  from gd_subcategorias as sub inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id INNER JOIN gd_permisos_documentos as per on doc.gddoc_id = per.gddoc_id where  sub.gdsub_estado = 'activo' and doc.gddoc_req_consecutivo = 1 and per.usu_id = ".Session::get('usu_id')." and per.gdperdoc_permiso = 1  ORDER BY sub.gdcat_id, sub.gdsub_guia ASC"));
      $documentos = DB::SELECT(DB::RAW("SELECT * , ver.empresa as ent1, per.empresa as ent2 FROM gd_versiones as ver inner join gd_documentos as doc on ver.gddoc_id = doc.gddoc_id inner join gd_permisos_documentos as per on doc.gddoc_id = per.gddoc_id where per.usu_id = ".Session::get('usu_id')." and  per.gdperdoc_permiso=1 and ver.gdver_estado = 'activo' and doc.gddoc_estado = 'activo' and doc.gddoc_req_consecutivo = 1  ORDER BY doc.gddoc_identificacion;")); 
   }
   else{

      /*$categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->where('gdcat_estado','=','activo')->get();
      $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id')->orderBy('gdsub_guia', 'asc')->where('gdsub_estado','=','activo')->get();*/

      $categorias = DB::SELECT(DB::RAW("select DISTINCT(cat.gdcat_id),cat.*   from gd_categorias as cat INNER JOIN gd_subcategorias as sub on cat.gdcat_id = sub.gdcat_id inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id INNER JOIN gd_permisos_documentos as per on doc.gddoc_id = per.gddoc_id where  sub.gdsub_estado = 'activo' and cat.gdcat_estado = 'activo'  and per.usu_id = ".Session::get('usu_id')." and per.gdperdoc_permiso = 1  ORDER BY sub.gdcat_id, sub.gdsub_guia ASC"));

      $subcategorias = DB::SELECT(DB::RAW("select DISTINCT(sub.gdsub_id),sub.*  from gd_subcategorias as sub inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id INNER JOIN gd_permisos_documentos as per on doc.gddoc_id = per.gddoc_id where  sub.gdsub_estado = 'activo'  and per.usu_id = ".Session::get('usu_id')." and per.gdperdoc_permiso = 1  ORDER BY sub.gdcat_id, sub.gdsub_guia ASC"));

      $documentos = DB::SELECT(DB::RAW("SELECT * , ver.empresa as ent1, per.empresa as ent2 FROM gd_versiones as ver inner join gd_documentos as doc on ver.gddoc_id = doc.gddoc_id inner join gd_permisos_documentos as per on doc.gddoc_id = per.gddoc_id where per.usu_id = ".Session::get('usu_id')." and  per.gdperdoc_permiso=1 and ver.gdver_estado = 'activo' and doc.gddoc_estado = 'activo'  ORDER BY doc.gddoc_identificacion;"));
   }
 	

   $empresas = psig\models\ListEnterprises::where('cliente', '=', 0)->get();
   return View::make('usuarios.gdocumental.download_doc', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos, 'empresas' => $empresas));
});

// esta ruta es para buscar informacion de un documento espesifico y su version en uso
Route::post('buscar_info_doc_json', 'Congddocumentos@store_json');

// esta ruta es para generar el consecutivo de un archivo
Route::post('generarconsecutivo_json', 'Congdconsecutivos@create');

// esta ruta recibe el id de un documento se la pasa al controlador
// para forzar la descarga del documento con el nombre mas el consecutivo
Route::post('descargar_doc_json', 'Congddocumentos@download_json');

Route::post('download_sin_consecutivo', 'Congddocumentos@download_sin_conse_json');

Route::any('registros_pendientes', function(){
	$consecutivos = psig\models\Modgdconsecutivos::where('usu_id', '=', Session::get('usu_id'))->where('gdcon_estado', '=', 'abierto')->get();
   if($consecutivos->isEmpty()){
   	return View::make('usuarios.gdocumental.gdocumental', array('mensaje' => 'No tiene registros pendientes'));
   }else{
   	return View::make('usuarios.gdocumental.registros_pendientes', array('consecutivos' => $consecutivos));
   }
});

// esta es para guardar los registros pendientes del usuario
Route::post('guardar_registro', 'Congdregistros@create_pusuario');

// consultar registros del usuario
Route::any('consultar_registros', function(){	
	$categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->where('gdcat_estado','=','activo')->get();
	$subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id')->orderBy('gdsub_guia', 'asc')->where('gdsub_estado','=','activo')->get();
   $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->join('usuarios', 'usuarios.usu_id', '=', 'gd_documentos.usu_id')
      ->join('gd_permisos_documentos', 'gd_permisos_documentos.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_permisos_documentos.usu_id', '=', Session::get('usu_id'))
      ->where('gd_permisos_documentos.gdperdoc_permiso', '=', '1')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')
      ->orderBy('gddoc_identificacion', 'asc')->get();  	
    
	return View::make('usuarios.gdocumental.consultar_registros', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos));
});

Route::any('registros_usuario',function(){  
  
    $registros = psig\models\Modgdregistros::where('usu_id','=',Session::get('usu_id'))->get();
 
  return view('usuarios.gdocumental.regs_usuario',compact('registros'));
  
});

// consultar linea de tiempo registros del usuario por documento
Route::any('timeline_registro', function(){
	
	$registros = psig\models\Modgdregistros::join('gd_permisos_registros', 'gd_permisos_registros.gdreg_id', '=', 'gd_registros.gdreg_id')
      ->where('gd_registros.gddoc_id', '=', Input::get('gddoc_id'))
      ->where('gd_permisos_registros.usu_id', '=', Session::get('usu_id'))
      ->where('gd_permisos_registros.gdperreg_permiso', '=', true)->get();

	$documet = psig\models\Modgddocumentos::find(Input::get('gddoc_id'));
	return View::make('usuarios.gdocumental.timeline_reg_doc', array('registros' => $registros, 'documet' => $documet));
});

// consultar registros del usuario individual
Route::any('consulta_reg_individual', function(){
	$documento = psig\models\Modgddocumentos::where('gddoc_identificacion', '=', trim (Input::get('gddoc_identificacion')))->first();
	if(is_null($documento)){
   	return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Documento no encontrado!!');
   }else{
      $consecutivo = psig\models\Modgdconsecutivos::where('gddoc_id', '=', $documento->gddoc_id)
      	->where('gdcon_consecutivo', '=', Input::get('gdcon_consecutivo'))->first();

         if(is_null($consecutivo)){
            return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Consecutivo no encontrado!!');
         }else{
            $registro = psig\models\Modgdregistros::join('gd_permisos_registros', 'gd_permisos_registros.gdreg_id', '=', 'gd_registros.gdreg_id')
            	->where('gd_registros.gddoc_id', '=', $documento->gddoc_id)
            	->where('gd_registros.gdcon_id', '=', $consecutivo->gdcon_id)
            	->where('gd_permisos_registros.usu_id', '=', Session::get('usu_id'))
            	->where('gd_permisos_registros.gdperreg_permiso', '=', '1')->first();

            if(is_null($registro)){
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Registro no cargado o No tiene Permisos!!');
            }else{
               return View::make('usuarios.gdocumental.consulta_reg_individual', array('registro' => $registro)); 
            }
         }
   }  	
});


Route::post('buscar_doc_conse', 'Congdconsecutivos@doc_que_pertenece');