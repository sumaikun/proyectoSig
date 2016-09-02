<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdregistros extends Model {
	public $timestamps = false;
	protected $table = 'gd_registros';
	protected $primaryKey = 'gdreg_id';


	public function versiones(){
		return $this->belongsTo('psig\models\Modgdversiones', 'gdver_id');
	}

	public function documentos(){
		return $this->belongsTo('psig\models\Modgddocumentos', 'gddoc_id');
	}

	public function consecutivos(){
		return $this->belongsTo('psig\models\Modgdconsecutivos', 'gdcon_id');
	}

	public function usuarios(){
		return $this->belongsTo('psig\models\Modusuarios', 'usu_id');
	}

	public function permisos(){
		return $this->hasMany('psig\models\Modgdpermisosregistros' , 'gdreg_id');
	}


}