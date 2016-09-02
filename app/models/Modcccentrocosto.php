<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modcccentrocosto extends Model {
	public $timestamps = true;
	protected $table = 'cc_centro_costo';
	protected $primaryKey = 'cccc_id';
}