<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListActivities extends Model
{
	use SoftDeletes;
    protected $table = 'lista_actividades';
    
}
