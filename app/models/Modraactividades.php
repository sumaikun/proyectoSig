<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modraactividades extends Model {
	public $timestamps = true;
	protected $table = 'ra_actividades';
	protected $primaryKey = 'raact_id';
}