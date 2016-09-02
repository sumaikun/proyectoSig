<?php

namespace psig\Http\Controllers;

use psig\helpers\Metodos;
use psig\models\Modgdconsecutivos;
use psig\models\Modgddocumentos;
use Input;
use Session;



class Congdconsecutivos extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdconsecutivos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
 
	/**
	 * Show the form for creating a new resource.
	 * GET /congdconsecutivos/create
	 *
	 * @return Response
	 */
	public function create(){		

		$consecutivo = null;
		$existe_activo = namespace psig\Http\Controllers;::whereRaw('usu_id = ? and gdcon_estado=? and gddoc_id=?', array( Session::get('usu_id'), 'abierto', Input::get('iddoc')))->exists();

		if($existe_activo){
			// el proceso termina por que el usuario tiene un proceso pendiente
			$consecutivo=-1;

		}else{
			// consulto si el id del documento recibido tiene algun consecutivo registrado
			$existe_conse = Modgdconsecutivos::where('gddoc_id', '=', Input::get('iddoc'))->exists();
			if($existe_conse){

				//dd($existe_conse).exit();
				
				// opteniendo el ultimo consecutivo registrado por el id del documento resivido
				$ultimo_conse = DB::select('SELECT * FROM gd_consecutivos WHERE gddoc_id=? and gdcon_anio=? and gdcon_numero = (select max(gdcon_numero) from gd_consecutivos where gddoc_id=? and gdcon_anio=?)', array(Input::get('iddoc'), date("y"), Input::get('iddoc'), date("y")));
				
				//dd($ultimo_conse).exit();

				if(!empty($ultimo_conse) && ($ultimo_conse[0]->gdcon_anio == date("y"))){
				//si el año actual es igual al ultimo registrado tomo el ultimo consecutivo y le sumo 1

					$conse_igual = new Modgdconsecutivos;
						$conse_igual->gddoc_id = Input::get('iddoc');
						$conse_igual->usu_id = Session::get('usu_id');
						$conse_igual->gdcon_consecutivo = Metodos::arma_y_suma_cons($ultimo_conse[0]->gdcon_numero);
						$conse_igual->gdcon_numero = $ultimo_conse[0]->gdcon_numero + 1;
						$conse_igual->gdcon_anio = date("y");
					
					if($conse_igual->save()) $consecutivo = $conse_igual->gdcon_consecutivo;

				}else{ //si el año es diferente debe empezar con 0001

					$conse_dif = new Modgdconsecutivos;
						$conse_dif->gddoc_id = Input::get('iddoc');
						$conse_dif->usu_id = Session::get('usu_id');
						$conse_dif->gdcon_consecutivo = '0001-'.date("y");
						$conse_dif->gdcon_numero = 1;
						$conse_dif->gdcon_anio = date("y");
					
					if($conse_dif->save()) $consecutivo = $conse_dif->gdcon_consecutivo;

				}


			}else{ // si no tiene ningun consecutivo registrado
				// aqui pregunto si el año guardado inicialmente es igual al actual
				$docu = Modgddocumentos::find(Input::get('iddoc'));
				if($docu->gddoc_anio==date("y")){

					//consecutivo igual año
					$conse_iga = new Modgdconsecutivos;
						$conse_iga->gddoc_id = Input::get('iddoc');
						$conse_iga->usu_id = Session::get('usu_id');
						$conse_iga->gdcon_consecutivo = Metodos::arma_y_suma_cons($docu->gddoc_consecutivo_ini);
						$conse_iga->gdcon_numero = $docu->gddoc_consecutivo_ini + 1;
						$conse_iga->gdcon_anio = date("y");
					
					if($conse_iga->save()) $consecutivo = $conse_iga->gdcon_consecutivo;
				}else{ // en caso que el año inicial sea diferente al actual el consecutivo inicial con 0001

					//consecutivo diferente año
					$conse_difa = new Modgdconsecutivos;
						$conse_difa->gddoc_id = Input::get('iddoc');
						$conse_difa->usu_id = Session::get('usu_id');
						$conse_difa->gdcon_consecutivo = '0001-'.date("y");
						$conse_difa->gdcon_numero = 1;
						$conse_difa->gdcon_anio = date('y');
					
					if($conse_difa->save()) $consecutivo = $conse_difa->gdcon_consecutivo;
				}

			}
			
		}
		
		return $consecutivo;
			
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congdconsecutivos
	 *
	 * @return Response
	 */
	public function consecutivo_json()
	{

	
	}

	/**
	 * Display the specified resource.
	 * GET /congdconsecutivos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(){
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /congdconsecutivos/{id}/edit
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
	 * PUT /congdconsecutivos/{id}
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
	 * DELETE /congdconsecutivos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function doc_que_pertenece(){
		$result = Modgdconsecutivos::find(Input::get('gdcon_id'))->documentos()->first();
		return $result;
	}

}