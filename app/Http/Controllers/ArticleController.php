<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\ImageResource;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Author;
use App\Models\Category;
use App\Models\Image;
use App\Services\ArticleService;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    private $articleService;
    private $imageService;

    public function __construct(ArticleService $articleService, ImageService $imageService) {
        $this->articleService = $articleService;
        $this->imageService = $imageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locale = app()->getLocale();
        return new ArticleCollection(Article::translatedIn($locale)->paginate(10));
    }

    public function getArticlesByCategory(Category $category) {
        $locale = app()->getLocale();
        return new ArticleCollection(
            $category
                ->articles()
                ->translatedIn($locale)
                ->paginate(10)
        );
    }

    public function addCategoryArticle(Request $request, Category $category) {
//        dd(Auth::user()->id);
        try {
            $article = $category->articles()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $category->id,
                'status' => 'N',

            ]);

            return new ArticleResource($article);
        } catch (UniqueConstraintViolationException $e){

            return response()->json($e->errorInfo, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article, ArticleService $service)
    {

        $this->articleService->lockArticle($article);

        return new ArticleResource($article);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'lead' => $request->lead,
            'body' => $request->body,
            'status' => $request->status,
            'is_flash' => $request->is_flash,
            'is_alert' => $request->is_alert,
            'is_breaking' => $request->is_breaking,
        ]);
        if ($request->has('saveType') && $request->saveType == 'close') {
            $this->articleService->unlockArticle($article);
        }
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        return $article->delete();
    }

    public function getArticleImages(Article $article) {
        $article->refresh();
        return ImageResource::collection($article->images);
    }

    public function addArticleImages(Request $request, Article $article) {
        foreach ($request->images as $image) {
            $image = $this->imageService->uploadImage($image);
            if (!$article->images->contains($image)) {
                $article->images()->attach($image);
            }
        }

        if ($article->images()->count() >= 1) {
            $image = $article->images()->first();
            $mainImage = ArticleImage::where('article_id',$article->id)
                ->where('image_id',$image->id)->first();
            $mainImage->setMain();
            $this->imageService->saveImageThumbnails($image);
        }
        $article->refresh();

        return ImageResource::collection($article->images);
    }

    public function detachArticleImage(Request $request, Article $article) {
        $article->images()->detach($request->get('id'));
        $article->refresh();
        return ImageResource::collection($article->images);
    }

    public function setMainArticleImage(Request $request, Article $article) {

        $articleImages = ArticleImage::where('article_id', $article->id)->get();
        foreach ($articleImages as $articleImage) {
            $articleImage->update([
                'is_main' => false,
            ]);
        }
        $mainImage = ArticleImage::where('article_id',$article->id)
            ->where('image_id',$request->get('image'))
            ->first();
        $mainImage->update(['is_main'=>true]);
        $image = Image::find($request->get('image'));
        return new ImageResource($image);
    }

    public function setPublishTime(Request $request, Article $article) {

        $dt = Carbon::parse($request->get('time'));
        $article->update([
            'publish_at' => $dt,
        ]);
        return new ArticleResource($article);
    }

    public function deleteEvent(Article $article) {
        $article->update([
            'publish_at' => null,
            'published_at' => null,
        ]);
        return new ArticleResource($article);
    }

    public function getArticleAuthors(Article $article) {
        return AuthorResource::collection($article->authors);
    }

    public function addArticleAuthor(Request $request, Article $article) {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:authors,email',
        ]);

        $author = Author::create([
            'email' => $request->get('email'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'full_name' => $request->get('first_name').' '.$request->get('last_name'),
            'slug' => Str::slug($request->get('first_name').' '.$request->get('last_name'))
        ]);

        if (!$article->authors->contains($author)) {
            $article->authors()->attach($author);
        }

        return new AuthorResource($author);

    }

    public function deleteArticleAuthor(Article $article, Author $author) {
        $article->authors()->detach($author);

        return AuthorResource::collection($article->authors);
    }

    public function selectArticleAuthor(Request $request, Article $article) {
        $author = Author::find($request->author);
        if (!$article->authors->contains($author)) {
            $article->authors()->attach($author);
        }
        $article->refresh();
        return AuthorResource::collection($article->authors);
    }
}
