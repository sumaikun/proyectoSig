<?php
namespace psig\Http\Controllers;

use psig\models\Modgdcategorias;
use psig\models\Modgdsubcategorias;
use Input;
use View;

class Congdsubcategorias extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdsubcategorias
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congdsubcategorias/create
	 *
	 * @return Response
	 */
	public function create(){
		
		// pregunto si la categoria recibida contiene alguna subcategoria con el nombre a crear
		$existe = Modgdsubcategorias::where('gdsub_nombre', '=', Input::get('gdsub_nombre'))
												->where('gdcat_id', '=', Input::get('gdcat_id'))
												->exists();
		if($existe){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La Sub - categoria ya existe para esta categoria!!');
		}else{
			$cat = Modgdcategorias::find(Input::get('gdcat_id'));

			$sub_nombre = str_replace(' ', '_', strtolower(trim (Input::get('gdsub_nombre'))));

			$sub = new Modgdsubcategorias;
			$sub->gdsub_nombre = Input::get('gdsub_nombre');
			$sub->gdcat_id = Input::get('gdcat_id');
			$sub->gdsub_directorio = Metodos::quitar_tildes($cat->gdcat_directorio.'/'.$sub_nombre);
			
			if($sub->save()){

				File::makeDirectory($sub->gdsub_directorio, 0777, false, true);

				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Se ha creado con éxito la Sub - Categoria '.$sub->gdsub_nombre.' !!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error creando la subcategoria !!');
			}
		}

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congdsubcategorias
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	public function store_json()
	{
		$subcategoria = Modgdsubcategorias::orderBy('gdcat_id','gdsub_guia', 'asc')->where('gdcat_id', '=', Input::get('id_cate'))->get();
		return $subcategoria;
	}

	/**
	 * Display the specified resource.
	 * GET /congdsubcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
		$subcategoria = Modgdsubcategorias::find($id);
		return View::make('administrador.modulos.cassima.show_subcate', array('subcategoria' => $subcategoria));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /congdsubcategorias/{id}/edit
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
	 * PUT /congdsubcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$subcategoria = Modgdsubcategorias::find(Input::get('gdsub_id'));
		$subcategoria->gdsub_nombre = Input::get('gdsub_nombre');

		if($subcategoria->save()){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Se actualizo con éxito la subcategoría!!');
		}else{
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error editando la subcategoría!!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /congdsubcategorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function ordsubup($idcat, $idsub){
		$todas = Modgdsubcategorias::orderBy('gdsub_guia', 'asc')
		->where('gdcat_id','=',$idcat)->where('gdsub_estado','=','activo')->get();

		$con = count($todas); 
		for ($i=0; $i < $con; $i++) { 
			if($i != 0 && $todas[$i]->gdsub_id === $idsub){

				$aux = $todas[$i]->gdsub_guia;
				$aux2 = $todas[$i-1]->gdsub_guia;

				$actual = Modgdsubcategorias::find($idsub);
				$actual->gdsub_guia = $aux2;
				$actual->save();

				$anterior = Modgdsubcategorias::find($todas[$i-1]->gdsub_id);
				$anterior->gdsub_guia = $aux; 
				$anterior->save();

			}
		}

		return Redirect::to('admin/ord_edit_cat_and_sub');
	}



	public function ordsubdown($idcat, $idsub){
		$todas = Modgdsubcategorias::orderBy('gdsub_guia', 'asc')
		->where('gdcat_id','=',$idcat)->where('gdsub_estado','=','activo')->get();

		$con = count($todas); 
		for ($i=0; $i < $con; $i++) { 
			if($i != $con-1 && $todas[$i]->gdsub_id == $idsub){

				$aux = $todas[$i]->gdsub_guia;
				$aux2 = $todas[$i+1]->gdsub_guia;

				$actual = Modgdsubcategorias::find($idsub);
				$actual->gdsub_guia = $aux2;
				$actual->save();

				$anterior = Modgdsubcategorias::find($todas[$i+1]->gdsub_id);
				$anterior->gdsub_guia = $aux;
				$anterior->save();

			}
		}
	
		return Redirect::to('admin/ord_edit_cat_and_sub');
	}



}