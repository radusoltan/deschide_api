<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Image as ImageIntervention;

class ImageService
{
    private $image;
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function getImageSize()
    {
        $path = public_path($this->image->path);
        // $img = ImageIntervention::make($path);
        // Log::info(json_encode($img->width()));
        // Log::info(json_encode($img->height()));

        //
        return [
            ImageIntervention::make($path)->width(),
            ImageIntervention::make($path)->height()
        ];
    }

    public function generateThumb(Image $image)
    {
        $path = public_path($image->path);

        $img = ImageIntervention::make($path);

        Log::info(json_encode($img));
    }
}
