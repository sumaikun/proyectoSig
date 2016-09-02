<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modgdcategorias extends Model {

	public $timestamps = false;
	protected $table = 'gd_categorias';
	protected $primaryKey = 'gdcat_id';



	public function subcategorias(){
		return $this->hasMany('psig\models\Modgdsubcategorias');
	}


	public function documentos(){
        return $this->hasManyThrough('psig\models\Modgddocumentos', 'Modgdsubcategorias');
    }

}