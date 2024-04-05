<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'publish_at'
    ];

    public function article(){
        return $this->belongsTo(Article::class);
    }

    protected $casts = [
        'publish_at' => 'datetime',
//        'keywords' => 'json'
    ];
}
