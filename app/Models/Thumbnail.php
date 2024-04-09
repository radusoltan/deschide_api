<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'image_id',
        'rendition_id',
        'width',
        'height',
        'path',
        'coords'
    ];

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function rendition() {
        return $this->belongsTo(Rendition::class);
    }
}
