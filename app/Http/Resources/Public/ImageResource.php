<?php

namespace App\Http\Resources\Public;

use App\Http\Resources\ThumbnailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource {
    public function toArray(Request $request) {
        return [
                'id' => $this->id,
                'name' => $this->name,
                'path' => $this->path,
                'width' => $this->width,
                'height' => $this->height,
                'is_main' => (bool) $this->whenPivotLoaded('article_images', function () {
                    return $this->pivot->is_main;
                }),
                'source' => $this->source,
                'author' => $this->author,
                "description" => $this->description,
                'thumbnails' => ThumbnailResource::collection($this->thumbnails),
        ];
    }
}
