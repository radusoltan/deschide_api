<?php

namespace App\Http\Controllers;

use App\Exports\ArticlesExport;
use App\Http\Resources\Public\ArticleResource;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Author;
use App\Models\Category;
use App\Models\Image;
use App\Services\ArticleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use League\Flysystem\Filesystem;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

class ImportController extends Controller {

    private $service;
    public function __construct(ArticleService $service){
            $this->service = $service;
    }

    public function import() {
        $articlesUrl = "https://deschide.md/api/articles.json";
        $data = Http::withQueryParameters([
            'language' => app()->getLocale(),
            'items_per_page' => 300,
            'type' => 'stiri',
            'sort[published]' => 'desc',
        ])->timeout(360)->withOptions(['verify' => false])->accept('application/json')->get($articlesUrl);


        $csv = Writer::createFromFileObject(new \SplTempFileObject());


        $csv->insertOne([
            'Title',
            'Slug',
            'Body',
            'Created On',
            'Published On',
            'Updated On',
            'Category',
            'Author',
            'Main Image'
        ]);

        $i = 0;

        foreach($data->object()->items as $item) {

            $row = [];

            $article = $this->getArticleByNumber($item->number);
            $images = $this->getArticleImages($item->number, 'ro');
            $authors = $item->authors;
            $section = strtoupper($item->section->title);
            $title = $item->fields->Titlu;
            $lead = $item->fields->lead;
            $body = $item->fields->Continut;
            $published = Carbon::parse($item->published)->format('m/d/Y h:i A');
            $created = Carbon::parse($item->created)->format('m/d/Y h:i A');
            $updated = Carbon::parse($item->updated)->format('m/d/Y h:i A');

            $url = $item->url;
            $path = parse_url($url, PHP_URL_PATH);
            $segments = explode('/', rtrim($path, '/'));
            $slug = pathinfo(end($segments), PATHINFO_FILENAME);

//            dump($item->renditions);

            $collection = collect($item->renditions);
            $i++;
            $mainImage = $collection->first(function ($item){

                return $item->caption === 'articlebig';
            });

            if (!is_null($mainImage)){
                $imageUrl = $mainImage->link;
            }

//
//
//            $decoded_url = urldecode(urldecode($imageUrl));
//            $image_parts = explode('|', $decoded_url);
//
//            // Extragem numele fișierului din ultima parte
//            $image_name = basename(end($image_parts));
//
            $authorsCollection = collect($item->authors);
            $names = $authorsCollection->pluck('name')->implode(', ');

            // Title,
            //Slug,
            //Collection ID,
            //Locale ID,
            //Item ID,
            //Created On,
            //Updated On,
            //Published On,
            //Main Image,
            //Short Description,
            //Lead text,
            //Video Link,
            //Content Text,
            //Category,
            //Keywords,
            //Author,
            //Is featured?,
            //Manual Data

//            $csv->insertOne([
//                'Title',
//                'Slug',
//                'Body',
//                'Created On',
//                'Published On',
//                'Updated On',
//                'Category',
//                'Author',
//                'Main Image'
//            ]);

            $row['Title'] = $title;
            $row['Slug'] = $slug;
            $row['Body'] = $body;
            $row['Created On'] = $created;
            $row['Published On'] = $published;
            $row['Updated On'] = $updated;
            $row['Category'] = $section;
            $row['Author'] = $names;
//            $row['Main Image'] = "https://deschide.md/images/".$image_name;




//            $csv->insertOne($row);
//            $i++;
//
//            Log::info('Exported article '.$item->number.' #'.$i);

        }

//        $csv->output('articles.csv');

    }

    private function getArticleImages ($number, $locale) {
        $url = "https://deschide.md/api/articles/{$number}/{$locale}/images.json";

        $articleImages = Http::withOptions(['verify' => false])
            ->withQueryParameters([
                'items_per_page' => 10
            ])
            ->get($url);
        $images = [];
        foreach ($articleImages->object()->items as $articleImage) {
            $images[] = $this->getImageByNumber($articleImage->id)->basename;
        }

        return $images;

    }

    private function getImageByNumber($number){

        $url = "https://deschide.md/api/images/{$number}.json";
        $image = Http::withOptions(['verify' => false])->get($url);
        return $image->object();


    }

  public function index() {

      app()->setLocale('ro');
      $client = new Client(env('DROPBOX_AUTH_TOKEN'));

      $adapter = new DropboxAdapter($client);

      $filesystem = new Filesystem($adapter, ['case_sensitive' => false]);
      $articlesUrl = "https://deschide.md/api/articles.json";


      $data = Http::withQueryParameters([
          'language' => app()->getLocale(),
          'items_per_page' => 900,
          'sort[published]' => 'desc',
      ])->timeout(360)->withOptions(['verify' => false])->accept('application/json')->get($articlesUrl);


      $csv = Writer::createFromFileObject(new \SplTempFileObject());

      foreach ($data->object()->items as $row) {
          $old_article = $this->getArticleByNumber($row->number);
          $remoteImage = $this->getImageByNumber($item->id);
//          $this->getArticleImagesByNumber($old_article->number, app()->getLocale());
          dump($old_article);
      }

//      if (!empty($arr)) {
//          // Alege doar cheile pe care dorești să le exporti
//          $selectedKeys = ['section.title', 'fields.Titlu', 'fields.lead', 'fields.Continut', 'updated', 'published', 'created', 'renditions.captions.original', 'reads', 'authors'];
//
//          // Crează antetul CSV pe baza cheilor selectate
//          $headers = array_map(function($key) {
//              return last(explode('.', $key)); // obține partea finală a cheii (în caz de chei complexe)
//          }, $selectedKeys);
//          $csv->insertOne($headers);
//      }
//
//      foreach ($arr as $item) {
//          dump($item);
//          $row = [];

//          // Extragem secțiunea
//          $row['section'] = $item['section']['title'] ?? '';
//
//          // Extragem titlul, lead și body din "fields"
//          $row['Titlu'] = $item['fields']['Titlu'] ?? '';
//          $row['lead'] = $item['fields']['lead'] ?? '';
//          $row['body'] = $item['fields']['Continut'] ?? '';
//
//          // Extragem numele autorilor
//          if (!empty($item['authors']) && is_array($item['authors'])) {
//              $authorNames = array_column($item['authors'], 'name');
//              $row['authors'] = implode(', ', $authorNames);
//          } else {
//              $row['authors'] = '';
//          }
//
//          // Formatarea datelor (updated, published, created) în format MM/DD/YYYY hh:mm AM/PM
//          $row['updated'] = !empty($item['updated']) ? Carbon::parse($item['updated'])->format('m/d/Y h:i A') : '';
//          $row['published'] = !empty($item['published']) ? Carbon::parse($item['published'])->format('m/d/Y h:i A') : '';
//          $row['created'] = !empty($item['created']) ? Carbon::parse($item['created'])->format('m/d/Y h:i A') : '';
//
//          // Extragem link-ul din "renditions" și îl încărcăm pe Dropbox
//          if (!empty($item['renditions']) && isset($item['renditions'][0]['link'])) {
//              $originalLink = $item['renditions'][0]['link'];
//
//              // Descărcăm imaginea
//              $imageContents = Http::get($originalLink)->body();
//
//
//              $fileName = uniqid() . '.jpg';
//              $filesystem->write($fileName, $imageContents);
//
//              $response = Http::withHeaders([
//                  'Authorization' => 'Bearer ' . env('DROPBOX_AUTH_TOKEN'),
//                  'Content-Type' => 'application/json',
//              ])->timeout(360)->post('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings', [
//                  'path' => "/$fileName",
//                  'settings' => [
//                      'access' => 'viewer',
//                      'allow_download' => true,
//                      'audience' => 'public',
//                      'requested_visibility' => 'public',
//                  ]
//              ]);
//
//              $json = $response->json();
//
//              // Transformăm link-ul pentru a fi accesibil public
//              $row['rendition_link'] = $json['url'];
//          } else {
//              $row['rendition_link'] = '';
//          }
//
//          // Inserăm rândul în CSV
//          $csv->insertOne($row);
//      }

//      $csv->output('articles.csv');

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
                'items_per_page' => 10,
            ])
            ->get($url);
        if(!property_exists($articleImages->object(),'errors')){
            foreach ($articleImages->object()->items as $item){

                $remoteImage = $this->getImageByNumber($item->id);

                $imageUrl = "https://omega.deschide.md/images/{$remoteImage->basename}";

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
                $this->service->updateDoc($article);

            }
        } else {
            return new \stdClass();
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

  public function exportCSV(){

      $articlesUrl = "https://deschide.md/api/articles.json";
//      $data = Http::withQueryParameters([
//          'language' => app()->getLocale(),
//          'items_per_page' => 300,
//          'type' => 'stiri',
//          'sort[published]' => 'desc',
//      ])->timeout(360)->withOptions(['verify' => false])->accept('application/json')->get($articlesUrl);

      $csv = Writer::createFromFileObject(new \SplTempFileObject());

      $csv->insertOne([
          'Title',
          'Slug',
          'Body',
          'Created On',
          'Published On',
          'Updated On',
          'Category',
          'Author',
          'Main Image'
      ]);

      foreach (Article::all() as $article){

          $csv->insertOne([
              $article->title,
              $article->slug,
              $article->body,
              Carbon::parse($article->created_at)->format('m/d/Y h:i A'),
              Carbon::parse($article->published_at)->format('m/d/Y h:i A'),
              Carbon::parse($article->updated_at)->format('m/d/Y h:i A'),
              strtoupper($article->category->title),
//              $article->authors()->get()->pluck('name')->implode(' ,'),
              "Deschide.md",
              is_null($article->images()->where('is_main',true)->first()) ? '' : env('APP_URL').'storage/images/'.$article->images()->where('is_main',true)->first()->name,
          ]);
      }



      $csv->output('articles.csv');
  }

}
