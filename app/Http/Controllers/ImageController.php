<?php

namespace App\Http\Controllers;

use App\Http\Resources\ThumbnailResource;
use App\Models\Image;
use App\Models\Rendition;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    private $imageService;
    public function __construct(ImageService $imageService){
        $this->imageService = $imageService;
    }

    public function crop(Request $request, Image $image) {
        $rendition = Rendition::find($request->get('rendition'));
        $crop = $request->get('crop');
        return $this->imageService->crop($image, $rendition, $crop);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }

    public function getImageThumbnails(Image $image){
        return ThumbnailResource::collection($image->thumbnails);
    }
}
