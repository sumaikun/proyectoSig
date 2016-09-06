<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Helpers\Metodos;

use psig\models\ListActivities;

use psig\models\ListEnterprises;

use psig\models\modActividad;

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
       return View::make('actividades.admin.update_parameter',array('actividad'=>$actividad));
    }

    public function showEmp($id)
    {
        $empresa = ListEnterprises::find($id);
        return View::make('actividades.admin.update_parameter',array('empresa'=>$empresa));
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

    public function store()
    {
        $Actividad = new modActividad;
        $id = Metodos::id_generator($Actividad,'id');
        $Actividad->id = $id;
        $Actividad->fecha = Input::get('fecha');
        $Actividad->tp_actividad = Input::get('actividad');
        $Actividad->tp_empresa = Input::get('empresa');
        $Actividad->filial = Input::get('filial');
        $Actividad->subcontratista = Input::get('fecha');
        $Actividad->horas = Input::get('horas');
        $Actividad->descripcion = Input::get('descripcion');
        $Actividad->usuario = Session::get('usu_id');

        if($Actividad->save()){  return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actividad Registrada!!');
        }
        else{

            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        } 

    }

    public function edit($id)
    {
        $registro = modActividad::find($id);
        $actividades = ListActivities::lists('nombre','id');
        $empresas = ListEnterprises::lists('nombre','id');
        return View::make('actividades.admin.editaractividad',array('registro'=>$registro,'actividades'=>$actividades,'empresas'=>$empresas));
    }

    public function update()
    {
        $Actividad=modActividad::find(Input::get('id'));
        $Actividad->fecha = Input::get('fecha');
        $Actividad->tp_actividad = Input::get('actividad');
        $Actividad->tp_empresa = Input::get('empresa');
        $Actividad->filial = Input::get('filial');
        $Actividad->subcontratista = Input::get('fecha');
        $Actividad->horas = Input::get('horas');
        $Actividad->descripcion = Input::get('descripcion');

        if($Actividad->save()){  return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Registro Editado!!');
        }
        else{

            return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
        } 

    }
}
