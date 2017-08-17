<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use psig\models\InvCategorias;

use psig\models\InvElementos;

use psig\models\InvStatus;

use psig\models\InvSeriales;

use psig\models\InvAlquiler;

use psig\models\InvReparacion;

use psig\models\InvComponentes;

use psig\models\InvAlquilerCom;

use psig\models\InvAlquilerRec;

use psig\models\InvRepSeg;

use psig\Helpers\Metodos;

use Redirect;

use Session;

use View;

use File;

use \Storage;

use DB;

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
        //return $id;
        $foid = $id;
        $element->id = $id;
        $element->codigo = $request->codigo;
        $element->descripcion = $request->descripcion;          
        $element->cantidad = $request->cantidad;
        $element->categoria = $request->categoria;
        
        if($request->file('archivo'))
        {
            $archivo = $request->file('archivo');
            $ext = $archivo->getClientOriginalExtension();

            if(strpos($ext, 'pdf')!== false)
            {
                $element->archivo=$this->filemanage($archivo,'archivo_inventario');
            }
            else{
                return $this->common_answer('!Solamente se aceptan archivos de tipo pdf!',false);            
            }
        }        
          
        $element->save();
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

        return $this->common_answer('Elemento creado con éxito!!',true);
        
    }

    public function editEle(Request $request)
    {
        $element = InvElementos::where('id','=',$request->id)->first();
        $element->codigo = $request->codigo;
        $element->descripcion = $request->descripcion; 
        $element->categoria = $request->categoria;
        if($request->file('archivo'))
        {
            $archivo = $request->file('archivo');
            $ext = $archivo->getClientOriginalExtension();

            if(strpos($ext, 'pdf')!== false)
            {
                $element->archivo=$this->filemanage($archivo,'archivo_inventario');
            }
            else{
                return $this->common_answer('!Solamente se aceptan archivos de tipo pdf!',false);            
            }
        }  
        $element->save();
        return $this->common_answer('Elemento editado con éxito!!',true);        
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
        //print_r($_POST);
        //return "";
        $serial = InvSeriales::where('id','=',$request->objectid)->first();
        //return $serial->id_status;
        if($serial->id_status==3 || $serial->id_status==2)
        {
            return $this->common_answer('El elemento no esta disponible para esta solicitud!!',false);              
        }
        if($request->valor2 > $request->valor)
        {
            return $this->common_answer('El valor de receso no debe ser mayor al valor estandar de alquiler!!',false);   
        }
        else{

            $alquiler = new InvAlquiler;
            $alquiler->id = Metodos::id_generator($alquiler,'id');
            $alquiler->id_usuario = Session::get('usu_id');
            $alquiler->id_serial = $request->objectid;
            $alquiler->valor = $request->valor;
            $alquiler->valor2 = $request->valor2;
            $alquiler->fecha_ingreso = $request->fecha1;
            $alquiler->fecha_salida = $request->fecha2;
            $alquiler->id_empresa = $request->empresa;
            $alquiler->save();        
            $serial->id_status = 3;
            $serial->save();
            return $this->common_answer('Elemento alquilado!!',true);       
        }
            
    }

    public function edit_alquilar($id,$fecha2,$fecha1,$valor,$valor2,$cantidad)
    {
        $validate = InvAlquilerCom::where('id_alquiler','=',$id)->whereNotBetween('fecha_comentario', array($fecha1,$fecha2))->first();
        $validate2 = InvAlquilerRec::where('id_alquiler','=',$id)->whereNotBetween('fecha_receso', array($fecha1,$fecha2))->first();
        if($validate != null or $validate2!= null)
        {
            return "No pueden editarse las fechas de alquiler ya que hay dias de receso o anotaciones fuera del rango de las nuevas fechas";
        }

        if($valor2>$valor)
        {
            return "El valor de los dias de receso no puede ser mayor al valor de los días estandar";
        }
        $alquiler = InvAlquiler::where('id','=',$id)->first();
        $alquiler->valor = $valor;
        $alquiler->valor2 = $valor2;
        $alquiler->cantidad_valor2 = $cantidad;
        $alquiler->fecha_ingreso = $fecha1;
        $alquiler->fecha_salida = $fecha2;
        $alquiler->save();
        return "Datos modificados";            
    }

    public function details($id)
    {        //Alquier

        $status = InvSeriales::where('id','=',$id)->value('id_status');
        if($status==3)
        {
            $registro = InvAlquiler::where('id_serial','=',$id)->orderby('id','desc')->first();

            $anotaciones = InvAlquilerCom::where('id_alquiler','=',$registro->id)->where('estado','=',1)->get(); 

            $recesos = InvAlquilerRec::where('id_alquiler','=',$registro->id)->where('estado','=',1)->get();

            //return $recesos;
                
            return View::make('inventario.admin.detalles',compact('registro','anotaciones','recesos'));    
        }

        if($status==2)
        {
            $registro = InvReparacion::where('id_seriales','=',$id)->orderby('id','desc')->first();
           
            return View::make('inventario.admin.detalles2',compact('registro'));
        }

        if($status==1)
        {
            return $this->common_answer('El elemento se encuentra en bodega',false);
        }
        
    }



    public function createcomp(Request $request)
    {

        $componente = new InvComponentes;
        $id = Metodos::id_generator($componente,'id');
        $componente->id = $id;
        $componente->nombre=$request->nombre;
        $componente->id_elementos = $request->elementcomp;
        $archivo = $request->file('archivo');
        $componente->imagen=$this->filemanage($archivo,'inventarios_imagenes');
        $componente->save();//return $componente;
        return $this->common_answer('Componente creado',true);
    }

    public function reparar(Request $request)
    {
        $serial = InvSeriales::where('id','=',$request->objectidr)->first();
        //return $serial->id_status;
        if($serial->id_status==3 || $serial->id_status==2)
        {
            return $this->common_answer('El elemento no esta disponible para esta solicitud!!',false);              
        }
        else{

            $serial->id_status=2;
            $serial->save(); 
            $reparacion = new InvReparacion;
            $id = Metodos::id_generator($reparacion,'id');
            $reparacion->id = $id;
            $reparacion->fecha = $request->fechar;
            $reparacion->info_extra = $request->detalles_oper;
            $reparacion->id_seriales = $request->objectidr;      
            $reparacion->save();
            return $this->common_answer('Registro creado',true);
        }
            
    }

    public function calendar_action(Request $request)
    {
        //return "test";

        $validate = InvAlquilerRec::where('fecha_receso','=',$request->fecha)->where('id_alquiler','=',$request->alquiler)->first();
        $validate2 = InvAlquilerCom::where('fecha_comentario','=',$request->fecha)->where('id_alquiler','=',$request->alquiler)->first();

        if($request->es_receso == "si")
        {
            if($validate == null)
            {
               $sql = DB::select(DB::raw("select max(id) as id from inventario_alquiler_recesos"));
               $id = $sql[0]->id;
               if($id == null)
               {
                    $id=1;
               }
               else{
                    $id += 1;
               }

               $receso = new InvAlquilerRec;
               $receso->id = $id;
               $receso->fecha_receso = $request->fecha;
               $receso->id_alquiler = $request->alquiler;
               $receso->estado = 1;
               $receso->save();

               $alquiler= InvAlquiler::where('id','=',$request->alquiler)->first();
               $alquiler->cantidad_valor2 += 1;
               $alquiler->save();
               //echo "guardo receso"; 

            }
            else{
                $validate->estado = 1;
                $validate->save();
                $alquiler= InvAlquiler::where('id','=',$request->alquiler)->first();
                $alquiler->cantidad_valor2 += 1;
                $alquiler->save();
                   
            }
        }
        else{
            if($validate != null)
            {
                $validate->estado = 0;
                $validate->save();
                $alquiler= InvAlquiler::where('id','=',$request->alquiler)->first();
                $alquiler->cantidad_valor2 -= 1;
                $alquiler->save();
                //echo "quito receso";
            }    
        }
        if($request->comentario != null)
        {
            if($validate2!=null)
            {
                $validate2->comentario=$request->comentario;
                $validate2->save();
                //echo "actualizo comentario";
            }
            else{
                $sql = DB::select(DB::raw("select max(id) as id from inventario_alquiler_comentarios"));
                //return $sql[0]->id;
               $id = $sql[0]->id;
               if($id == null)
               {
                    $id=1;
               }
               else{
                    $id += 1;
               }

               $comentario = new InvAlquilerCom;
               $comentario->id = $id;
               $comentario->fecha_comentario = $request->fecha;
               $comentario->id_alquiler = $request->alquiler;
               $comentario->comentario = $request->comentario;
               $comentario->estado = 1;
               $comentario->save();
               //echo "guardo anotacion";            
            }
        }
        else{
            if($validate2!=null)
            {
                $validate2->estado=0;
                $validate2->save();
                //echo "actualizo comentario";
            }
        }

        return "datos guardados";
    }

    function delete_anotation(Request $request)
    {
        DB::delete("delete from inventario_alquiler_comentarios where id = ".$request->id);
        return "Anotación eliminada";   
    }

    function delete_rest(Request $request)
    {
        $rest = InvAlquilerRec::where('id','=',$request->id)->first();
        $alquiler= InvAlquiler::where('id','=',$rest->id_alquiler)->first();
        $alquiler->cantidad_valor2 -= 1;
        $alquiler->save();
        DB::delete("delete from inventario_alquiler_recesos where id = ".$request->id);
        return "Anotación eliminada";   
    }

    function get_all_res($id)
    {
        $recesos = InvAlquilerRec::where('id_alquiler','=',$id)->where('estado','=',1)->get();
        return response()->json(['recesos' =>$recesos]);
                
    }

    function get_all_anotations($id)
    {
        $anotaciones =  InvAlquilerCom::where('id_alquiler','=',$id)->get();
        return response()->json(['anotaciones' =>$anotaciones]);         
    }

    function get_main_event($id)
    {
        $main = InvAlquiler::where('id','=',$id)->first();
        return response()->json(['main' =>$main]);
    }

    public function delete_reparacion($id)
    {
        return "Registro eliminado";            
        DB::delete("delete from inventario_reparacion where id = ".$id);
        return "Registro eliminado";   
    }

    public function edit_reparacion_fecha(Request $request)
    {
        $reparacion = InvReparacion::where('id','=',$request->id)->first();        

        $seguimiento = new InvRepSeg();
        $sql = DB::select(DB::raw("select max(id) as id from inventario_reparacion_seguimiento"));
           $id = $sql[0]->id;
           if($id == null)
           {
                $id=1;
           }
           else{
                $id += 1;
           }
        $seguimiento->id = $id;
        $seguimiento->seguimiento = "El usuario ".Session::get('usu_nombres')." realizó una edición de la fecha de ".$reparacion->fecha." a ".$request->fecha;
        $seguimiento->id_reparacion = $request->id;
        $seguimiento->fecha = date("Ymd");
        $seguimiento->type = 1;
        $seguimiento->usuario = Session::get('usu_id');
        $seguimiento->save();

        $reparacion->fecha = $request->fecha;
        $reparacion->save();
        
        return "fecha modificada";
    }

    public function edit_reparacion_comentario(Request $request)
    {
        $reparacion = InvReparacion::where('id','=',$request->id)->first();
        $reparacion->info_extra = $request->comentario;
        $reparacion->save();
        $seguimiento = new InvRepSeg();
        $sql = DB::select(DB::raw("select max(id) as id from inventario_reparacion_seguimiento"));
           $id = $sql[0]->id;
           if($id == null)
           {
                $id=1;
           }
           else{
                $id += 1;
           }
        $seguimiento->id = $id;
        $seguimiento->seguimiento = "El usuario ".Session::get('usu_nombres')." realizó una edición del comentario";
        $seguimiento->id_reparacion = $request->id;
        $seguimiento->fecha = date("Ymd");
        $seguimiento->type = 1;
        $seguimiento->usuario = Session::get('usu_id');
        $seguimiento->save();
        
        return "comentario modificado";   
    }

    public function create_seguimiento(Request $request)
    {
        //print_r($_POST);
        //return "";
        $seguimiento = new InvRepSeg();
        $sql = DB::select(DB::raw("select max(id) as id from inventario_reparacion_seguimiento"));
           $id = $sql[0]->id;
           if($id == null)
           {
                $id=1;
           }
           else{
                $id += 1;
           }
        $seguimiento->id = $id;
        $seguimiento->seguimiento = $request->seguimiento;
        $seguimiento->id_reparacion = $request->id;
        $seguimiento->fecha = date("Ymd");
        $seguimiento->type = 0;
        $seguimiento->usuario = Session::get('usu_id');
        $seguimiento->save();
        return "Seguimiento creado";     

    }

    public function table_seguimiento($id)
    {   
        $seguimientos = InvRepSeg::where('id_reparacion','=',$id)->get();
        //return $seguimientos;        
        return view('inventario.ajax.seguimientos',compact('seguimientos'));

    }

    public function delete_seguimiento($id)
    {
        //$seguimientos = InvRepSeg::where('id','=',$id)->get();
        DB::delete("delete from inventario_reparacion_seguimiento where id = ".$id);
        return "!El seguimiento ha sido eliminado¡";
    }

    public function update_seguimiento(Request $request)
    {
        $seguimiento = InvRepSeg::where('id','=',$request->id)->first();
        $seguimiento->seguimiento = $request->seguimiento;
        $seguimiento->save();
        return "Seguimiento actualizado";
    }

    public function download_pdf($id)
    {
        $file = InvElementos::where('id','=',$id)->value('archivo');
        if(file_exists(storage_path('archivo_inventario/'.$file)))
        {
            $file_path = storage_path('archivo_inventario/'.$file);
            $dest_path = public_path('pdf/'.$file);

            File::copy($file_path,$dest_path);

            return Redirect::to('pdf/pdfviewer?file='.$file);
            //return response()->download($file_path);
        
        }
        else {
            return "no existe el documento";
        }             
    }

    public function pdf_viewer()
    {
        return view("inventario.pdf.viewer");
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


     private function filemanage($archivo,$disk)
    {        
        $name=$archivo->getClientOriginalName();            
        $upload=Storage::disk($disk)->put($name,  \File::get($archivo) );
            if($upload)
            {
                               
                return $name;
            }
          
    }


}
