<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity_type extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * $table->increments('id');
        $table->string('name_type');
        $table->timestamps();
     */
    protected $fillable = [
        'name_type'
    ];

    public function entities()
    {
        return $this->hasMany('App\Entity');
    }

}
