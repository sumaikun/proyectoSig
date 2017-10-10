<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvReparacion extends Model
{
    use SoftDeletes;
    protected $table = 'inventario_reparacion';

    public function serial(){

    	return $this->belongsTo('psig\models\InvSeriales','id_serial','id');
    }

    public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','id_usuario','usu_id');
    }
}
