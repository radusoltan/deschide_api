<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'width', 'height', 'aspect'];

    public function thumbnails() {
        return $this->hasMany(Thumbnail::class);
    }
}
