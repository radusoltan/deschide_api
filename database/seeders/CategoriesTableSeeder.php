<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = json_decode(file_get_contents(__DIR__ . '/categories.json'));

        foreach ($data as $locale => $categories) {
            app()->setLocale($locale);
            $locale = app()->getLocale();
            foreach ($categories as $old_category) {
                $category = Category::where('old_number', $old_category->number)
                    ->first();
                if (!$category) {
                    $category = Category::create([
                        'old_number' => $old_category->number,
                        'title' => ucfirst($old_category->title),
                        'slug' => Str::slug($old_category->title),
                        'in_menu' => TRUE,
                    ]);
                }

                $category->update([
                    'old_number' => $old_category->number,
                    'title' => ucfirst($old_category->title),
                    'slug' => Str::slug($old_category->title),
                    'in_menu' => TRUE,
                ]);

            }
        }

//        foreach (config('translatable.locales') as $locale){
//            app()->setLocale($locale);
//            $sectionsUrl = "https://deschide.md/api/sections.json?items_per_page=100&language={$locale}";
//
//            $sections = Http::withOptions(['verify' => false])->get($sectionsUrl);
//
//            foreach($sections->object()->items as $old_category){
//
//
//
//                $category = Category::where('old_number', $old_category->number)->first();
//                if(!$category){
//                    $category = Category::create([
//                        'old_number' => $old_category->number,
//                        'title' => ucfirst($old_category->title),
//                        'slug' => Str::slug($old_category->title),
//                        'in_menu' => true,
//                    ]);
//                }
//
//                $category->update([
//                    'old_number' => $old_category->number,
//                    'title' => ucfirst($old_category->title),
//                    'slug' => Str::slug($old_category->title),
//                    'in_menu' => true,
//                ]);
//
//            }
//
//        }
    }
}
