<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{

     /**
     *  Fillable fields for a flyer.
     *
     * @var array
     * 
     */

    protected $fillable = [
        'street',      
        'city',       
        'zip' ,       
        'state',      
        'country',    
        'price',      
        'description'
    ];


	 /**
     * A Flyer is composed of many photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 
     */

    public function photos()
    {
    	return $this->hasMany('App\Photo');
    }
}
