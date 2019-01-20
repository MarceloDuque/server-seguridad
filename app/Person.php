<?php
//modelo no se necesita crearse en una carpeta 
namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Person extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // campos del modelo aceptas para se utilize los parámetros en BD
        'name'
    ];

    public function Account()
    {
    return $this->hasOne('App\Account');//relación usuario se relaciona con un profesional uno a uno
    } //el padre tiene hasOne

    public function systems() //Relacion de Muchos a muchos
    {
        return $this->belongsToMany('App\State');
    }

    public function roles() //Relacion de Muchos a muchos
    {
        return $this->hasMany('App\Role');
    }
}