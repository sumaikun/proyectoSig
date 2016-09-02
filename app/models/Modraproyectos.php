<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modraproyectos extends Model {
	public $timestamps = true;
	protected $table = 'ra_proyectos';
	protected $primaryKey = 'raproy_id';
}