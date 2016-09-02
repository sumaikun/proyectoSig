<?php

class Conraproyectos extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /conraproyectos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /conraproyectos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /conraproyectos
	 *
	 * @return Response
	 */
	public function store_json(){	

		//retorna los proyectos de una empresa especifica
		$proyectos = Modraproyectos::where('raemp_id', '=', Input::get('raemp_id'))->get();
		return $proyectos;
	}

	/**
	 * Display the specified resource.
	 * GET /conraproyectos/{id}
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
	 * GET /conraproyectos/{id}/edit
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
	 * PUT /conraproyectos/{id}
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
	 * DELETE /conraproyectos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}