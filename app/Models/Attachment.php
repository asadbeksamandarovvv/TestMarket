<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\URL;

class Attachment extends Model
{
    use Prunable;

    protected $fillable = [
        'display_name',
        'extra_identifier',
        'type',
        'size',
        'path_original',
        'path_1024',
        'path_512',
        'attachment',
        'sequence',
    ];

    public function prunable()
    {
        return $this
            ->whereNull('attachment_id')
            ->where('created_at', '<', now()->subDay());
    }

    public function urlOriginal(): Attribute
    {
        return Attribute::make(fn(): string => URL::to($this->path_original));
    }

    public function getUrl1024Attribute(): ?string
    {
        return $this->attributes['path_1024'] ? URL::to($this->attributes['path_1024']) : null;
    }

    public function getUrl512Attribute(): ?string
    {
        return $this->attributes['path_512'] ? URL::to($this->attributes['path_512']) : null;
    }

    public function attachment(): MorphTo
    {
        return $this->morphTo();
    }
}
