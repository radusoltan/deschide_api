<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class CategoryCollection extends ResourceCollection
{

    public function toArray(Request $request){

        return [
            'data' => $this->collection,
        ];
    }

}
