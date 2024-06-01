<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ImportController extends Controller {

  public function index() {

      app()->setLocale('en');
      dump(app()->getLocale());
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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

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
          } else {
              $article->update([
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

          visits($article)->increment(intval($old_article->reads));

      }



  }

    public function categories() {
        $data = json_decode(file_get_contents(__DIR__ . '/../../categories.json'));

        foreach ($data as $locale => $categories){
            app()->setLocale($locale);
            $locale = app()->getLocale();

            dump($locale);

            foreach ($categories as $old_category){

                $category = Category::where('old_number', $old_category->number)->first();

                if(!$category) {
                    $category = Category::create([
                        'old_number' => $old_category->number,
                        'title' => $old_category->title,
                        'slug' => Str::slug($old_category->title),
                        'in_menu' => true,
                    ]);
                }

                $category->update([
                    'old_number' => $old_category->number,
                    'title' => $old_category->title,
                    'slug' => Str::slug($old_category->title),
                    'in_menu' => true,
                ]);

            }
        }
    }

  private function getFields($obj) {
      dump($obj);
      return [
          'title' => $obj->titlu,
      ];
  }

}
