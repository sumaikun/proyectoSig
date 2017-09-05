<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvSeriales extends Model
{
    use SoftDeletes;
    protected $table = 'inventario_seriales';

    public function elemento(){

    	return $this->belongsTo('psig\models\InvElementos','id_elementos','id');
    }

    public function unidad(){

    	return $this->belongsTo('psig\models\InvUnidades','id_inventario_unidades','id');
    }
}
