<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{

    protected $table = "informaciones";

    protected $fillable = ['title','descripcion','category_id','user_id'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function images(){
    	return $this->hasMany('App\imagesInformacion');
    }

}
