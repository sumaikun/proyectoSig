<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CapDocumento extends Model
{    
    use SoftDeletes;
    protected $table = 'capacitaciones_documento';
}
