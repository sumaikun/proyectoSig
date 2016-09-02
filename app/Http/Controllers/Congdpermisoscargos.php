<?php
namespace psig\Http\Controllers;

use psig\models\Modgddocumentos;
use psig\models\Modgdpermisoscargos;
use psig\models\Modusuarios;
use psig\models\Modgdpermisosdocumentos;
use Input;
use View;
class Congdpermisoscargos extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdpermisoscargos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congdpermisoscargos/create
	 *
	 * @return Response
	 */
	public function create()
	{

		$documentos = Modgddocumentos::where('gddoc_estado','=','activo')->get();

		foreach ($documentos as $key => $value) {

			$existe = Modgdpermisoscargos::where('carg_id', '=', Input::get('carg_id'))
															->where('gddoc_id', '=', $value->gddoc_id)->get();
			
			if($existe->isEmpty()){

				$permisonew = new Modgdpermisoscargos;
					$permisonew->carg_id = Input::get('carg_id');
					$permisonew->gddoc_id = $value->gddoc_id;
					$permisonew->gdpercarg_permiso = Input::has($value->gddoc_id.'doc');
				$permisonew->save();

			}else{

				$permiso = Modgdpermisoscargos::find($existe[0]->gdpercarg_id);
				$permiso->gdpercarg_permiso = Input::has($value->gddoc_id.'doc');
				$permiso->save();

			}

		}

		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Permisos guardados con éxito!!');



	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congdpermisoscargos
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /congdpermisoscargos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$permisos = Modgdpermisoscargos::where('carg_id', '=', Input::get('carg_id'))->get();
		return $permisos;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /congdpermisoscargos/{id}/edit
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
	 * PUT /congdpermisoscargos/{id}
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
	 * DELETE /congdpermisoscargos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function asignar_por_cargo(){
		$usuario = Modusuarios::find(Input::get('usu_id'));
		// $usuario->cargos->carg_nombre;

		$permisos = Modgdpermisoscargos::where('carg_id','=',$usuario->cargos->carg_id)->get();

		if($permisos->isEmpty()){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'El cargo de esta persona no tiene permisos configurados!!');
		}else{

			foreach ($permisos as $key => $value) {

				$existe = Modgdpermisosdocumentos::where('usu_id', '=', Input::get('usu_id'))
																->where('gddoc_id', '=', $value->gddoc_id)->get();
				
				if($existe->isEmpty()){

					$permisonew = new Modgdpermisosdocumentos;
						$permisonew->usu_id = Input::get('usu_id');
						$permisonew->gddoc_id = $value->gddoc_id;
						$permisonew->gdperdoc_permiso = $value->gdpercarg_permiso;
					$permisonew->save();

				}else{

					$permiso = Modgdpermisosdocumentos::find($existe[0]->gdperdoc_id);
					$permiso->gdperdoc_permiso = $value->gdpercarg_permiso;
					$permiso->save();

				}
			}



			return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Permisos transferidos con exito!!');
		}

		
	}

	

}