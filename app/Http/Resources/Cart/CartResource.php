<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'session_id' => $this->session_id,
            'product_id'=> $this->product_id,
            'user_id'=> $this->user_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
