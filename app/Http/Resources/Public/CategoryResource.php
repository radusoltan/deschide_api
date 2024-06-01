<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray(Request $request){

//        if ($this->in_menu){
            return [
                'id' => $this->getId(),
                'title' => $this->title,
                'slug' => $this->slug,
                'in_menu' => $this->in_menu,
//                'translations' => $this->translations
            ];
//        }

    }

}
