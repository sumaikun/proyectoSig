<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdconsecutivos extends Model {
	public $timestamps = false;
	protected $table = 'gd_consecutivos';
	protected $primaryKey = 'gdcon_id';



	public function documentos(){
		return $this->belongsTo('psig\models\Modgddocumentos', 'gddoc_id');
	}

	public function registro(){
		return $this->hasOne('psig\models\Modgdregistros', 'gdcon_id');
	}
}