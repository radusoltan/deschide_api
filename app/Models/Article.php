<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Article extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['title','slug','lead','body'];
    protected $fillable = ['category_id','is_flash','is_alert','is_breaking','status','published_at'];
    protected $casts = [
        'is_flash' => 'boolean',
        'is_alert' => 'boolean',
        'is_breaking' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
