<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'article_images';
    protected $fillable = ['is_main'];

    public function setMain(){
        $this->is_main = true;
        $this->save();
        return $this;
    }
}
