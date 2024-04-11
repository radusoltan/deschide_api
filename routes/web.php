<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('radu', function (){



    $categories = json_decode(file_get_contents(__DIR__.'/categories.json'));

    foreach($categories->items as $item) {
        $category = Category::where('old_number', $item->number)->first();
        if($item->language === app()->getLocale()) {

            if(!$category) {
                Category::create([
                    'title' => $item->title,
                    'old_number' => $item->number,
                    'slug' => \Illuminate\Support\Str::slug($item->title),
                ]);
            }
        } else if($item->language === 'en') {
            app()->setLocale('ru');
            $category->update([
                'title' => $item->title,
                'slug' => \Illuminate\Support\Str::slug($item->title),
            ]);
        }
    }

});
