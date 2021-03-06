<?php 

// CARGA LA VISTA PRINCIPAL DE LA SECCION GESTION DOCUMENTAL DEL ADMINISTRADOR
Route::any('gdocumentos', function(){
   return View::make('administrador.modulos.gdocumentos.gdocumentos');
});

// CARGA LA VISTA PRINCIPAL DE LA SECCION DESCARGA DE DOCUMENTOS EN EL ADMINISTRADOR
Route::any('download_doc', function(){

  if(strpos(URL::previous(),'download_doc'))
  {
    $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')     
      ->where('gddoc_req_consecutivo','=',1)
      ->orderBy('gddoc_identificacion', 'asc')   
      ->get();

    $categorias = DB::SELECT(DB::RAW("select DISTINCT(cat.gdcat_id),cat.*   from gd_categorias as cat INNER JOIN gd_subcategorias as sub on cat.gdcat_id = sub.gdcat_id inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id where  cat.gdcat_estado = 'activo' and doc.gddoc_req_consecutivo = 1"));
    $subcategorias = DB::SELECT(DB::RAW("select DISTINCT(sub.gdsub_id), sub.*  from gd_subcategorias as sub inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id where sub.gdsub_estado = 'activo' and doc.gddoc_req_consecutivo = 1 ORDER BY sub.gdcat_id, sub.gdsub_guia ASC"));
  }
  else{
    $documentos = DB::table('gd_documentos')
      ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
      ->where('gd_versiones.gdver_estado', '=', 'activo')
      ->where('gd_documentos.gddoc_estado', '=', 'activo')     
      ->orderBy('gddoc_identificacion', 'asc')   
      ->get();

    $categorias = DB::SELECT(DB::RAW("select DISTINCT(cat.gdcat_id),cat.*   from gd_categorias as cat INNER JOIN gd_subcategorias as sub on cat.gdcat_id = sub.gdcat_id inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id where  cat.gdcat_estado = 'activo'"));

    $subcategorias = DB::SELECT(DB::RAW("select DISTINCT(sub.gdsub_id), sub.*  from gd_subcategorias as sub inner join gd_documentos as doc on sub.gdsub_id = doc.gdsub_id where sub.gdsub_estado = 'activo' ORDER BY sub.gdcat_id, sub.gdsub_guia ASC"));      
  }

   $empresas = psig\models\ListEnterprises::where('cliente', '=', 0)->get();
   
   
   // esta consulta trae todos los documentos activos sin importar permisos 
          //return $documentos;    	
   return View::make('administrador.modulos.gdocumentos.download_doc', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos, 'empresas' => $empresas));
});



// esta ruta es para buscar informacion de un documento espesifico y su version en uso
Route::post('buscar_info_doc_json', 'Congddocumentos@store_json');

// esta ruta es para generar el consecutivo de un archivo
Route::post('generarconsecutivo_json', 'Congdconsecutivos@create');

// esta ruta es la vista principal para la carga de registros
Route::any('subir_registro', function(){
  	$consecutivos = psig\models\Modgdconsecutivos::where('usu_id', '=', Session::get('usu_id'))->where('gdcon_estado', '=', 'abierto')->get();
  	if($consecutivos->isEmpty()){
   	return View::make('administrador.modulos.gdocumentos.gdocumentos', array('mensaje' => 'No tiene registros pendientes'));
   }else{
   	return View::make('administrador.modulos.gdocumentos.subir_registro', array('consecutivos' => $consecutivos));
   }
});

Route::post('guardar_registro', 'Congdregistros@create');

// esta ruta recibe el id de un documento se la pasa al controlador
// para forzar la descarga del documento con el nombre mas el consecutivo
Route::post('descargar_doc_json', 'Congddocumentos@download_json');

Route::post('download_sin_consecutivo', 'Congddocumentos@download_sin_conse_json');

// consultar registros del usuario
Route::any('consultar_registros', function(){   
   $categorias = psig\models\Modgdcategorias::orderBy('gdcat_guia', 'asc')->where('gdcat_estado','=','activo')->get();
   $subcategorias = psig\models\Modgdsubcategorias::orderBy('gdcat_id')->orderBy('gdsub_guia', 'asc')->where('gdsub_estado','=','activo')->get();
    $usuarios = psig\models\Modusuarios::join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')->where('roles.rol_nombre', '=', 'usuario')->where('usu_estado','=','activo')->get();
   $documentos = DB::table('gd_documentos')
    ->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
    ->where('gd_versiones.gdver_estado', '=', 'activo')
    ->where('gd_documentos.gddoc_estado', '=', 'activo')
    ->orderBy('gddoc_identificacion', 'asc')   
    ->get();    
    
      return View::make('administrador.modulos.gdocumentos.consultar_registros', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos,'usuarios' => $usuarios));
});

Route::any('registros_usuario',function(){

  $usuarios = DB::SELECT(DB::RAW("select DISTINCT(us.usu_id),us.* from usuarios as us inner join gd_registros as reg on reg.usu_id = us.usu_id ORDER BY us.usu_nombres"));
  
  if(strpos(URL::previous(),'registros_usuario'))
  {
    $registros = psig\models\Modgdregistros::where('usu_id','=',Input::get('user_id'))->get();
    $usu = Input::get('user_id');
  }
  else{    
    $registros = psig\models\Modgdregistros::All();
    $usu = null;    
  }
  
  return view('administrador.modulos.gdocumentos.regs_usuario',compact('usuarios','registros','usu'));
  
});

// consultar linea de tiempo registros del usuario por documento
Route::any('timeline_registro', function(){  
   $registros = psig\models\Modgdregistros::join('gd_permisos_registros', 'gd_permisos_registros.gdreg_id', '=', 'gd_registros.gdreg_id')
      ->where('gd_registros.gddoc_id', '=', Input::get('gddoc_id'))
      // ->where('gd_permisos_registros.usu_id', '=', Session::get('usu_id'))
      ->where('gd_permisos_registros.gdperreg_permiso', '=', true)
      ->get();

   $documet = psig\models\Modgddocumentos::find(Input::get('gddoc_id'));
  

   return View::make('administrador.modulos.gdocumentos.timeline_reg_doc', array('registros' => $registros, 'documet' => $documet));
});

// consultar registros del usuario individual
Route::any('consulta_reg_individual', function(){  
   $documento = psig\models\Modgddocumentos::where('gddoc_identificacion', '=', trim (Input::get('gddoc_identificacion')))->first();

   if(is_null($documento)){
      return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Documento no encontrado!!');
   }else{

      $consecutivo = psig\models\Modgdconsecutivos::where('gddoc_id', '=', $documento->gddoc_id)
      ->where('gdcon_consecutivo', '=', Input::get('gdcon_consecutivo'))->first();

         if(is_null($consecutivo)){
            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Consecutivo no encontrado!!');
         }else{
            $registro = psig\models\Modgdregistros::join('gd_permisos_registros', 'gd_permisos_registros.gdreg_id', '=', 'gd_registros.gdreg_id')
            ->where('gd_registros.gddoc_id', '=', $documento->gddoc_id)
            ->where('gd_registros.gdcon_id', '=', $consecutivo->gdcon_id)
            // ->where('gd_permisos_registros.usu_id', '=', Session::get('usu_id'))
            ->where('gd_permisos_registros.gdperreg_permiso', '=', true)
            ->first();

            if(is_null($registro)){
               return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Registro no cargado o No tiene Permisos!!');
            }else{
               return View::make('administrador.modulos.gdocumentos.consulta_reg_individual', array('registro' => $registro)); 
            }
         }

   }
});


Route::post('buscar_doc_conse', 'Congdconsecutivos@doc_que_pertenece');

Route::post('reg_visu_per', function(){
  return 'reg_visu_per';
});

route::post('buscar_usu_rela',function(){
  return 'buscar_usu_rela';
});