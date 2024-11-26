<?php

namespace App\Http\Resources;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Attachment */
class AttachmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'url_original'     => $this->url_original,
            'url1024'          => $this->url1024,
            'url512'           => $this->url512,
            'display_name'     => $this->display_name,
            'extra_identifier' => $this->extra_identifier,
            'size'             => $this->size,
            'type'             => $this->type,
        ];
    }
}
