<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use psig\models\InvCategorias;

use psig\models\InvElementos;

use psig\models\InvStatus;

use psig\models\InvSeriales;

use psig\models\InvAlquiler;

use psig\Helpers\Metodos;

use Session;

use View;

class Coninventario extends Controller
{
       public function createCat($nombre)
    {
    	$categoria = new InvCategorias;
    	$id = Metodos::id_generator($categoria,'id');
    	$categoria->id = $id;
    	$categoria->nombre = $nombre;
    	$categoria->save();

    	return $id;    	
    	 
    }

    public function createEle(Request $request)
    {
        //return print_r($_POST);
        $element = new InvElementos;
        $id = Metodos::id_generator($element,'id');
        $foid = $id;
        $element->id = $id;
        $element->codigo = $request->codigo;
        $element->descripcion = $request->descripcion;          
        $element->cantidad = $request->cantidad;
        for($i=1; $i<=$request->cantidad;$i++ )
        {

            $serial = new InvSeriales;
            $id = Metodos::id_generator($serial,'id');
            $serial->valor = $request['item'.$i];
            $serial->id = $id;
            $serial->id_elementos = $foid;
            $serial->id_status = 1;      
            $serial->save();
            
        }        
        
        $element->categoria = $request->categoria;         

        if($element->save())
        {
            if(Session::get('rol_nombre')=='administrador')
            {
              return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Elemento creado con éxito!!');
            }
            else{
               return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Elemento creado con éxito!!'); 
            }  
         }
 


    }

    public function editEle(Request $request)
    {
        $element = InvElementos::where('id','=',$request->id)->first();
        $element->codigo = $request->codigo;
        $element->descripcion = $request->descripcion; 
        $element->categoria = $request->categoria;
        $element->save();
        if(Session::get('rol_nombre')=='administrador')
        {
          return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Elemento editado con éxito!!');
        }
        else{
           return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Elemento editado con éxito!!'); 
        }
    }

       public function createSta($nombre)
    {
        $status = new InvStatus;
        $id = Metodos::id_generator($status,'id');
        $status->id = $id;
        $status->nombre = $nombre;
        $status->save();

        return $id;     
         
    }

    public function deleteSerial($id)
    {
        $serial = InvSeriales::where('id','=',$id)->first();
        $serial->delete();
        $element = InvElementos::where('id','=',$serial->id_elementos)->first();
        $element->cantidad = $element->cantidad-1;
        $element->save();  
        return $this->common_answer('Serial eliminado con éxito!!',true);
    }

    public function createSerial(Request $request)
    {
        $serial = new InvSeriales;
        $serial->id = Metodos::id_generator($serial,'id');
        $serial->id_elementos = $request->newsid;
        $serial->valor  = $request->serial;
        $serial->id_status = $request->status;
        $serial->save(); 
        return $this->common_answer('Serial creado con éxito!!',true);    
    }

    public function editnameSerial(Request $request)
    {
        $serial = InvSeriales::where('id','=',$request->namesid)->first();
        $serial->valor = $request->serial;
        $serial->save();
        return $this->common_answer('Valor del serial modificado!!',true);   
    }

    public function deleteEle($id)
    {
        $element = InvElementos::where('id','=',$id)->first();
        $element->delete();
        return $this->common_answer('Elemento eliminado!!',true);    
    }

    public function alquilar(Request $request)
    {
        $serial = InvSeriales::where('id','=',$request->objectid)->first();
        //return $serial->id_status;
        if($serial->id_status==3)
        {
            return $this->common_answer('Elemento esta alquilado, no puedo realizar su solicitud!!',false);              
        }
        else{

            $alquiler = new InvAlquiler;
            $alquiler->id = Metodos::id_generator($alquiler,'id');
            $alquiler->id_usuario = Session::get('usu_id');
            $alquiler->id_serial = $request->objectid;
            $alquiler->valor = $request->valor;
            $alquiler->fecha_ingreso = $request->fecha;
            $alquiler->fecha_ingreso = $request->fecha2;
            $alquiler->id_empresa = $request->empresa;
            $alquiler->save();        
            $serial->id_status = 3;
            $serial->save();
            return $this->common_answer('Elemento alquilado!!',true);       
        }
            
    }

    private function common_answer($string,$bool)
    {
        if(Session::get('rol_nombre')=='administrador')
        {
          return View::make('administrador.cosas.resultado_volver')->with('funcion', $bool)->with('mensaje',$string );
        }
        else{
           return View::make('usuarios.cosas.resultado_volver')->with('funcion', $bool)->with('mensaje', $string); 
        }
    }


}
