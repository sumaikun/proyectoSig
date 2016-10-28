<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use psig\models\ListEnterprises;

use Cache;

use Input;

use View;

use Excel;

use Session;

use DB;

class Confactura extends Controller
{
    public function createCli()
    {
    	return 'cliente';
    	/*$actividad = new ListActivities;
    	$id = Metodos::id_generator($actividad,'id');
    	$actividad->id = $id;
    	$actividad->nombre = Input::get('act_nombre');
    	if($actividad->save()){
    		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actividad registrada con éxito!!');
    	 }
    	 else
    	 {
    	 	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
    	 }	*/		
    	
    }

    public function createEmp()
    {
    	return 'empresa';
    	/*$empresa = new ListEnterprises;
    	$id = Metodos::id_generator($empresa,'id');
    	$empresa->id = $id;
    	$empresa->nombre = Input::get('emp_nombre');
    	if($empresa->save()){
    		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!');
    	 }
    	 else
    	 {
    	 	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
    	 }*/
    }


    public function showEmp($id)
    {
        $empresa = ListEnterprises::find($id);
        return View::make('facturacion.admin.update_emp',array('empresa'=>$empresa));
    }



    public function updateEmp()
    {
        $id = Input::get('id');
        $empresa = ListEnterprises::find($id);
        $empresa->nombre = Input::get('nombre');
        $empresa->nombre = Input::get('nit');
        $empresa->nombre = Input::get('telefono');
        $empresa->nombre = Input::get('direccion');
        $empresa->nombre = Input::get('ciudad');
        $empresa->nombre = Input::get('contacto');
        if($empresa ->save()){
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Parametro actualizado con éxito!!');
        } 
        else{

            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        }   
        
    }

    public function destroyAct($id)
    {
        $actividad = ListActivities::find($id);
        if($actividad->delete())
        {
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Parametro Borrado!!');
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

}
