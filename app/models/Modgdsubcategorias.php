<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdsubcategorias extends Model {
	public $timestamps = false;
	protected $table = 'gd_subcategorias';
	protected $primaryKey = 'gdsub_id';



	public function documentos(){
		return $this->hasMany('psig\models\Modgddocumentos' , 'gdsub_id');
	}

	public function categorias(){
		return $this->belongsTo('psig\models\Modgdcategorias', 'gdcat_id');
	}
}