<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modrareportes extends Model {
	public $timestamps = true;
	protected $table = 'ra_reportes';
	protected $primaryKey = 'rarepo_id';
}