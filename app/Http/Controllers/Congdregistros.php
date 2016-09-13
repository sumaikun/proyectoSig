<?php
namespace psig\Http\Controllers;

use psig\models\Modgdregistros;
use psig\models\Modgdconsecutivos;
use psig\models\Modgdpermisosregistros;
use psig\Helpers\Metodos;
use Input;
use View;
use Session;
use File;

class Congdregistros extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /congdregistros
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congdregistros/create
	 *
	 * @return Response
	 */
	public function create(){

		if(Input::has('gdcon_id'))$id = Input::get('gdcon_id');
		if(Input::has('gdcon_id_nulo'))$id = Input::get('gdcon_id_nulo');

		$existe = Modgdregistros::where('gdcon_id', '=', $id )->first();
		if(!empty($existe)){
			return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error registro ya guardado!!');
		}else{

			

		$idconse =''; //
		if(Input::has('gdreg_estado')){

			$registro = new Modgdregistros;
			$registro->gdcon_id = Input::get('gdcon_id');
			$registro->usu_id = Session::get('usu_id');

			$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id'));
			$documento = $consecutivo->documentos;
			$subategoria = $documento->subcategorias;
			$version = $documento->versiones()->where('gdver_estado', 'activo')->first();

			if (Input::hasFile('archivo')){
 
				$ruta = str_replace("activos", "registros", $subategoria->gdsub_directorio);

				if(file_exists($ruta)==false){
					$ruta = Metodos::quitar_tildes($ruta);
					File::makeDirectory($ruta, 0777, true, true);
				}

				$file = Input::file('archivo');
				$destinationPath = $ruta;
				$extension = $file->getClientOriginalExtension();
				$filename = $consecutivo->documentos->gddoc_identificacion.'_'.$consecutivo->gdcon_consecutivo."_registro.{$extension}";
				$upload_success = $file->move($destinationPath, $filename);
			}

			$registro->gdver_id = $version->gdver_id;
			$registro->gddoc_id = $documento->gddoc_id;
			$registro->gdreg_ruta_archivo = $destinationPath."/".$filename;

			$registro->gdreg_descripcion = Input::get('gdreg_descripcion');

			if(Input::get('gdreg_detalles')!='')
			$registro->gdreg_detalles = Input::get('gdreg_detalles');

			// $idconse = Input::get('gdcon_id');

			// si el registro se guarda con éxito se busca el consecutivo y se actualiza el campo esta a cerrado
			if($registro->save()){
				$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id'));
				$consecutivo->gdcon_estado = 'cerrado';

				// asignando permiso a quien esta generando el registro
				$permiso = new Modgdpermisosregistros();
				$permiso->usu_id = Session::get('usu_id');
				$permiso->gdreg_id = $registro->gdreg_id;
				$permiso->gdperreg_permiso = true;

				if($consecutivo->save() && $permiso->save()){
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Registro guardado con éxito!!');
				}else{
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el registro!!');
				}
			}

		}else{

			$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id_nulo'));
			$documento = $consecutivo->documentos;
			$version = $documento->versiones()->where('gdver_estado', 'activo')->first();

			$registro = new Modgdregistros;
			$registro->gdcon_id = Input::get('gdcon_id_nulo');
			$registro->usu_id = Session::get('usu_id');
			$registro->gdreg_descripcion = Input::get('gdreg_descripcion_nulo');
			$registro->gdreg_estado = 'anulado';
			$registro->gdver_id = $version->gdver_id;
			$registro->gddoc_id = $documento->gddoc_id;

			// $idconse = Input::get('gdcon_id_nulo');

			// si el registro se guarda con éxito se busca el consecutivo y se actualiza el campo esta a cerrado
			if($registro->save()){
				$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id_nulo'));
				$consecutivo->gdcon_estado = 'cerrado';

				// asignando permiso a quien esta generando el registro
				$permiso = new Modgdpermisosregistros();
				$permiso->usu_id = Session::get('usu_id');
				$permiso->gdreg_id = $registro->gdreg_id;
				$permiso->gdperreg_permiso = true;

				if($consecutivo->save() && $permiso->save()){
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Registro guardado con éxito!!');
				}else{
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el registro!!');
				}
			}
		}


	}
	
	}



	// esta funcion es para crear el registro pero por parte del usuario general
	public function create_pusuario(){

		if(Input::has('gdcon_id'))$id = Input::get('gdcon_id');
		if(Input::has('gdcon_id_nulo'))$id = Input::get('gdcon_id_nulo');

		$existe = Modgdregistros::where('gdcon_id', '=', $id )->first();
		if(!empty($existe)){
			return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error registro ya guardado!!');
		}else{



		$idconse =''; //
		if(Input::has('gdreg_estado')){

			$registro = new Modgdregistros;
			$registro->gdcon_id = Input::get('gdcon_id');
			$registro->usu_id = Session::get('usu_id');

			$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id'));
			$documento = $consecutivo->documentos;
			$subategoria = $documento->subcategorias;
			$version = $documento->versiones()->where('gdver_estado', 'activo')->first();

			if (Input::hasFile('archivo')){
 
				$ruta = str_replace("activos", "registros", $subategoria->gdsub_directorio);

				if(file_exists($ruta)==false){
					$ruta = Metodos::quitar_tildes($ruta);
					File::makeDirectory($ruta, 0777, true, true);
				}

				$file = Input::file('archivo');
				$destinationPath = $ruta;
				$extension = $file->getClientOriginalExtension();
				$filename = $consecutivo->documentos->gddoc_identificacion.'_'.$consecutivo->gdcon_consecutivo."_registro.{$extension}";
				$upload_success = $file->move($destinationPath, $filename);
			}

			$registro->gdver_id = $version->gdver_id;
			$registro->gdreg_ruta_archivo = $destinationPath."/".$filename;
			$registro->gddoc_id = $documento->gddoc_id;

			$registro->gdreg_descripcion = Input::get('gdreg_descripcion');

			if(Input::get('gdreg_detalles')!='')
			$registro->gdreg_detalles = Input::get('gdreg_detalles');

			// $idconse = Input::get('gdcon_id');

			// si el registro se guarda con éxito se busca el consecutivo y se actualiza el campo esta a cerrado
			if($registro->save()){
				$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id'));
				$consecutivo->gdcon_estado = 'cerrado';

				// asignando permiso a quien esta generando el registro
				$permiso = new Modgdpermisosregistros();
				$permiso->usu_id = Session::get('usu_id');
				$permiso->gdreg_id = $registro->gdreg_id;
				$permiso->gdperreg_permiso = true;

				if($consecutivo->save() && $permiso->save()){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Registro guardado con éxito!!');
				}else{
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el registro!!');
				}
			}

		}else{

			$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id_nulo'));
			$documento = $consecutivo->documentos;
			$version = $documento->versiones()->where('gdver_estado', 'activo')->first();

			$registro = new Modgdregistros;
			$registro->gdcon_id = Input::get('gdcon_id_nulo');
			$registro->usu_id = Session::get('usu_id');
			$registro->gdreg_descripcion = Input::get('gdreg_descripcion_nulo');
			$registro->gdreg_estado = 'anulado';
			$registro->gdver_id = $version->gdver_id;
			$registro->gddoc_id = $documento->gddoc_id;

			// $idconse = Input::get('gdcon_id_nulo');

			// si el registro se guarda con éxito se busca el consecutivo y se actualiza el campo esta a cerrado
			if($registro->save()){
				$consecutivo = Modgdconsecutivos::find(Input::get('gdcon_id_nulo'));
				$consecutivo->gdcon_estado = 'cerrado';

				$permiso = new Modgdpermisosregistros();
				$permiso->usu_id = Session::get('usu_id');
				$permiso->gdreg_id = $registro->gdreg_id;
				$permiso->gdperreg_permiso = true;

				if($consecutivo->save() && $permiso->save()){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Registro guardado con éxito!!');
					
				}else{
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el registro!!');
				}
			}
		}


		}

	
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /congdregistros
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /congdregistros/{id}
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
	 * GET /congdregistros/{id}/edit
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
	 * PUT /congdregistros/{id}
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
	 * DELETE /congdregistros/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}