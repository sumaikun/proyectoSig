<?php

namespace psig\Http\Controllers;

use psig\models\Modgddocumentos;
use psig\models\Modgdpermisosdocumentos;
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

		// return Input::get('usuario');
		$documentos = Modgddocumentos::where('gddoc_estado','=','activo')->get();
		foreach ($documentos as $key => $value) {
			$existe = Modgdpermisosdocumentos::where('usu_id', '=', Input::get('usuario'))
															->where('gddoc_id', '=', $value->gddoc_id)->get();
			
			if($existe->isEmpty()){

				$permisonew = new Modgdpermisosdocumentos;
					$permisonew->usu_id = Input::get('usuario');
					$permisonew->gddoc_id = $value->gddoc_id;
					$permisonew->gdperdoc_permiso = Input::has($value->gddoc_id.'doc');
				$permisonew->save();

			}else{

				$permiso = Modgdpermisosdocumentos::find($existe[0]->gdperdoc_id);
				$permiso->gdperdoc_permiso = Input::has($value->gddoc_id.'doc');
				$permiso->save();

			}

		}

		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Permisos guardados con éxito!!');
		
	}


  


	public function create_doc_per(){

		//return Input::get('gddoc_id');
		// return Input::get('usuario');
		
		// optengo los usuarios que no son administradores
		$usuarios = DB::table('usuarios')
    	->join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')
    	->where('roles.rol_nombre', '=', 'usuario')->get();


		foreach ($usuarios as $key => $value) {
			$existe = Modgdpermisosdocumentos::where('usu_id', '=', $value->usu_id)
		 			->where('gddoc_id', '=', Input::get('gddoc_id'))->get();
			
		 	if($existe->isEmpty()){

				$permisonew = new Modgdpermisosdocumentos;
					$permisonew->usu_id = $value->usu_id;
					$permisonew->gddoc_id = Input::get('gddoc_id');
					$permisonew->gdperdoc_permiso = Input::has($value->usu_id.'u');
				$permisonew->save();

			}else{

				$permiso = Modgdpermisosdocumentos::find($existe[0]->gdperdoc_id);
				$permiso->gdperdoc_permiso = Input::has($value->usu_id.'u');
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
		$permisos = Modgdpermisosdocumentos::where('usu_id', '=', Input::get('id_udu'))->get();
		return $permisos;
	}


	public function show_per_json()
	{
		$permisos = Modgdpermisosdocumentos::where('gddoc_id', '=', Input::get('docid'))->get();
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