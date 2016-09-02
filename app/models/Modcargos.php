<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;


class Modcargos extends Model {
	public $timestamps = false;
	protected $table = 'cargos';
	protected $primaryKey = 'carg_id';
}