<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * $table->increments('id');
        $table->integer('career_id')->unsigned();
        $table->foreign('career_id')->references('id')->on('careers');
        $table->integer('person_id')->unsigned();
        $table->foreign('person_id')->references('id')->on('persons');
        $table->increments('level');
        $table->timestamps();
     */
    protected $fillable = [
        'level'
    ];

    public function project()
    {
        return $this->hasOne('App\Project');
    }

    public function career()
    {
        return $this->belongsTo('App\Career');
    }
    public function person()
    {
        return $this->belongsTo('App\Person');
    }


}
