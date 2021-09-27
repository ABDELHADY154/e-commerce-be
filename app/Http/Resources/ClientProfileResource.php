<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientProfileResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'orders' => count($this->orders()->where('status', '!=', 'canceled')->get()),
            'addresses' => count($this->addresses),
            'image' => asset('storage/clientImages/' . $this->image),
        ];
    }
}
