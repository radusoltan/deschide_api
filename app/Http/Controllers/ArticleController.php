<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
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
        return response()->json([
            'request' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response()->json([
            'article' => $article
        ]);
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
        $request->validate([
            'title' => 'required|string'
        ]);
        app()->setLocale($request->get('lng'));
        $article->update([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title'))
        ]);

        return response()->json($article);
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

    public function articleImages(Article $article)
    {
        return response()->json($article->images());
    }

    public function addArticleImages(Request $request, Article $article)
    {
        $request->validate([
            // 'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);



        foreach ($request->images as $file) {
            $name = $file->getClientOriginalName();
            $image = Image::where('name', $name)->first();
            $file->storeAs('public/images', $name);
            $path = 'storage/images/' . $name;



            list($width, $height) = getimagesize(public_path($path));

            Log::info($width . '=//=' . $height);

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


        return response()->json([
            // 'image' => $image,
            'images' => $article->images()->get()
        ]);
    }

    public function detachImage(Request $request, Article $article)
    {
        $article->images()->detach();

        return response()->json([
            'iamge' => $request->image
        ]);
    }
}
