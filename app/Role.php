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
        'description',
        'role',
        'state',
    ];

    //campos modelo sin id sin foreinng y timestamps

    public function users()//plural
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
