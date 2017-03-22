<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CapRegister extends Model
{
    use SoftDeletes;
    protected $table = 'capacitaciones_user_docs';
}
