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
        $table->string('name');
        $table->string('lastname');
        $table->string('dni');
        $table->string('age');
        $table->string('address');
        $table->string('cellphone');
        $table->string('email');
        $table->timestamps();
     */
    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'age',
        'address',
        'cellphone',
        'email'
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
