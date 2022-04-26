<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleImages;
use App\Models\Article;
use App\Models\Image;
use App\Models\ImageThumbnail;
use App\Services\ImageService;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware("auth:api");
        // $this->user = new User;
    }

    public function setMainImage(Request $request){
        $articleImage = ArticleImages::where('article_id',$request->get('article'))
            // ->where('image_id',$request->get('image'))
            ->where('is_main', true)
            ->get();
        
        if ($articleImage->count() > 0){
            foreach($articleImage as $image){

                $image->update([
                    'is_main' => false
                ]);
            }
        }

        $mainImage = ArticleImages::where('article_id',$request->get('article'))
            ->where('image_id',$request->get('image'))
            ->first();
        
        
            
        return $mainImage->setMain();
    }

    public function getImageThumbs()
    {
        $image = Image::find(5);
        $service = new ImageService($image);
        $service->getRenditionThumb($image);
    }

    public function getRenditions(Image $image){
        return ImageThumbnail::where('image_id',$image->id)
            ->join('renditions','image_thumbnails.rendition_id','=','renditions.id')
            ->select('height','width','path','name')
            ->get();



// coords: "coords"
// height: 630
// id: 1
// image_id: 9
// name: "article"
// path: "storage/images/thumbnails/article_fff.png"
// rendition_id: 1
// specs: "specs"
// width: 1200





    }

}
