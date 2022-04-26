<?php

namespace App\Services;

use Image as ImageManager;
use App\Models\Image;
use App\Models\Rendition;
use App\Models\ImageThumbnail;
class ImageService
{
    private $image;
    private $renditions;

    public function __construct(Image $image){
        $this->image = $image;
        $this->renditions = Rendition::all();
    }

    public function uploadImage($file){

        $imageFile = ImageManager::make($file->getRealPath());

        dump($imageFile);

        $name = $file->getClientOriginalName();
        $image = Image::where('name', $name)->first();
        
        $file->storeAs('public/images', $name);
        $path = 'storage/images/' . $name;

        list($width, $height) = getimagesize(public_path($path));

        $imageFile->crop($width,$height)->save('test',100,'jpg');

    }

    public function saveImageThumbnails(){

        $file = file_get_contents(public_path($this->image->path));

        $name = $this->image->name;

        foreach ($this->renditions as $rendition){            

            $img = ImageManager::make($file);

            $destinationPath = public_path('storage/images/thumbnails/');

            $img->crop($rendition->width,$rendition->height)
                ->save($destinationPath.$rendition->name.'_'.$name,100,'jpg');
            
            ImageThumbnail::create([
                'image_id' => $this->image->id,
                'rendition_id' => $rendition->id,
                'path' => 'storage/images/thumbnails/'.$rendition->name.'_'.$name
            ]);

        }        
        

    }

}