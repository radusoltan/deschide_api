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
            'published_at' => $this->publish_at,
            'authors' => AuthorResource::collection($this->authors),
            'images' => ImageResource::collection($this->images)
        ];
    }
}
