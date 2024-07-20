<?php

namespace App\Http\Resources\Public;

use App\Http\Resources\ArticleTranslationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource {
    public function toArray(Request $request) {
        return [
            'article_id' => $this->id,
            'category' => [
                'id' => $this->category->getId(),
                'title' => $this->category->title,
                'slug' => $this->category->slug,
                'in_menu' => $this->category->in_menu,
                'translations' => $this->category->translations,
            ],
            'translations' => ArticleTranslationResource::collection($this->translations),
            'visits' => $this->vzt()->count(),
            'images' => ImageResource::collection($this->images),
            'is_video' => $this->is_video,
            'authors' => $this->authors()->get(),
        ];
    }
}
