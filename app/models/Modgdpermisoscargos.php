<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdpermisoscargos extends Model {
	public $timestamps = true;
	protected $table = 'gd_permisos_cargos';
	protected $primaryKey = 'gdpercarg_id';
}