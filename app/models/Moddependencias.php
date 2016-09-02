<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Moddependencias extends Model {
	public $timestamps = false;
	protected $table = 'dependencia';
	protected $primaryKey = 'depe_id';
}