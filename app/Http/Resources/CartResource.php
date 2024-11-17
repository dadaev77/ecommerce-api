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
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'items' => CartItemResource::collection($this->items),
            'total_price' => $this->items->sum(fn($item) => $item->quantity * $item->product->price),
        ];
    }
}
