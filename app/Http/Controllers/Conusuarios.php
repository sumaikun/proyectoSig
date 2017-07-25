<?php

namespace psig\Http\Controllers;
use psig\Helpers\Metodos;
use psig\models\Modusuarios;
use psig\models\Modgdpermisoscargos;
use psig\models\Modroles;
use psig\models\Moddependencias;
use psig\models\Modcargos;
use Input;
use Auth;
use Session;
use Redirect;
use View;
use Hash;
use File;
use Image;

class Conusuarios extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(){
		$this->middleware('admin', ['except' => ['login','logout']]);
	}


	public function login()	{

		$userdata = array(
			'usu_email' => Input::get('usu_usuario')."@grupo-sig.com",
			'password' => Input::get('usu_password'),
			'usu_estado' => 'activo'
		);

		if(Input::has('remember_me')){
			if (Auth::attempt($userdata, true)){

				$usuario = Modusuarios::where('usu_email', '=', Input::get('usu_usuario')."@grupo-sig.com")->get();

					Session::put('usu_nombres', $usuario[0]->usu_nombres);
					Session::put('usu_apellido1', $usuario[0]->usu_apellido1);
					Session::put('usu_id', $usuario[0]->usu_id);
					Session::put('usu_email', $usuario[0]->usu_email);
					Session::put('usu_foto', $usuario[0]->usu_foto);
					Session::put('rol_nombre', $usuario[0]->roles->rol_nombre);
					Session::put('carg_nombre', $usuario[0]->cargos->carg_nombre);
					Session::put('usu_firma', $usuario[0]->usu_firma);

					// si la persona es un usuario general se registran los permisos 
					if($usuario[0]->roles->rol_nombre=='usuario'){
						Metodos::registrar_permisos($usuario[0]->usu_id);
					}

            	return Redirect::to('/');
        	}else{

        		return View::make('cosas_generales.login')->with('error', 'Usuario y contraseña inválidos.');
        	}
		}else{
			if (Auth::attempt($userdata)){
				
				$usuario = Modusuarios::where('usu_email', '=', Input::get('usu_usuario')."@grupo-sig.com")->get();

					Session::put('usu_nombres', $usuario[0]->usu_nombres);
					Session::put('usu_apellido1', $usuario[0]->usu_apellido1);
					Session::put('usu_id', $usuario[0]->usu_id);
					Session::put('usu_email', $usuario[0]->usu_email);
					Session::put('usu_foto', $usuario[0]->usu_foto);
					Session::put('rol_nombre', $usuario[0]->roles->rol_nombre);
					Session::put('carg_nombre', $usuario[0]->cargos->carg_nombre);
					Session::put('usu_firma', $usuario[0]->usu_firma);

					// si la persona es un usuario general se registran los permisos 
					if($usuario[0]->roles->rol_nombre=='usuario'){
						Metodos::registrar_permisos($usuario[0]->usu_id);
					}

            	return Redirect::to('/');
        	}else{
        		return View::make('cosas_generales.login')->with('error', 'Usuario y contraseña inválidos.');
        	}
		}


	}

	public function logout(){
      Auth::logout();
      Session::flush();
      return View::make('cosas_generales.login');
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){

		$existe = Modusuarios::where('usu_email', '=', Input::get('usu_email'))
									->orWhere('usu_usuario', '=', Input::get('usu_usuario'))->exists();
		if($existe){
			return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'El Usuario ya se encuntra registrado!!');
		}else{

		$usuario = new Modusuarios;
			$usuario->usu_nombres = Input::get('usu_nombres');
			$usuario->usu_apellido1 = Input::get('usu_apellido1');
			$usuario->usu_apellido2 = Input::get('usu_apellido2');
			$usuario->usu_email = Input::get('usu_email');
			$usuario->usu_usuario = trim(Input::get('usu_usuario'));
			$usuario->password = Hash::make(Input::get('password'));

			$usuario->rol_id = Input::get('rol_id');
			$usuario->carg_id = Input::get('carg_id');
			$usuario->depe_id = Input::get('depe_id');
			$destinationPath ='fotos';

			if (Input::hasFile('usu_foto')){
	
				$foto = Input::file('usu_foto');
				$foto->move('fotos', $usuario->usu_usuario.'.'.$foto->getClientOriginalExtension());

				$image = Image::make(sprintf('fotos/%s', $usuario->usu_usuario.'.'.$foto->getClientOriginalExtension()))->resize(95, 120)->save();

				$usuario->usu_foto = $destinationPath."/".$usuario->usu_usuario.'.'.$foto->getClientOriginalExtension();
			}
			

			// esto es para enviar notificacion al usuario cuando se crea
			// if (Input::has('notificacion')){

			// 		$data = array(
			// 			'nombre'	  =>	Input::get('usu_nombres')." ".Input::get('usu_apellido1'),
			// 			'email'	  =>	Input::get('usu_email'),
			// 			'usuario'  =>	Input::get('usu_usuario'),
			// 			'password' =>	Input::get('password')
			// 		);
				
			// 		$fromEmail	=	'storres@grupo-sig.com';
			// 		$fromName	=	'Soporte IT';
				
			// 		Mail::send('emails.nuevo_usuario', $data, function($message) use ($fromName, $fromEmail){
			// 			// $message->bcc('dipalvel@gmail.com', 'Contáctanos Meteoagro.co');
			// 			$message->to($fromEmail, $fromName);
			// 			$message->from($fromEmail, $fromName);
			// 			$message->subject('Notificación de usuario');
			// 		});

			// }

			if($usuario->save()){

			
				if (Input::has('documentos')){
					$permisos = Modgdpermisoscargos::where('carg_id','=',Input::get('carg_id'))->get();

					if($permisos->isEmpty()){
						return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'El usuario se creo con exito pero no se asignaron permisos a los documentos por que el cargo no tiene documentos asignados!!');
					}else{

						foreach ($permisos as $key => $value) {

								$permisonew = new Modgdpermisosdocumentos;
									$permisonew->usu_id = $usuario->usu_id;
									$permisonew->gddoc_id = $value->gddoc_id;
									$permisonew->gdperdoc_permiso = $value->gdpercarg_permiso;
								$permisonew->save();

						}
					}
				}

				
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Usuario registrado con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error registrando el usuario verifique la información!!');
			}
		}

	}



	public function store(){
		$usuario =Modusuarios::where('usu_email', '=', Input::get('email').'@grupo-sig.com')->first();
		return $usuario;
	}



	public function show($id){
		$roles = Modroles::orderBy('rol_nombre')->get();
    	$dependencias = Moddependencias::orderBy('depe_nombre')->get();
    	$cargos = Modcargos::orderBy('carg_nombre')->get();
		$usuario = Modusuarios::find($id);
      return View::make('administrador.usuarios.showusuario', array('usuario' => $usuario, 'roles' => $roles, 'dependencias' => $dependencias, 'cargos' => $cargos));
	}



	public function listado_json()
	{
		$usuarios = Modusuarios::all();
		return Response::json($usuarios);
	}

	public function usuarios_no_admin_json(){
		
		$usuarios = DB::table('usuarios')
    	->join('roles', 'roles.rol_id', '=', 'usuarios.rol_id')
    	->where('roles.rol_nombre', '=', 'usuario')->get();

		return Response::json($usuarios);
	}


	

	public function update(){
		$usuario = Modusuarios::find(Input::get('usu_id'));
			$usuario->usu_nombres = Input::get('usu_nombres');
			$usuario->usu_apellido1 = Input::get('usu_apellido1');
			$usuario->usu_apellido2 = Input::get('usu_apellido2');

			$usuario->usu_email = Input::get('usu_email');
			$usuario->usu_usuario = Input::get('usu_usuario');
			$usuario->usu_estado = Input::get('usu_estado');

			if(Input::has('password')){
				$usuario->password = Hash::make(Input::get('password'));
			}

			if (Input::hasFile('usu_foto')){

				if (File::exists($usuario->usu_foto)){
					File::delete($usuario->usu_foto);
				}

				$destinationPath ='fotos';
				$foto = Input::file('usu_foto');
				$foto->move($destinationPath, $usuario->usu_usuario.'.'.$foto->getClientOriginalExtension());

				$image = Image::make(sprintf('fotos/%s', $usuario->usu_usuario.'.'.$foto->getClientOriginalExtension()))->resize(95, 120)->save();

				$usuario->usu_foto = $destinationPath."/".$usuario->usu_usuario.'.'.$foto->getClientOriginalExtension();
			}
			
			$usuario->rol_id = Input::get('rol_id');
			$usuario->carg_id = Input::get('carg_id');
			$usuario->depe_id = Input::get('depe_id');

			if($usuario->save()){
				return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Usuario actualizado con éxito!!');
			}else{
				return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizado el usuario verifique la información!!');
			}
	}


	// this function
	public function destroy($id)
	{
		//
	}


	public function updatepassusu()
	{
		$usuario =Modusuarios::find(Session::get('usu_id')); 
		$usuario->password = Hash::make(Input::get('password'));
		if($usuario->save()){
			return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Contraseña actualizada con éxito!!');
		}else{
			return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error actualizando Contraseña!!');
		}
	}


	


}
