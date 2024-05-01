<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ArticlessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $startDate = '-1 year'; // Data de start (de exemplu, acum un an)
        $endDate = 'now'; // Data de sfârșit (de exemplu, acum)
        for ($i=0;$i<300;$i++){
            /**
             * (integer) - The number of paragraphs to generate.
             * short, medium, long, verylong - The average length of a paragraph.
             * decorate - Add bold, italic and marked text.
             * link - Add links.
             * ul - Add unordered lists.
             * ol - Add numbered lists.
             * dl - Add description lists.
             * bq - Add blockquotes.
             * code - Add code samples.
             * headers - Add headers.
             * allcaps - Use ALL CAPS.
             * prude - Prude version.
             * plaintext - Return plain text, no HTML.
             */
            $body = Http::get('https://loripsum.net/api/5/headers/link/ul/ol/bq/decorate');
            $lead = Http::get('https://loripsum.net/api/1/link/decorate');
            app()->setLocale('ro');
            $title = '// RO //'.fake()->sentence();

            $article = Article::create([
                'category_id' => fake()->randomKey(Category::pluck('id','id')->all()),
                'title' => $title,
                'slug' => Str::slug($title),
                'lead' => $lead->body(),
                'body' => $body->body(),
                'status' => "P",
                'is_breaking' => false,
                'is_alert' => false,
                'is_flash' => false,
                'published_at' => $faker->dateTimeBetween($startDate, $endDate),
            ]);

            app()->setLocale('en');
            $title = '// EN //'.fake()->sentence();
            $article->update([
                'title' => $title,
                'slug' => Str::slug($title),
                'lead' => $lead->body(),
                'body' => $body->body(),
                'status' => "P",
                'is_breaking' => false,
                'is_alert' => false,
                'is_flash' => false,
                'published_at' => $faker->dateTimeBetween($startDate, $endDate),
            ]);
            app()->setLocale('ru');
            $title = '// RU //'.fake()->sentence();
            $article->update([
                'title' => $title,
                'slug' => Str::slug($title),
                'lead' => $lead->body(),
                'body' => $body->body(),
                'status' => "P",
                'is_breaking' => false,
                'is_alert' => false,
                'is_flash' => false,
                'published_at' => $faker->dateTimeBetween($startDate, $endDate),
            ]);

        }
    }
}
