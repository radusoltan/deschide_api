<?php

namespace App\Models;

use App\Http\Resources\ArticleResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
//    use Searchable;

    public array $translatedAttributes = [
        'title',
        'slug',
        'lead',
        'body',
        'status',
        'published_at',
        'is_locked',
        'locked_by_user',
        'is_flash',
        'is_alert',
        'is_breaking',
        'publish_at'
    ];

    protected $fillable = ['category_id','old_number'];

    protected $casts = [
        'is_flash' => 'boolean',
        'is_alert' => 'boolean',
        'is_breaking' => 'boolean',
//        'related' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function authors() {
        return $this->belongsToMany(Author::class, 'article_authors', "article_id", "author_id");
    }

    public function images(){
        return $this->belongsToMany(Image::class, 'article_images')->withPivot('is_main');
    }


    public function toSearchArray() {
        return new ArticleResource($this);
    }

    public function getSearchIndex() {
        return $this->getTable();
    }

    public function getSearchType() {
        return '_doc';
    }

    public function getId() {
        return $this->id;
    }

}
