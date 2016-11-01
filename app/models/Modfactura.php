<?php

namespace psig\models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Modfactura extends Model
{
	use SoftDeletes;
    protected $table = 'factura';
}
