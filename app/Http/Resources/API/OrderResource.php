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
        return [
            'id' => $this->id,
            'order_num' => $this->order_num,
            'status' => $this->status,
            'quantity' => count($this->products),
            'created_at' => date("Y-m-d", $this->created_at->timestamp),
            'price' => $this->price,
            'delivery' => $this->delivery,
            'total_price' => $this->total_price,
            'payment_method' => $this->payment_method,
            'products' => ProductResoource::collection($this->products),
            'address' => $this->address,
        ];
    }
}
