<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListBancos extends Model
{
	use SoftDeletes;
	
    protected $table = 'bancos';
}
