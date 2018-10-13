<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = "actividades";

    protected $fillable = ['id','title','volanta','duracion','largo','descripcion','category_id','user_id','recomendacion','proveedor_id','precioPublico','precioProveedor','descuento'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function images(){
    	return $this->hasMany('App\Image');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function actividadPaquete(){
        return $this->hasMany('App\ActividadPaquete');
    }

    public function scopePost($query){
        return $query->where('state',1);
    }
}
