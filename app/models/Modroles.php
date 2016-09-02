<?php
namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modroles extends Model {
	public $timestamps = false;
	protected $table = 'roles';
	protected $primaryKey = 'rol_id';



	 public function usuarios(){
        return $this->hasMany('psig\models\Modusuarios', 'rol_id');
    }
}