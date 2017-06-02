<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Helpers\Metodos;

use psig\models\ListActivities;

use psig\models\ListEnterprises;

use psig\models\modActividad;

use psig\models\modusuarios;

use psig\models\Modpermisosact;

use psig\Http\Requests;

use Cache;

use Input;

use View;

use Excel;

use Session;

use DB;

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

    public function store(Request $request)
    {
        $hora_inicial = $request->hini;
        $hora_final = $request->hfin;
        if($hora_inicial == $hora_final)
        {
            return 'deben ser horas distintas';
        }
        $cross = $this->cross_time($request->fechaactividad,$hora_final,$hora_inicial,$request->actividad,0);

        if($cross != True)
        {            
            $Actividad = new modActividad;
            $id = Metodos::id_generator($Actividad,'id');
            $Actividad->id = $id;
            $Actividad->fecha = $request->fechaactividad;
            $Actividad->tp_actividad = $request->actividad;
            $Actividad->tp_empresa = $request->empresa;
            $Actividad->filial = $request->filial;
            $Actividad->subcontratista = $request->subcontratista;
            $Actividad->horas = round(($this->float_time($hora_final,$hora_inicial)/60),2);        
            $Actividad->descripcion = $request->descripcion;
            $Actividad->hora_inicio = $hora_inicial;
            $Actividad->hora_final = $hora_final;      
            $Actividad->usuario = Session::get('usu_id');     
            $Actividad->save();
            return "Actividad registrada";    
        }
        else{
            return "Actividad no registrada, se cruza con otra actividad";
        }
    }

    public function edit($id)
    {
        $Actividad = modActividad::where('id','=',$id)->first();
        return $Actividad;                   
    }

    public function update(Request $request)
    {

        $hora_inicial = $request->hini;
        $hora_final = $request->hfin;
        if($hora_inicial == $hora_final)
        {
            return 'deben ser horas distintas';
        }
        $cross = $this->cross_time($request->fechaactividad,$hora_final,$hora_inicial,$request->actividad,$request->id);
        
        if($cross != True)
        {                    
            $Actividad=modActividad::find($request->id);
            $Actividad->fecha = $request->fecha;
            $Actividad->tp_actividad = $request->actividad;
            $Actividad->tp_empresa = $request->empresa;
            $Actividad->filial = $request->filial;
            $Actividad->subcontratista = $request->subcontratista;        
            $Actividad->descripcion = $request->descripcion;
            $Actividad->horas = round(($this->float_time($hora_final,$hora_inicial)/60),2);  
            $Actividad->hora_inicio = $hora_inicial;
            $Actividad->hora_final = $hora_final;   
            $Actividad->save();
            return "Actividad editada";    
        }
        else{
            return "Actividad no registrada, se cruza con otra actividad";
        }
   }


    public function exportar_actividades()
    {
        $registros = Session::get('usu_exportactividades');
        $order = Array ('fecha','tp_actividad','tp_empresa','filial','subcontratista','horas','usuario','descripcion'); 
    
            Excel::load(public_path('excel').'\GOLBMSFO12.xlsx',function($sheet)use($registros,$order){               

                $row = 8;
                  foreach($registros as $key => $temp) 
               {
                    $col = 0;

                    foreach($order as $value)
                    {  
                        if($value=='usuario'){

                            $usuario = modusuarios::where('usu_id','=',$temp[$value])->first();
                            $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $usuario->usu_nombres.' '.$usuario->usu_apellido1);
                            
                        }

                        elseif($value=='tp_actividad')
                        {
                            $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $temp['actividades']->nombre);
                        }    

                        elseif($value=='tp_empresa')
                        {
                            $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $temp['empresas']->nombre);
                        }

                        else {$sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $temp[$value]);}                         

                        $col++; 

                    }

                   $row++;   
               }          

            })->export('xlsx');
    }

    public function exportar_actividades_admin (Request $request)
    {
        if($request->nfilter=='on'){

            return $this->exportar_actividades();

        }

       $datos = modActividad::where(function($query)use($request){
            if ($request->empresa!=null)
            {
                 $query->where('tp_empresa',"=",$request->empresa);                 
            }
            return $query;
            })->where(function($query) use ($request){
            if ($request->usuario!=null)
            {
                 $query->where('usuario',"=",$request->usuario);
            }
            return $query;
            })->where(function($query) use ($request){
            if ($request->year!=null)
            {
                 $query->where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$request->year.'%');
            }
            return $query;
            })->where(function($query) use ($request){
            if ($request->month!=null)
            {
                 $query->where('fecha',"LIKE",'%'.$request->month.'%');
            }
            return $query;
            })->get();

        Session::put('usu_exportactividades',$datos); 
        //return $request->month;
       
        return $this->exportar_actividades();

    }

    private $rute;

    private $row='n';

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
            
             $ruta  ="public/excel/".$nombre_original;           

             Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) {           

                   
                    $usuario = $_POST['usuario'];
                    $pos = array('fecha','actividad','empresa','lugar','tema','horas','descripcion');   
                    
                    $hoja->each(function($fila)use($usuario,$pos){

                        $condition = true;

                        $cont = 0;

                     for ($i=0; $i <count($pos) ; $i++)
                     { 
                        $var = $pos[$i];                     
                        if($fila->$var==null or $fila->$var==' ')
                        {
                              //echo "encontre un nulo";
                              $cont ++;  
                              $condition = false;
                        }                                            
                        
                     }

                     if($cont>4)
                     {
                        return 'proceso terminado';
                     }


                     if($this->row!='n')
                     {
                        return 'proceso terminado';
                     }

                     static $i=0;                
                     $i++;
                    
                     if($condition==true)
                     { 

                       $actividad = new modActividad;                      
                        //echo  date_format($fila->fecha, 'Y-m-d');
                        //echo var_dump($fila);
                        $id = Metodos::id_generator($actividad,'id');
                        $actividad->id = $id;
                        $fecha=date_format($fila->fecha, 'Y-m-d'); 
                        $actividad->fecha=$fecha;
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
                        $exist = modActividad::Where('tp_empresa','=',$tp_empresa)->where('tp_actividad','=',$tp_actividad)->where('subcontratista','=',$fila->tema)->where('horas','=',$fila->horas)->where('fecha','=',$fecha)->get();
                    
                        if($tp_actividad!=null&&$tp_empresa!=null&&$exist=='[]')
                        {                           
                            if($actividad->save())
                            {                                            
                                $this->rute = true;
                            }                          

                        }
                        elseif ($tp_actividad==null or $tp_empresa==null)
                        {                            
                            $this->row=$i;
                            $this->rute = false;
                            return '';
                        }
                         else
                        {
                            $this->rute = true;
                        }     
                                        
                     }
                        
                    });
              });

            if($this->rute==true)
            {                
                return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Excel recibido!!');
            }    

            else
            {                
                return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'un parametro de la linea '.($this->row+1).' no existe en el sistema');
            }

        }
        else
        {
            return "Ha ocurrido un error";
        }    
        
    }

    public function myactivities($fecha)
    {

        $actividades = DB::select(Db::raw("select hora_inicio, a.id as id, hora_final, la.nombre as actividad , le.nombre as empresa, filial, subcontratista, descripcion  from reg_actividades as a inner join lista_actividades as la on a.tp_actividad = la.id inner join lista_empresas as le on a.tp_empresa = le.id where fecha = '".$fecha."' and usuario = ".Session::get('usu_id')." order by hora_final"));
        //return $actividades;
        $int2 = 'something'; 
        return view('actividades.ajax.actividadesdia',compact('actividades','int2'));

         //DB::select(DB::raw("select max(id) as id from Factores")); 
    }

    public function calendar($id)
    {
        $fechas = modActividad::Select(DB::raw('DISTINCT fecha as start'))->orderBy('fecha','desc')->Where('usuario','=',$id)->get();
        foreach($fechas as $fecha)
        {
            $fecha->title='detalles';
            $fecha->fecha = $fecha->start;
            $fecha->id = $id;
            $fecha->url = "#";            
        }

        return $fechas;
    }

    public function detailinfo($fecha,$id)
    {
         $actividades = DB::select(Db::raw("select a.id as id, hora_inicio, hora_final, filial, subcontratista, descripcion,la.nombre as actividad , le.nombre as empresa from reg_actividades as a inner join lista_actividades as la on a.tp_actividad = la.id inner join lista_empresas as le on a.tp_empresa = le.id where fecha = '".$fecha."' and usuario = ".$id." order by hora_final"));

        return view('actividades.ajax.actividadesdia',compact('actividades'));
    }

    public function lista($id,$year)
    {
      $actividades = modActividad::Where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$year.'%')->where('usuario','=',$id)->orderBy('fecha','desc')->get();
      return view('actividades.ajax.actividadeslista',compact('actividades'));
    }

    public function assign_permission(Request $request)
    {
        $permisos = new Modpermisosact;          

        $existence = Modpermisosact::where('user_id','=',$request->usuario)->first();

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

        for($i=1;$i<3;$i++)
        {
            if($request['permiso'.$i]!=null)
            {
                $chain = $chain.$request['permiso'.$i].',';
            }
        }

        $permisos->permisos = $chain;

        //return $permisos;

        $permisos->save();
        return $this->common_answer("Permisos asignados con exito!!",true);
    }

    public function check_permission($id){
        $existence = Modpermisosact::where('user_id','=',$id)->first();
        if($existence!=null){
            return $existence->permisos;
        }
        else {
            return 'inexistence';
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

    private function float_time($hora1,$hora2){
        $separar[1]=explode(':',$hora1); 
        $separar[2]=explode(':',$hora2); 

        $total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]; 
        $total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1]; 
        $total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2];
        return $total_minutos_trasncurridos;
    }

    private function cross_time($fecha,$hora_final,$hora_inicial,$actividad,$id)
    {
        $actividad = strtoupper(ListActivities::where('id','=',$actividad)->value('nombre'));
        if($actividad != "DESPLAZAMIENTO")
        {
            $registros = modActividad::where('fecha','=',$fecha)->where('usuario','=',Session::get('usu_id'))->where('tp_actividad','!=',61)->where('id','!=',$id)->orderBy('hora_inicio')->get();
            foreach($registros as $registro)
            {

                if($this->float_time($hora_inicial,$registro->hora_final)>=0)
                {
                    $var1 = True; 
                }
                else{
                    $var1 = False;    
                }
                if($this->float_time($hora_final,$registro->hora_inicio)<=0)
                {
                    $var2 = True;
                }
                else{
                    $var2 = False;    
                }

                if($var1==False and $var2==False)
                {
                    return True;
                }

            }
            return False;    
        }
        else{
            return False;
        }     

    } 
}

