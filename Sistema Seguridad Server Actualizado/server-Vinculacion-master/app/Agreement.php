<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * $table->increments('id');
        $table->integer('entity_id')->unsigned();
        $table->foreign('entity_id')->references('id')->on('entities');
        $table->integer('project_id')->unsigned();
        $table->foreign('project_id')->references('id')->on('projects');
        $table->string('state');
        $table->string('route_file1');
        $table->string('route_file2');
        $table->string('route_file3');
        $table->timestamps();
     */
    protected $fillable = [
        'state',
        'route_file3',
        'route_file2',
        'route_file3'
    ];

    public function entity()
    {
        return $this->belongsTo('App\Entity');
    }

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }



}
