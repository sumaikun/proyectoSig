<?php


//CARGA EL FORMULARIO PARA DILIGENCIAR EL REPORTE DIARIO DE ACTIVIDADES
Route::any('reporte_actividades', function(){  
	$empresas = psig\models\Modraempresas::orderby('raemp_empresa')->get();
	$actividades = psig\models\Modraactividades::orderby('racct_actividad')->get();
    return View::make('usuarios.reporte.reporte', array('empresas' => $empresas, 'actividades' => $actividades));
}); 

Route::post('ra_buscar_proyecto', 'Conraproyectos@store_json');

Route::post('ra_send_reporte', 'Conrareportes@create');







// Administracion

Route::any('admin_reporte', function(){  
	// $empresas = Modraempresas::orderby('raemp_empresa')->get();
	// $actividades = Modraactividades::orderby('raact_actividad')->get();
    return View::make('usuarios.reporte.admin.admin');
});