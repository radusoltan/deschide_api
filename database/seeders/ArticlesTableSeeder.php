<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_1.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_2.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_3.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_4.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_5.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_6.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_7.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_8.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_10.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_15.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_17.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_20.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_22.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_23.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_24.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_25.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_26.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }


        app()->setLocale('en');

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_1.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_2.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_3.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_4.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_5.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_6.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_7.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_8.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_10.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_en_section_15.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => $slug[0],
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        app()->setLocale('ru');

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_1.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_2.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_3.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_4.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_5.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_6.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_7.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_8.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_10.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_15.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_20.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_21.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_22.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

        $data = json_decode(file_get_contents(base_path('data/articles_language_ru_section_23.json')));

        foreach ($data->items as $old_article) {


            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();
            // Verificăm dacă proprietatea 'authors' există și nu este null
            $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
            $path = parse_url($old_article->url, PHP_URL_PATH);
            $segments = explode('/', $path);
            $slug = explode('.', $segments[5]);

            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            } else {
                $article->update([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead ?? null,
                    'body' => $old_article->fields->Continut ?? null,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                    'is_live' => false,
                    'embed' => $old_article->fields->Embed ?? null,
                ]);
            }

            foreach($authors as $old_author) {
                $path = parse_url($old_author->link, PHP_URL_PATH);
                // Explode the path into segments
                $segments = explode('/', trim($path, '/'));
                $author = Author::where('old_number', $segments[2])->first();
                if (!$article->authors->contains($author)) {
                    $article->authors()->attach($author);
                }
            }

            visits($article)->increment(intval($old_article->reads));

        }

    }
}
