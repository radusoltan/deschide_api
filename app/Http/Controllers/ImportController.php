<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Category;

class ImportController extends Controller
{
    private $baseUrl = 'https://deschide.md/api';
    public function importCategories(){

        $locales = config('app.locales');

        foreach ($locales  as $language){
            $items = Http::get('https://deschide.md/api/sections.json?items_per_page=100&language='.$language)->json();
            foreach ($items['items'] as $category){
                app()->setLocale($category['language']);
                $category = Category::create([
                    'title' => Str::ucfirst($category['title']),
                    'slug' => Str::slug($category['title'],'-')
                ]);
            }
        }

        // $items = Http::get('https://deschide.md/api/sections.json?items_per_page=100&language=ru')->json();
        
        
    }
}
