<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;


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
     *  Find the flyer at the given address.
     *
     * @param   string   $zip      
     * @param   string   $street   
     * @return  Builder            
     */

    public static function locatedAt($zip,$street)
    {
       
         $street = str_replace('-', ' ', $street );

         return static::where(compact('zip','street'))->firstOrFail();
    }

    public function getPriceAttribute($price)
    {
       
         return '$ ' . number_format($price);
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }
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
    /**
     * Aflyer is owned by a user .
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Determine if the given created the flyer.
     * @param  Uesr $user 
     * @return boolean
     */
    public function ownedBy(Uesr $user)
    {
        return $this->$user_id == $user_id;
    }

}
