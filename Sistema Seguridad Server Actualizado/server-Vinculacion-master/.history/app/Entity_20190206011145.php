<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * $table->increments('id');
     */
    protected $fillable = [
        'name',
        'web_address',
        'email',
        'phone'
    ];

    public function entity_type()
    {
        return $this->belongsTo('App\Entity_type');
    }

    public function project()
    {
        return $this->hasOne('App\Project');
    }
}
