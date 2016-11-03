<?php

namespace psig\models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Modfac_pagada extends Model
{
    use SoftDeletes;
    protected $table = 'pagada_factura';

    public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','user');
    }
}
