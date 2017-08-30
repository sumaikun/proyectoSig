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
use psig\models\modActividad;
use psig\models\Modfactura;
use psig\models\Modpermisosfac;
use psig\models\InvPermisos;
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
// generador de id y generador de consecutivos para facturacion

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

	public static function cons_generator($ent){

		$query = Modfactura::where('facturadora','=',$ent)->orderBy('id','desc')->first();
		
		if($query!=null)
		{
			return $query->consecutivo+1;	
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
		$empresas = modActividad::select(DB::raw('Distinct tp_empresa'))->where('usuario','=',$id)->get();
		return $empresas;
	}

	public static function ent_names($id){
		$empresa = ListEnterprises::Where('id','=',$id)->first();
		return $empresa->nombre;
	}

	public static function cal_month($id_usu,$id_ent,$date)
	{
		$total_horas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->sum('horas');
		$horas_especificas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->where('tp_empresa','=',$id_ent)->sum('horas');
		if($total_horas!=0)
		{return number_format(($horas_especificas*100)/$total_horas,2); }
		else {
			return 0.0;
		}	
		 
	}

	public static function hr_month($id_usu,$id_ent,$date)
	{		
		$horas_especificas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->where('tp_empresa','=',$id_ent)->sum('horas');
		return (int)$horas_especificas;			
		 
	}

	public static function total_hr_month($id_usu,$date)
	{		
		$total_horas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->sum('horas');
		return (int)$total_horas;		 
	}

	public static function avr_hr_month($id_usu,$date,$year)
	{	
		$total_año = modActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$year.'%')->Where('usuario','=',$id_usu)->sum('horas');	
		$total_mes = modActividad::where('fecha',"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->sum('horas');
		if($total_año!=0)
		{return number_format(($total_mes*100)/$total_año,2); }
		else {
			return 0.0;
		}			 
	}

	public static function cal_year($id_usu,$id_ent,$date)
	{
		$total_horas = modActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->sum('horas');
		$horas_especificas = modActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->where('tp_empresa','=',$id_ent)->sum('horas');
		if($total_horas!=0)
		{return number_format(($horas_especificas*100)/$total_horas,2); }
		else {
			return 0.0;
		}
	}

	public static function hr_year($id_usu,$id_ent,$date)
	{
		$horas_especificas = modActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->where('tp_empresa','=',$id_ent)->sum('horas');
		return (int)$horas_especificas;
	}

	public static function total_hr_year($id_usu,$date)
	{		
		$total_horas = modActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->Where('usuario','=',$id_usu)->sum('horas');
		return (int)$total_horas;		 
	}

	public static function hr_month_total_ent($id_ent,$date)
	{		
		$horas_especificas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->where('tp_empresa','=',$id_ent)->sum('horas');
		return (int)$horas_especificas;			
		 
	}

	public static function hr_month_per_ent($id_ent,$date)
	{
		$total_horas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->sum('horas');
		$horas_especificas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->where('tp_empresa','=',$id_ent)->sum('horas');
		if($total_horas!=0)
		{return number_format(($horas_especificas*100)/$total_horas,2); }
		else {
			return 0.0;
		}			
		 
	}

	public static function hr_year_per_ent($id_ent,$date)
	{
		$total_horas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->sum('horas');
		$horas_especificas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->where('tp_empresa','=',$id_ent)->sum('horas');
		if($total_horas!=0)
		{return number_format(($horas_especificas*100)/$total_horas,2); }
		else {
			return 0.0;
		}			
		 
	}

	public static function hr_month_all_ent($date)
	{		
		$horas_especificas = modActividad::where('fecha',"LIKE",'%'.$date.'%')->sum('horas');
		return (int)$horas_especificas;			
		 
	}

	public static function hr_year_total_ent($id_ent,$date)
	{
		$horas_especificas = modActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->where('tp_empresa','=',$id_ent)->sum('horas');
		return (int)$horas_especificas;
	}	

	public static function hr_year_all_ent($date)
	{
		$horas_especificas = modActividad::where(DB::raw('YEAR(fecha)'),"LIKE",'%'.$date.'%')->sum('horas');
		return (int)$horas_especificas;
	}

	public static function double_enterprises($enterprise,$int)
	{
		$check = ListEnterprises::Where('nombre','LIKE','%'.$enterprise->name.'%')->where('nit','=',$enterprise->nit)->get();
		$count = ListEnterprises::Where('nombre','LIKE','%'.$enterprise->name.'%')->where('nit','=',$enterprise->nit)->count();

		 
		if ($int==1)
		{
			if($count>0)
			{
				return true;
			}
			else
			{
				return false;
			}	
		}
		elseif($int==2)
		{
			if($count>1)
			{
				return true;
			}			
			elseif($count==1&&$check[0]->id!=$enterprise->id)
			{
				return true;
			}
			else
			{
				return false;
			}	
		}	
	}

	//elementos de la factura
	public  static function factura($cadena,$parametro){

        $array = explode('|', $cadena);
        //print_r($array);
        $size = count($array);
        //echo('tamaño: '.$size);
        $resultado = 0; 
       
          
          for($i=0;$i<($size-1);$i++)
          {
            $string_pr = $array[$i];
            //echo('string :'.$string_pr);
            $product = explode('Ç', $string_pr);
            //return $product[3];
            //print_r($product);

              	if($parametro == 'con_iva')
              	{
              		if($product[3]=='con')
              		{
              			$resultado = $resultado + ($product[1]*$product[2]); 
              		}	
              	}
            	elseif ($parametro == 'sin_iva') {
            		if($product[3]=='sin')
              		{
              			$resultado = $resultado + ($product[1]*$product[2]); 
              		}			
    			}
          }
          return $resultado;      
   
     
    } 

    public static function exist_fac_permission($id){
    	$query = Modpermisosfac::where('user_id','=',$id)->first();
    	//echo $query;
    	if($query!=null)
    	{
	    	$array = explode(',', $query->permisos);
	    	if(in_array('gene_factura', $array)){
	    		 Session::put('gene_factura','gene_factura'); 
	    	}
	    	if(in_array('obs_factura', $array)){
	    		 Session::put('obs_factura','obs_factura'); 
	    	}
	    	if(in_array('ver_pago', $array)){
	    		 Session::put('ver_pago','ver_pago'); 
	    	}	    	
	    	if(in_array('ges_entidades', $array)){
	    		 Session::put('ges_entidades','ges_entidades'); 
	    	}
	    	if(in_array('ges_cuentas', $array)){
	    		 Session::put('ges_cuentas','ges_cuentas'); 
	    	}
	    	if(in_array('ges_ciudades', $array)){
	    		 Session::put('ges_ciudades','ges_ciudades'); 
	    	}
    	
    		return true;	
    	}
    
    	
    }


    public static function exist_inv_permission($id){
    	$query = InvPermisos::where('usuario','=',$id)->first();
    	//echo $query;
    	if($query!=null)
    	{
	    	$array = explode(',', $query->permisos);
	    	if(in_array('inventario_crear', $array)){
	    		 Session::put('inventario_crear','inventario_crear'); 
	    	}
	    	if(in_array('inventario_editar', $array)){
	    		 Session::put('inventario_editar','inventario_editar'); 
	    	}
	    	if(in_array('inventario_eliminar', $array)){
	    		 Session::put('inventario_eliminar','inventario_eliminar'); 
	    	}	    	
	    	if(in_array('observar_alquileres', $array)){
	    		 Session::put('observar_alquileres','observar_alquileres'); 
	    	}
	    	if(in_array('cambiar_alquileres', $array)){
	    		 Session::put('cambiar_alquileres','cambiar_alquileres'); 
	    	}
	    	if(in_array('ges_ciudades', $array)){
	    		 Session::put('observar_mantenimiento','observar_mantenimiento'); 
	    	}
	    	if(in_array('ges_ciudades', $array)){
	    		 Session::put('cambiar_mantenimiento','cambiar_mantenimiento'); 
	    	}
	    	if(in_array('ges_ciudades', $array)){
	    		 Session::put('ver_alertas','ver_alertas'); 
	    	}
	    	if(in_array('crear_consumibles', $array)){
	    		 Session::put('crear_consumibles','crear_consumibles'); 
	    	}
	    	if(in_array('man_consumibles', $array)){
	    		 Session::put('man_consumibles','man_consumibles'); 
	    	}
    	
    		return true;	
    	}
    
    	
    }

    public static function asDollars($value) {
  		return '$' . number_format($value, 0);
	}
}
?>