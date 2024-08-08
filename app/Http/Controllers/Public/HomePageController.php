<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Author;
use App\Models\Category;
use App\Models\FeaturedArticlesList;
use App\Models\Image;
use App\Services\ArticleService;
use App\Services\CloudFlareService;
use App\Services\ImageService;
use Http\Client\Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image as ImageManager;

// ?items_per_page=100&type=stiri&language=ro&section=1&sort[published]=desc

class HomePageController extends Controller
{
    private $service;
    private $imageService;
    public function __construct(ArticleService $service, ImageService $imageService){
        $this->service = $service;
        $this->imageService = $imageService;
    }

    public function getArticlesFromAPI() {

        phpinfo();

    }





    private function getArticleAuthorsByNumber($number){
        $authorsUrl = "https://deschide.md/api/articles/{$number}/ro/authors.json";
        $articleAuthors = Http::withOptions(['verify' => false])->get($authorsUrl);
        dump($articleAuthors->object());
//        foreach ($articleAuthors->object()->items as $item){
//            $this->getAuthorByNumber($item->author->id);
//        }
//        return $articleAuthors;


    }



    private function getAuthorByNumber($number){
        $url = "https://deschide.md/api/authors/{$number}.json";
        $author = Http::withOptions(['verify' => false])->get($url);
        dump($author->object());

    }

    public function featuredListArticles() {

        return FeaturedArticlesList::find(1)
            ->articles()
            ->translatedIn(app()->getLocale())
            ->whereTranslation('status',"P")
            ->pluck('index_id');


    }

    public function getLastPublishedArticles() {
//        $articles = Article::whereTranslation('status', "P")
//            ->orderByTranslation('published_at', 'desc')
//            ->limit(9)
//            ->pluck("index_id");
//
//        return $this->service->getByIds($articles)->docs;
        return Article::whereTranslation('status', "P")
            ->orderByTranslation('published_at', 'desc')
            ->limit(9)
            ->pluck("index_id");
    }
}
