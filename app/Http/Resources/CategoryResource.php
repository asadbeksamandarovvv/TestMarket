<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Category
 */
class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'image'          => new AttachmentResource($this->whenLoaded('image')),
            'sub_categories' => CategoryResource::collection($this->whenLoaded('children')),
            'products'       => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
