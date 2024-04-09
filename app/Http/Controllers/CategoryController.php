<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locale = app()->getLocale();
        return new CategoryCollection(Category::translatedIn($locale)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'in_menu' => 'boolean',
            'old_number' => 'integer'
        ]);

        $category = Category::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'in_menu' => $data['in_menu'],
            'old_number' => $data['old_number'] ?? null
        ]);

        return new CategoryResource($category);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            'in_menu' => $request->get('in_menu') ?? false
        ]);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
