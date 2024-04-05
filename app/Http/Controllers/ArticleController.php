<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
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
        try {
            $article = $category->articles()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $category->id,
                'status' => 'N'
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
    public function show(Article $article)
    {
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
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
