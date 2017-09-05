<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvUnidades extends Model
{
    use SoftDeletes;
    protected $table = 'inventario_unidades';
}
