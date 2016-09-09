<?php
 
namespace psig\Http\Controllers;

use psig\Helpers\Metodos;
use psig\models\Modgddocumentos;
use psig\models\Modgdsubcategorias;
use psig\models\Modgdversiones;
use psig\models\Modgdhvdocumentos;
use psig\models\Modgdconsecutivos;
use Input;
use Session;
use View;
use DB;
use Response;
use Str;
use File;

class Congddocumentos extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congddocumentos
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congddocumentos/create
	 *
	 * @return Response
	 */
	public function create(){
		// pregunto si existe la identificacion del documento
		$existe = Modgddocumentos::where('gddoc_identificacion', '=', trim(Input::get('gddoc_identificacion')))->exists();

		if($existe){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La identificación que esta intentando registrar ya se encuentra en uso!!');
		}else{

			$doc = new Modgddocumentos;
			$doc->gddoc_identificacion = Str::upper(trim(Input::get('gddoc_identificacion')));
			$doc->gddoc_req_consecutivo = Input::has('gddoc_req_consecutivo');
			$doc->gddoc_req_registro = Input::has('gddoc_req_registro');
			
			if(Input::has('gddoc_req_consecutivo')){
				$doc->gddoc_consecutivo_ini = Input::get('gddoc_consecutivo_ini');
				$doc->gddoc_anio = date("y");
			}
			$doc->gdsub_id = Input::get('gdsub_id');
			//return $doc->gdsub_id;
			$doc->usu_id = Session::get('usu_id');

			//si se guarda el registro general del documento se procede a cargar la 
			//informacion de la version inicial del documento
			if($doc->save()){  

				$subcategoria = Modgdsubcategorias::find(Input::get('gdsub_id'));

				$ver = new Modgdversiones;
				$ver->gddoc_id = $doc->gddoc_id;
				$ver->gdver_version = Input::get('gdver_version');
				$ver->gdver_descripcion = Input::get('gdver_descripcion');
				$ver->gdver_fecha_version = Input::get('gdver_fecha_version');

				$file = Input::file('gdver_ruta_archivo');
				$file->move($subcategoria->gdsub_directorio, $doc->gddoc_identificacion.'.'.$file->getClientOriginalExtension());

				$file_preview = Input::file('gdver_ruta_preview');
				$file_preview->move($subcategoria->gdsub_directorio, $doc->gddoc_identificacion.'_preview.'.$file_preview->getClientOriginalExtension());

				$ver->gdver_ruta_archivo = $subcategoria->gdsub_directorio."/".$doc->gddoc_identificacion.'.'.$file->getClientOriginalExtension();
				$ver->gdver_ruta_preview = $subcategoria->gdsub_directorio."/".$doc->gddoc_identificacion.'_preview.'.$file_preview->getClientOriginalExtension();

				$ver->usu_id = Session::get('usu_id');

				if($ver->save()){
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Documento guardado con éxito!!');
				}else{
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el documento (E: version)!!');
				}
			
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el documento (E: info basica) !!');
			}
			
				
		}

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congddocumentos
	 *
	 * @return Response
	 */
	public function store(){
		//
	}


	// busca la informacion de un documento espesifico
	public function store_json(){
	$documentos = DB::table('gd_documentos')
   	->join('gd_versiones', 'gd_versiones.gddoc_id', '=', 'gd_documentos.gddoc_id')
    		->where('gd_versiones.gdver_estado', '=', 'activo')
    		->where('gd_documentos.gddoc_id', '=', Input::get('iddoc'))
    		->where('gd_documentos.gddoc_estado', '=', 'activo')->first(); 
    	
    	$hv = Modgdhvdocumentos::where('gddoc_id', '=', Input::get('iddoc'))->first();

    	$consecutivo = Modgdconsecutivos::whereRaw('gddoc_id = ? and gdcon_creacion = (select max(gdcon_creacion) from gd_consecutivos where gddoc_id = ?)', array(Input::get('iddoc'),Input::get('iddoc')))->first();


		return Response::json(array('documentos' => $documentos, 'hv' => $hv, 'consecutivo' => $consecutivo));
	}

	/**
	 * Display the specified resource.
	 * GET /congddocumentos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function download_json(){
	
		$documento = Modgddocumentos::find(Input::get('id_doc'));
		$version = $documento->versiones()->where('gdver_estado', 'activo')->get();

		$info = pathinfo($version[0]->gdver_ruta_archivo);
		$ext = $info['extension'];

		$nombre = $documento->gddoc_identificacion."_".Input::get('consecutivogenerado').".".$ext;

		Metodos::registrar_descarga(Session::get('usu_id'),Input::get('id_doc'));

		return Response::download($version[0]->gdver_ruta_archivo, $nombre);
	}

	public function download_sin_conse_json(){
		Metodos::registrar_descarga(Session::get('usu_id'),Input::get('iddoc_hidden'));
		return Response::download(Input::get('download'));
	}


	

	/**
	 * Show the form for editing the specified resource.
	 * GET /congddocumentos/{id}/edit
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
	 * PUT /congddocumentos/{id}
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
	 * DELETE /congddocumentos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function disable_doc(){

		// obtengo el documento y la version actual del documento
		$documento = Modgddocumentos::find(Input::get('geddoc_id'));
		$version_act = $documento->versiones()->where('gdver_estado', 'activo')->first();

		// obtengo la subcategoria para sacar la tura general
		$subcategoria = $documento->subcategorias;

		$ruta_final = str_replace("activos", "obsoletos", $subcategoria->gdsub_directorio);
		
		// antes de mover los archivos verifico si la ruta existe, si no existe se crea
		if(file_exists($ruta_final)==false){ File::makeDirectory($ruta_final, 0755, true, true); }

		if (File::exists($version_act->gdver_ruta_archivo)){
			$archivo_final = str_replace("activos", "obsoletos", $version_act->gdver_ruta_archivo);
			$archivo_final = str_replace(".", "_v".$version_act->gdver_version.".", $archivo_final);
			if(File::move($version_act->gdver_ruta_archivo, $archivo_final)){File::delete($version_act->gdver_ruta_archivo);}
		}	

		if (File::exists($version_act->gdver_ruta_preview)){
			$preview_final = str_replace("activos", "obsoletos", $version_act->gdver_ruta_preview);
			$preview_final = str_replace(".", "_v".$version_act->gdver_version.".", $preview_final);
			if(File::move($version_act->gdver_ruta_preview, $preview_final)){File::delete($version_act->gdver_ruta_preview);}
		}

		$version_act->gdver_estado = 'inactivo';
		$documento->gddoc_estado = 'inactivo';

		if($version_act->save() && $documento->save()){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Documento Inabilitado con éxito!!');
		}else{
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error Inabilitado el documento!!');
		}

	}


	

}