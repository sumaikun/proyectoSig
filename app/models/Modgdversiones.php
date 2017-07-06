<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdversiones extends Model {
	public $timestamps = false;
	protected $table = 'gd_versiones';
	protected $primaryKey = 'gdver_id';


	public function empresas(){
		return $this->hasone('psig\models\ListEnterprises', 'id','empresa');		
	}


	public function documento(){
		return $this->belongsTo('psig\models\Modgddocumentos', 'gddoc_id');
	}
}