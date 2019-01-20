<?php
//modelo no se necesita crearse en una carpeta 
namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class System extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // campos del modelo aceptas para se utilize los parámetros en BD
        'system_name', 'id_status'
    ];

    public function people() //Relacion de Muchos a muchos
    {
        return $this->belongsToMany('App\Person'); //Se relacionara de muchos a muchos con la clase person, al crear esto la tabla permisos se creara automaticamente
    }

    public function states() //Relacion de Muchos a muchos
    {
        return $this->hasMany('App\Person'); //Se relacionara de muchos a muchos con la clase person, al crear esto la tabla permisos se creara automaticamente
    }
}
