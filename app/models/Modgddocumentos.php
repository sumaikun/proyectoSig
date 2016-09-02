<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgddocumentos extends Model {
	public $timestamps = false;
	protected $table = 'gd_documentos';
	protected $primaryKey = 'gddoc_id';

	public function subcategorias(){
		return $this->belongsTo('psig\models\Modgdsubcategorias', 'gdsub_id');
	}

	public function usuarios(){
		return $this->belongsTo('psig\models\Modusuarios', 'usu_id');
	}

	public function versiones(){
		return $this->hasMany('psig\models\Modgdversiones' , 'gddoc_id');
	}

	public function consecutivos(){
		return $this->hasMany('psig\models\Modgdconsecutivos', 'gddoc_id');
	}

	public function hojavida(){
        return $this->hasOne('psig\models\Modgdhvdocumentos', 'gddoc_id');
    }
}