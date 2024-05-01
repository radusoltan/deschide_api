<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'locale' => $this->locale,
            'slug' => $this->slug,
            'is_breaking' => $this->is_breaking,
            'is_flash' => $this->is_flash,
            'is_alert' => $this->is_alert,
            'title' => $this->title,
            'body' => $this->body,
            'lead' => $this->lead,
            'published_at' => $this->published_at
        ];
    }
}
