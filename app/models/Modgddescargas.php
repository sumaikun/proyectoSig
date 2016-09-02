<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgddescargas extends Model {
	public $timestamps = false;
	protected $table = 'gd_descargas';
	protected $primaryKey = 'gddes_id';
}