<?php
//modelo no se necesita crearse en una carpeta 
namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Resource extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $fillable = [ // campos del modelo aceptas para se utilize los parámetros en BD
        'url'
    ];

    protected $hidden = [ //al momento de realizar una consulta el campo password no se visualiza

    ];

    public function roles() //Relacion de Muchos a muchos
    {
        return $this->belongsToMany('App\Role'); //Se relacionara de muchos a muchos
    }
}
