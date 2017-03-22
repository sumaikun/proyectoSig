<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use Storage;

use psig\models\CapDocumento;

use psig\models\CapRegister;

use psig\Helpers\Metodos;

use View;

use Session;

use DB;


class Concapacitacion extends Controller
{
    public function createDoc(Request $request){
    	
    	$archivo = $request->file('archivo');        
        $nombre=$archivo->getClientOriginalName();          
        $this->filemanage($archivo,'cap_documentos');            
        $documento = new capDocumento;
        $documento->id = Metodos::id_generator($documento,'id');        
        $documento->titulo = $request->titulo;        ;      
        $documento->ruta = $nombre;
        $documento->save();
        return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Documento subido con éxito!!');           
    }


     private function filemanage($archivo,$disk)
    {     
        $name=$archivo->getClientOriginalName();
            
        $upload=Storage::disk($disk)->put($name,  \File::get($archivo) );       
    }
    public function download($file,$foid)
    {
	    if(file_exists(storage_path('cap_documentos/'.$file)))
        {
            $file_path = storage_path('cap_documentos/'.$file);

            $this->register_download($foid);

            return response()->download($file_path);
        
        }
        else {
            return "no existe el documento";
        }  
    }

    private function register_download($foid)
    {
    	$register = CapRegister::where('id_user','=',Session::get('usu_id'))->where('id_doc','=',$foid)->first();

    	if($register == null)
    	{
    		$register = new CapRegister;
    		$register->id = Metodos::id_generator($register,'id');
    		$register->id_user = Session::get('usu_id');
    		$register->id_doc = $foid;
    		$register->save(); 
    	} 
    	else{
    		$register->save();
    	}
    }

     public function delete_doc($foid)
    {

      $documento = CapDocumento::where('id','=',$foid)->first();
      $registros = CapRegister::where('id_doc','=',$foid)->get();
      foreach ($registros as $registro) {
      		$registro->delete();
      	}
      $documento->delete();		
      if(file_exists(storage_path('cap_documentos/'.$documento->ruta)))
      {
        Storage::disk('cap_documentos')->delete($documento->ruta);
        return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Documento borrado con exito!!');
       
      }
      else {
             return View::make('administrador.cosas.resultado_volver')->with('funcion', false)->with('mensaje', 'Hubo un error, No existe el documento');
        }  
    }

    public function editDoc(Request $request){
    	
    	$documento = CapDocumento::where('id','=',$request->id)->first();
    	

        if($request->file('archivo')!=null)
        {
            if(file_exists(storage_path('cap_documentos/'.$documento->ruta))){
            Storage::disk('cap_documentos')->delete($documento->ruta.'.xlsx');
            }
            $archivo = $request->file('archivo');        
            $nombre=$archivo->getClientOriginalName();          
            $this->filemanage($archivo,'cap_documentos');    
            $documento->ruta = $nombre;    
        }
    	

        $documento->titulo = $request->titulo;             
        
        $documento->save();
        return View::make('administrador.cosas.resultado_volver')->with('funcion', true)->with('mensaje', 'Documento editado con éxito!!');     
    }

    public function details($id){
    	
    	$usuarios = DB::select(DB::raw('select us.usu_nombres as nombre , us.usu_apellido1 as apellido , doc.updated_at as hora from capacitaciones_user_docs  as doc INNER JOIN  usuarios as us on doc.id_user=us.usu_id where doc.id_doc = '.$id.' ORDER BY hora desc'));
    	
    	return view::make('capacitacion.ajax.details',compact('usuarios'));
    }
}
