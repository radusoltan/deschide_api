<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Models\Article;
use App\Models\ArticleImage;
use App\Models\Category;
use App\Services\ArticleService;
use App\Services\ImageService;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
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
        //
    }

    public function getArticleImages(Article $article) {
        return new ImageCollection($article->images);
    }

    public function addArticleImages(Request $request, Article $article) {
        foreach ($request->images as $image) {
            $image = $this->imageService->uploadImage($image);
            if (!$article->images->contains($image)) {
                $article->images()->attach($image);
            }
        }

        if ($article->images()->count() === 1) {
            $image = $article->images()->first();
            $mainImage = ArticleImage::where('article_id',$article->id)
                ->where('image_id',$image->id)->first();
            $mainImage->setMain();
//            $this->imageService->saveImageThumbnails($image);
        }

        return new ArticleResource($article);
    }
}
