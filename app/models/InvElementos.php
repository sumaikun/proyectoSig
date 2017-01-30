<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InvElementos extends Model
{
    use SoftDeletes;

    protected $table = 'inventario_elementos';

     public function categoria(){

    	return $this->belongsTo('psig\models\InvCategorias','categoria','id');
    }
}
