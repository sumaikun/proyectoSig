<?php  
/**
* 
*/
namespace psig\Helpers;

use psig\models\Modfuncionalidades;
use psig\models\Modpermisosfuncionalidades;
use psig\models\Modgddescargas;
use psig\models\Modgdregistros;
use psig\models\Modusuarios;
use psig\models\ModActividad;
use Session;
use DB;
use psig\models\ListEnterprises;

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

		$query = $table::withTrashed()->lists($id)->last();
		if($query!=null)
		{
			return $query+1;	
		}	
		else {
			return 1;
		} 
	}

//todas estas clases pertenecen a reportes

	public static function user_name($id){

		$user = Modusuarios::Where('usu_id','=',$id)->first();

		return $user->usu_nombres.' '.$user->usu_apellido1;

	}

	public static function ent_reports($id){
		$empresas = ModActividad::select(DB::raw('Distinct tp_empresa'))->where('usuario','=',$id)->get();
		return $empresas;
	}

	public static function ent_names($id){
		$empresa = ListEnterprises::Where('id','=',$id)->first();
		return $empresa->nombre;
	}

	public static function cal_month($id_usu,$id_ent,$date)
	{
		$total_horas = ModActividad::where('fecha',"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->sum('horas');
		$horas_especificas = ModActividad::where('fecha',"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->where('tp_empresa','=',$id_ent)->sum('horas');
		if($total_horas!=0)
		{return number_format(($horas_especificas*100)/$total_horas,2); }
		else {
			return 0.0;
		}	
		 
	}

	public static function cal_year($id_usu,$id_ent,$date)
	{
		$total_horas = ModActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->sum('horas');
		$horas_especificas = ModActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->where('tp_empresa','=',$id_ent)->sum('horas');
		if($total_horas!=0)
		{return number_format(($horas_especificas*100)/$total_horas,2); }
		else {
			return 0.0;
		}
	}


}
?>