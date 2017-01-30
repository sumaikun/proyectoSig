<?php

namespace psig\Http\Controllers;

use Illuminate\Http\Request;

use psig\Http\Requests;

use psig\models\InvCategorias;

use psig\Helpers\Metodos;

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
}
