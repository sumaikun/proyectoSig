<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;

class Modccconsecutivos extends Model {

	
	protected $table = 'cc_consecutivos';
	protected $primaryKey = 'ccco_id';


	public function gncliente(){
		return $this->belongsTo('psig\models\Modgnclientes', 'gncli_id');
	}

	public function centrocosto(){
		return $this->belongsTo('psig\models\Modcccentrocosto', 'cccc_id');
	}

	public function cccontacto(){
		return $this->belongsTo('psig\models\Modcccontactos', 'cccnt_id');
	}

	public function usuairo(){
		return $this->belongsTo('psig\models\Modusuarios', 'usu_id');
	}
}