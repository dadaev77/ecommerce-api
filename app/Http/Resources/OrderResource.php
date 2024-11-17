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
            'created_at' => $this->resource->created_at,
            'status' => $this->resource->status,
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'payment_method' => $this->resource->paymentMethod ? $this->resource->paymentMethod->name : null, // Получаем имя метода оплаты
            'total_price' => $this->resource->total_price,

        ];
    }
}
