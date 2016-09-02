<?php 

//-----------------------------------------------------------------------------------------------------
//   ____      _      ____    ____    ___   __  __      _                  _   _   ____    _   _ 
//  / ___|    / \    / ___|  / ___|  |_ _| |  \/  |    / \                | | | | / ___|  | | | |
// | |       / _ \   \___ \  \___ \   | |  | |\/| |   / _ \      _____    | | | | \___ \  | | | |
// | |___   / ___ \   ___) |  ___) |  | |  | |  | |  / ___ \    |_____|   | |_| |  ___) | | |_| |
//  \____| /_/   \_\ |____/  |____/  |___| |_|  |_| /_/   \_\              \___/  |____/   \___/ 
//-----------------------------------------------------------------------------------------------------                                                                                               


Route::any('cassima', array('before' => 'sfun:cassima', function(){  
    return View::make('usuarios.cassima.cassima');
}));

 


/***************************************** ACTUALIZACION HV ***********************************/

//carga la vista principal de la actualizacion de la hoja de vida
Route::any('hvdocumento', array('before' => 'sfun:cassima', 'uses' => 'Congdhvdocumentos@index'));

// busca la informacion de la hoja de vida de un documento 
Route::post('buscar_hv_doc', array('before' => 'sfun:cassima', 'uses' => 'Congdhvdocumentos@show'));

// esta ruta es para registrar o actualizar la hv de un documento
Route::post('save_hv_doc', array('before' => 'sfun:cassima', 'uses' => 'Congdhvdocumentos@create'));

/***********************************************************************************************/