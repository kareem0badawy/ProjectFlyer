<?php

namespace App;

use Image;

use Illuminate\Database\Eloquent\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\HttpFoundation\File;

use Intervention\Image\ImageServiceProvider;


class Photo extends Model
{

	protected $table='flyer_photos';

	protected $fillable = ['path','name','thumbnail_path'];

	
	protected $baseDir = 'images/photos';

    public function flyer()
    {
    	return $this->belongsTo('App\Flyer');
    }
    /**
     * [named description]
     * @param  string $name
     * @return self
     */
    public static function named($name)
    {

        return (new static)->saveAs($name);
	
    }
    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(),$name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }

    public function move(UploadedFile $file)
    {
      $file->move($this->baseDir, $this->name);  //Question
    
        $this->makeThumbnail();

        return $this;
    }

    protected function makeThumbnail()
    {

        Image::make($this->path)
        ->fit(200)
        ->save($this->thumbnail_path);
    }
}
