<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgeofertas extends Model {
	public $timestamps = true;
	protected $table = 'ge_ofertas';
	protected $primaryKey = 'geofer_id';



	public function usuarios(){
		return $this->belongsTo('psig\models\Modusuarios', 'usu_id');
	}
}