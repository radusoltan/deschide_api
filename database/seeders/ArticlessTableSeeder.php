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

        app()->setLocale('ro');

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_1_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_2_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_3_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_4_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_5_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_6_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_7_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_8_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_10_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_15_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_17_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_20_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_21_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_22_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_23_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_24_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_25_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_26_ro.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        app()->setLocale('ru');

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_1_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_2_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_3_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_4_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_5_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_6_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_7_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_8_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_10_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_15_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_17_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_20_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_21_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_22_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

        $data = json_decode(file_get_contents(__DIR__ . '/articles_section_23_ru.json'));

        foreach ($data->items as $old_article) {
            $article = Article::where('old_number', $old_article->number)->first();
            $category = Category::where('old_number', $old_article->section->number)->first();


            if (!$article) {

                $article = Article::create([
                    'old_number' => $old_article->number,
                    'category_id' => $category->id,
                    'title' => $old_article->title,
                    'slug' => Str::slug($old_article->title),
                    'lead' => $old_article->fields->lead,
                    'body' => $old_article->fields->Continut,
                    'published_at' => $old_article->published,
                    'status' => $old_article->status === 'Y'? "P": "S",
                    'is_flash' => false,
                    'is_breaking' => false,
                    'is_alert' => false,
                ]);
            }
            $article->update([
                'title' => $old_article->title,
                'slug' => Str::slug($old_article->title),
                'lead' => $old_article->fields->lead,
                'body' => $old_article->fields->Continut,
                'published_at' => $old_article->published,
                'status' => $old_article->status === 'Y'? "P": "S",
                'is_flash' => false,
                'is_breaking' => false,
                'is_alert' => false
            ]);

        }

//        $faker = Faker::create();
//        $startDate = '-1 year'; // Data de start (de exemplu, acum un an)
//        $endDate = 'now'; // Data de sfârșit (de exemplu, acum)
//        for ($i=0;$i<300;$i++){
//            /**
//             * (integer) - The number of paragraphs to generate.
//             * short, medium, long, verylong - The average length of a paragraph.
//             * decorate - Add bold, italic and marked text.
//             * link - Add links.
//             * ul - Add unordered lists.
//             * ol - Add numbered lists.
//             * dl - Add description lists.
//             * bq - Add blockquotes.
//             * code - Add code samples.
//             * headers - Add headers.
//             * allcaps - Use ALL CAPS.
//             * prude - Prude version.
//             * plaintext - Return plain text, no HTML.
//             */
//            $body = Http::get('https://loripsum.net/api/5/headers/link/ul/ol/bq/decorate');
//            $lead = Http::get('https://loripsum.net/api/1/link/decorate');
//            app()->setLocale('ro');
//            $title = '// RO //'.fake()->sentence();
//
//            $article = Article::create([
//                'category_id' => fake()->randomKey(Category::pluck('id','id')->all()),
//                'title' => $title,
//                'slug' => Str::slug($title),
//                'lead' => $lead->body(),
//                'body' => $body->body(),
//                'status' => "P",
//                'is_breaking' => false,
//                'is_alert' => false,
//                'is_flash' => false,
//                'published_at' => $faker->dateTimeBetween($startDate, $endDate),
//            ]);
//
//            app()->setLocale('en');
//            $title = '// EN //'.fake()->sentence();
//            $article->update([
//                'title' => $title,
//                'slug' => Str::slug($title),
//                'lead' => $lead->body(),
//                'body' => $body->body(),
//                'status' => "P",
//                'is_breaking' => false,
//                'is_alert' => false,
//                'is_flash' => false,
//                'published_at' => $faker->dateTimeBetween($startDate, $endDate),
//            ]);
//            app()->setLocale('ru');
//            $title = '// RU //'.fake()->sentence();
//            $article->update([
//                'title' => $title,
//                'slug' => Str::slug($title),
//                'lead' => $lead->body(),
//                'body' => $body->body(),
//                'status' => "P",
//                'is_breaking' => false,
//                'is_alert' => false,
//                'is_flash' => false,
//                'published_at' => $faker->dateTimeBetween($startDate, $endDate),
//            ]);
//
//        }
    }
}
