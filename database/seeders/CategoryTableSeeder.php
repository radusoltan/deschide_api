<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'ro' => [
                'Politic',
                'Social',
                'Economic',
            ],
            'en' => [
                'Political',
                'Social',
                'Economix'
            ],
            'ru' => [
                'Политика',
                'Общество',
                'Экономика'
            ]
        ];
        foreach (config('app.languages') as $locale => $langName){
            app()->setlocale($locale);
            foreach ($categories[$locale] as $category){
                Category::create([
                    'name' => $category,
                    'slug' => Str::slug($category,'_',$locale)
                ]);
            }
        }
    }
}
