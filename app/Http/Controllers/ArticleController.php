<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware("auth:api");
        // $this->user = new User;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return $article;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        app()->setLocale($request->get('lng'));
        $article->update([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'is_breaking' => $request->get('is_breaking'),
            'is_alert' => $request->get('is_alert'),
            'is_flash' => $request->get('is_flash'),
            'body' => $request->get('articleBody'),
            'lead' => $request->get('lead'),
            'status' => $request->get('status')
        ]);

        // $artImgs = Image::findMany($request->get('attachedImages'));
        // dump($artImgs);
        // foreach ($request->get('attachedImages') as $imgId){

        // }
        $article->images()->sync($request->get('attachedImages'));
        // $article->images()->sync();
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    /**
     * Get articles list by Category
     *
     * @param \App\Models\Category $category
     * @return void
     */
    public function getArticlesByCategory(Category $category){
        return $category->articles()->paginate(10);
    }

    /**
     * Add Article by Category
     *
     * @param Request $request
     * @param Category $category
     * @return void
     */
    public function addArticleByCategory(Request $request, Category $category){
        $request->validate([
            'lng' => 'required',
            'title' => 'required',
        ]);
        app()->setLocale($request->get('lng'));       

        return $category->articles()->create([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'category_id' => $category->id
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Article $article
     * @return void
     */
    public function addArticleImages(Request $request, Article $article){

        foreach ($request->images as $file) {
            $name = $file->getClientOriginalName();
            $image = Image::where('name', $name)->first();
            $file->storeAs('public/images', $name);
            $path = 'storage/images/' . $name;



            list($width, $height) = getimagesize(public_path($path));

            // Log::info($width . '=//=' . $height);

            if (!$image) {
                $image = Image::create([
                    'name' => $name,
                    'path' => $path,
                    'width' => $width,
                    'height' => $height
                ]);
            }

            if (!$article->images->contains($image)) {
                $article->images()->attach($image);
            }
        }

        return $article->images()->get();

    }

    public function detachArticleImages(Request $request, Article $article){
        $article->images()->detach($request->get('id'));

        return $article->images()->get();
    }

    public function getArticleImages(Article $article){
        return $article->images()->get();
    }
}
