<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modpermisosfuncionalidades extends Model {
	public $timestamps = false;
	protected $table = 'permisos_funcionalidades';
	protected $primaryKey = 'perfun_id';
}