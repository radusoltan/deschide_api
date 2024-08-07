<?php

namespace App\Http\Controllers;

use App\Http\Resources\Public\ArticleResource;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Services\ArticleService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ImportController extends Controller {

    private $service;
    public function __construct(ArticleService $service){
            $this->service = $service;
    }

  public function index() {

      app()->setLocale('ro');
      dump(app()->getLocale());
      $data = json_decode(file_get_contents(base_path('data/articles_language_ro_section_17.json')));


      foreach ($data->items as $old_article) {


          $article = Article::where('old_number', $old_article->number)->first();
          $category = Category::where('old_number', $old_article->section->number)->first();
//          // Verificăm dacă proprietatea 'authors' există și nu este null
          $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];
          $reads = intval($old_article->reads);
          $path = parse_url($old_article->url, PHP_URL_PATH);

          $segments = explode('/', trim($path, '/'));
          dump($segments[4]);

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

          visits($article)->increment($reads);
          $this->service->updateDocVisits($article);

          foreach($authors as $old_author) {
              $path = parse_url($old_author->link, PHP_URL_PATH);
              // Explode the path into segments
              $segments = explode('/', trim($path, '/'));
              $author = Author::where('old_number', $segments[2])->first();
              if (!$article->authors->contains($author)) {
                  $article->authors()->attach($author);
              }
          }

      }
  }

    public function categories() {
        $data = json_decode(file_get_contents(__DIR__ . '/../../categories.json'));

        foreach ($data as $locale => $categories){
            app()->setLocale($locale);
            $locale = app()->getLocale();


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
