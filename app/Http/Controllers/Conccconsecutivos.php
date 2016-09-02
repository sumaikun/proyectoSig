<?php
namespace psig\Http\Controllers;

use psig\Helpers\Metodos;
use psig\models\Modccconsecutivos;
use Input;
use Session;
use View;
use Excel;

class Conccconsecutivos extends Controller {

	public function guardar_consecutivo(){

		$ultimo_conse = Modccconsecutivos::whereRaw('ccco_anio=? and ccco_numero = (select max(ccco_numero) from cc_consecutivos where ccco_anio=?)', array(date('y'), date('y')))->first();
		
		if($ultimo_conse){

			// si el consecutivo es del año actual solo sumo 1
			if($ultimo_conse->ccco_anio == date('y')){
				$consecutivo = new Modccconsecutivos();
					$consecutivo->ccco_anio = date('y');
					$consecutivo->ccco_numero = $ultimo_conse->ccco_numero + 1;
					$consecutivo->ccco_consecutivo = Metodos::cc_armar_consecutivo('PRE',$ultimo_conse->ccco_numero);
					$consecutivo->cccc_id = Input::get('cccc_id');
					$consecutivo->ccco_servicio_prestado = Input::get('ccco_servicio_prestado');
					$consecutivo->ccco_asunto = Input::get('ccco_asunto');
					$consecutivo->cccnt_id = Input::get('cccnt_id');
					$consecutivo->created_at = Input::get('created_at');

					if(Session::get('rol_nombre')=='usuario'){
						$consecutivo->usu_id = Session::get('usu_id');
					}elseif (Session::get('rol_nombre')=='administrador') {
						$consecutivo->usu_id = Input::get('usu_id');
					}


				if($consecutivo->save()){

					if(Session::get('rol_nombre')=='usuario'){
						return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Comunicación guardada con exito: Consecutivo '.$consecutivo->ccco_consecutivo);
					}elseif (Session::get('rol_nombre')=='administrador') {
						return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Comunicación guardada con exito: Consecutivo '.$consecutivo->ccco_consecutivo);
					}
					
				}else{

					if(Session::get('rol_nombre')=='usuario'){
						return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la comunicación!!');
					}elseif (Session::get('rol_nombre')=='administrador') {
						return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la comunicación!!');
					}

				}


			}

		// si no encuentra consecutivo es por que el año cambio o simplemente la empresa no tiene consecutivos registrados
		}else{

			$consecutivo = new Modccconsecutivos();

				$consecutivo->ccco_anio = date('y');
				$consecutivo->ccco_numero = 1;
				$consecutivo->ccco_consecutivo = Metodos::cc_armar_consecutivo('PRE',0);
				$consecutivo->cccc_id = Input::get('cccc_id');
				$consecutivo->ccco_servicio_prestado = Input::get('ccco_servicio_prestado');
				$consecutivo->ccco_asunto = Input::get('ccco_asunto');
				$consecutivo->cccnt_id = Input::get('cccnt_id');
				$consecutivo->created_at = Input::get('created_at');

				if(Session::get('rol_nombre')=='usuario'){
					$consecutivo->usu_id = Session::get('usu_id');
				}elseif (Session::get('rol_nombre')=='administrador') {
					$consecutivo->usu_id = Input::get('usu_id');
				}
			
			if($consecutivo->save()){

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Comunicación guardada con exito: Consecutivo '.$consecutivo->ccco_consecutivo);
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Comunicación guardada con exito: Consecutivo '.$consecutivo->ccco_consecutivo);
				}
					
			}else{

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la comunicación!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la comunicación!!');
				}

			}

		}

	}









	// public function enviar_comunicacion(){

	// 	// obtiene el ultimo consecutio del año actual
	// 	$ultimo_conse = Modccconsecutivos::whereRaw('gncli_id=? and ccco_anio=? and ccco_numero = (select max(ccco_numero) from cc_consecutivos where gncli_id=? and ccco_anio=?)', array(Input::get('gncli_id'), date('y'), Input::get('gncli_id'), date('y')))->first();
		
	// 	if($ultimo_conse){

	// 		// si el consecutivo es del año actual solo sumo 1
	// 		if($ultimo_conse->ccco_anio == date('y')){
	// 			$consecutivo = new Modccconsecutivos();
	// 				$consecutivo->ccco_anio = date('y');
	// 				$consecutivo->ccco_numero = $ultimo_conse->ccco_numero + 1;
	// 				$consecutivo->ccco_consecutivo = Metodos::cc_armar_consecutivo($ultimo_conse->gncliente->gncli_prefijo,$ultimo_conse->ccco_numero);
	// 				$consecutivo->cccc_id = Input::get('cccc_id');
	// 				$consecutivo->ccco_servicio_prestado = Input::get('ccco_servicio_prestado');
	// 				$consecutivo->ccco_asunto = Input::get('ccco_asunto');
	// 				$consecutivo->usu_id = Session::get('usu_id');
	// 				$consecutivo->cccnt_id = Input::get('cccnt_id');
	// 				$consecutivo->gncli_id = Input::get('gncli_id');

	// 			if($consecutivo->save()){


			

	// 				$data = array(
	// 					'mensaje'  		=> Input::get('mensaje'),
	// 					'asunto'			=> Input::get('ccco_asunto'),
	// 				);
								
	// 				$fromEmail	=	Session::get('usu_email');
	// 				$fromName	=	Session::get('usu_nombres')." ".Session::get('usu_apellido');
								
	// 				Mail::send('emails.comunicaciones_cliente', $data, function($message) use ($fromName, $fromEmail){
						
	// 					if(Input::has('concopia')){
	// 						$array=[];
	// 						$array = explode(",", Input::get('concopia'));
	// 						foreach ($array as $key => $value) {
	// 							$message->cc(trim($value));
	// 						}
	// 					}

	// 					if(Input::has('concopiaoculta')){
	// 						$array=[];
	// 						$array = explode(",", Input::get('concopiaoculta'));
	// 						foreach ($array as $key => $value) {
	// 							$message->cc(trim($value));
	// 						}
	// 					}

	// 					if (Input::hasFile('adjuntos')){
	// 						$files = Input::file('adjuntos');
	// 						foreach($files as $file) {
	// 							$message->attach($file->getRealPath(), array(
	// 					        'as' => $file->getClientOriginalName().".".$file->getClientOriginalExtension(), 
	// 					        'mime' => $file->getMimeType())
	// 					    	);
	// 					   }
	// 					}
						

	// 					$message->to('shamirtv1@gmail.com'); //Input::get('email')
	// 					$message->from($fromEmail, $fromName);
	// 					$message->subject(Input::get('ccco_asunto'));
	// 				});


	// 				return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Comunicación guardada con exito: Consecutivo '.$consecutivo->ccco_consecutivo);
	// 			}else{
	// 				return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la comunicación!!');
	// 			}

	// 		}

	// 	// si no encuentra consecutivo es por que el año cambio o simplemente la empresa no tiene consecutivos registrados
	// 	}else{

	// 		$consecutivo = new Modccconsecutivos();

	// 			$cliente = Modgnclientes::where('gncli_id', '=', Input::get('gncli_id'))->first();

	// 			$consecutivo->ccco_anio = date('y');
	// 			$consecutivo->ccco_numero = 1;
	// 			$consecutivo->ccco_consecutivo = Metodos::cc_armar_consecutivo($cliente->gncli_prefijo,0);
	// 			$consecutivo->cccc_id = Input::get('cccc_id');
	// 			$consecutivo->ccco_servicio_prestado = Input::get('ccco_servicio_prestado');
	// 			$consecutivo->ccco_asunto = Input::get('ccco_asunto');
	// 			$consecutivo->usu_id = Session::get('usu_id');
	// 			$consecutivo->cccnt_id = Input::get('cccnt_id');
	// 			$consecutivo->gncli_id = Input::get('gncli_id');
			
	// 		if($consecutivo->save()){
	// 			return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Comunicación guardada con exito: Consecutivo '.$consecutivo->ccco_consecutivo);
	// 		}else{
	// 			return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la comunicación!!');
	// 		}

	// 	}

	// }





public function exportar_cc(){

	if(Session::has('anio_cc_consecutivo')){
		$anio = Session::get('anio_cc_consecutivo');
	}else{
		$anio = date("Y");
	}

	Excel::create('Consecutivos_'.$anio, function($excel) use($anio){
   	$excel->sheet($anio, function($sheet) use($anio){

   		$sheet->mergeCells('A1:G4');
        	$sheet->row(1, function ($row) {
            $row->setFontSize(15);
            $row->setBackground('#428bca');
			   $row->setFontColor('#FFFFFF');
			   $row->setAlignment('center');
			   $row->setValignment('center');
			   $row->setFontWeight('bold');
        	});

        	$sheet->row(1, array('CONSECUTIVOS COMUNICACIONES A PACIFIC RUBIALES ENERGY'));

        	$sheet->cells('A6:G6', function($cells)  {
     			$cells->setBackground('#c2c2c2');
     			$cells->setFontColor('#000000');
     			$cells->setAlignment('left');
     			$cells->setValignment('center');
     			$cells->setFontWeight('bold');
    		});
   
   		$data=[];
    		array_push($data, array('FECHA', 'CONSECUTIVOS', 'CC', 'SERVICIO PRESTADO', 'DIRIGIDO A', 'ASUNTO', 'UTILIZADO POR'));

    		$consecutivos = Modccconsecutivos::whereRaw ('YEAR( created_at ) = ?', array($anio))->get();
    		foreach ($consecutivos as $key => $value) {
    			array_push($data, array($value->created_at->format('Y-m-d') , $value->ccco_consecutivo, $value->centrocosto->cccc_nombre, $value->ccco_servicio_prestado, $value->cccontacto->cccnt_nombres." ".$value->cccontacto->cccnt_apellido1, $value->ccco_asunto, ucwords ($value->usuairo->usu_nombres)." ".ucwords ($value->usuairo->usu_apellido1)));
    		}
    		
    		$sheet->fromArray($data, null, 'A6', false, false);

   	});
  	})->download('xlsx');

	}

}