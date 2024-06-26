<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['in_menu','title','slug'];
    protected $casts = [
        'in_menu' => 'boolean'
    ];

    public function vzt()
    {
        return visits($this);
    }
}
