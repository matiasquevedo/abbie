<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = "items";

    protected $fillable = ['id','pedido_id','actividad_id'];

    public function pedido(){
    	return $this->belongsTo('App\Pedido');
    }

    public function actividad(){
    	return $this->belongsTo('App\Actividad');
    }

}
