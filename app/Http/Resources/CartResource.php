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
            'id'         => $this->id,
            'quantity'   => $this->quantity,
            'price'      => $this->price,
            'product'    => [
                'id'    => $this->product->id,
                'name'  => $this->product->name,
                'brand' => $this->product->brand->name ?? '',
                'image' => $this->product->productImages->first()->image_path ?? '',
            ],
            'stock'      => $this->productItem->stock ?? 0,
        ];
    }
}
