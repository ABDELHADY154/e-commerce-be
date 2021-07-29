<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientAuthResource extends JsonResource
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
            'token' => $this['token'],
            'name' => $this['client']->name,
            'email' => $this['client']->email,
            'phone_number' => $this['client']->phone_number
        ];
    }
}
