<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeaturedArticlesListCollection;
use App\Http\Resources\FeaturedArticlesListResource;
use App\Models\Article;
use App\Models\FeaturedArticlesList;
use Illuminate\Http\Request;

class FeaturedArticlesListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!request()->has('page')){
            return new FeaturedArticlesListCollection(FeaturedArticlesList::all());
        } else {
            return new FeaturedArticlesListCollection(FeaturedArticlesList::paginate(10));
        }

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'max_item_count' => 'required|integer',
        ]);

        $list = FeaturedArticlesList::create([
            'title' => $data['title'],
            'max_item_count' => $data['max_item_count'],
        ]);
        return new FeaturedArticlesListResource($list);
    }

    /**
     * Display the specified resource.
     */
    public function show(FeaturedArticlesList $list)
    {
        return new FeaturedArticlesListResource($list);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeaturedArticlesList $featuredArticlesList)
    {
        //
    }

    public function addArticles(Request $request, FeaturedArticlesList $list) {
      $list->articles()->sync($request->get('ids'));

      $list->update([
          'count' => $list->articles->count()
      ]);

      return new FeaturedArticlesListResource($list);
    }

    public function addArticle(Request $request, FeaturedArticlesList $list) {
        $article = Article::find((int)$request->get('article'));
        if (!$list->articles->contains($article)) {
            $list->articles()->attach($article);
        }
        $list->refresh();
        $list->update([
            "count" => $list->articles->count()
        ]);


        return new FeaturedArticlesListResource($list);
    }

    public function deleteArticle(Request $request, FeaturedArticlesList $list) {
        $list->articles()->detach($request->get('article'));
        $list->update([
            "count" => $list->articles->count()
        ]);
        $list->refresh();
        return new FeaturedArticlesListResource($list);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeaturedArticlesList $list)
    {
        return $list->delete();
    }
}
