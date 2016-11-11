<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListCuentas extends Model
{
	use SoftDeletes; 
    protected $table = 'cuentas';

     public function empresas(){

    	return $this->belongsTo('psig\models\ListEnterprises','fact_id','id');
    }
     public function bancos(){

    	return $this->belongsTo('psig\models\ListBancos','banco_id','id');
    }
}
