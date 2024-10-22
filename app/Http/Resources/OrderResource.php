<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_status_id' => $this->order_status_id,
            'user_id' => $this->user_id,
            'guest_user_id' => $this->guest_user_id,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'order_status' => $this->order_status,
            'user' => $this->user,
            'guest_user' => $this->guest_user,
            'order_details' => $this->order_details
        ];
    }
}
