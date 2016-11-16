<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use psig\models\ListEnterprises;

use psig\models\Modfactura;

use psig\Helpers\Metodos;

use psig\Helpers\NumerosALetras;

use psig\models\Modfac_anulada;

use psig\models\Modfac_pagada;

use psig\models\Modpermisosfac;

use psig\models\ListDepartamentos;

use psig\models\ListCiudades;

use psig\models\ListBancos;

use psig\models\ListCuentas;  

use Cache;

use Input;

use View;

use Excel;

use Session;

use Storage;

use DB;

use PHPExcel_Style_Alignment;

class Confactura extends Controller
{
    public function createCli(Request $request)
    {
    	$rules = ['nombre'=>'required','nit'=>'required|max:11|min:10','telefono'=>'required|min:7|max:20','direccion'=>'required|min:10|max:100','ciudad'=>'required|numeric'];
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
            if(Session::get('rol_nombre')=='administrador')
            {
        	   return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema'); 
            }	
        }	
    	if($empresa->save()){
            if(Session::get('rol_nombre')=='administrador')
            {
    		  return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!'); 
            }  
    	 }
    	 else
    	 {
            if(Session::get('rol_nombre')=='administrador')
            {
    	 	 return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error'); 
            } 
    	 }
    }

    public function createEmp(Request $request)
    {
		$rules = ['nombre'=>'required','nit'=>'required|max:11|min:10','telefono'=>'required|min:7|max:20','direccion'=>'required|min:10|max:100','ciudad'=>'required|numeric'];
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
        	if(Session::get('rol_nombre')=='administrador')
            {
               return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema'); 
            }	
        }
    	if($empresa->save()){
    		if(Session::get('rol_nombre')=='administrador')
            {
              return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!'); 
            }
    	 }
    	 else
    	 {
    	 	if(Session::get('rol_nombre')=='administrador')
            {
             return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error'); 
            }
    	 }
    }


    public function showEmp($id)
    {
        $empresa = ListEnterprises::find($id);
        $departamentos = ListDepartamentos::lists('nombre','id');

        if(Session::get('rol_nombre')=='administrador')
        {
            return View::make('facturacion.admin.update_emp',array('empresa'=>$empresa,'departamentos'=>$departamentos));
        }
        else{
            return View::make('facturacion.usuario.update_emp',array('empresa'=>$empresa,'departamentos'=>$departamentos));   
        }
    }



    public function updateEmp(Request $request)
    {
    	$rules = ['nombre'=>'required','nit'=>'required|max:11|min:10','telefono'=>'required|min:7|max:20','direccion'=>'required|min:10|max:100','ciudad'=>'required|numeric','tp_emp'=>'required'];
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
            if(Session::get('rol_nombre')=='administrador')
            {
        	   return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'La entidad ya existe en el sistema');    
            }	
        }
		//return $empresa;
        if($empresa ->save()){
            if(Session::get('rol_nombre')=='administrador')
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Parametros actualizado con éxito!!');
            }
            else{
                return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Parametros actualizado con éxito!!');   
            }    
        } 
        else{
            if(Session::get('rol_nombre')=='administrador')
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
            }
            else{
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');    
            }   
        }   
        
    }    

 
    public function store(Request $request)
    {
    	//print_r($_POST);
    	$rules = ['fecha_elaboracion'=>'required|date','cliente'=>'required|numeric','facturadora'=>'required|numeric','reembolso'=>'required|numeric','fecha_vencimiento'=>'required|date','iva'=>'required|numeric','cuenta'=>'required|numeric'];

        $this->validate($request,$rules);

    	$factura = new Modfactura;    	
    	$id = Metodos::id_generator($factura,'id');
    	$factura->id = $id;
    	$factura->fecha_elaboracion = Input::get('fecha_elaboracion');
    	$factura->cliente = Input::get('cliente');
    	$factura->facturadora = Input::get('facturadora');
    	$factura->reembolso = Input::get('reembolso');
    	$factura->fecha_vencimiento = Input::get('fecha_vencimiento');
    	$factura->iva = Input::get('iva');
        $factura->cuenta = Input::get('cuenta');
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
            if(Session::get('rol_nombre')=='administrador')
            {  
                return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura creada con éxito!! Consecutivo: '.$factura->consecutivo);
            }
            else{
                return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura creada con éxito!! Consecutivo: '.$factura->consecutivo);   
            }    
        } 
        else{
            if(Session::get('rol_nombre')=='administrador')
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error,');
            }
            else{
                return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error,');   
            }    
        }   

    }

    public function get_customer_info($id)
    {
    	$customer = ListEnterprises::where('id','=',$id)->first();
        $customer->ciudad = $customer->ciudades["nombre"];  
    	return $customer;
    }

    public function get_bill_info($id)
    {
    	$bill = Modfactura::where('id','=',$id)->first();

		  $bill->con_iva = Metodos::factura($bill->descripcion,'con_iva');
	      $bill->sin_iva = Metodos::factura($bill->descripcion,'sin_iva');
	      $bill->valor_iva = (int) ($bill->iva*$bill->con_iva)/100;
	      $bill->total = (int) $bill->valor_iva+$bill->con_iva+$bill->sin_iva+$bill->reembolso;

          $bill->cuenta = $bill->cuentas;
          $bill->banco = $bill->cuentas->bancos;
           if($bill->cuenta->tipo==1){
                $bill->cuenta->tipo = "Ahorros";
            }
            else{
               $bill->cuenta->tipo = "Corriente";    
            }   

    	return $bill;
    }

    public function anular(Request $request, $id){
    	if ($request->isMethod('post'))
		{
            $rules = ['id'=>'required|numeric'];
            $this->validate($request,$rules);

			$anulada = new Modfac_anulada;
			$id = Metodos::id_generator($anulada,'id');
			$anulada->id=$id;
			$anulada->detalles = Input::get('detalles');
			$anulada->factura_id = Input::get('id');
			$this->change_status($anulada->factura_id,2);
			$anulada->user = Session::get('usu_id');
          


	    	if($anulada ->save()){
               if(Session::get('rol_nombre')=='administrador')
                { 
	               return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura anulada con éxito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura anulada con éxito!!');   
                }   
	        } 
	        else{
                if(Session::get('rol_nombre')=='administrador')
                {
	               return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
                else {
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');    
                }   
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
            $rules = ['id'=>'required|numeric','rete_fuente'=>'required|numeric','rete_ica'=>'required|numeric','fecha_pago'=>'required|date','rete_cree'=>'required|numeric','rete_otras'=>'required|numeric'];
            $this->validate($request,$rules);

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
	            if(Session::get('rol_nombre')=='administrador')
                {
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Procedimiento de pago realizado!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Procedimiento de pago realizado!!');   
                }    
	        } 
	        else{
                if(Session::get('rol_nombre')=='administrador')
                {
	               return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');   
                }   
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


    public function save_layout(Request $request)
    {      
      $name= $request->empresa.'.xlsx';
      if(file_exists(storage_path('plantillas_excel/'.$name)))
      {
        return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error, ya existe la plantilla');
      }         
      $archivo = $request->file('archivo');

      $filemanage = $this->filemanage($archivo,'plantillas_excel',$name);

      if($filemanage=="storaged"){
      	return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Plantilla guardada con exito!!');
      }
      else{
      	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error, el formato no es permitido');
      }

      
    }

        public function delete_layout($file)
    {
      if(file_exists(storage_path('plantillas_excel/'.$file.'.xlsx')))
      {
        Storage::disk('plantillas_excel')->delete($file.'.xlsx');
        return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Plantilla borrada con exito!!');
       
      }
      else {
             return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error, No existe el documento');
        }  
    }

    public function download_layout($file)
    {
      if(file_exists(storage_path('plantillas_excel/'.$file.'.xlsx')))
        {
            $file_path = storage_path('plantillas_excel/'.$file.'.xlsx');
            return response()->download($file_path);
        
        }
        else {
            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error, No existe el documento');
        }  
    }

        private function filemanage($archivo,$disk,$name)
    {
               
        $extension = $archivo->getClientOriginalExtension();
        if ($extension!='xlsx')
        {
           return "invalid";   
        }     
        else
        {   
        
        $nombre_original=$archivo->getClientOriginalName();
        $upload=Storage::disk($disk)->put($name,  \File::get($archivo) );
            if($upload)
            {
                               
                return "storaged";
            }
        }  
    }

    	public function download_bill($id){

    		$factura = Modfactura::find($id);

		 	$factura->con_iva = Metodos::factura($factura->descripcion,'con_iva');
	      	$factura->sin_iva = Metodos::factura($factura->descripcion,'sin_iva');
	      	$factura->valor_iva = ($factura->iva*$factura->con_iva)/100;
	      	$factura->total = $factura->valor_iva+$factura->con_iva+$factura->sin_iva+$factura->reembolso;

    		$path ='../storage/plantillas_excel/'.$factura->facturadoras->nombre.'.xlsx';
           //return $path;
            if(file_exists($path))
            { 
            	//return 'existe';
              Excel::load('storage/plantillas_excel/'.$factura->facturadoras->nombre.'.xlsx',function($sheet)use($factura){  
              
                 $sheet->setActiveSheetIndex(0)->setCellValue('C10',$factura->fecha_elaboracion);
                 $sheet->setActiveSheetIndex(0)->setCellValue('K10',$factura->fecha_vencimiento);

	            $style = array(
		        'alignment' => array(
	            	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	    	    	),
		         'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => 'FF0000'),
			        'size'  => 15,
			        'name'  => 'Verdana'
	   				 )
	    		);

            	$sheet->setActiveSheetIndex(0)->setCellValue('M12',$factura->consecutivo);
            	$sheet->setActiveSheetIndex(0)->getStyle('M12')->applyFromArray($style);
            	$sheet->setActiveSheetIndex(0)->setCellValue('E11',$factura->clientes->nombre);
            	$sheet->setActiveSheetIndex(0)->setCellValue('C12',$factura->clientes->nit);
            	$sheet->setActiveSheetIndex(0)->setCellValue('D13',$factura->clientes->direccion);
            	$sheet->setActiveSheetIndex(0)->setCellValue('K12',$factura->clientes->telefono);
            	$sheet->setActiveSheetIndex(0)->setCellValue('K13',$factura->clientes->ciudades->nombre);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M29',$factura->con_iva);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M30',$factura->sin_iva);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M32',$factura->reembolso);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M34',$factura->valor_iva);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M36',$factura->total);
                if($factura->cuentas->tipo==1){$string = 'AHORROS';} else {$string = 'CORRIENTE';}                
                $sheet->setActiveSheetIndex(0)->setCellValue('B31',strtoupper('CONSIGNAR A NOMBRE DE '.$factura->clientes->nombre.' '.$factura->cuentas->bancos->nombre.' '.'CUENTA DE '.$string.' '.$factura->cuentas->numero));
            	$array = explode('|', $factura->descripcion);
		        $size = count($array);
		        $resultado = 0; 

	        		for($i=0;$i<($size-1);$i++)
		          {
		            $string_pr = $array[$i];
		            $product = explode(',', $string_pr);

		          	  $sheet->setActiveSheetIndex(0)->setCellValue('B'.(17+$i),$product[0]);
		          	  $sheet->setActiveSheetIndex(0)->setCellValue('k'.(17+$i),$product[2]);
		          	  $sheet->setActiveSheetIndex(0)->setCellValue('M'.(17+$i),($product[1]*$product[2]));
		              	
	    	      }

	    		$convertidor = new NumerosALetras;
                $factura->total = round($factura->total) ; 
	    		$sheet->setActiveSheetIndex(0)->setCellValue('B33',mb_strtoupper($convertidor->traducir($factura->total).' PESOS MCTE'));

	    		/*	$sheet->setActiveSheetIndex(0)->mergeCells('B33:J34');
	    		$sheet->setActiveSheetIndex(0)->getCell('B33')->setValue(strtoupper($convertidor-> traducir($factura->total).'PESOS MCTE'))->setWrapText(true);*/
    		 	   

               })->export('xlsx');;

             }
             else{
                if(Session::get('rol_nombre')=='administrador')
                {
             	  return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error, la plantilla para descargar la factura no esta en el sistema');
                }
                else{
                   return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error, la plantilla para descargar la factura no esta en el sistema');    
                }  
     		 }	     


    }

    public function assing_permission(Request $request){

       //print_r($_POST);

        $permisos = new Modpermisosfac;          

        $existence = Modpermisosfac::where('user_id','=',$request->usuario)->first();

        if($existence==null)
        {
            $id = Metodos::id_generator($permisos,'id');
            $permisos->id = $id;                        
        }   
        else{
            $permisos = $existence;
        }     

        $permisos->user_id = $request->usuario;

        $chain = '';

        for($i=1;$i<7;$i++)
        {
            if($request['permiso'.$i]!=null)
            {
                $chain = $chain.$request['permiso'.$i].',';
            }
        }

        $permisos->permisos = $chain;

        //return $permisos;

        if($permisos->save()){
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Permisos asignados con exito!!');
        }
        else{
            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        }        

    }

    public function check_permission($id){
        $existence = Modpermisosfac::where('user_id','=',$id)->first();
        if($existence!=null){
            return $existence->permisos;
        }
        else {
            return 'inexistence';
        }        
    }

    public function city_manager(){
        $ciudades = ListCiudades::All();
        return view('facturacion.admin.citys',compact('ciudades'));
    }

    public function city_create(Request $request){

        if($request->isMethod('post')){
            $ciudad = new ListCiudades;
            $id = Metodos::id_generator($ciudad,'id');
            $ciudad->id = $id;
            $ciudad->nombre = Input::get('nombre');
            $ciudad->departamento_id = Input::get('departamento');
            if(Session::get('rol_nombre')=='administrador')
            {     
                if($ciudad->save()){
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Ciudad creada con exito!!');
                }
                else{
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
            }
            else {
                if($ciudad->save()){
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Ciudad creada con exito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                } 
            }    
         }    
        
        if($request->isMethod('get')){
            $departamentos = ListDepartamentos::lists('nombre','id');
            //return $departamentos;
            return view('facturacion.ajax.ciudades.form_create',compact('departamentos'));
        }
    }

    public function city_edit(Request $request, $id){        

        if($request->isMethod('post')){
            $ciudad = ListCiudades::find(Input::get('id'));
            $ciudad->nombre = Input::get('nombre');
            $ciudad->departamento_id = Input::get('departamento');
            if(Session::get('rol_nombre')=='administrador')
            {
                if($ciudad->save()){
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Ciudad editada con exito!!');
                }
                else{
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
            }
            else{
                if($ciudad->save()){
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Ciudad editada con exito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }   
            }    
         }    
        
        if($request->isMethod('get')){
            $departamentos = ListDepartamentos::lists('nombre','id');
            $ciudad = ListCiudades::where('id','=',$id)->first();    
            //return $departamentos;
            return view('facturacion.ajax.ciudades.form_edit',compact('departamentos','id','ciudad'));
        }
    }

    public function account_manager(){
        $bancos = ListBancos::All();
        $cuentas = ListCuentas::All();
        return view('facturacion.admin.accounts',compact('bancos','cuentas'));
    }

    public function banco_create(Request $request){

        if($request->isMethod('post')){
            $rules = ['nombre'=>'required'];
            $this->validate($request,$rules);
            $repeat = ListBancos::where('nombre','=',Input::get('nombre'))->count();
            if($repeat>0)
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Ya existe la entidad bancaria');
            }
            $banco = new ListBancos;
            $id = Metodos::id_generator($banco,'id');
            $banco->id = $id;
            $banco->nombre = Input::get('nombre');
            if(Session::get('rol_nombre')=='administrador')
            {
               if($banco->save()){
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Entidad bancaria creada con exito!!');
                }
                else{
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                } 
            }
            else{
                if($banco->save()){
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Entidad bancaria creada con exito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }    
            }    
                
         }    
        
        if($request->isMethod('get')){            
            //return $departamentos;
            return view('facturacion.ajax.banco.form_create');
        }
    }

    public function banco_edit(Request $request,$id){

        if($request->isMethod('post')){
            $rules = ['nombre'=>'required'];
            $this->validate($request,$rules);
            $banco =ListBancos::find(Input::get('id'));
            $repeat = ListBancos::where('nombre','=',Input::get('nombre'))->get();

            if(count($repeat)>1)
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Ya existe la entidad bancaria');
            }
            elseif(count($repeat)==1&&$repeat[0]->id!=Input::get('id')){
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Ya existe la entidad bancaria');
            }
            
            $banco->nombre = Input::get('nombre');
            if(Session::get('rol_nombre')=='administrador')
            {
                if($banco->save()){
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Entidad bancaria editada con exito!!');
                }
                else{
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
            }
            else{
                if($banco->save()){
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Entidad bancaria editada con exito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }   
            }    
         }    
        
        if($request->isMethod('get')){
            $banco = ListBancos::find($id);
            //return $banco;
            return view('facturacion.ajax.banco.form_edit',compact('banco','id'));
        }
    }


    public function cuenta_create(Request $request){

        if($request->isMethod('post')){
            $rules = ['banco'=>'required|numeric','cuenta'=>'required','empresa'=>'required|numeric','tipo'=>'required'];
            $this->validate($request,$rules);

             $repeat = ListCuentas::where('numero','=',Input::get('cuenta'))->count();
            if($repeat>0)
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Ya existe la cuenta bancaria');
            }

            $cuenta = new ListCuentas;
            $id = Metodos::id_generator($cuenta,'id');
            $cuenta->id = $id;
            $cuenta->numero = Input::get('cuenta');
            $cuenta->banco_id = Input::get('banco');
            $cuenta->fact_id = Input::get('empresa');
            $cuenta->tipo = Input::get('tipo');
            //1 es estado activo
            $cuenta->estado = 1;
            if(Session::get('rol_nombre')=='administrador')
            {
                if($cuenta->save()){
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Cuenta creada con exito!!');
                }
                else{
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
            }
            else{
                if($cuenta->save()){
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Cuenta creada con exito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }   
            }    
         }    
        
        if($request->isMethod('get')){            
            $empresas = ListEnterprises::Where('cliente','=',0)->lists('nombre','id');
            $bancos = ListBancos::lists('nombre','id');
            return view('facturacion.ajax.cuenta.form_create',compact('empresas','bancos'));
        }
    }

    public function cuenta_edit(Request $request, $id){        

        if($request->isMethod('post')){
            $rules = ['banco'=>'required|numeric','cuenta'=>'required','empresa'=>'required|numeric','tipo'=>'required','banco'=>'required|numeric'];
            $this->validate($request,$rules);
            
            $repeat = ListCuentas::where('numero','=',Input::get('cuenta'))->get();

            if(count($repeat)>1)
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Ya existe la cuenta bancaria');
            }
            elseif(count($repeat)==1&&$repeat[0]->id!=Input::get('id')){
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Ya existe la cuenta bancaria');
            }

            $cuenta = ListCuentas::find(Input::get('id'));
            $cuenta->numero = Input::get('cuenta');
            $cuenta->banco_id = Input::get('banco');
            $cuenta->fact_id = Input::get('empresa');
            $cuenta->tipo = Input::get('tipo');
            $cuenta->estado = Input::get('estado');
            if(Session::get('rol_nombre')=='administrador')
            { 
                if($cuenta->save()){
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Cuenta editada con exito!!');
                }
                else{
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
            }
            else{
                if($cuenta->save()){
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Cuenta editada con exito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }   
            }    
         }    
        
        if($request->isMethod('get')){
            $empresas = ListEnterprises::Where('cliente','=',0)->lists('nombre','id');
            $bancos = ListBancos::lists('nombre','id');
            $cuenta = ListCuentas::find($id);
            return view('facturacion.ajax.cuenta.form_edit',compact('empresas','bancos','cuenta','id'));
        }
    }

    public function cuenta_relations($id){
        $cuentas = ListCuentas::where('fact_id','=',$id)->get();
        foreach($cuentas as $cuenta){
            $cuenta->banco_id = $cuenta->bancos["nombre"];
            if($cuenta->tipo==1){
                $cuenta->tipo = "Ahorros";
            }
            else{
               $cuenta->tipo = "Corriente";    
            } 
        }
        return $cuentas;
    }

    public function cuenta_info($id){
        $cuenta = ListCuentas::find($id);
        $cuenta->banco_id = $cuenta->bancos["nombre"];
        if($cuenta->tipo==1){
            $cuenta->tipo = "Ahorros";
        }
        else{
           $cuenta->tipo = "Corriente";    
        }
        return $cuenta;
    }

    public function edit_paid(Request $request,$id)
    {
        if($request->isMethod('get')){
            $info = Modfac_pagada::find($id);
            return view('facturacion.ajax.editpayment_cancel.edit_payed',compact('info','id'));
        }
        if($request->isMethod('post')){

            $rules = ['id'=>'required|numeric','rete_fuente'=>'required|numeric','rete_ica'=>'required|numeric','fecha_pago'=>'required|date','rete_cree'=>'required|numeric','rete_otras'=>'required|numeric'];
            $this->validate($request,$rules);

            $pagado = Modfac_pagada::find(Input::get('id'));
            $pagado->detalles = Input::get('detalles');            
            $pagado->user = Session::get('usu_id');
            $pagado->fecha_pago = Input::get('fecha_pago');
            $pagado->rete_fuente = Input::get('rete_fuente');
            $pagado->rete_ica = Input::get('rete_ica');
            $pagado->rete_cree = Input::get('rete_cree');
            $pagado->rete_otras = Input::get('rete_otras');

            
            if($pagado ->save()){
                if(Session::get('rol_nombre')=='administrador')
                {
                    return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Procedimiento de pago editado !!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Procedimiento de pago editado!!');   
                }    
            } 
            else{
                if(Session::get('rol_nombre')=='administrador')
                {
                   return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');   
                }   
            }  

        }    
    }

    public function edit_nulled(Request $request,$id)
    {
        if($request->isMethod('get')){
            $info = Modfac_anulada::find($id);
            return view('facturacion.ajax.editpayment_cancel.edit_cancel',compact('info','id'));
        }
        if($request->isMethod('post')){           

            $rules = ['id'=>'required|numeric'];
            $this->validate($request,$rules);

            $anulada =  Modfac_anulada::find(Input::get('id'));         
            $anulada->detalles = Input::get('detalles');          
            $anulada->user = Session::get('usu_id');

              //return $anulada->archivo.'aca abajo';

            if($anulada ->save()){
               if(Session::get('rol_nombre')=='administrador')
                { 
                   return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura anulada editada con éxito!!');
                }
                else{
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Factura anulada editada con éxito!!');   
                }   
            } 
            else{
                if(Session::get('rol_nombre')=='administrador')
                {
                   return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
                }
                else {
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');    
                }   
            }
        }    
    }

    public function add_support(Request $request,$id)
    {
         if($request->isMethod('get')){           
            return view('facturacion.ajax.support',compact('id'));
        }
        if($request->isMethod('post')){

            $factura = Modfactura::find(Input::get('id'));
            $archivo = $request->file('archivo');     
            $nombre_original=$archivo->getClientOriginalName();
            $extension = $archivo->getClientOriginalExtension();
            //return $extension;

            if($extension!='jpg' && $extension!='jpeg' && $extension!='pdf')
            {
                if(Session::get('rol_nombre')=='administrador')
                {
                   return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Formato no valido , solo JPG o PDF');
                }
                else {
                    return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Formato no valido , solo JPG o PDF');    
                }
            } 

            $upload=Storage::disk('soporte')->put($nombre_original,  \File::get($archivo));
            if($factura->archivo!=""){
                Storage::disk('soporte_pagada')->delete($factura->archivo);
            } 
            $factura->soporte = $nombre_original;
            $factura->save();

            if(Session::get('rol_nombre')=='administrador')
            { 
               return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Soporte guardado con éxito!!');
            }
            else{
                return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Soporte guardado con éxito!!');   
            }

        }  
    }
}
