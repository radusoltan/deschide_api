<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response()->json(Category::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'lng' => 'required|string'
        ]);
        
        try {
           app()->setLocale($request->get('lng'));
                
            $category = Category::create([
                'title' => $request->get('title'),
                'slug' => Str::slug($request->get('title')),
                'in_menu' => $request->get('in_menu')
            ]);


            return response()->json($category);

        } catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string',
            'lng' => 'required|string'
        ]);

        app()->setLocale($request->get('lng'));

        $category->update([
            'title' => $request->get('title'),
            'in_menu' => $request->get('in_menu'),
            'slug' => Str::slug($request->get('title'))
        ]);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return response()->json($category->delete());
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     * 
     */
    public function publishCategory(Request $request,Category $category){
        $category->in_menu = $request->get('in_menu');
        $category->save();
        return response()->json([
            'request'=>$request->get('in_menu'),
            'category'=>$category
        ]);
    }

    /**
     * 
     * @param \App\Models\Category $category
     * @return \Illumnate\Http\Response
     * 
     */
    public function getArticles(Category $category){
        return response()->json($category->articles()->paginate(10));
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * 
     */
    public function addArticle(Request $request, Category $category){
        $request->validate([
            'title' => 'required|string',
            'lng' => 'required|string'
        ]);
        app()->setLocale($request->get('lng'));
        $article = Article::create([
            'category_id' => $category->id,
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title'))
        ]);

        return response()->json([
            'article' => $article
        ]);
    }

    public function translateCategory(Request $request, Category $category){
        app()->setLocale($request->get('lng'));

        $category->update([
            'title'=>$request->get('title'),
            'slug' => Str::slug($request->get('title'))
        ]);

        return response()->json([
            'message' => 'Success',
            'category' => $category
        ]);
    }
}
