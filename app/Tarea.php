<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //
    protected $table = "tareas";

    protected $fillable = ['id','name','descripcion','totaldeHoras'];

    public function proyecto(){
        return $this->belongsTo('App\Proyecto');
    }

	public function horas(){
        return $this->hasMany('App\Hora');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
