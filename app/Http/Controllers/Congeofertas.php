<?php
namespace psig\Http\Controllers;

use psig\models\Modgeofertas;

use psig\Helpers\Metodos;
use Input;
use View;
use Session;
use Excel;

class Congeofertas extends Controller {

	/** 
	 * Display a listing of the resource.
	 * GET /congeofertas
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /congeofertas/create
	 *
	 * @return Response
	 */
	public function create(){
		
		$ultimo_oferta = Modgeofertas::whereRaw('geofer_anio=? and geofer_numero = (select max(geofer_numero) from ge_ofertas where geofer_anio=?)', array(date('y'), date('y')))->first();
		
		if($ultimo_oferta){

			// si el consecutivo es del año actual solo sumo 1
			if($ultimo_oferta->geofer_anio == date('y')){
				$oferta = new Modgeofertas();
				$oferta->geofer_anio = date('y');
				$oferta->geofer_numero = $ultimo_oferta->geofer_numero + 1;
				$oferta->geofer_consecutivo = Metodos::cc_armar_consecutivo('SIG',$ultimo_oferta->geofer_numero);
				
				$oferta->geofer_cliente = Input::get('geofer_cliente');
				$oferta->geofer_concepto = Input::get('geofer_concepto');
				$oferta->geofer_reemplazo = Input::get('geofer_reemplazo');
				$oferta->geofer_valor_inicial = Input::get('geofer_valor_inicial');
				$oferta->geofer_moneda = Input::get('geofer_moneda');

				$oferta->geofer_ult_valor_cot = Input::get('geofer_ult_valor_cot');
				$oferta->geofer_resultado = Input::get('geofer_resultado');

				$oferta->geofer_fact_sig = Input::get('geofer_fact_sig');
				$oferta->geofer_val_factura = Input::get('geofer_val_factura');

				$oferta->created_at = Input::get('created_at');


				if(Session::get('rol_nombre')=='usuario'){
					$oferta->usu_id = Session::get('usu_id');
				}elseif (Session::get('rol_nombre')=='administrador') {
					$oferta->usu_id = Input::get('usu_id');
				}
				

				if($oferta->save()){

					if(Session::get('rol_nombre')=='usuario'){
						return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Oferta guardada con exito: Consecutivo '.$oferta->geofer_consecutivo);
					}elseif (Session::get('rol_nombre')=='administrador') {
						return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Oferta guardada con exito: Consecutivo '.$oferta->geofer_consecutivo);
					}
					
				}else{

					if(Session::get('rol_nombre')=='usuario'){
						return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la Oferta!!');
					}elseif (Session::get('rol_nombre')=='administrador') {
						return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la Oferta!!');
					}

				}
			}

			// si no encuentra consecutivo es por que el año cambio o simplemente la empresa no tiene consecutivos registrados
			}else{

				$oferta = new Modgeofertas();
					$oferta->geofer_anio = date('y');
					$oferta->geofer_numero = 1;
					$oferta->geofer_consecutivo = Metodos::cc_armar_consecutivo('SIG',0);
					
					$oferta->geofer_cliente = Input::get('geofer_cliente');
					$oferta->geofer_concepto = Input::get('geofer_concepto');
					$oferta->geofer_reemplazo = Input::get('geofer_reemplazo');
					$oferta->geofer_valor_inicial = Input::get('geofer_valor_inicial');
					$oferta->geofer_moneda = Input::get('geofer_moneda');

					$oferta->geofer_ult_valor_cot = Input::get('geofer_ult_valor_cot');

					$oferta->geofer_resultado = Input::get('geofer_resultado');

					$oferta->geofer_fact_sig = Input::get('geofer_fact_sig');

					$oferta->geofer_val_factura = Input::get('geofer_val_factura');

					$oferta->created_at = Input::get('created_at');
					

					if(Session::get('rol_nombre')=='usuario'){
					$oferta->usu_id = Session::get('usu_id');
				}elseif (Session::get('rol_nombre')=='administrador') {
					$oferta->usu_id = Input::get('usu_id');
				}
				

				if($oferta->save()){

					if(Session::get('rol_nombre')=='usuario'){
						return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Oferta guardada con exito: Consecutivo '.$oferta->geofer_consecutivo);
					}elseif (Session::get('rol_nombre')=='administrador') {
						return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Oferta guardada con exito: Consecutivo '.$oferta->geofer_consecutivo);
					}
					
				}else{

					if(Session::get('rol_nombre')=='usuario'){
						return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la Oferta!!');
					}elseif (Session::get('rol_nombre')=='administrador') {
						return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la Oferta!!');
					}

				}

			}

		}


	public function buscar_consecutivos_anio(){
		$ofertas = Modgeofertas::whereRaw ('YEAR( created_at ) = ?', array(Input::get('anio')))->select('geofer_consecutivo')->get();
		return $ofertas;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /congeofertas/{id}/edit
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
	 * PUT /congeofertas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(){
		
		$oferta = Modgeofertas::find(Input::get('geofer_id_upd'));
			$oferta->geofer_cliente = Input::get('geofer_cliente_upd');
			$oferta->geofer_concepto = Input::get('geofer_concepto_upd');
			$oferta->geofer_reemplazo = Input::get('geofer_reemplazo_upd');
			$oferta->geofer_valor_inicial = Input::get('geofer_valor_inicial_upd');
			$oferta->geofer_moneda = Input::get('geofer_moneda_upd');
			$oferta->geofer_ult_valor_cot = Input::get('geofer_ult_valor_cot_upd');
			$oferta->geofer_resultado = Input::get('geofer_resultado_upd');
			$oferta->geofer_fact_sig = Input::get('geofer_fact_sig_upd');
			$oferta->geofer_val_factura = Input::get('geofer_val_factura_upd');
			$oferta->created_at = Input::get('created_at_upd');

			if($oferta->save()){

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Oferta guardada con exito');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Oferta guardada con exito');
				}
					
			}else{

				if(Session::get('rol_nombre')=='usuario'){
					return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la Oferta!!');
				}elseif (Session::get('rol_nombre')=='administrador') {
					return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Error guardando la Oferta!!');
				}

			}

	}


	public function buscar_una_oferta(){
		$oferta = Modgeofertas::find(Input::get('geofer_id'));
		return $oferta;
	}


	public function exportar_ofertas(){
		if(Session::has('anio_ofertas')){
		$anio = Session::get('anio_ofertas');
	}else{
		$anio = date("Y");
	}

	Excel::create('Ofertas_'.$anio, function($excel) use($anio){
   	$excel->sheet($anio, function($sheet) use($anio){

   		$sheet->mergeCells('A1:K4');
        	$sheet->row(1, function ($row) {
            $row->setFontSize(15);
            $row->setBackground('#ed1a23');
			   $row->setFontColor('#FFFFFF');
			   $row->setAlignment('center');
			   $row->setValignment('center');
			   $row->setFontWeight('bold');
        	});

        	$sheet->row(1, array('CONSECUTIVOS OFERTAS SIG'));

        	$sheet->cells('A6:K6', function($cells)  {
     			$cells->setBackground('#c2c2c2');
     			$cells->setFontColor('#000000');
     			$cells->setAlignment('left');
     			$cells->setValignment('center');
     			$cells->setFontWeight('bold');
    		});
   
   		$data=[];
    		array_push($data, array('FECHA', 'CONSECUTIVOS', 'CLIENTE', 'CONCEPTO', 'OFERTA REMPLAZO', 'VALOR INICIAL', 'MONEDA', 'ULTIMO VR COTIZADO', 'RESULTADO', 'FACTURA SIG', 'VALOR FACTURA'));

    		$consecutivos = Modgeofertas::whereRaw ('YEAR( created_at ) = ?', array($anio))->get();
    		foreach ($consecutivos as $key => $value) {
    			array_push($data, array($value->created_at->format('Y-m-d') , 
    				$value->geofer_consecutivo, 
    				$value->geofer_cliente, 
    				$value->geofer_concepto, 
    				$value->geofer_reemplazo, 
    				$value->geofer_valor_inicial, 
    				$value->geofer_moneda, 
    				$value->geofer_ult_valor_cot, 
    				$value->geofer_resultado, 
    				$value->geofer_val_factura    				
    			));
    		}
    		
    		$sheet->fromArray($data, null, 'A6', false, false);

   	});
  	})->download('xlsx');

	}

	

}