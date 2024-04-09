<?php

namespace App\Services;

use App\Models\Thumbnail;
use App\Models\Rendition;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image as ImageManager;
use App\Models\Image;

class ImageService {

    public function uploadImage(UploadedFile $file) {
        $name = $file->getClientOriginalName();
        $imageFile = ImageManager::read($file->getRealPath());
        $destinationPath = storage_path('app/public/images/'.$name);
        $imageFile->save($destinationPath);

        $image = Image::where('name', $name)->first();
        if (!$image){
            $image = Image::create([
                'name' => $name,
                'path' => 'storage/images/',
                'width' => $imageFile->width(),
                'height' => $imageFile->height(),
            ]);
        }
        $this->saveImageThumbnails($image);
        return $image;
    }

    public function saveImageThumbnails(Image $image){
        $file = file_get_contents(public_path($image->path.'/'.$image->name));
        foreach (Rendition::all() as $rendition){
            $img = ImageManager::read($file);
            $destinationPath = storage_path('app/public/images/thumbnails/');

            $thumb = Thumbnail::where('rendition_id', $rendition->id)
                ->where('image_id', $image->id)
                ->first();
            $cropped = $img->crop($img->width(), $img->height())
                ->save($destinationPath.$rendition->name.'_'.$image->name, 100,'jpg');
            if (!$thumb){
                Thumbnail::create([
                    'rendition_id' => $rendition->id,
                    'width' => $cropped->width(),
                    'height' => $cropped->height(),
                    'path' => '/storage/images/thumbnails/'.$rendition->name.'_'.$image->name
                ]);
            }
            if (!$image->thumbnails->contains($thumb)){
                $image->thumbnails()->attach($thumb);
            }
        }
    }
}
