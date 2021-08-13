<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Brand;
use App\Gender;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\BrandResource;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use CoreJsonResponse;

    public function getMenBrands()
    {
        $gender = Gender::where('gender_name', 'Men')->first();
        $brands = $gender->brands;
        return $this->ok((BrandResource::collection($brands))->resolve());
    }

    public function getWomenBrands()
    {
        $gender = Gender::where('gender_name', 'Women')->first();
        $brands = $gender->brands;
        return $this->ok((BrandResource::collection($brands))->resolve());
    }
}
