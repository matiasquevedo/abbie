<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    //
    protected $table = "paquetes";

    protected $fillable = ['title','descripcion','precioCliente','descuento','fechaInicio','fechaTermino','user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function actividadPaquete(){
        return $this->hasMany('App\ActividadPaquete');
    }
}
