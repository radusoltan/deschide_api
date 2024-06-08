<?php

namespace App\Models;

use App\Http\Resources\Public\CategoryResource;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, Searchable, SoftDeletes;
    public $translatedAttributes = ['in_menu','title','slug'];
    public $fillable = ['old_number', 'index_id'];

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function toSearchArray(){
        return new CategoryResource($this);
    }

    public function getId() {
        return $this->id;
    }

    public function vzt()
    {
        return visits($this);
    }
}
