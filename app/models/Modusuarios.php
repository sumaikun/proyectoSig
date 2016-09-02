<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Modusuarios extends Model implements AuthenticatableContract, CanResetPasswordContract{

	use  Authenticatable,CanResetPassword;

	public $timestamps = true;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';
	protected $primaryKey = 'usu_id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function documentos(){
		return $this->hasMany('psig\models\Modgdocumentos', 'usu_id');
	}

	public function roles(){
		return $this->belongsTo('psig\models\Modroles', 'rol_id');
	}

	public function cargos(){
		return $this->belongsTo('psig\models\Modcargos', 'carg_id');
	}

	public function dependencias(){
		return $this->belongsTo('psig\models\Moddependencias', 'depe_id');
	}
}