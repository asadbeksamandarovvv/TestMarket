<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'name_ru'        => $this->name_ru,
            'description'    => $this->description,
            'description_ru' => $this->description_ru,
            'selling_price'  => $this->selling_price,
            'liked'          => $this->liked ?? false,
            'category'       => new CategoryResource($this->whenLoaded('category')),
            'brand'          => new BrandResource($this->whenLoaded('brand')),
            'image'          => new AttachmentResource($this->whenLoaded('image')),
            'discount'       => new DiscountProductResource($this->whenLoaded('discount')),
        ];
    }
}
