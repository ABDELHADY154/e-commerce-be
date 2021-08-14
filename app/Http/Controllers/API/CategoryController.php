<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\CategoryResoource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CoreJsonResponse;


    public function getCategories(Int $brandId)
    {
        $brand = Brand::find($brandId);
        if ($brand) {
            return $this->ok(CategoryResoource::collection($brand->categories)->resolve());
        }
        return $this->notFound(['Brand Not Found']);
    }
}
