<?php

namespace App\Events;

use App\Models\Attachment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttachmentDestroyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public array|int|Attachment|Collection $files)
    {
    }
}
