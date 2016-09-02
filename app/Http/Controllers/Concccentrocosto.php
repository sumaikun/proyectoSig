<?php
namespace psig\Http\Controllers;

use psig\models\Modcccentrocosto;
use Input;
use Session;
use View;
class Concccentrocosto extends Controller {

	public function cc_gest_centro_costo()
	{
		
		if(Input::get('centro_costo')=='nuevo'){

			$centroc = new Modcccentrocosto();
				$centroc->cccc_nombre = Input::get('centro_de_costo');


			if($centroc->save()){

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Centro de costo guardado con Éxito');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Centro de costo guardado con Éxito');
				}
					
			}else{

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el Centro de costo!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el Centro de costo!!');
				}

			}

			
		}else{

			$centroc = Modcccentrocosto::find(Input::get('centro_costo'));
				$centroc->cccc_nombre = Input::get('centro_de_costo');

			if($centroc->save()){

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Centro de costo guardado con Éxito');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Centro de costo guardado con Éxito');
				}
					
			}else{

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el Centro de costo!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el Centro de costo!!');
				}

			}


		}

	}
	
	

}