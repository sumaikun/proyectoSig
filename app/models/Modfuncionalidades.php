<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modfuncionalidades extends Model {
	public $timestamps = false;
	protected $table = 'funcionalidades';
	protected $primaryKey = 'fun_id';
}