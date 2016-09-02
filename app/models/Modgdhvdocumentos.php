<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdhvdocumentos extends Model {
	public $timestamps = true;
	protected $table = 'gdhv_documentos';
	protected $primaryKey = 'gdhv_id';



	public function versiones(){
		return $this->hasMany('psig\models\Modgdversiones', 'gddoc_id');
	}
}