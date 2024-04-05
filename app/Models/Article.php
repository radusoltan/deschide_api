<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public array $translatedAttributes = ['title', 'slug', 'lead', 'body', 'status', 'published_at','publish_at'];

    protected $fillable = ['category_id', 'is_flash', 'is_alert', 'is_breaking', 'old_number'];

    protected $casts = [
        'is_flash' => 'boolean',
        'is_alert' => 'boolean',
        'is_breaking' => 'boolean',
//        'related' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }



}
