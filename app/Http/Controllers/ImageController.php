<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageCollection;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ThumbnailResource;
use App\Models\Image;
use App\Models\Rendition;
use App\Models\Thumbnail;
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
        $thumbnail = Thumbnail::find($request->get('thumbnail'));
        $crop = $request->get('crop');
        if (!$thumbnail){
            $thumbnail = Thumbnail::create([
                'image_id' => $image->id,
                'rendition_id' => $rendition->id,
                'width' => 1200,
                'height' => 630,
                'path' => 'storage/images/thumbnails/'.$rendition->name.'_'.$image->name,
                'coords' => json_encode($crop)
            ]);
        }
        return $this->imageService->crop($image, $rendition, $crop, $thumbnail);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ImageCollection(Image::paginate());
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
        return new ImageResource($image);
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
        return $image->update([
            'source' => $request->get('source'),
            'author' => $request->get('author'),
            'description' => $request->get('description'),
        ]);
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
