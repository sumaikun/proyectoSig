<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class InvRepSeg extends Model
{
     protected $table = 'inventario_reparacion_seguimiento';
     public $timestamps = false;
     public function usuarios(){
    	return $this->belongsTo('psig\models\Modusuarios','usuario');
    }

}
