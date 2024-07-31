<?php

namespace App\Services;

use App\Http\Resources\ThumbnailResource;
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
        $imageFile->save($destinationPath,quality: 10, progressive: true);

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

    public function uploadFromUrl($url, $name) {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $response = file_get_contents($url, false, stream_context_create($arrContextOptions));

        $img = ImageManager::read($response);

        $destinationPath = storage_path('app/public/images/'.$name);
        $img->save($destinationPath,quality: 10, progressive: true);

        $image = Image::where('name', $name)->first();
        if (!$image){
            $image = Image::create([
                'name' => $name,
                'path' => 'storage/images/',
                'width' => $img->width(),
                'height' => $img->height(),
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

            $thumb = Thumbnail::where([
                ['rendition_id', $rendition->id],
                ['image_id', $image->id],
            ])->first();
            $cropped = $img->crop($img->width(), $img->height())
                ->save($destinationPath.$rendition->name.'_'.$image->name, 80,'jpg');
            if (!$thumb){
                Thumbnail::create([
                    'image_id' => $image->id,
                    'rendition_id' => $rendition->id,
                    'width' => $cropped->width(),
                    'height' => $cropped->height(),
                    'path' => '/storage/images/thumbnails/'.$rendition->name.'_'.$image->name,
                ]);
            }
            if (!$image->thumbnails->contains($thumb)){
                $image->thumbnails()->attach($thumb);
            }
        }
    }

    public function crop(
        Image $image,
        Rendition $rendition,

        array $crop,
        Thumbnail $thumbnail,
    ){
        $name = $image->name;
        $destinationPath = storage_path('app/public/images/thumbnails/');

        $img = ImageManager::read(public_path('/storage/images/'.$name));

        $width = round($image->width / 100 * $crop['p']['width']);
        $height = round($image->height / 100 * $crop['p']['height']);
        $x = round($image->width / 100 * $crop['p']['x']);
        $y = round($image->height / 100 * $crop['p']['y']);

        $cropped = $img->crop($width, $height, $x, $y)
            ->resize($rendition->width, $rendition->height)
            ->save($destinationPath.$rendition->name.'_'.$name, 80,'jpg');


        if (!$thumbnail){
            Thumbnail::create([
                'image_id' => $image->id,
                'rendition_id' => $rendition->id,
                'width' => $cropped->width(),
                'height' => $cropped->height(),
                'path' => 'storage/images/thumbnails/'.$rendition->name.'_'.$name,
                'coords' => json_encode($crop),
            ]);
        } else {
            $thumbnail->update([
                'image_id' => $image->id,
                'rendition_id' => $rendition->id,
                'width' => $cropped->width(),
                'height' => $cropped->height(),
                'path' => 'storage/images/thumbnails/'.$rendition->name.'_'.$name,
                'coords' => json_encode($crop),
            ]);
        }
        if (!$image->thumbnails->contains($thumbnail)){
            $image->thumbnails()->attach($thumbnail);
        }
        $image->refresh();
        return new ThumbnailResource($thumbnail);
    }


}
