<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvComponentes extends Model
{
	use SoftDeletes;
    protected $table = 'inventario_componentes';
}
