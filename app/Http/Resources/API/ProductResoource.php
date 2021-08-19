<?php

namespace App\Http\Resources\API;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->category->brand->brand,
            'price' => round($this->price, 2),
            'total_price' => round($this->total_price, 2),
            'discount' => $this->discount,
            'images' => ProductImageResource::collection($this->images)

        ];
    }
}
