<?php

namespace App\Http\Resources;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin OrderProduct
 */
class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'product'     => new ProductResource($this->whenLoaded('product')),
            'quantity'    => $this->quantity,
            'price'       => $this->price,
            'total_price' => $this->total_price,
        ];
    }
}
