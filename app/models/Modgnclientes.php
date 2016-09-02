<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgnclientes extends Model {
	public $timestamps = true;
	protected $table = 'gn_clientes';
	protected $primaryKey = 'gncli_id';
}