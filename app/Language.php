<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'written_level',
        'spoken_level',
        'reading_level',
        'state',
    ];

    public function profsesional()//singular minusculas
    {
        return $this->belongsTo('App\Professional');//ruta y nombre de los modelos
    }

}
