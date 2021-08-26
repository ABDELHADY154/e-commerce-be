<?php

namespace App\Http\Resources\API;

use App\ProductSize;
use Illuminate\Http\Resources\Json\JsonResource;

class CartProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->pivot->quantity,
            'size' => (new ProductSizeResource(ProductSize::find($this->pivot->size_id)))->resolve(), //ProductSize::find($this->pivot->size_id)->size,
            'price' => $this->total_price,
            'images' => ProductImageResource::collection($this->images)->resolve(),
        ];
    }
}
