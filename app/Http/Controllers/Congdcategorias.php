<?php
namespace psig\Http\Controllers;

use psig\models\Modgdcategorias;
use psig\models\Modgdsubcategorias;
use psig\Helpers\Metodos;
use File;
use Input;
use View;
use redirect;


class Congdcategorias extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdcategorias
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congdcategorias/create
	 *
	 * @return Response
	 */
	public function create(){
		// pregunto si la categoria existe para no duplicar
		$existe = Modgdcategorias::where('gdcat_nombre', '=', Input::get('gdcat_nombre'))->exists();
		
		if($existe){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'El nombre de la categoría ya se encuentra registrado!!');
		}else{

			$ruta_base = 'gdocumentos/activos/';
			// $directorio = strtolower(trim ($cat->gdcat_nombre));
			$categoria = str_replace(' ', '_', strtolower(trim (Input::get('gdcat_nombre'))));

			$cat = new Modgdcategorias;
			$cat->gdcat_nombre = Input::get('gdcat_nombre');
			$cat->gdcat_directorio = Metodos::quitar_tildes($ruta_base."".$categoria);

			
			if($cat->save()){ 
			//si guarda con éxito la categoria se procede a crear la categoria general por defecto
			// y el directorio

				File::makeDirectory($cat->gdcat_directorio, 0777, true, true);

				$sub = new Modgdsubcategorias;
				$sub->gdsub_nombre='General';
				$sub->gdcat_id = $cat->gdcat_id;

				$sub->gdsub_directorio = Metodos::quitar_tildes($cat->gdcat_directorio."/general");

				// si registro con éxito la subcategoria general, automaticamente crea una carpeta
				// con el nombre general, en la ruta public/gdocumentos
				if($sub->save()){

					File::makeDirectory($cat->gdcat_directorio.'/general', 0777, true, true);
				}

				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Se ha creado la categoría '.Input::get('gdcat_nombre').' y la subcategoría general!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la categoria!!');
			}
		}
			
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congdcategorias
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /congdcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$categoria = Modgdcategorias::find($id);
		return View::make('administrador.modulos.cassima.show_cate', array('categoria' => $categoria));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /congdcategorias/{id}/edit
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
	 * PUT /congdcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$categoria = Modgdcategorias::find(Input::get('gdcat_id'));
		$categoria->gdcat_nombre = Input::get('gdcat_nombre');

		if($categoria->save()){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Se actualizo con éxito la categoría!!');
		}else{
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error editando la categoría!!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /congdcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function ordcatup($id){
		$todas = Modgdcategorias::orderBy('gdcat_guia', 'asc')->where('gdcat_estado','=','activo')->get();
		$con = count($todas); 
		for ($i=0; $i < $con; $i++) { 
			if($i != 0 && $todas[$i]->gdcat_id == $id){
				$aux = $todas[$i]->gdcat_guia;
				$aux2 = $todas[$i-1]->gdcat_guia;

				$actual = Modgdcategorias::find($id);
				$actual->gdcat_guia = $aux2; 
				$actual->save();

				$anterior = Modgdcategorias::find($todas[$i-1]->gdcat_id);
				$anterior->gdcat_guia = $aux; 
				$anterior->save();
			}
		}

		return Redirect::to('admin/ord_edit_cat_and_sub');
	}

	public function ordcatdown($id){
		$todas = Modgdcategorias::orderBy('gdcat_guia', 'asc')->where('gdcat_estado','=','activo')->get();
		$con = count($todas); 
		for ($i=0; $i < $con; $i++) { 
			if($i != $con-1 && $todas[$i]->gdcat_id == $id){
				$aux = $todas[$i]->gdcat_guia;
				$aux2 = $todas[$i+1]->gdcat_guia;

				$actual = Modgdcategorias::find($id);
				$actual->gdcat_guia = $aux2; 
				$actual->save();

				$anterior = Modgdcategorias::find($todas[$i+1]->gdcat_id);
				$anterior->gdcat_guia = $aux; 
				$anterior->save();
			}
		}
		return Redirect::to('admin/ord_edit_cat_and_sub');

	}




	

}