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
        $test_auth = Http::get('https://deschide.md/oauth/v2/auth?client_id=2_1fps5eyseu00ckgsog40sk884wwg8s0s0gww0wwks0cs8g48wg&redirect_uri=https%3A%2F%2Fdeschide.md%2Foauth%2Fauthentication%2Fresult&response_type=token');
//dd($test_auth->body());
        foreach (config('translatable.locales') as $locale){

            app()->setLocale($locale);

            foreach (Category::all() as $category){
                $articlesUrl = "https://deschide.md/api/articles.json";

                $resp = Http::withQueryParameters([
                    'language' => $locale,
                    'section' => $category->old_number,
                    'items_per_page' => 100,
                    'sort[number]' => 'desc',
                    'type' => 'stiri',
                    'page' => 1,
                    "access_token" => "ZDNlZWYwMGE4NDY2YmZjMDk0Y2ZjMGNiY2U2MmEzNmFiYzU2ZTc4MmQzNmJlOWQ5NWI3NWI3ZDM3MTU0OWExZA"
                ])->timeout(360)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36',
                    ])
                    ->withOptions(['verify' => false])->accept('application/json')->get($articlesUrl);

                if (!is_null($resp) && property_exists($resp->object(), 'items')){
                    foreach($resp->object()->items as $item) {
                        $old_article = $this->getArticleByNumber($item->number);
                        if (property_exists($old_article, 'number')){
                            $article = Article::where('old_number', $old_article->number)->first();
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
                            $this->getArticleAuthors($article->old_number);
                            $this->getArticleImagesByNumber($old_article->number, app()->getLocale());
                        }
                    }
                }
            }
        }
    }

    public function getArticleAuthors($article){
        $locale = app()->getLocale();
        $url = "https://deschide.md/api/authors/article/{$article}/{$locale}.json";

        $resp = Http::get($url)->json();

        foreach($resp as $field) {
            if (array_key_exists('author', $field[0])){
                $author = $this->getAuthorByNumber($field[0]['author']['id']);
            } else {
                $author = Author::find(221);
            }

            $article = Article::where("old_number", $article)->first();
            if (!$article->authors->contains($author)) {
                $article->authors()->attach($author);
            }
        }
    }

    private function getAuthorByNumber($number){
        $url = "https://deschide.md/api/authors/{$number}.json";
        $author = Http::withOptions(['verify' => false])->get($url);
        $localAuthor = Author::where('old_number', $author->object()->id)->first();
        if(!$localAuthor) {
            $localAuthor = Author::create([
                'first_name' => $author->object()->firstName,
                "last_name" => $author->object()->lastName,
                "full_name" => $author->object()->firstName . ' ' . $author->object()->lastName,
                'slug' => Str::slug($author->object()->firstName . ' ' . $author->object()->lastName),
                'old_number' => $author->object()->id,
            ]);
        }
        return $localAuthor;
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
