<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Helpers\Metodos;

use psig\models\ListActivities;

use psig\models\ListEnterprises;

use psig\models\modActividad;

use psig\Http\Requests;

use Cache;

use Input;

use View;

use Excel;

use Session;

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
        $Actividad->subcontratista = Input::get('subcontratista');
        $Actividad->horas = Input::get('horas');
        $Actividad->descripcion = Input::get('descripcion');
        $Actividad->usuario = Session::get('usu_id');

        if($Actividad->save()){  
            if(Session::get('rol_nombre')=='administrador')
            {
             return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actividad Registrada!!');
            }
            else
            {
                $key=$id;
                Cache::put($key,Session::get('usu_id'),30);

             return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Actividad Registrada, tiene 30 minutos si desea editarla!!');
            }       
        }
        else{

            if(Session::get('rol_nombre')=='administrador')
            {     
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
            }
            else
            {
                return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
            }    
        } 

    }

    public function edit($id)
    {
        $registro = modActividad::find($id);
        $actividades = ListActivities::lists('nombre','id');
        $empresas = ListEnterprises::lists('nombre','id');
        if(Session::get('rol_nombre')=='administrador')
        {
          return View::make('actividades.admin.editaractividad',array('registro'=>$registro,'actividades'=>$actividades,'empresas'=>$empresas));    
        }
        else{
            if(Cache::get($id)==Session::get('usu_id'))
            {
                 return View::make('actividades.usuario.editaractividad',array('registro'=>$registro,'actividades'=>$actividades,'empresas'=>$empresas));  
            }
            else{

                 return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'No puede editarse');
            }

        }    
        
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

        if($Actividad->save()){ 
            if(Session::get('rol_nombre')=='administrador')
            {  
                return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Registro Editado!!');
            }
            else
            {
                return View::make('usuarios.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Registro Editado!!'); 
            }           
        }
        else{
            if(Session::get('rol_nombre')=='administrador')
            {
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
            }   
            else
            {
                return View::make('usuarios.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error');
            }    
        } 

    }


    public function exportar_actividades()
    {

        Excel::create('Reporte_Actividades', function($excel){
        $excel->sheet('reporte', function($sheet){

            $sheet->mergeCells('A1:K4');
                $sheet->row(1, function ($row) {
                $row->setFontSize(15);
                $row->setBackground('#A9E2F3');
                   $row->setFontColor('#08088A');
                   $row->setAlignment('center');
                   $row->setValignment('center');
                   $row->setFontWeight('bold');
                });

                $sheet->row(1, array('Reporte Actividades'));

                $sheet->cells('A6:I6', function($cells)  {
                    $cells->setBackground('#A9E2F3');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('left');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                });
       
            $data=[];
                array_push($data, array('FECHA', 'USUARIO', 'ACTIVIDAD', 'EMPRESA', 'FILIAL', 'SUBCONTRATISTA', '#HORAS', 'DESC. ACTIVIDAD'));

                $registros = Session::get('usu_exportactividades');
                foreach ($registros as $registro) {
                    array_push($data, array(
                        $registro->fecha,
                        $registro->usuarios->usu_nombres,
                        $registro->actividades->nombre,
                        $registro->empresas->nombre,
                        $registro->filial,
                        $registro->subcontratista,
                        $registro->horas,                    
                        $registro->descripcion,               
                    ));
                }
                
                $sheet->fromArray($data, null, 'A6', false, false);

        });
        })->download('xlsx');

    }

    public function excel(Request $request)
    {

        $archivo = $request->file('archivo');
            
        $nombre_original=$archivo->getClientOriginalName();
        $extension=$archivo->getClientOriginalExtension();
        if($extension!='xlsx')
        {
            return "Formato no valido";
        }

        if($archivo->move('excel',$nombre_original))
        {
            
             $ruta  = public_path('excel')."/".$nombre_original;

             Excel::selectSheetsByIndex(0)->load($ruta, function($hoja){           

                   
                    $usuario = $_POST['usuario'];
                    $pos = array('fecha','actividad','empresa','lugar','tema','horas','descripcion');   

                    $hoja->each(function($fila)use($usuario,$pos){

                        $condition = true;

                        $cont = 0;

                     for ($i=0; $i <count($pos) ; $i++)
                     { 
                        $var = $pos[$i];

                        //echo $var;
                        //echo '<br>';
                        //$var = 'horas';
                        

                        if($fila->$var==null or $fila->$var==' ')
                        {
                              //echo "encontre un nulo";
                              $cont ++;  
                              $condition = false;
                        }

                                              
                        
                     }



                     if($cont>4)
                     {
                        return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Excel recibido!!');
                     }

                    /* static $i=0;  
                    echo $i.'espacios '.$cont;   ;  
                    echo '<br>'; 
                    /* if($fila->horas==null or $fila->horas==' ')
                     {
                        echo $i;
                        echo "encontrado";
                        echo '<br>';
                     }   
                      */  //
                    // $i++;
                    
                     if($condition==true)
                     { 

                       $actividad = new modActividad;                      
                        //echo  date_format($fila->fecha, 'Y-m-d');
                        //echo var_dump($fila);
                        $id = Metodos::id_generator($actividad,'id');
                        $actividad->id = $id;
                        $actividad->fecha=date_format($fila->fecha, 'Y-m-d');
                        $fila->actividad=trim($fila->actividad);
                        $fila->empresa=trim($fila->empresa);
                         $tp_actividad=ListActivities::Where('nombre','=',$fila->actividad)->value('id');
                         $tp_empresa=ListEnterprises::Where('nombre','LIKE','%'.$fila->empresa.'%')->value('id');
                        $actividad->tp_actividad=$tp_actividad;
                        $actividad->tp_empresa=$tp_empresa; 
                        $actividad->filial=$fila->lugar;
                        $actividad->subcontratista=$fila->tema;
                        $actividad->horas=$fila->horas;
                        $actividad->descripcion=$fila->descripcion;
                        $actividad->usuario=$usuario;
                        if($tp_actividad!=null&&$tp_empresa!=null)
                        {
                             $actividad->save();

                        }//*/
                                        
                     }
                        
                    }); 


              });

            
            return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Excel recibido!!');


        }
        else
        {
            return "Ha ocurrido un error";
        }    
        
    }
}
