<?php
namespace psig\Http\Controllers;

use Input;
use psig\models\Modcargos;
use psig\models\Modusuarios;
use View;

class Concargos extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /concargos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /concargos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$cargo = new Modcargos;
			$cargo->carg_nombre = Input::get('carg_nombre');

			if($cargo->save()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'cargo registrado con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error registrando el cargo verifique la información!!');
			}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /concargos
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /concargos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$cargos = Modcargos::orderBy('carg_nombre')->get();
		$uncargo = Modcargos::find($id);
		return View::make('administrador.cargos.update_cargo', array('cargos' => $cargos, 'uncargo' => $uncargo));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /concargos/{id}/edit
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
	 * PUT /concargos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(){

			$cargo = Modcargos::find(Input::get('carg_id'));
			$cargo->carg_nombre = Input::get('carg_nombre');

			if($cargo->save()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Cargo actualizado con éxito!!');
			}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /concargos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$existen = Modusuarios::where('carg_id', '=', $id)->exists();

		if($existen){

			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'No se pudo eliminar el cargo por que existen usuarios relacionados a este cargo!!');

		}else{

			$cargo = Modcargos::find($id);
			if($cargo->delete()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'cargo eliminado con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'No se pudo eliminar el cargo por que existen usuarios relacionados a este cargo!!');
			}

		}		
		
	}

}