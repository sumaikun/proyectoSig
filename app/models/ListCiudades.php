<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListCiudades extends Model
{
    use SoftDeletes;

    protected $table = 'ciudades';

    public function departamento(){

    	return $this->belongsTo('psig\models\ListDepartamentos','departamento_id');
    }
}
