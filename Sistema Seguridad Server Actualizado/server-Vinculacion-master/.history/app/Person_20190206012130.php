<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * $table->increments('id');
     */
    protected $fillable = [
        'name',
        'last_name',
        'cellphone',
        'email',
        'password',
        'api_token'
    ];

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function tutor()
    {
        return $this->hasOne('App\Tutor');
    }

    public function coordinator()
    {
        return $this->hasOne('App\Coordinator');
    }

}
