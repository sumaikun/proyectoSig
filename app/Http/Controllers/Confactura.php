<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use psig\models\ListEnterprises;

use psig\models\Modfactura;

use psig\Helpers\Metodos;

use psig\models\Modfac_anulada;

use psig\models\Modfac_pagada; 

use Cache;

use Input;

use View;

use Excel;

use Session;

use DB;

class Confactura extends Controller
{
    public function createCli(Request $request)
    {
    	$rules = ['nombre'=>'required','nit'=>'required|max:11|min:10','telefono'=>'required|min:7|max:20','direccion'=>'required|min:10|max:100','ciudad'=>'required|min:4'];
    	$this->validate($request,$rules);
    	//return 'llego';
    	$empresa = new ListEnterprises;
    	$id = Metodos::id_generator($empresa,'id');
    	$empresa->id = $id;
        $empresa->nombre = Input::get('nombre');
        $empresa->nit = Input::get('nit');
        $empresa->telefono = Input::get('telefono');
        $empresa->direccion = Input::get('direccion');
        $empresa->ciudad = Input::get('ciudad');
        $empresa->contacto = Input::get('contacto');    	
        $empresa->cliente = 1;
        $empresa->user = Session::get('usu_id');
        $check = Metodos::double_enterprises($empresas,1);
        if($check==true)
        {
        	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema');	
        }	
    	if($empresa->save()){
    		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!');
    	 }
    	 else
    	 {
    	 	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
    	 }
    }

    public function createEmp(Request $request)
    {
		$rules = ['nombre'=>'required','nit'=>'required|max:11|min:10','telefono'=>'required|min:7|max:20','direccion'=>'required|min:10|max:100','ciudad'=>'required|min:4'];
    	$this->validate($request,$rules);
    	
    	$empresa = new ListEnterprises;
    	$id = Metodos::id_generator($empresa,'id');
    	$empresa->id = $id;
        $empresa->nombre = Input::get('nombre');
        $empresa->nit = Input::get('nit');
        $empresa->telefono = Input::get('telefono');
        $empresa->direccion = Input::get('direccion');
        $empresa->ciudad = Input::get('ciudad');
        $empresa->contacto = Input::get('contacto');    	
        $empresa->cliente = 0;
        $empresa->user = Session::get('usu_id');
        $check = Metodos::double_enterprises($empresa,1);
        if($check==true)
        {
        	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema');	
        }
    	if($empresa->save()){
    		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!');
    	 }
    	 else
    	 {
    	 	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
    	 }
    }


    public function showEmp($id)
    {
        $empresa = ListEnterprises::find($id);
        return View::make('facturacion.admin.update_emp',array('empresa'=>$empresa));
    }



    public function updateEmp(Request $request)
    {
    	$rules = ['nombre'=>'required','nit'=>'required|max:11|min:10','telefono'=>'required|min:7|max:20','direccion'=>'required|min:10|max:100','ciudad'=>'required|min:4','tp_emp'=>'required'];
    	$this->validate($request,$rules);
    	//return 'tipo empresa '.Input::get('tp_emp');
        $id = Input::get('id');
        $empresa = ListEnterprises::find($id);
        $empresa->nombre = Input::get('nombre');
        $empresa->nit = Input::get('nit');
        $empresa->telefono = Input::get('telefono');
        $empresa->direccion = Input::get('direccion');
        $empresa->ciudad = Input::get('ciudad');
        $empresa->contacto = Input::get('contacto');
        $empresa->cliente = Input::get('tp_emp');
        $empresa->user = Session::get('usu_id');
        $check = Metodos::double_enterprises($empresa,2);
        //return $check;
        if($check==true)
        {
        	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema');	
        }
		//return $empresa;
        if($empresa ->save()){
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Parametros actualizado con éxito!!');
        } 
        else{
            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        }   
        
    }    

    public function destroyEmp($id)
    {
        $empresa = ListEnterprises::find($id);
        if($empresa->delete())
        {
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Parametro Borrado!!');
        }
        else{

            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        }
    }

    public function store(Request $request)
    {
    	//print_r($_POST);
    	
    	$factura = new Modfactura;    	
    	$id = Metodos::id_generator($factura,'id');
    	$factura->id = $id;
    	$factura->fecha_elaboracion = Input::get('fecha_elaboracion');
    	$factura->cliente = Input::get('cliente');
    	$factura->facturadora = Input::get('facturadora');
    	$factura->reembolso = Input::get('reembolso');
    	$factura->fecha_vencimiento = Input::get('fecha_vencimiento');
    	$factura->iva = Input::get('iva');
    	$cons = Metodos::cons_generator($factura->facturadora);    	
    	$factura->consecutivo = $cons;
    	$cont = Input::get('cont');
    	$desc = '';
    	for($i=0;$i<$cont;$i++)
    	{
    		$desc  = $desc.Input::get('item'.($i+1)).',';
    		$desc  = $desc.Input::get('cant'.($i+1)).',';
    		$desc  = $desc.Input::get('valor'.($i+1)).',';
    		if(Input::get('valor'.($i+1))!=0)
    		{
    			$desc = $desc.'con';
    		}
    		else{
    			$desc = $desc.'sin';	
    		}
    		$desc = $desc.'|';	
    	}	

    	$factura->descripcion = $desc;
    	$factura->status = 0;
    	$factura->user = Session::get('usu_id');

    	if($factura ->save()){
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura creada con éxito!! Consecutivo: '.$factura->consecutivo);
        } 
        else{
            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        }   

    }

    public function get_customer_info($id)
    {
    	$customer = ListEnterprises::where('id','=',$id)->first();
    	return $customer;
    }

    public function get_bill_info($id)
    {
    	$bill = Modfactura::where('id','=',$id)->first();

		  $bill->con_iva = Metodos::factura($bill->descripcion,'con_iva');
	      $bill->sin_iva = Metodos::factura($bill->descripcion,'sin_iva');
	      $bill->valor_iva = ($bill->iva*$bill->con_iva)/100;
	      $bill->total = $bill->valor_iva+$bill->con_iva+$bill->sin_iva+$bill->reembolso;

    	return $bill;
    }

    public function anular(Request $request, $id){
    	if ($request->isMethod('post'))
		{
			$anulada = new Modfac_anulada;
			$id = Metodos::id_generator($anulada,'id');
			$anulada->id=$id;
			$anulada->detalles = Input::get('detalles');
			$anulada->factura_id = Input::get('id');
			$this->change_status($anulada->factura_id,2);
			$anulada->user = Session::get('usu_id');

	    	if($anulada ->save()){
	            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura anulada con éxito!!');
	        } 
	        else{
	            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
	        }
// 
		}
		if ($request->isMethod('get'))
		{
			return view('facturacion.ajax.form_cancel',compact('id'));// 		
		}
    	
    }

    public function change_status($id,$status){
    	$factura = Modfactura::find($id);
    	$factura->status = $status;
    	$factura->save();
    }

    public function pagar(Request $request, $id){
    	if ($request->isMethod('post'))
		{
			$pagado = new Modfac_pagada;
			$id = Metodos::id_generator($pagado,'id');
			$pagado->id = $id;
			$pagado->detalles = Input::get('detalles');
			$pagado->factura_id = Input::get('id');
			$pagado->user = Session::get('usu_id');
			$pagado->fecha_pago = Input::get('fecha_pago');
			$pagado->rete_fuente = Input::get('rete_fuente');
			$pagado->rete_ica = Input::get('rete_ica');
			$pagado->rete_cree = Input::get('rete_cree');
			$pagado->rete_otras = Input::get('rete_otras');
			$this->change_status($pagado->factura_id,1);

	    	if($pagado ->save()){
	            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Procedimiento de pago realizado!!');
	        } 
	        else{
	            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
	        }   			
// 
		}
		if ($request->isMethod('get'))
		{
			return view('facturacion.ajax.form_payed',compact('id'));// 		
		}
    }

    public function anular_info($id){
    	$info = Modfac_anulada::where('factura_id','=',$id)->first();
    	return view('facturacion.ajax.cancel_info',compact('info'));
    }

    public function pagar_info($id){
    	$info = Modfac_pagada::where('factura_id','=',$id)->first();
    	return view('facturacion.ajax.payment_info',compact('info'));
    }

}
