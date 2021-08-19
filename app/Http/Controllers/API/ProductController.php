<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\ProductResoource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use CoreJsonResponse;


    public function allProducts($brandId)
    {
        $products = [];
        $brand = Brand::find($brandId);
        if ($brand) {
            $categories = $brand->categories;
            foreach ($categories as $category) {
                foreach ($category->products  as $product) {
                    $products[] = $product;
                }
            }
            return $this->ok(ProductResoource::collection($products)->resolve());
        }
    }

    public function categoryProducts($catId)
    {
        $category = Category::find($catId);
        return $this->ok(ProductResoource::collection($category->products)->resolve());
    }
}
