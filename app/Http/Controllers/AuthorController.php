<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locale = App::getLocale();
        return new AuthorCollection(Author::translatedIn($locale)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|unique:authors,email',
//            'locale' => 'required'
        ]);

        $author = Author::create([
            'email' => $request->get('email'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'full_name' => $request->get('first_name').' '.$request->get('last_name'),
            'slug' => Str::slug($request->get('first_name').' '.$request->get('last_name'))
        ]);

        return new AuthorResource($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $author->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            "full_name" => $request->get('first_name').' '.$request->get('last_name'),
            'slug' => Str::slug($request->get('first_name').' '.$request->get('last_name')),
            'email' => $request->get('email')
        ]);

        return new AuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        return $author->delete();
    }
}
