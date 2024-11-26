<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Order
 */
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
            'id'            => $this->id,
            'total_price'   => $this->total_price,
            'status'        => $this->status,
            'comment'       => $this->comment,
            'address'       => $this->address,
            'lat'           => $this->lat,
            'lng'           => $this->lng,
            'created_at'    => $this->created_at->format(DATE_TIME_FORMATE),
            'canceled_at'   => $this->canceled_at?->format(DATE_TIME_FORMATE),
            'accepted_at'   => $this->accepted_at?->format(DATE_TIME_FORMATE),
            'delivered_at'  => $this->delivered_at?->format(DATE_TIME_FORMATE),
            'courier'       => new UserResource($this->whenLoaded('courier')),
            'tariff'        => new TariffResource($this->whenLoaded('tariff')),
            'orderProducts' => OrderProductResource::collection($this->whenLoaded('orderProducts')),
        ];
    }
}
