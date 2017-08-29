<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class InvConsumibles extends Model
{
    use SoftDeletes;

    protected $table = 'inventario_consumibles';
}
