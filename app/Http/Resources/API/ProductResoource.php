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
            'price' => $this->price,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
            'images' => ProductImageResource::collection($this->images)

        ];
    }
}
