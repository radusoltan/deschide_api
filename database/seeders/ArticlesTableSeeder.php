<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Author;
use App\Models\Category;
use App\Services\ArticleService;
use App\Services\ImageService;
use Http\Client\Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
//set_time_limit(360);
class ArticlesTableSeeder extends Seeder
{
    private $service;
    private $imageService;


    public function __construct(ArticleService $service, ImageService $imageService){
        $this->service = $service;
        $this->imageService = $imageService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {


            foreach (Category::all() as $category){
                $articlesUrl = "https://deschide.md/api/articles.json";

                try {
                    $resp = Http::withQueryParameters([
                        'language' => 'ro',
                        'section' => $category->old_number,
                        'items_per_page' => 10,
                        'sort[number]' => 'desc'
                    ])->timeout(360)
                        ->withOptions(['verify' => false])->accept('application/json')->get($articlesUrl);
                    if (!empty($resp->object()->items)){
                        foreach ($resp->object()->items as $item){
                            $old_article = $this->getArticleByNumber($item->number);
                            if (property_exists($old_article, 'number')){
                                $article = Article::where('old_number', $old_article->number)->first();
                                $authors = property_exists($old_article, 'authors') ? $old_article->authors : [];

                                $reads = intval($old_article->reads);

                                $path = parse_url($old_article->url, PHP_URL_PATH);

                                $segments = explode('/', trim($path, '/'));

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
                                        'slug' => $category->id != 11 ? Str::slug($old_article->title) : Str::slug($old_article->number.'-'.$segments[4].'-'.Str::random()),
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

                                dump($article);

                                foreach($authors as $old_author) {
                                    $path = parse_url($old_author->link, PHP_URL_PATH);
                                    // Explode the path into segments
                                    $segments = explode('/', trim($path, '/'));
                                    $author = Author::where('old_number', $segments[2])->first();
                                    if (!$article->authors->contains($author)) {
                                        $article->authors()->attach($author);
                                    }
                                }
                                $this->getArticleImagesByNumber($old_article->number, app()->getLocale());
                            }
                        }
                    }
                } catch (Exception $exception){
                    dump($exception->getMessage());
                }
            }
//        }





    }

    private function getArticleByNumber($number) {

        $articleUrl = "https://deschide.md/api/articles/{$number}.json";
        $article = Http::withOptions(['verify' => false])->get($articleUrl);
        if($article && !property_exists($article->object(),'errors')){
            return $article->object();
        } else {
            return new \stdClass();
        }

    }

    private function getArticleImagesByNumber($number, $locale) {
        $url = "https://deschide.md/api/articles/{$number}/{$locale}/images.json";
        $articleImages = Http::withOptions(['verify' => false])
            ->withQueryParameters([
                'items_per_page' => 10
            ])
            ->get($url);
        if(!property_exists($articleImages->object(),'errors')){
            foreach ($articleImages->object()->items as $item){

                $remoteImage = $this->getImageByNumber($item->id);

                $imageUrl = "https://deschide.md/images/{$remoteImage->basename}";

                $image = $this->imageService->uploadFromUrl($imageUrl, $remoteImage->basename);

                $image->update([
                    'description' => property_exists($remoteImage, 'description') ? $remoteImage->description : "Poza simbol",
                    'source' => property_exists($remoteImage, 'photographer') ? $remoteImage->photographer : "deschide.md",
                    'author' => property_exists($remoteImage, 'photographer') ? $remoteImage->photographer : "deschide.md",
                ]);

                $article = Article::where('old_number', $number)->first();
                if (!$article->images->contains($image)) {
                    $article->images()->attach($image);
                }

                if ($article->images()->count() >= 1) {
                    $image = $article->images()->first();
                    $mainImage = ArticleImage::where('article_id',$article->id)
                        ->where('image_id',$image->id)->first();
                    $mainImage->setMain();
                    $this->imageService->saveImageThumbnails($image);
                }

                $article->refresh();
//                $this->service->updateDoc($article);

            }
        } else {
            return new \stdClass();
        }
    }

    private function getImageByNumber($number){

        $url = "https://deschide.md/api/images/{$number}.json";
        $image = Http::withOptions(['verify' => false])->get($url);
        return $image->object();


    }
}
