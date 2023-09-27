<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'user' => auth('api')->user()->name,
           'Product' => $this->product_id,
            'Price' => $this->price,
            'Quantity' => $this->quantity,
            'Sub_Total' =>  $this->subtotal
        ];
    }

}
