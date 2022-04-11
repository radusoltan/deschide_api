<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Article;
use Illuminate\Support\Facades\File;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'path', 'width', 'height'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_image', 'article_id');
    }
}
