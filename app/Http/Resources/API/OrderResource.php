<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $quantity = 0;
        foreach ($this->products as $product) {
            // dd();
            $quantity += $product->pivot->quantity;
        }
        return [
            'id' => $this->id,
            'order_num' => $this->order_num,
            'status' => $this->status,
            'quantity' => $quantity,
            'created_at' => date("Y-m-d", $this->created_at->timestamp),
            'price' => $this->price,
            'delivery' => $this->delivery,
            'total_price' => $this->total_price,
            'payment_method' => $this->payment_method,
            'products' => CartProductsResource::collection($this->products),
            'address' => $this->address,
        ];
    }
}
