<?php
namespace psig\Http\Controllers;

use psig\models\Modcccontactos;
use Input;
use Session;
use View;

class Concccontactos extends Controller {

	
	// busca la informacion de un cliente espesifico
	public function cc_buscar_un_contacto(){
		$emails = Modcccontactos::where('cccnt_id', '=', Input::get('cccnt_id'))->first();
		return Response::json($emails);
	}


	public function cc_gest_contacto(){

		if(Input::get('contacto_per')=='nuevo'){

			$contacto = new Modcccontactos();
				$contacto->cccnt_nombres = Input::get('cccnt_nombres');
				$contacto->cccnt_apellido1 = Input::get('cccnt_apellido1');
				$contacto->cccnt_apellido2 = Input::get('cccnt_apellido2');
				$contacto->cccnt_email_trabajo = Input::get('cccnt_email_trabajo');
				$contacto->cccnt_email_personal = Input::get('cccnt_email_personal');
				$contacto->cccnt_celular_trabajo = Input::get('cccnt_celular_trabajo');
				$contacto->cccnt_celular_personal = Input::get('cccnt_celular_personal');
				$contacto->cccnt_tel_trabajo = Input::get('cccnt_tel_trabajo');
				$contacto->cccnt_tel_personal = Input::get('cccnt_tel_personal');
				$contacto->cccnt_notas = Input::get('cccnt_notas');

			if($contacto->save()){

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Contacto guardado con Éxito');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Contacto guardado con Éxito');
				}
					
			}else{

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el contacto!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el contacto!!');
				}

			}

			
		}else{

			$contacto = Modcccontactos::find(Input::get('contacto_per'));
				$contacto->cccnt_nombres = Input::get('cccnt_nombres');
				$contacto->cccnt_apellido1 = Input::get('cccnt_apellido1');
				$contacto->cccnt_apellido2 = Input::get('cccnt_apellido2');
				$contacto->cccnt_email_trabajo = Input::get('cccnt_email_trabajo');
				$contacto->cccnt_email_personal = Input::get('cccnt_email_personal');
				$contacto->cccnt_celular_trabajo = Input::get('cccnt_celular_trabajo');
				$contacto->cccnt_celular_personal = Input::get('cccnt_celular_personal');
				$contacto->cccnt_tel_trabajo = Input::get('cccnt_tel_trabajo');
				$contacto->cccnt_tel_personal = Input::get('cccnt_tel_personal');
				$contacto->cccnt_notas = Input::get('cccnt_notas');

			if($contacto->save()){

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Contacto guardado con Éxito');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Contacto guardado con Éxito');
				}
					
			}else{

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el contacto!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando el contacto!!');
				}

			}


		}
	}
	
	

}