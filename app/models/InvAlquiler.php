<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvAlquiler extends Model
{
    use SoftDeletes;

    protected $table = 'inventario_alquiler';

    public function serial(){

    	return $this->belongsTo('psig\models\InvSeriales','id_serial','id');
    }

    public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','id_usuario','usu_id');
    }
}
