<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imagesInformacion extends Model
{
    //
    protected $table = "imagesInformacion";

    protected $fillable = ['foto','informacion_id'];

    public function informacion(){
    	return $this->belongsTo('App\Informacion');
    }
}
