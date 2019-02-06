<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * $table->increments('id');
        $table->integer('career_id')->unsigned();
        $table->foreign('person_id')->references('id')->on('persons');
        $table->timestamps();
     */
    protected $fillable = [

    ];

    public function project()
    {
        return $this->hasOne('App\Project');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }


}
