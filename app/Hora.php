<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    //
        protected $table = "horas";
        
        protected $fillable = ['id','name','descripcion','horas','fecha','user_id','proyecto_id','tarea_id'];

        public function proyecto(){
            return $this->belongsTo('App\Proyecto');
        }

    	public function tarea(){
            return $this->belongsTo('App\Tarea');
        }

        public function user(){
            return $this->belongsTo('App\User');
        }
}
