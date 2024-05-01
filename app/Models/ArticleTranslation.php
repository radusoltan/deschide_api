<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\ArticleTranslationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([ArticleTranslationObserver::class])]

class ArticleTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
        'lead',
        'body',
        'keywords',
        'status',
        'published_at',
        'publish_at',
        'is_locked',
        'locked_by_user',
        'is_flash',
        'is_alert',
        'is_breaking'

    ];

    public function article(){
        return $this->belongsTo(Article::class);
    }

    protected $casts = [
        'is_locked' => 'boolean',
        'publish_at' => 'datetime',
        'is_flash' => 'boolean',
        'is_alert' => 'boolean',
        'is_breaking' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function vzt()
    {
        return visits($this);
    }
}
