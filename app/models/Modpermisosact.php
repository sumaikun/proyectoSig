<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modpermisosact extends Model
{
  	use SoftDeletes;
    protected $table = 'permisos_actividades';

      public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','user_id');
    }
}
