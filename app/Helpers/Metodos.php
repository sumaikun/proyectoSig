<?php  
/**
* 
*/
namespace psig\Helpers;

class Metodos{


	public static function cc_armar_consecutivo($prefijo,$numero){
		$numero = $numero +1;

		$aux = null;
		switch (strlen($numero)) {
		   case 0:
		        $aux=$prefijo."-0000-".date("y");
		   break;
		   case 1:
		        $aux=$prefijo."-000".$numero."-".date("y");
		   break;
		   case 2:
		        $aux=$prefijo."-00".$numero."-".date("y");
		   break;
		   case 3:
		        $aux=$prefijo."-0".$numero."-".date("y");
		   break;
		   case 4:
		        $aux=$prefijo."-".$numero."-".date("y");
		   break;
		}

		return $aux;
	}



	
	public static function arma_y_suma_cons($numero){
		$numero = $numero +1;

		$aux = null;
		switch (strlen($numero)) {
		   case 0:
		        $aux="0000-".date("y");
		   break;
		   case 1:
		        $aux="000".$numero."-".date("y");
		   break;
		   case 2:
		        $aux="00".$numero."-".date("y");
		   break;
		   case 3:
		        $aux="0".$numero."-".date("y");
		   break;
		   case 4:
		        $aux=$numero."-".date("y");
		   break;
		}

		return $aux;
	}


	public static function download_file($archivo, $downloadfilename = null) {

    	if (file_exists($archivo)) {
        	$downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
        	header('Content-Description: File Transfer');
        	header('Content-Type: application/octet-stream');
        	header('Content-Disposition: attachment; filename=' . $downloadfilename);
        	header('Content-Transfer-Encoding: binary');
        	header('Expires: 0');
        	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        	header('Pragma: public');
        	header('Content-Length: ' . filesize($archivo));

        	ob_clean();
        	flush();
        	readfile($archivo);
        	exit;
    	}
	
	}



	public static function quitar_tildes($cadena) {
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹","Ñ","à","è","ì","ò","ù");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","N","a","e","i","o","u");
		$texto = str_replace($no_permitidas, $permitidas ,$cadena);
	return $texto;
	}




	public static function registrar_permisos($idusuario) {
		$funciones = Modfuncionalidades::all();

		$permisos = Modpermisosfuncionalidades::where('usu_id', '=', $idusuario)->get();
		
		foreach ($funciones as $key => $value) {

			foreach ($permisos as $key => $per) {
				if($per->fun_id == $value->fun_id){
					Session::put($value->fun_nombre, $per->perfun_permiso);
				}
			}
		}
	}




	public static function registrar_descarga($idusuario, $iddocumento) {
		$descarga = new Modgddescargas();
			$descarga->usu_id = $idusuario;
			$descarga->gddoc_id = $iddocumento;
			$descarga->save();
	}
	
	public static function buscar_palabras($cadena, $palabras) {
		$result=false;
		foreach($palabras as $p){
		   if(strpos($cadena, $p) !== false){
		   	$result=true;
		      break;
		   }
		}
		return $result;
	}



	public static function obtener_usuario_de_un_registro($regid) {
		$registro = Modgdregistros::find($regid);
		$usuario = Modusuarios::find($registro->usu_id);
		return $usuario->usu_nombres." ".$usuario->usu_apellido1;
	}


	public static function id_generator($table,$id){

		$query = $table::lists($id)->last();
		if($query!=null)
		{
			return $query+1;	
		}	
		else {
			return 1;
		} 
	}



}
?>