<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class modActividad extends Model
{
    use SoftDeletes;
    protected $table = 'reg_actividades';
}
