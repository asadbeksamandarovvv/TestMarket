<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'fullName' => $this->full_name,
            'phone'    => $this->phone_number,
            'image'    => new AttachmentResource($this->whenLoaded('image')),
        ];
    }
}
