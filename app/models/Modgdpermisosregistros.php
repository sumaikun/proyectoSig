<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdpermisosregistros extends Model {
	public $timestamps = false;
	protected $table = 'gd_permisos_registros';
	protected $primaryKey = 'gdperreg_id';


	public function registros(){
		return $this->belongsTo('psig\models\Modgdregistros', 'gdreg_id');
	}

	public function usuarios(){
		return $this->belongsTo('psig\models\Modusuarios', 'usu_id');
	}
}