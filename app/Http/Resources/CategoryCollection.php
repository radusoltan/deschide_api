<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Observers\CategoryTranslationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
 #[ObservedBy([CategoryTranslationObserver::class])]
class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
