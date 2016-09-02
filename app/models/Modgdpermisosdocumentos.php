<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdpermisosdocumentos extends Model {
	public $timestamps = false;
	protected $table = 'gd_permisos_documentos';
	protected $primaryKey = 'gdperdoc_id';



	public function usuarios(){
		return $this->belongsTo('psig\models\Modusuarios', 'usu_id');
	}
}