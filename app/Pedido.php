<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $table = "pedidos";

    protected $fillable = ['id','user_id','precioTotal','status','items'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }

}
