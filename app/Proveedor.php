<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = "proveedores";

    protected $fillable = ['empresa','name','email','telefono'];

    public function actividades(){
        return $this->hasMany('App\Actividad');
    }

	public function horas(){
        return $this->hasMany('App\Hora');
    }

}
