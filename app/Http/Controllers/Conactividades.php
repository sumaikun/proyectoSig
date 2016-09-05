<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Helpers\Metodos;

use psig\models\ListActivities;

use psig\models\ListEnterprises;

use psig\Http\Requests;

use Input;

use View;

class Conactividades extends Controller
{
    public function createAct()
    {
    	$actividad = new ListActivities;
    	$id = Metodos::id_generator($actividad,'id');
    	$actividad->id = $id;
    	$actividad->nombre = Input::get('act_nombre');
    	if($actividad->save()){
    		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actividad registrada con éxito!!');
    	 }
    	 else
    	 {
    	 	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
    	 }			
    	
    }

    public function createEmp()
    {
    	$empresa = new ListEnterprises;
    	$id = Metodos::id_generator($empresa,'id');
    	$empresa->id = $id;
    	$empresa->nombre = Input::get('emp_nombre');
    	if($empresa->save()){
    		return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Empresa registrada con éxito!!');
    	 }
    	 else
    	 {
    	 	return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
    	 }
    }

    public function showAct($id)
    {
       $actividad = ListActivities::find($id);
       return View::make('actividades.update_parameter',array('actividad'=>$actividad));
    }

    public function showEmp($id)
    {
        $empresa = ListEnterprises::find($id);
        return View::make('actividades.update_parameter',array('empresa'=>$empresa));
    }

    public function updateAct()
    {
        $id = Input::get('id');
        $actividad = ListActivities::find($id);
        $actividad->nombre = Input::get('nombre');
        if($actividad ->save()){
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Parametro actualizado con éxito!!');
        } 
        else{

            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        }        
        
    }

    public function updateEmp()
    {
        $id = Input::get('id');
        $empresa = ListEnterprises::find($id);
        $empresa->nombre = Input::get('nombre');
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
