<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['name'];

    public function actividades(){
    	return $this->hasMany('App\Actividad');
    }

    public function informaciones(){
        return $this->hasMany('App\Informacion');
    }
}
