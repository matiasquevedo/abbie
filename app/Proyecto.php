<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $table = "proyectos";

    protected $fillable = ['id','name','precio','totaldeHoras','precioTotal'];

    public function tareas(){
        return $this->hasMany('App\Tarea');
    }

    public function horas(){
        return $this->hasMany('App\Hora');
    }
}
