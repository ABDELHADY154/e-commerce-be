<?php

namespace App\Http\Resources\API;

use App\Client;
use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResoource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $client = Client::find(auth('api')->id());
        $product = Product::find($this->id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'quantity' => $this->quantity,
            'brand' => $this->category->brand->brand,
            'price' => round($this->price, 2),
            'total_price' => round($this->total_price, 2),
            'sale' => $this->sale == 1 ? true : false,
            'discount' => $this->discount,
            'favourited' => $client->hasFavorited($product),
            'images' => ProductImageResource::collection($this->images),
            'sizes' => ProductSizeResource::collection($this->sizes)

        ];
    }
}
