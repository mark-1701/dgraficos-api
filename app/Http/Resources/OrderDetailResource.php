<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'product_customonization_id' => $this->product_customonization_id,
            'quantity' => $this->quantity,
            'product' => $this->product,
            'order' => $this->order,
            'product_customization' => $this->product_customization
        ];
    }
}
