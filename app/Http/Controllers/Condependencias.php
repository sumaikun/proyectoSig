<?php

namespace psig\Http\Controllers;

use psig\models\Moddependencias;
use psig\models\Modusuarios;
use Input;
use View;


class Condependencias extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /condependencias
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /condependencias/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$depen = new Moddependencias;
			$depen->depe_nombre = Input::get('depe_nombre');
			$depen->depe_sigla = Input::get('depe_sigla');
			$depen->depe_responsable = Input::get('depe_responsable');
			

			if($depen->save()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Dependencia registrada con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error registrando dependencia verifique la información!!');
			}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /condependencias
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /condependencias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$dependencia = Moddependencias::find($id);
		return View::make('administrador.dependencias.update_depe', array('dependencia' => $dependencia));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /condependencias/{id}/edit
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
	 * PUT /condependencias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(){
			$depe = Moddependencias::find(Input::get('depe_id'));
			$depe->depe_nombre = Input::get('depe_nombre');
			$depe->depe_sigla = Input::get('depe_sigla');
			$depe->depe_responsable = Input::get('depe_responsable');

			if($depe->save()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Dependencia actualizada con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando la  Dependencia!!');
			}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /condependencias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$existen = Modusuarios::where('depe_id', '=', $id)->exists();

		if($existen){

			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'No se pudo eliminar la dependencia por que existen usuarios relacionados a esta!!');

		}else{

			$depe = Moddependencias::find($id);
			if($depe->delete()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Dependencia eliminado con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'No se pudo eliminar la dependencia por que existen usuarios relacionados a esta!!');
			}

		}		
		
	}

}