<?php


namespace psig\models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Modpermisosfac extends Model
{
    use SoftDeletes;
    protected $table = 'factura_permisos';

      public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','user_id');
    }
}
