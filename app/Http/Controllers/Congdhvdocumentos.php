<?php
namespace psig\Http\Controllers;

use psig\models\Modgdcategorias;
use psig\models\Modgdsubcategorias;
use psig\models\Modgdhvdocumentos;
use psig\models\Modgddocumentos;
use Input;
use View;
use Session;
use Response;
use DB;

class Congdhvdocumentos extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdhvdocumentos
	 *
	 * @return Response
	 */
	public function index(){
		
		$categorias = Modgdcategorias::where('gdcat_estado', '=', 'activo')->orderBy('gdcat_guia', 'asc')->get();
   		$subcategorias = Modgdsubcategorias::where('gdsub_estado', '=', 'activo')->orderBy('gdcat_id','gdsub_guia', 'asc')->get();     
   		$documentos = DB::table('gd_documentos')
    			->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
    			->where('gd_versiones.gdver_estado', '=', 'activo')
   			->where('gd_documentos.gddoc_estado', '=', 'activo')
    			->orderBy('gddoc_identificacion', 'asc')->get();

		if(Session::get('rol_nombre')=='usuario'){
			return View::make('usuarios.cassima.hvdocumento', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos));
		}elseif (Session::get('rol_nombre')=='administrador') {
			return View::make('administrador.modulos.cassima.hvdocumento', array('categorias' => $categorias, 'subcategorias' => $subcategorias, 'documentos' => $documentos));
		}

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congdhvdocumentos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$existe = Modgdhvdocumentos::where('gddoc_id', '=', Input::get('gddoc_id'))->exists();
		if($existe){

			$hvdoc = Modgdhvdocumentos::where('gddoc_id', '=', Input::get('gddoc_id'))->first();
			$hv = Modgdhvdocumentos::find($hvdoc->gdhv_id);

			$hv->gdhv_origen = Input::get('gdhv_origen');
			$hv->gdhv_revisado_por = Input::get('gdhv_revisado_por');
			$hv->gdhv_aprobado_por = Input::get('gdhv_aprobado_por');
			$hv->gdhv_detalle_cambio = Input::get('gdhv_detalle_cambio');
			$hv->gdhv_disp_obsoletos = Input::get('gdhv_disp_obsoletos');
			$hv->gdhv_custodia = Input::get('gdhv_custodia');
			$hv->gdhv_med_almacenamiento = Input::get('gdhv_med_almacenamiento');
			$hv->gdhv_med_proteccion = Input::get('gdhv_med_proteccion');
			$hv->gdhv_ubicacion_reg = Input::get('gdhv_ubicacion_reg');
			$hv->gdhv_ret_gestion = Input::get('gdhv_ret_gestion');
			$hv->gdhv_ret_inactivo = Input::get('gdhv_ret_inactivo');
			$hv->gdhv_ret_muerto = Input::get('gdhv_ret_muerto');

			if($hv->save()){
				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actualización guardada con éxito!!!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actualización guardada con éxito!!!!');
				}
			}else{
				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando HV del documento!!!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando HV del documento!!!!');
				}
			}


		}else{

			$hv = new Modgdhvdocumentos();
			$hv->gddoc_id = Input::get('gddoc_id');
			$hv->gdhv_origen = Input::get('gdhv_origen');
			$hv->gdhv_revisado_por = Input::get('gdhv_revisado_por');
			$hv->gdhv_aprobado_por = Input::get('gdhv_aprobado_por');
			$hv->gdhv_detalle_cambio = Input::get('gdhv_detalle_cambio');
			$hv->gdhv_disp_obsoletos = Input::get('gdhv_disp_obsoletos');
			$hv->gdhv_custodia = Input::get('gdhv_custodia');
			$hv->gdhv_med_almacenamiento = Input::get('gdhv_med_almacenamiento');
			$hv->gdhv_med_proteccion = Input::get('gdhv_med_proteccion');
			$hv->gdhv_ubicacion_reg = Input::get('gdhv_ubicacion_reg');
			$hv->gdhv_ret_gestion = Input::get('gdhv_ret_gestion');
			$hv->gdhv_ret_inactivo = Input::get('gdhv_ret_inactivo');
			$hv->gdhv_ret_muerto = Input::get('gdhv_ret_muerto');

			if($hv->save()){
				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actualización guardada con éxito!!!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actualización guardada con éxito!!!!');
				}
			}else{
				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando HV del documento!!!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando HV del documento!!!!');
				}
			}
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congdhvdocumentos
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /congdhvdocumentos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(){

		$hvdoc = Modgdhvdocumentos::where('gddoc_id', '=', Input::get('gddoc_id'))->first();
		$doc = Modgddocumentos::where('gddoc_id', '=', Input::get('gddoc_id'))->first();
		$version = $doc->versiones()->where('gdver_estado', '=', 'activo')->first();
		return Response::json(array('hvdoc' => $hvdoc, 'version' => $version, 'doc' => $doc));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /congdhvdocumentos/{id}/edit
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
	 * PUT /congdhvdocumentos/{id}
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
	 * DELETE /congdhvdocumentos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}