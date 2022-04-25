<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        return Category::paginate(10);
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
        app()->setLocale($request->get('lng'));
        try {
            return Category::create([
                'title' => $request->get('title'),
                'slug' => Str::slug($request->get('title')),
                'in_menu' => $request->get('in_menu')
            ]);

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
        return $category;
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
        app()->setLocale($request->get('lng'));
        $category->update([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'in_menu' => $request->get('in_menu')
        ]);
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return $category->delete();
    }

    public function translate(Request $request,Category $category){
        
        app()->setLocale($request->get('lng'));
        $category->update([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title'))
        ]);
        return $category;
    }

    public function updateCategoryStatus (Request $request,Category $category){
        // dump();
        $category->update([
            'in_menu' => $request->get('in_menu') 
        ]);

        return $category;
    }
}
