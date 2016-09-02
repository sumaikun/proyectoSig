<?php

namespace psig\Http\Controllers;

use psig\models\Modpermisosfuncionalidades;
use Input;
use View;
use DB;


class Conpermisosfuncionalidaes extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /conpermisosfuncionalidaes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /conpermisosfuncionalidaes/create
	 *
	 * @return Response
	 */
	public function create(){
		

		$usuarios = DB::table('usuarios')
    	->join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')
    	->where('roles.rol_nombre', '=', 'usuario')->get();

		foreach ($usuarios as $key => $value) {
			$existe = Modpermisosfuncionalidades::where('fun_id', '=', Input::get('idfuncion'))
															->where('usu_id', '=', $value->usu_id)->get();
			
			if($existe->isEmpty()){

				$permisonew = new Modpermisosfuncionalidades;
					$permisonew->usu_id = $value->usu_id;
					$permisonew->fun_id = Input::get('idfuncion');
					$permisonew->perfun_permiso = Input::has($value->usu_id.'u');
				$permisonew->save();

			}else{

				$permiso = Modpermisosfuncionalidades::find($existe[0]->perfun_id);
				$permiso->perfun_permiso = Input::has($value->usu_id.'u');
				$permiso->save();

			}

		}

		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Permisos guardados con éxito!!');


	}

	/**
	 * Store a newly created resource in storage.
	 * POST /conpermisosfuncionalidaes
	 *
	 * @return Response
	 */
	public function store(){
		$permisos = Modpermisosfuncionalidades::where('fun_id', '=', Input::get('funid'))->get();
		return $permisos;
	}

	/**
	 * Display the specified resource.
	 * GET /conpermisosfuncionalidaes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /conpermisosfuncionalidaes/{id}/edit
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
	 * PUT /conpermisosfuncionalidaes/{id}
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
	 * DELETE /conpermisosfuncionalidaes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}