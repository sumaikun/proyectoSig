<?php



namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvCategorias extends Model
{
  	use SoftDeletes;
    protected $table = 'categoria_elementos';
    
    
}
