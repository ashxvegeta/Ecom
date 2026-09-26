<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'product_name' => $this->product_name,
            'price'        => $this->price,
            'quantity'     => $this->quantity,
            'total'        => $this->total,
            'image'        => $this->product->productImages->first()->image_path ?? '',
            'brand'        => $this->product->brand->name ?? '',
        ];
    }
}
