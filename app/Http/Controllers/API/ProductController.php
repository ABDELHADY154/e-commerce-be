<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Brand;
use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\ProductResoource;
use App\Product;
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

    public function favoriteProduct(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);
        $client = Client::where('id', auth('api')->id())->first();
        $product = Product::find($request->product_id);
        if ($product) {
            $client->favorite($product);
        }
        return $this->ok(['product favorited successfully']);
    }

    public function unFavoriteProduct(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);
        $client = Client::where('id', auth('api')->id())->first();
        $product = Product::find($request->product_id);
        if ($product) {
            $client->unfavorite($product);
        }
        return $this->ok(['product favorited successfully']);
    }

    public function getFavoritedProducts()
    {
        $products = [];
        $client = Client::find(auth('api')->id());
        $favorites = $client->favorites;
        foreach ($favorites as $fav) {
            $products[] = Product::find($fav->favoriteable_id);
        }
        return $this->ok(ProductResoource::collection($products)->resolve());
    }

    public function getProduct(Int $id)
    {
        $product = Product::find($id);
        if ($product) {
            return $this->ok((new ProductResoource($product))->resolve());
        }
        return $this->notFound(['product not found']);
    }

    public function getLatestNewProducts()
    {
        $products = Product::where('sale', false)->orderBy('id', 'desc')->get()->random(10);
        return $this->ok(ProductResoource::collection($products)->resolve());
    }

    public function getLatestSaleProducts()
    {
        $products = Product::where('sale', true)->orderBy('id', 'desc')->get()->random(10);
        return $this->ok(ProductResoource::collection($products)->resolve());
    }
}
