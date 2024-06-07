<?php

namespace Database\Seeders;

use App\Models\FeaturedArticlesList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturedArticlesListAtbleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FeaturedArticlesList::create([
            'title' => "Important",
            'max_item_count' => 9,
        ]);
    }
}
