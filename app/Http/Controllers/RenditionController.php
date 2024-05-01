<?php

namespace App\Http\Controllers;

use App\Http\Resources\RenditionsResource;
use App\Models\Rendition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RenditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('page')){
            return RenditionsResource::collection(Rendition::paginate(10));
        } else {
            return RenditionsResource::collection(Rendition::all());
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
        $data = $request->validate([
            'name' => 'required|string',
            'width' => 'required|integer',
            'height' => 'required|integer',
        ]);

        $imageUrl = 'https://dummyimage.com/'.$data['width'].'x'.$data['height'];

        list($width, $height) = getimagesize($imageUrl);

        $ratio = $width / $height;
        $rendition = Rendition::create([
            'name' => $data['name'],
            'width' => $data['width'],
            'height' => $data['height'],
            'aspect' => $ratio,
        ]);
        return new RenditionsResource($rendition);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rendition $rendition)
    {
        return new RenditionsResource($rendition);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rendition $rendition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rendition $rendition)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'width' => 'required|integer',
            'height' => 'required|integer',
        ]);
        $imageUrl = 'https://dummyimage.com/'.$data['width'].'x'.$data['height'];

        list($width, $height) = getimagesize($imageUrl);

        $ratio = $width / $height;
        $rendition->update([
            'name' => $data['name'],
            'width' => $data['width'],
            'height' => $data['height'],
            'aspect' => $ratio,
        ]);
        return new RenditionsResource($rendition);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rendition $rendition)
    {
        return $rendition->delete();
    }
}
