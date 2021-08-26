<?php

namespace App\Http\Resources\API;

use App\ProductSize;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'total_price' => $this->total_price,
            'quantity' => $this->quantity,
            'products' => CartProductsResource::collection($this->products)->resolve()
        ];
    }
}
