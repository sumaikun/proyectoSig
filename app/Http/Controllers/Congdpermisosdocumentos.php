<?php

namespace psig\Http\Controllers;

use psig\models\Modgddocumentos;
use psig\models\Modgdpermisosdocumentos;
use psig\models\Modgdversiones;
use Input;
use View;
use DB;



class Congdpermisosdocumentos extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdpermisosdocumentos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congdpermisosdocumentos/create
	 *
	 * @return Response
	 */
	public function create_per_doc(){
		
		$documentos = Modgdversiones::all();

		//return $documentos;
		//showreturn $documentos;
		foreach ($documentos as $key => $value) {
			if($value->empresa==null)
			{
				$existe = Modgdpermisosdocumentos::where('usu_id', '=', Input::get('usuario'))->where('gddoc_id', '=', $value->gddoc_id)->get();
					$empresa = null;
			}
			else{
				$existe = Modgdpermisosdocumentos::where('usu_id', '=', Input::get('usuario'))->where('gddoc_id', '=', $value->gddoc_id)->where('empresa','=',$value->empresa)->get();
				$empresa = $value->empresa;	
			}

			if($existe->isEmpty()){

				$permisonew = new Modgdpermisosdocumentos;
					$permisonew->usu_id = Input::get('usuario');
					$permisonew->gddoc_id = $value->gddoc_id;
					$permisonew->gdperdoc_permiso = Input::has($value->gdver_id.'doc');
					$permisonew->empresa = $empresa;
				$permisonew->save();

			}else{

				$permiso = Modgdpermisosdocumentos::find($existe[0]->gdperdoc_id);
				$permiso->gdperdoc_permiso = Input::has($value->gdver_id.'doc');
				$permiso->empresa = $empresa;
				$permiso->save();

			}
			
			
			

		}

		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Permisos guardados con éxito!!');
		
	}


  


	public function create_doc_per(){

		//return Input::get('gddoc_id');
		// return Input::get('usuario');
		
		// optengo los usuarios que no son administradores
		$version = Modgdversiones::where('gdver_id','=',Input::get('gddoc_id'))->first();


		$usuarios = DB::table('usuarios')
    	->join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')
    	->where('roles.rol_nombre', '=', 'usuario')->get();


		foreach ($usuarios as $key => $value) {
			if($version->empresa == null)
			{
				$existe = Modgdpermisosdocumentos::where('usu_id', '=', $value->usu_id)
		 			->where('gddoc_id', '=', $version->gddoc_id)->get();
				$empresa = null;	
			}
			else{
				$existe = Modgdpermisosdocumentos::where('usu_id', '=', $value->usu_id)
		 			->where('gddoc_id', '=', $version->gddoc_id)->where('empresa','=',$version->empresa)->get();
		 		$empresa = $version->empresa;
			}
			
		 	if($existe->isEmpty()){

				$permisonew = new Modgdpermisosdocumentos;
					$permisonew->usu_id = $value->usu_id;
					$permisonew->gddoc_id = $version->gddoc_id;
					$permisonew->gdperdoc_permiso = Input::has($value->usu_id.'u');
					$permisonew->empresa = $empresa;
				$permisonew->save();

			}else{

				$permiso = Modgdpermisosdocumentos::find($existe[0]->gdperdoc_id);
				$permiso->gdperdoc_permiso = Input::has($value->usu_id.'u');
				$permiso->empresa = $empresa;
				$permiso->save();
			}

		 }

		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Permisos guardados con éxito!!');
	}





	

	/**
	 * Store a newly created resource in storage.
	 * POST /congdpermisosdocumentos
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /congdpermisosdocumentos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	public function show_doc_json()
	{
		//print_r($_POST);
		//return '';
		$permisos = \DB::SELECT(\DB::RAW("select per.gdperdoc_id, per.gddoc_id, ver.gddoc_id, gdperdoc_permiso, per.empresa, ver.empresa, per.usu_id, ver.gdver_id  from gd_permisos_documentos as per inner join gd_versiones as ver on per.gddoc_id = ver.gddoc_id where per.usu_id = ".Input::get('id_udu')."  and per.empresa = ver.empresa and gdperdoc_permiso = 1 union select per.gdperdoc_id, per.gddoc_id, ver.gddoc_id, gdperdoc_permiso, per.empresa, ver.empresa, per.usu_id, ver.gdver_id  from gd_permisos_documentos as per inner join gd_versiones as ver on per.gddoc_id = ver.gddoc_id where per.usu_id = ".Input::get('id_udu')." and per.empresa is null and ver.empresa is null and gdperdoc_permiso = 1"));
		return $permisos;
	}


	public function show_per_json()
	{
		//$version = Modgdversiones::where('gdver_id','=',Input::get('docid'))->first(); 
		//$permisos = Modgdpermisosdocumentos::where('gddoc_id', '=', $version->gddoc_id)->get();
		$permisos = DB::SELECT(DB::RAW("select * , per.usu_id as usu_id from gd_permisos_documentos as per inner join gd_versiones as ver on per.gddoc_id = ver.gddoc_id where ver.gdver_id = ".Input::get('docid')." and ver.empresa = per.empresa and gdperdoc_permiso = 1 union select * , per.usu_id as usu_id from gd_permisos_documentos as per inner join gd_versiones as ver on per.gddoc_id = ver.gddoc_id where ver.gdver_id = ".Input::get('docid')." and ver.empresa is null and per.empresa is null and gdperdoc_permiso = 1 ;"));

		return $permisos;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /congdpermisosdocumentos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /congdpermisosdocumentos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /congdpermisosdocumentos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}