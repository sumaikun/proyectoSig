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
   return View::make('facturacion.admin.modulo_facturacion');
});

Route::get('facturacion/create', function(){
  $empresas = psig\models\ListEnterprises::Where('cliente','=',1)->lists('nombre','id');
  $facturadoras = psig\models\ListEnterprises::Where('cliente','=',0)->lists('nombre','id');
  return View::make('facturacion.admin.nuevafactura',array('empresas'=>$empresas,'facturadoras'=>$facturadoras));
   //return View::make('actividades.actividades');
});

Route::any('facturacion/list', function(){

  //return 'tomala bitch';
  if(strpos(URL::previous(),'list'))
  {
    $year = Input::get('year_list');
  }

  else
  {
    $year = date('Y');
  }


  	$registros = psig\models\Modfactura::orderBy('fecha_elaboracion','desc')->Where(DB::raw('YEAR(fecha_elaboracion)'),"LIKE",'%'.$year.'%')->get();

    foreach($registros as $registro)
    {
      //echo $registro->descripcion;
      //echo '<br>';
      $registro->con_iva = psig\Helpers\Metodos::factura($registro->descripcion,'con_iva');
      $registro->sin_iva = psig\Helpers\Metodos::factura($registro->descripcion,'sin_iva');
      $registro->valor_iva = ($registro->iva*$registro->con_iva)/100;
      $registro->total = $registro->valor_iva+$registro->con_iva+$registro->sin_iva+$registro->reembolso;
    }  


    //return $registros;

    Session::put('usu_listy',$year);  
  
    Session::put('usu_exportactividades',$registros);  
     return View::make('facturacion.admin.listafacturas',array('registros'=> $registros));

});

Route::any('facturacion/parameters', function(){
    
   $empresas = psig\models\ListEnterprises::Where('cliente','=',0)->OrderBy('nombre')->get();
   $clientes = psig\models\ListEnterprises::Where('cliente','=',1)->OrderBy('nombre')->get();
   return View::make('facturacion.admin.entidades', array('empresas'=>$empresas,'clientes'=>$clientes));
});

Route::post('facturacion/registrarcliente', 'Confactura@createCli');

Route::post('facturacion/registrarempresa', 'Confactura@createEmp');

Route::get('facturacion/editEmp/{id}', 'Confactura@showEmp');

Route::post('facturacion/updateEmp','Confactura@updateEmp');

Route::post('facturacion/registrarfactura','Confactura@store');

Route::get('facturacion/excel', function(){
   $usuarios = psig\models\Modusuarios::OrderBy('usu_nombres')->get();
   return View::make('facturacion.admin.excel',compact('usuarios'));
});


Route::any('facturacion/reports',function(){
  if(strpos(URL::previous(),'reports'))
  {
    $year = Input::get('year_list');
  }

  else
  {
    $year = date('Y');
  } 

  $empresas = psig\models\ListEnterprises::OrderBy('nombre')->get();
  $usuarios = psig\models\modActividad::Select(DB::raw('DISTINCT usuario'))->get();
  
  return View::make('facturacion.admin.reports',compact('empresas','usuarios','year'));
});

Route::get('facturacion/cliente/{id}','Confactura@get_customer_info');

Route::get('facturacion/factura_info/{id}','Confactura@get_bill_info');

Route::any('facturacion/anular_factura/{id}','Confactura@anular');

Route::any('facturacion/pagar_factura/{id}','Confactura@pagar');

Route::get('facturacion/pagada_info/{id}','Confactura@pagar_info');

Route::get('facturacion/anulada_info/{id}','Confactura@anular_info');
