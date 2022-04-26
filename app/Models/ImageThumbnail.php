<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageThumbnail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['image_id','rendition_id','path'];
}
