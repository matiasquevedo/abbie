<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadPaquete extends Model
{
    //
    protected $table = "actividadPaquete";

    protected $fillable = ['paquete_id','actividad_id'];

    public function paquete(){
    	return $this->belongsTo('App\Paquete');
    }

    public function actividad(){
    	return $this->belongsTo('App\Actividad');
    }
}



