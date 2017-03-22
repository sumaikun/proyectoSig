<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use psig\models\InvCategorias;

use psig\models\InvElementos;

use psig\models\InvStatus;

use psig\models\InvSeriales;

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

       public function createSta($nombre)
    {
        $status = new InvStatus;
        $id = Metodos::id_generator($status,'id');
        $status->id = $id;
        $status->nombre = $nombre;
        $status->save();

        return $id;     
         
    }
}
