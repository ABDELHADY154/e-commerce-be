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
                foreach ($category->products()->where('quantity', '!=', 0)->get()  as $product) {
                    if (isset($_GET['size']) && $_GET['size'] !== "") {
                        foreach ($product->sizes as  $size) {
                            if ($size->size == $_GET['size'] && $size->quantity > 0) {
                                $products[] = $product;
                            }
                        }
                    } else {
                        $products[] = $product;
                    }
                }
            }
            return $this->ok(ProductResoource::collection($products)->resolve());
        }
    }

    public function categoryProducts($catId)
    {
        $products = [];
        $category = Category::find($catId);
        foreach ($category->products()->where('quantity', '!=', 0)->get()  as $product) {
            if (isset($_GET['size']) && $_GET['size'] !== "") {
                foreach ($product->sizes as  $size) {
                    if ($size->size == $_GET['size'] && $size->quantity > 0) {
                        $products[] = $product;
                    }
                }
            } else {
                $products[] = $product;
            }
        }
        return $this->ok(ProductResoource::collection($products)->resolve());
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
        $products = Product::where('sale', false)->where('quantity', '!=', 0)->orderBy('id', 'desc')->get()->random(10);
        return $this->ok(ProductResoource::collection($products)->resolve());
    }

    public function getLatestSaleProducts()
    {
        $products = Product::where('sale', true)->where('quantity', '!=', 0)->orderBy('id', 'desc')->get()->random(10);
        return $this->ok(ProductResoource::collection($products)->resolve());
    }
}
