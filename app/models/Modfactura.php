<?php

namespace psig\models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Modfactura extends Model
{
	use SoftDeletes;
    protected $table = 'factura';

   public function facturadoras(){

    	return $this->belongsTo('psig\models\ListEnterprises','facturadora');
    }

    public function clientes(){

    	return $this->belongsTo('psig\models\ListEnterprises','cliente');
    }

   public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','user');
    }

    public function cuentas(){

        return $this->belongsTo('psig\models\ListCuentas','cuenta');
    }
}
