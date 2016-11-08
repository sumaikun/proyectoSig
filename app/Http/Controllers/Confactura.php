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
        if(Session::get('rol_nombre')=='administrador')
        {
            return View::make('facturacion.admin.update_emp',array('empresa'=>$empresa));
        }
        else{
            return View::make('facturacion.usuario.update_emp',array('empresa'=>$empresa));   
        }
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
              
                 $sheet->setActiveSheetIndex(0)->setCellValue('E10',$factura->fecha_elaboracion);
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
            	$sheet->setActiveSheetIndex(0)->setCellValue('F11',$factura->clientes->nombre);
            	$sheet->setActiveSheetIndex(0)->setCellValue('F12',$factura->clientes->nit);
            	$sheet->setActiveSheetIndex(0)->setCellValue('E13',$factura->clientes->direccion);
            	$sheet->setActiveSheetIndex(0)->setCellValue('K12',$factura->clientes->telefono);
            	$sheet->setActiveSheetIndex(0)->setCellValue('K13',$factura->clientes->ciudad);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M29',$factura->con_iva);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M30',$factura->sin_iva);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M32',$factura->reembolso);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M34',$factura->valor_iva);
            	$sheet->setActiveSheetIndex(0)->setCellValue('M36',$factura->total);

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

	    		$sheet->setActiveSheetIndex(0)->setCellValue('B33',strtoupper($convertidor-> traducir($factura->total).'PESOS MCTE'));

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

        for($i=1;$i<5;$i++)
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
}
