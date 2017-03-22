<?php

//-------------------------------------------------------------------------------------------    
/*                                  .__  __                .__               
  ____ _____  ___________    ____ |__|/  |______    ____ |__| ____   ____  
_/ ___\\__  \ \____ \__  \ _/ ___\|  \   __\__  \ _/ ___\|  |/  _ \ /    \ 
\  \___ / __ \|  |_> > __ \\  \___|  ||  |  / __ \\  \___|  (  <_> )   |  \
 \___  >____  /   __(____  /\___  >__||__| (____  /\___  >__|\____/|___|  /
     \/     \/|__|       \/     \/              \/     \/               \/
//-------------------------------------------------------------------------------------------*/    

Route::any('capacitacion', function(){

   return View::make('capacitacion.admin.modulo_capacitacion');
});

Route::get('capacitacion/create', function(){


   return View::make('capacitacion.admin.create');
});

Route::get('capacitacion/list', function(){

   $documentos = psig\models\CapDocumento::All(); 
   return View::make('capacitacion.admin.list',compact('documentos'));
});

Route::post('capacitacion/addDocumento','Concapacitacion@createDoc');

Route::get('capacitacion/downloaddocumento/{document}/{foid}','Concapacitacion@download');

Route::get('capacitacion/deletedoc/{foid}','Concapacitacion@delete_doc');

Route::get('capacitacion/detalles_doc/{id}','Concapacitacion@details');

Route::post('capacitacion/editDocumento','Concapacitacion@editDoc');