<?php
namespace psig\Http\Controllers;

use psig\Helpers\Metodos;
use psig\models\Modgddocumentos;
use psig\models\Modgdversiones;
use psig\models\ListEnterprises;
use Input;
use View;
use Session;
use File;

class Congdversiones extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdversiones
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congdversiones/create
	 *
	 * @return Response
	 */
	public function create(){

		

		$version_act = Modgdversiones::find(Input::get('gddoc_id'));
		$documento = Modgddocumentos::find($version_act->gddoc_id);
		//$version_act = $documento->versiones()->where('gdver_estado', 'activo')->first();

		

		$subcategoria = $documento->subcategorias;

		$ruta_final = str_replace("activos", "obsoletos", $subcategoria->gdsub_directorio);
		
		if($version_act->empresa!= null)
		{
			$ruta_final = Metodos::quitar_tildes($ruta_final.'/'.preg_replace('/\s+/','',$version_act->empresas->nombre));
		}
		else{
			$ruta_final = Metodos::quitar_tildes($ruta_final);	
		}
		

		//return $ruta_final;
		// antes de mover los archivos verifico si la ruta existe, si no existe se crea
		if(file_exists($ruta_final)==false){ File::makeDirectory($ruta_final, 0777, true, true); }

		if($version_act->empresa!= null)
		{
			if($documento->gddoc_is_multcons == 1 and $documento->gddoc_is_multarch ==1)
			{
				if(File::exists($version_act->gdver_ruta_archivo)){
				$archivo_final = str_replace("activos", "obsoletos", $version_act->gdver_ruta_archivo);			
					if(File::move($version_act->gdver_ruta_archivo, $archivo_final)){File::delete($version_act->gdver_ruta_archivo);}
				}	

				if(File::exists($version_act->gdver_ruta_preview)){
					$preview_final = str_replace("activos", "obsoletos", $version_act->gdver_ruta_preview);		
					if(File::move($version_act->gdver_ruta_preview, $preview_final)){File::delete($version_act->gdver_ruta_preview);}
				}
			}
			$nempresa = $version_act->empresa; 
		}
		else{

			if(File::exists($version_act->gdver_ruta_archivo)){
			$archivo_final = str_replace("activos", "obsoletos", $version_act->gdver_ruta_archivo);			
			$archivo_final = str_replace(".", "_v".$version_act->gdver_version.".", $archivo_final);
			if(File::move($version_act->gdver_ruta_archivo, $archivo_final)){File::delete($version_act->gdver_ruta_archivo);}
			}	

			if(File::exists($version_act->gdver_ruta_preview)){
				$preview_final = str_replace("activos", "obsoletos", $version_act->gdver_ruta_preview);
				$preview_final = str_replace(".", "_v".$version_act->gdver_version.".", $preview_final);
				if(File::move($version_act->gdver_ruta_preview, $preview_final)){File::delete($version_act->gdver_ruta_preview);}
			}
			$nempresa = null;	
		}
		
		$version_act->gdver_estado = 'inactivo';
		

		if($version_act->save()){
			$ver = new Modgdversiones;
				$ver->gddoc_id = $documento->gddoc_id;
				if(Input::get('reebot')==1)
				{
					$ver->gdver_version = 0;
				}
				else{
					$ver->gdver_version = $version_act->gdver_version + 1;	
				}				
				
				$ver->gdver_descripcion = Input::get('gddoc_descripcion');
				$ver->gdver_fecha_version = Input::get('gdver_fecha_version');

				if($version_act->empresa != null)
				{
					$empresa = ListEnterprises::find($version_act->empresa);
					$empresa->nombre = preg_replace('/\s+/','',$empresa->nombre);

					$file = Input::file('gdver_ruta_archivo');
					$file->move($subcategoria->gdsub_directorio."/".$empresa->nombre, $documento->gddoc_identificacion.'-'.$empresa->abbr.'.'.$file->getClientOriginalExtension());

					$ver->gdver_ruta_archivo = $subcategoria->gdsub_directorio."/".$empresa->nombre."/".$documento->gddoc_identificacion.'-'.$empresa->abbr.'.'.$file->getClientOriginalExtension();
		
	
					$file = Input::file('gdver_ruta_preview');
					$file->move($subcategoria->gdsub_directorio."/".$empresa->nombre, $documento->gddoc_identificacion.'-'.$empresa->abbr.'_preview.'.$file->getClientOriginalExtension());

					$ver->gdver_ruta_preview = $subcategoria->gdsub_directorio."/".$empresa->nombre."/".$documento->gddoc_identificacion.'-'.$empresa->abbr.'_preview.'.$file->getClientOriginalExtension();						
				}
				else{
					$file = Input::file('gdver_ruta_archivo');
					$file->move($subcategoria->gdsub_directorio, $documento->gddoc_identificacion.'.'.$file->getClientOriginalExtension());

					$file_preview = Input::file('gdver_ruta_preview');
					$file_preview->move($subcategoria->gdsub_directorio, $documento->gddoc_identificacion.'_preview.'.$file_preview->getClientOriginalExtension());

					$ver->gdver_ruta_archivo = $subcategoria->gdsub_directorio."/".$documento->gddoc_identificacion.'.'.$file->getClientOriginalExtension();
					$ver->gdver_ruta_preview = $subcategoria->gdsub_directorio."/".$documento->gddoc_identificacion.'_preview.'.$file_preview->getClientOriginalExtension();	
				}

				
				$ver->usu_id = Session::get('usu_id');
				$ver->empresa = $nempresa;

				if($ver->save()){
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Version actualizada con éxito!!');
				}else{
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando el documento!!');
				}

		}else{
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando el documento (E: version)!!');
		}

		
		
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congdversiones
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /congdversiones/{id}
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
	 * GET /congdversiones/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(){

		$version = Modgdversiones::find(Input::get('gdver_id')); 
		$documento = $version->documento;
		$subcategoria = $documento->subcategorias;

		if($version->empresa == null)
		{
			if(Input::hasFile('gdver_ruta_archivo')){
				if (File::exists($version->gdver_ruta_archivo)){
					if(File::delete($version->gdver_ruta_archivo)){
						$file = Input::file('gdver_ruta_archivo');
						$file->move($subcategoria->gdsub_directorio, $documento->gddoc_identificacion.'.'.$file->getClientOriginalExtension());				
						$version->gdver_ruta_archivo = $subcategoria->gdsub_directorio."/".$documento->gddoc_identificacion.'.'.$file->getClientOriginalExtension();
					}
				}	
			}

			if(Input::hasFile('gdver_ruta_preview')){
				if (File::exists($version->gdver_ruta_preview)){
					if(File::delete($version->gdver_ruta_preview)){
						$file = Input::file('gdver_ruta_preview');
						$file->move($subcategoria->gdsub_directorio, $documento->gddoc_identificacion.'_preview.'.$file->getClientOriginalExtension());				
						$version->gdver_ruta_preview = $subcategoria->gdsub_directorio."/".$documento->gddoc_identificacion.'_preview.'.$file->getClientOriginalExtension();
					}
				}	
			}
		}
		
		else{

			$empresa = ListEnterprises::find($version->empresa);
			$empresa->nombre = preg_replace('/\s+/','',$empresa->nombre);

			if(Input::hasFile('gdver_ruta_archivo')){
				if(File::exists($version->gdver_ruta_archivo)){
					if($documento->gddoc_is_multcons == 1 and $documento->gddoc_is_multarch ==1)
					{File::delete($version->gdver_ruta_archivo);}				
					$file = Input::file('gdver_ruta_archivo');
					$file->move($subcategoria->gdsub_directorio."/".$empresa->nombre, $documento->gddoc_identificacion.'-'.$empresa->abbr.'.'.$file->getClientOriginalExtension());

					$version->gdver_ruta_archivo = $subcategoria->gdsub_directorio."/".$empresa->nombre."/".$documento->gddoc_identificacion.'-'.$empresa->abbr.'.'.$file->getClientOriginalExtension();
					
				}	
			}

			if(Input::hasFile('gdver_ruta_preview')){
				if (File::exists($version->gdver_ruta_preview)){
					if($documento->gddoc_is_multcons == 1 and $documento->gddoc_is_multarch ==1)
					{File::delete($version->gdver_ruta_preview);}
					$file = Input::file('gdver_ruta_preview');
					$file->move($subcategoria->gdsub_directorio."/".$empresa->nombre, $documento->gddoc_identificacion.'-'.$empresa->abbr.'_preview.'.$file->getClientOriginalExtension());
					$version->gdver_ruta_preview = $subcategoria->gdsub_directorio."/".$empresa->nombre."/".$documento->gddoc_identificacion.'-'.$empresa->abbr.'_preview.'.$file->getClientOriginalExtension();						
					
				}	
			}

		}

	
		if(Input::has('gdver_descripcion')){
			$version->gdver_descripcion = Input::get('gdver_descripcion');
		}

		$version->gdver_fecha_version = Input::get('gdver_fecha_version');

		$version->documento->gddoc_req_registro = Input::has('gddoc_req_registro');
		

		if(Input::has('gddoc_req_consecutivo')){
			$version->documento->gddoc_req_consecutivo = Input::has('gddoc_req_consecutivo');
			$version->documento->gddoc_consecutivo_ini = Input::get('gddoc_consecutivo_ini');
			$version->documento->gddoc_anio = date('y');
		}else{
			$version->documento->gddoc_req_consecutivo = Input::has('gddoc_req_consecutivo');
		}

		if($version->push() && $version->save()){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Documento actualizado con éxito!!');
		}else{
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando el documento!!');
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /congdversiones/{id}
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
	 * DELETE /congdversiones/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}