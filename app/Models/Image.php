<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'path',
        'width',
        'height',
        'old_number',
        'author',
        'source',
        'description'
    ];

    public function articles() {
        return $this->belongsToMany(Article::class, 'article_images', 'image_id',"article_id")->withPivot('is_main');
    }

    public function thumbnails(){
        return $this->belongsToMany(Thumbnail::class, 'image_thumbnails','image_id',"thumbnail_id");
    }
}
