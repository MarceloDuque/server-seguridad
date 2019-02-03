<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity',
        'first_name',
        'last_name',
        'email',
        'nationality',
        'civil_state',
        'birthdate',
        'gender',
        'phone',
        'address',
        'state',
    ];


    public function companies()
    {
        return $this->belongsToMany('App\Company')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
