<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedArticlesList extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ['title', 'max_item_count','count'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_featured_articles_list');
    }
}
