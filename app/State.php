<?php
//modelo no se necesita crearse en una carpeta 
namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class State extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;


    protected $fillable = [ // campos del modelo aceptas para se utilize los parámetros en BD
        'status_people', 'status_system'
    ];

    protected $hidden = [
    ];

    public function rol()//plural
    {
        return $this->belongsToMany('App\Role')->withTimestamps();//varios a variosfecha de creaccion y modificacion
    }//whithTime afecta en la migracion

    public function systems()
    {
        return $this->belongsToMany('App\System');
    }

}


