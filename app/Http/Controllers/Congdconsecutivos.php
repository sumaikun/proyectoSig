<?php

namespace psig\Http\Controllers;

use psig\Helpers\Metodos;
use psig\models\Modgdconsecutivos;
use psig\models\Modgddocumentos;
use psig\models\Modgdversiones;
use Input;
use Session;
use DB;



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

		$version = Modgdversiones::find(Input::get('iddoc'));



		$documento = Modgddocumentos::find($version->gddoc_id);

		

		if($documento->gddoc_is_multcons==1)
		{
			$existe_activo = Modgdconsecutivos::where('usu_id','=',Session::get('usu_id'))->where('gdcon_estado','=','abierto')->where('gddoc_id','=',$documento->gddoc_id)->where('empresa','=',$version->empresa)->exists();
			

		}
		else{
			$existe_activo = Modgdconsecutivos::whereRaw('usu_id = ? and gdcon_estado=? and gddoc_id=?', array( Session::get('usu_id'), 'abierto',$documento->gddoc_id))->exists();	
		}
		
		if($existe_activo){
			// el proceso termina por que el usuario tiene un proceso pendiente
			$consecutivo=-1;

		}else{

			if($documento->gddoc_is_multcons==1)
			{
				$existe_conse = Modgdconsecutivos::where('gddoc_id', '=', $documento->gddoc_id)->where('empresa','=',$version->empresa)->exists();
				if($existe_conse){
					//return 'here';
					$ultimo_conse = DB::select('SELECT * FROM gd_consecutivos WHERE gddoc_id=? and gdcon_anio=? and empresa=? and gdcon_numero = (select max(gdcon_numero) from gd_consecutivos where gddoc_id=? and gdcon_anio=? and empresa=?)', array($documento->gddoc_id, date("y"),$version->empresa,$documento->gddoc_id, date("y"),$version->empresa));
					
					//dd($ultimo_conse).exit();

					if(!empty($ultimo_conse) && ($ultimo_conse[0]->gdcon_anio == date("y"))){
					//si el año actual es igual al ultimo registrado tomo el ultimo consecutivo y le sumo 1

						$conse_igual = new Modgdconsecutivos;
							$conse_igual->gddoc_id = $documento->gddoc_id;
							$conse_igual->usu_id = Session::get('usu_id');
							$conse_igual->gdcon_consecutivo = Metodos::arma_y_suma_cons($ultimo_conse[0]->gdcon_numero).'-'.$version->empresas->abbr;
							$conse_igual->gdcon_numero = $ultimo_conse[0]->gdcon_numero + 1;
							$conse_igual->gdcon_anio = date("y");
							$conse_igual->empresa = $version->empresa;

						if($conse_igual->save()) $consecutivo = $conse_igual->gdcon_consecutivo;

					}else{ //si el año es diferente debe empezar con 0001
							//print_r($version);
							//return '';
							$conse_dif = new Modgdconsecutivos;
							$conse_dif->gddoc_id = $documento->gddoc_id;
							$conse_dif->usu_id = Session::get('usu_id');
							$conse_dif->gdcon_consecutivo = '0001-'.date("y").'-'.$version->empresas->abbr;
							$conse_dif->gdcon_numero = 1;
							$conse_dif->gdcon_anio = date("y");
							$conse_dif->empresa = $version->empresa;
						
						if($conse_dif->save()) $consecutivo = $conse_dif->gdcon_consecutivo;

					}
				 }
				 else{

				 	//$docu = Modgddocumentos::find($documento->gddoc_id);
					if($documento->gddoc_anio==date("y")){
							//print_r($version);
							//return '';
						//consecutivo igual año
							$conse_iga = new Modgdconsecutivos;
							$conse_iga->gddoc_id = $documento->gddoc_id;
							$conse_iga->usu_id = Session::get('usu_id');
							$conse_iga->gdcon_consecutivo = Metodos::arma_y_suma_cons($documento->gddoc_consecutivo_ini).'-'.$version->empresas->abbr;
							$conse_iga->gdcon_numero = $documento->gddoc_consecutivo_ini + 1;
							$conse_iga->gdcon_anio = date("y");
							$conse_iga->empresa = $version->empresa;
						
						if($conse_iga->save()) $consecutivo = $conse_iga->gdcon_consecutivo;
					}else{ // en caso que el año inicial sea diferente al actual el consecutivo inicial con 0001

						//consecutivo diferente año
						$conse_difa = new Modgdconsecutivos;
							$conse_difa->gddoc_id = $documento->gddoc_id;
							$conse_difa->usu_id = Session::get('usu_id');
							$conse_difa->gdcon_consecutivo = '0001-'.date("y").'-'.$version->empresas->abbr;
							$conse_difa->gdcon_numero = 1;
							$conse_difa->gdcon_anio = date('y');
							$conse_difa->empresa = $version->empresa;
						
						if($conse_difa->save()) $consecutivo = $conse_difa->gdcon_consecutivo;
					}
				 }
			}
			else{
				// consulto si el id del documento recibido tiene algun consecutivo registrado
				$existe_conse = Modgdconsecutivos::where('gddoc_id', '=', $documento->gddoc_id)->exists();
				if($existe_conse){

					//dd($existe_conse).exit();
					
					//$ultimo_conse = DB::select('SELECT * FROM gd_consecutivos WHERE gddoc_id=? and gdcon_anio=? ', array($documento->gddoc_id, date("y"), $documento->gddoc_id, date("y")));
					$ultimo_conse = DB::select('SELECT * FROM gd_consecutivos WHERE gddoc_id=? and gdcon_anio=? order by gddoc_id desc limit 1 ', array($documento->gddoc_id, date("y")));
										//dd($ultimo_conse).exit();
					
					//dd($ultimo_conse).exit();

					if(!empty($ultimo_conse) && ($ultimo_conse[0]->gdcon_anio == date("y"))){
					//si el año actual es igual al ultimo registrado tomo el ultimo consecutivo y le sumo 1

						$conse_igual = new Modgdconsecutivos;
							$conse_igual->gddoc_id = $documento->gddoc_id;
							$conse_igual->usu_id = Session::get('usu_id');
							$conse_igual->gdcon_consecutivo = Metodos::arma_y_suma_cons($ultimo_conse[0]->gdcon_numero);
							$conse_igual->gdcon_numero = $ultimo_conse[0]->gdcon_numero + 1;
							$conse_igual->gdcon_anio = date("y");
						
						if($conse_igual->save()) $consecutivo = $conse_igual->gdcon_consecutivo;

					}else{ //si el año es diferente debe empezar con 0001

						$conse_dif = new Modgdconsecutivos;
							$conse_dif->gddoc_id = $documento->gddoc_id;
							$conse_dif->usu_id = Session::get('usu_id');
							$conse_dif->gdcon_consecutivo = '0001-'.date("y");
							$conse_dif->gdcon_numero = 1;
							$conse_dif->gdcon_anio = date("y");
						
						if($conse_dif->save()) $consecutivo = $conse_dif->gdcon_consecutivo;

					}


				}else{ // si no tiene ningun consecutivo registrado
					// aqui pregunto si el año guardado inicialmente es igual al actual
					$docu = Modgddocumentos::find($documento->gddoc_id);
					if($docu->gddoc_anio==date("y")){

						//consecutivo igual año
						$conse_iga = new Modgdconsecutivos;
							$conse_iga->gddoc_id = $documento->gddoc_id;
							$conse_iga->usu_id = Session::get('usu_id');
							$conse_iga->gdcon_consecutivo = Metodos::arma_y_suma_cons($docu->gddoc_consecutivo_ini);
							$conse_iga->gdcon_numero = $docu->gddoc_consecutivo_ini + 1;
							$conse_iga->gdcon_anio = date("y");
						
						if($conse_iga->save()) $consecutivo = $conse_iga->gdcon_consecutivo;
					}else{ // en caso que el año inicial sea diferente al actual el consecutivo inicial con 0001

						//consecutivo diferente año
						$conse_difa = new Modgdconsecutivos;
							$conse_difa->gddoc_id = $documento->gddoc_id;
							$conse_difa->usu_id = Session::get('usu_id');
							$conse_difa->gdcon_consecutivo = '0001-'.date("y");
							$conse_difa->gdcon_numero = 1;
							$conse_difa->gdcon_anio = date('y');
						
						if($conse_difa->save()) $consecutivo = $conse_difa->gdcon_consecutivo;
					}

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