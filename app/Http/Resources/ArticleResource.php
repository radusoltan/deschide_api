<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'lead' => $this->lead,
            'body' => $this->body,
            'status' => $this->status,
            'is_flash' => $this->is_flash,
            'is_alert' => $this->is_alert,
            'is_breaking' => $this->is_breaking,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'publish_at' => $this->publish_at,
            'is_locked' => $this->is_locked,
            'authors' => AuthorResource::collection($this->authors),
            'images' => ImageResource::collection($this->images),
            'translations' => $this->translations()->get(),
            'is_live' => $this->is_live,
            'embed' => $this->embed,
            'keywords' => $this->keywords,
            'visits' => $this->vzt()->count()
        ];
    }
}
