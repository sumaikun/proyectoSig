<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modcccontactos extends Model {
	public $timestamps = true;
	protected $table = 'cc_contactos';
	protected $primaryKey = 'cccnt_id';
}