<?php

namespace psig\Http\Controllers;

use psig\models\Modfuncionalidades;
use Input;
use View;

class Confuncionalidades extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /confuncionalidades
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /confuncionalidades/create
	 *
	 * @return Response
	 */
	public function create(){
		$function = Modfuncionalidades::where('fun_nombre', '=', Input::get('fun_nombre'))->exists();

		if($function){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Esta funcionalidad ya se encuentra registrada!!');
		}else{
			$fun = new Modfuncionalidades();
			$fun->fun_nombre = Input::get('fun_nombre');
			if(Input::has('fun_detalle'))$fun->fun_detalle = Input::get('fun_detalle');

			if($fun->save()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Funcionalidad registrada con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la funcionalidad!!');
			}

		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /confuncionalidades
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /confuncionalidades/{id}
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
	 * GET /confuncionalidades/{id}/edit
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
	 * PUT /confuncionalidades/{id}
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
	 * DELETE /confuncionalidades/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
		$fun = Modfuncionalidades::find($id);
			if($fun->delete()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Funcionalidad eliminada con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Problemas eliminando la funcionalidad!!');
			}
		
	}

}