<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

}
