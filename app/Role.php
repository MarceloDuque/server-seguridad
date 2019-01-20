<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id-person',
        'id_status',
        'rol_name',
    ];

    public function resources()
    {
        return $this->belongsToMany('App\Resource');
    }

    public function person() //Relacion de Muchos a muchos
    {
        return $this->belongsToMany('App\Role'); //Se relacionara de muchos a muchos
    }

    public function state() //Relacion de Muchos a muchos
    {
        return $this->hasMany('App\Status'); //Se relacionara de muchos a muchos
    }
}
