<?php

namespace psig\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class modActividad extends Model
{
    use SoftDeletes;
    protected $table = 'reg_actividades';

    public function actividades(){

    	return $this->belongsTo('psig\models\ListActivities','tp_actividad');
    }

    public function empresas(){

    	return $this->belongsTo('psig\models\ListEnterprises','tp_empresa');
    }

    public function propias(){

        return $this->belongsTo('psig\models\ListEnterprises','tp_propia');
    }

   public function usuarios(){

    	return $this->belongsTo('psig\models\Modusuarios','usuario');
    }
}
