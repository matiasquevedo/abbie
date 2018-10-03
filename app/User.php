<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function actividades(){
        return $this->hasMany('App\Actividad');
    }

    public function pedidos(){
        return $this->hasMany('App\Pedido');
    }

    public function paquetes(){
        return $this->hasMany('App\Paquete');
    }

    public function informacion(){
        return $this->hasMany('App\Informacion');
    }

    public function eventos(){
        return $this->hasMany('App\Evento');
    }

    public function tareas(){
        return $this->hasMany('App\Tarea');
    }

    public function horas(){
        return $this->hasMany('App\Hora');
    }

    public function nova(){
        return $this->type === 'nuevo';
    }

    public function admin(){
        return $this->type === 'admin';
    }

    public function member(){
        return $this->type === 'member';
    }

    public function eventista(){
        return $this->type === 'even';
    }

    public function revisor(){
        return $this->type === 'revisor';
    }

    public function ventas(){
        return $this->type === 'ventas';
    }

}