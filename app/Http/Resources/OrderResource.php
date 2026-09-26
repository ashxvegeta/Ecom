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
   public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'order_number'   => $this->order_number,
            'subtotal'       => $this->subtotal,
            'shipping'       => $this->shipping_charge,
            'grand_total'    => $this->grand_total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'order_status'   => $this->order_status,
            'created_at'     => $this->created_at->format('Y-m-d'),
            'items'          => OrderItemResource::collection($this->items),
        ];
    }
}
