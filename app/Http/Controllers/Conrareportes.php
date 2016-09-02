<?php
namespace psig\Http\Controllers; 

use psig\models\Modrareportes; 
use Input;
use View;


class Conrareportes extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /conrareportes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /conrareportes/create
	 *
	 * @return Response
	 */
	public function create(){
		
		$reporte = new Modrareportes();
			$reporte->rarepo_fecha = Input::get('rarepo_fecha');
			$reporte->raact_id = Input::get('raact_id');
			$reporte->raemp_id = Input::get('raemp_id');
			$reporte->raproy_id = Input::get('raproy_id');

			$reporte->rarepo_lugar = Input::get('rarepo_lugar');
			$reporte->rarepo_sub_tema = Input::get('rarepo_sub_tema');
			$reporte->rarepo_horas = Input::get('rarepo_horas');
			$reporte->rarepo_informe = Input::get('rarepo_informe');
			$reporte->usu_id = Session::get('usu_id');

			if($reporte->save()){
				return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Reporte enviado con éxito!!');
			}else{
				return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error enviando el reporte!!');
			}

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /conrareportes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /conrareportes/{id}
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
	 * GET /conrareportes/{id}/edit
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
	 * PUT /conrareportes/{id}
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
	 * DELETE /conrareportes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}