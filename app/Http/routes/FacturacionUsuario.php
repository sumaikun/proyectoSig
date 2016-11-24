<?php

//-------------------------------------------------------------------------------------------    
  /*   _____               __                             .__               
_/ ____\____    _____/  |_ __ ______________    ____ |__| ____   ____  
\   __\\__  \ _/ ___\   __\  |  \_  __ \__  \ _/ ___\|  |/  _ \ /    \ 
 |  |   / __ \\  \___|  | |  |  /|  | \// __ \\  \___|  (  <_> )   |  \
 |__|  (____  /\___  >__| |____/ |__|  (____  /\___  >__|\____/|___|  /
            \/     \/                       \/     \/               \/  */
//-------------------------------------------------------------------------------------------    

Route::any('facturacion', function(){
   return View::make('facturacion.usuario.modulo_facturacion');
});

Route::get('facturacion/create', function(){
  if(Session::get('gene_factura')==null){
      return response(View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.'));
    }

  $empresas = psig\models\ListEnterprises::Where('cliente','=',1)->lists('nombre','id');
  $facturadoras = psig\models\ListEnterprises::Where('cliente','=',0)->lists('nombre','id');
  return View::make('facturacion.usuario.nuevafactura',array('empresas'=>$empresas,'facturadoras'=>$facturadoras));
   //return View::make('actividades.actividades');
});

Route::any('facturacion/list', function(){

  if(Session::get('obs_factura')==null){
      return response(View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.'));
    }

  if(strpos(URL::previous(),'list'))
  {
    $year = Input::get('year_list');
  }

  else
  {
    $year = date('Y');
  }


  	$registros = psig\models\Modfactura::orderBy('facturadora','desc')->orderBy('consecutivo','desc')->Where(DB::raw('YEAR(fecha_elaboracion)'),"LIKE",'%'.$year.'%')->get();

    foreach($registros as $registro)
    {
      //echo $registro->descripcion;
      //echo '<br>';
      $registro->con_iva = psig\Helpers\Metodos::factura($registro->descripcion,'con_iva');
      $registro->sin_iva = psig\Helpers\Metodos::factura($registro->descripcion,'sin_iva');
      $registro->valor_iva = ($registro->iva*$registro->con_iva)/100;
      $registro->total = (int)$registro->valor_iva+$registro->con_iva+$registro->sin_iva+$registro->reembolso;
    }  


    //return $registros;

    Session::put('usu_listy',$year);  
  
     return View::make('facturacion.usuario.listafacturas',array('registros'=> $registros));

});

Route::any('facturacion/parameters', function(){
  if(Session::get('ges_entidades')==null){
      return response(View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.'));
    }
     $departamentos = psig\models\ListDepartamentos::lists('nombre','id');
   $clientes = psig\models\ListEnterprises::Where('cliente','=',1)->OrderBy('nombre')->get();
   $empresas = psig\models\ListEnterprises::Where('cliente','=',0)->OrderBy('nombre')->get();
   return View::make('facturacion.usuario.entidades', array('empresas'=>$empresas,'clientes'=>$clientes,'departamentos'=>$departamentos));
});

Route::post('facturacion/registrarcliente', 'Confactura@createCli');

Route::post('facturacion/registrarempresa', 'Confactura@createEmp');

Route::get('facturacion/editEmp/{id}', 'Confactura@showEmp');

Route::post('facturacion/updateEmp','Confactura@updateEmp');

Route::post('facturacion/registrarfactura','Confactura@store');

Route::get('facturacion/cliente/{id}','Confactura@get_customer_info');

Route::get('facturacion/factura_info/{id}','Confactura@get_bill_info');

Route::any('facturacion/anular_factura/{id}','Confactura@anular');

Route::any('facturacion/pagar_factura/{id}','Confactura@pagar');

Route::get('facturacion/pagada_info/{id}','Confactura@pagar_info');

Route::get('facturacion/anulada_info/{id}','Confactura@anular_info');

Route::get('facturacion/descargar_factura/{id}','Confactura@download_bill');

Route::any('facturacion/test',function(){
  echo 'test';
  psig\Helpers\Metodos::exist_fac_permission(Session::get('usu_id'));
});
Route::get('facturacion/citys',function(){
   $ciudades = psig\models\ListCiudades::All();
        return view('facturacion.usuario.citys',compact('ciudades'));
});

Route::any('facturacion/crear_ciudad','Confactura@city_create');

Route::any('facturacion/editar_ciudad/{id}','Confactura@city_edit');

Route::get('facturacion/ciudades/{id}',function($id){
  $ciudades = psig\models\ListCiudades::where('departamento_id','=',$id)->get();
  return $ciudades;
});

Route::get('facturacion/accounts',function(){
        $bancos = psig\models\ListBancos::All();
        $cuentas = psig\models\ListCuentas::All();
        return view('facturacion.usuario.accounts',compact('bancos','cuentas'));
});

Route::post('facturacion/editBill','Confactura@edit');

Route::any('facturacion/crear_banco','Confactura@banco_create');

Route::any('facturacion/crear_cuenta','Confactura@cuenta_create');

Route::any('facturacion/editar_banco/{id}','Confactura@banco_edit');

Route::any('facturacion/editar_cuenta/{id}','Confactura@cuenta_edit');

Route::get('facturacion/cuentas/{id}','Confactura@cuenta_relations');

Route::get('facturacion/cuenta_info/{id}','Confactura@cuenta_info');

Route::any('facturacion/editar_pago/{id}','Confactura@edit_paid');

Route::any('facturacion/editar_cancel/{id}','Confactura@edit_nulled');

Route::any('facturacion/anexar_soporte/{id}','Confactura@add_support');

Route::get('facturacion/descargar_soporte/{file}',function($file){
  
  $file_path = storage_path('soporte/'.$file);
  if(file_exists($file_path))
  {return response()->download($file_path);}
  else{
    return 'el servidor tiene problemas con la verificacion de existencia de documentos';
  }
            
});

Route::get('facturacion/editarfactura/{id}',function($id){

  if(Session::get('gene_factura')==null){
      return response(View::make('cosas_generales.page_error')->with('mensaje', 'Área restringida.'));
    }

  $factura = psig\models\Modfactura::find($id);

  $products = array();

  $array = explode('|', $factura->descripcion);
   $size = count($array);

      for($i=0;$i<($size-1);$i++)
      {
        $string_pr = $array[$i];
        $product = explode('Ç', $string_pr);
        $pr = array('id'=>($i+1),'producto'=>$product[0],'cantidad'=>$product[1],'valor'=>$product[2],'iva'=>$product[3]);
        array_push($products, $pr);                 
      }
      

  $empresas = psig\models\ListEnterprises::Where('cliente','=',1)->lists('nombre','id');
  $facturadoras = psig\models\ListEnterprises::Where('cliente','=',0)->lists('nombre','id');
  return view('facturacion.usuario.editarfactura',compact('factura','empresas','facturadoras','products'));
  });