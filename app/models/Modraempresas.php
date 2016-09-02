<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modraempresas extends Model {
	public $timestamps = true;
	protected $table = 'ra_empresas';
	protected $primaryKey = 'raemp_id';
}