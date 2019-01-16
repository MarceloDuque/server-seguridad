<?php
//modelo no se necesita crearse en una carpeta 
namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // campos del modelo aceptas para se utilize los parámetros en BD
        'name', 'user_name', 'email', 'api_token', 'password', 'avatar', 'state',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ //al momento de realizar una consulta el campo password no se visualiza
        'password','name',
    ];

    public function roles()//plural
    {
        return $this->belongsToMany('App\Role')->withTimestamps();//varios a variosfecha de creaccion y modificacion
    }//whithTime afecta en la migracion

    public function professional()
    {
        return $this->hasOne('App\Professional');//relación usuario se relaciona con un profesional uno a uno
    } //el padre tiene hasOne
}
