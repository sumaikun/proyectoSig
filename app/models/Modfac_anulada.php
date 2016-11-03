<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modfac_anulada extends Model
{
	use SoftDeletes;
    protected $table = 'anulada_factura';

    public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','user');
    }
}
